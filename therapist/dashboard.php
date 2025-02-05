<?php
include '../components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

$appointments = [];

try {
    $sql = "SELECT * FROM appointments ORDER BY appointment_date, appointment_time";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $appointmentId = $_POST['appointment_id'];
        $action = $_POST['action'];
        $status = ($action === 'confirm') ? 'confirmed' : 'canceled';
        $reason = isset($_POST['cancellation_reason']) ? $_POST['cancellation_reason'] : null;

        // If "Other" was selected, use the custom reason
        if ($reason === 'Other' && !empty($_POST['custom_reason'])) {
            $reason = $_POST['custom_reason'];
        }

        $updateSql = "UPDATE appointments SET status = ?, cancellation_reason = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->execute([$status, $reason, $appointmentId]);

        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { display: flex; min-height: 100vh; }
        .sidebar { width: 230px; background-color: #6a1b9a; color: white; display: flex; flex-direction: column; align-items: center; padding: 20px; }
        .sidebar ul { list-style: none; width: 100%; margin-top: 20px; }
        .sidebar ul li a { text-decoration: none; color: white; padding: 10px; margin: 10px; display: block; border-radius: 5px; text-align: center; }
        .sidebar ul li a.active, .sidebar ul li a:hover { background-color: #9c27b0; }
        .main-content { flex-grow: 1; padding: 20px; }
        header h1 { color: #6a1b9a; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        table th { background-color: #6a1b9a; color: white; }
        .confirm, .cancel { color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .confirm { background-color: #4caf50; }
        .cancel { background-color: #f44336; }
        .confirm:hover { background-color: #45a049; }
        .cancel:hover { background-color: #e53935; }

        /* Modal Styling */
        #cancelModal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
        .modal-content { background: white; padding: 20px; border-radius: 10px; text-align: center; width: 300px; }
        .modal-content select, .modal-content input { width: 100%; margin-top: 10px; padding: 8px; border: 1px solid #ccc; border-radius: 5px; }
        .modal-content button { margin-top: 10px; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; }
        .close-btn { background-color: gray; color: white; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Therapist</h2>
        <ul>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header><h1>Welcome, Therapist</h1></header>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Communication Medium</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment) : ?>
                    <tr>
                        <td><?= htmlspecialchars($appointment['name']) ?></td>
                        <td><?= htmlspecialchars($appointment['email']) ?></td>
                        <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                        <td><?= htmlspecialchars($appointment['appointment_time']) ?></td>
                        <td><?= htmlspecialchars($appointment['communication_medium']) ?></td>
                        <td>
                        <?php if ($appointment['communication_medium'] === 'Zoom Call' && $appointment['status'] === 'confirmed') : ?>
                            <a href = "https://us05web.zoom.us/j/83517005191?pwd=6WcGqaNfnAbeqWunYgOuO78M4YyxGh.1" target="_blank">Join Meeting</a>
                            <?php elseif ($appointment['communication_medium'] === 'WhatsApp Call' && $appointment['status'] === 'confirmed') : ?>
                            0322-7860217
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>
                        <td><?= htmlspecialchars($appointment['status']) ?> - <?= htmlspecialchars($appointment['cancellation_reason'] ?? '-') ?></td>

                        <td>
                            <form method="POST">
                                <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                                <button type="submit" name="action" value="confirm" class="confirm">Confirm</button>
                                <button type="button" class="cancel" onclick="showCancelModal(<?= $appointment['id'] ?>)">Cancel</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Cancellation Modal -->
    <div id="cancelModal">
        <div class="modal-content">
            <h3>Cancel Appointment</h3>
            <p>Select a reason:</p>
            <form id="cancelForm" method="POST">
                <input type="hidden" name="appointment_id" id="cancelAppointmentId">
                <select name="cancellation_reason" id="cancellationReason" onchange="toggleCustomReason()">
                    <option value="Therapist Not Available">Therapist Not Available</option>
                    <option value="Timing Not Feasible">Timing Not Feasible</option>
                    <option value="Other">Other</option>
                </select>
                <input type="text" name="custom_reason" id="customReason" style="display: none;" placeholder="Enter reason">
                <button type="submit" name="action" value="cancel" class="confirm">Submit</button>
                <button type="button" class="close-btn" onclick="closeCancelModal()">Close</button>
                </form>
        </div>
    </div>

    <script>
        function showCancelModal(appointmentId) {
            document.getElementById("cancelAppointmentId").value = appointmentId;
            document.getElementById("cancelModal").style.display = "flex";
        }

        function closeCancelModal() {
            document.getElementById("cancelModal").style.display = "none";
        }

        function toggleCustomReason() {
            const reasonSelect = document.getElementById("cancellationReason");
            const customReasonInput = document.getElementById("customReason");
            customReasonInput.style.display = (reasonSelect.value === "Other") ? "block" : "none";
        }
    </script>
</body>
</html>