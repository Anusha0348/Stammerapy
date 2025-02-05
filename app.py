from flask import Flask, request, jsonify
from flask_cors import CORS, cross_origin
import librosa
import numpy as np
import sounddevice as sd
from transformers import Wav2Vec2Processor, Wav2Vec2Model
import torch
from tensorflow.keras.models import load_model
import threading

# Initialize Flask app
app = Flask(__name__)
CORS(app, resources={r"/*": {"origins": "*"}})  # Allow all origins

# Load models
processor = Wav2Vec2Processor.from_pretrained("facebook/wav2vec2-base-960h")
wav2vec_model = Wav2Vec2Model.from_pretrained("facebook/wav2vec2-base-960h")
model = load_model("stutter_detection_model.h5")

# Global variables
is_recording = False
audio_data = []

# Function to extract Wav2Vec2 embeddings
def extract_wav2vec_embeddings(audio, sample_rate=16000):
    inputs = processor(audio, sampling_rate=sample_rate, return_tensors="pt", padding=True)
    with torch.no_grad():
        embeddings = wav2vec_model(**inputs).last_hidden_state
    return embeddings.mean(dim=1).squeeze().numpy()

# Audio recording function
def record_audio():
    global is_recording, audio_data
    audio_data = []

    def callback(indata, frames, time, status):
        if is_recording:
            audio_data.append(indata.copy())

    with sd.InputStream(callback=callback, channels=1, samplerate=16000, dtype="float32"):
        while is_recording:
            sd.sleep(100)

# Start recording API
@app.route('/start_recording', methods=['POST'])
@cross_origin()
def start_recording():
    global is_recording
    is_recording = True
    threading.Thread(target=record_audio).start()
    return jsonify({"message": "Recording started"}), 200

# Stop recording and process API
@app.route('/stop_recording', methods=['POST'])
@cross_origin()
def stop_recording():
    global is_recording, audio_data
    is_recording = False
    
    if len(audio_data) == 0:
        return jsonify({"error": "No audio recorded"}), 400

    audio = np.concatenate(audio_data, axis=0).flatten()
    audio_embeddings = extract_wav2vec_embeddings(audio)
    prediction = model.predict(audio_embeddings.reshape(1, -1))
    
    stutter_score = float(prediction[0][0])  # Convert to standard Python float
    stutter_detected = stutter_score > 0.5
    stutter_percentage = round(stutter_score * 100, 2)  # Ensure proper rounding

    print("Stutter Score:", stutter_score)  # Debugging print
    print("Stutter Percentage:", stutter_percentage)  # Debugging print

    response = {
        "stutter_detected": bool(stutter_detected),
        "stutter_percentage": stutter_percentage
    }

    print("Response:", response)  # Debugging print

    return jsonify(response), 200

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)