<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $communication_medium = $_POST['communication_medium'];

    try {
        // Check if the appointment slot is already booked
        $stmt = $conn->prepare("SELECT * FROM appointments WHERE appointment_date = :appointment_date AND appointment_time = :appointment_time");
        $stmt->bindParam(':appointment_date', $appointment_date);
        $stmt->bindParam(':appointment_time', $appointment_time);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $message = "This date and time slot is already booked. Please choose another.";
        } else {
            // Insert the new appointment
            $stmt = $conn->prepare("INSERT INTO appointments (name, number, email, appointment_date, appointment_time, communication_medium) VALUES (:name, :number, :email, :appointment_date, :appointment_time, :communication_medium)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':number', $number);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':appointment_date', $appointment_date);
            $stmt->bindParam(':appointment_time', $appointment_time);
            $stmt->bindParam(':communication_medium', $communication_medium);

            if ($stmt->execute()) {
                $message = "Appointment booked successfully!";
            } else {
                $message = "Error: Unable to book the appointment.";
            }
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            width: 300px;
        }
        .card img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
        .card h3 {
            margin: 15px 0;
            font-size: 1.5rem;
            color: #333;
        }
        .card p {
            font-size: 1rem;
            color: #666;
        }
        .card button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        .card button:hover {
            background-color: #0056b3;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }
        .modal-content form input,
        .modal-content form select,
        .modal-content form button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .message {
            margin-top: 20px;
            font-size: 1rem;
            color: red;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="therapist.jpg" alt="Therapist Picture">
        <h3>Dr. John Doe</h3>
        <p>Specialist in Cognitive Behavioral Therapy.</p>
        <button id="bookAppointment">Book Appointment</button>
    </div>

    <div class="modal" id="appointmentModal">
        <div class="modal-content">
            <h3>Book an Appointment</h3>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="tel" name="number" placeholder="Phone Number" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="date" name="appointment_date" required>
                <input type="time" name="appointment_time" required>
                <select name="communication_medium" required>
                    <option value="" disabled selected>Communication Medium</option>
                    <option value="Zoom Call">Zoom Call</option>
                    <option value="WhatsApp Call">WhatsApp Call</option>
                </select>
                <button type="submit">Submit</button>
            </form>
            <?php if (!empty($message)) : ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const bookAppointment = document.getElementById('bookAppointment');
        const modal = document.getElementById('appointmentModal');

        bookAppointment.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>
</html>
