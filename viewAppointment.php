<?php
include 'components/connect.php';

// Check if user is signed in
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php'); // Redirect to login page if not signed in
    exit;
}

// Fetch user details
$select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
$select_user->execute([$user_id]);

if ($select_user->rowCount() > 0) {
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
} else {
    echo "User not found!";
    exit;
}

// Fetch appointments for the logged-in user by matching email only
$sql = "SELECT * FROM appointments WHERE email = :email ORDER BY appointment_date, appointment_time";
$stmt = $conn->prepare($sql);
$stmt->execute([':email' => $row['email']]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        h1 {
            color: #6a0dad; /* Purple */
            text-align: center;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #6a0dad; /* Purple */
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .appointment-card {
            background-color: #e6e6fa; /* Light purple background */
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }

        .appointment-card p {
            margin: 8px 0;
        }

        
/*-----------------------------------*\
  #GO TO TOP
\*-----------------------------------*/

.go-top {
  position: fixed;
  bottom: 0;
  right: 15px;
  background-color: var(--winter-sky);
  color: var(--white);
  font-size: 2rem;
  padding: 14px;
  border-radius: var(--radius-4);
  box-shadow: -3px 3px 15px var(--winter-sky_50);
  z-index: 2;
  visibility: hidden;
  opacity: 0;
  transition: var(--transition-1);
}

.go-top.active {
  visibility: visible;
  opacity: 1;
  transform: translateY(-15px);
}


        .go-back {
    position: fixed;
    bottom: 20px;
    left: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    width: 50px;
    height: 50px;
    background-color: #FF007F;
    color: white;
    text-align: center;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
  }


  .go-back:hover {
    background-color: #0056b3;
  }

  .go-back ion-icon {
    font-size: 24px;
  }


        .btn,
        .join-btn {
            background: #ff007f;
            border: none;
            color: #fff;
            padding: 5px 5px;
            font-size: 1rem;
            border-radius: 2px;
            cursor: pointer;
            display: inline-block;
            margin: 5px;
        }

        .btn:hover 
        .join-btn:hover {
            background: #e60073;
        }
    </style>
</head>
<body>

<h1>Your Appointments:</h1>

<?php if (!empty($appointments)): ?>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?= htmlspecialchars($appointment['name']) ?></td>
                    <td><?= htmlspecialchars($appointment['email']) ?></td>
                    <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                    <td><?= htmlspecialchars($appointment['appointment_time']) ?></td>
                    <td><?= htmlspecialchars($appointment['communication_medium']) ?></td>
                    <td>
                        <?php if ($appointment['communication_medium'] === 'Zoom Call' && $appointment['status'] === 'confirmed') : ?>
                            <a href = "https://us05web.zoom.us/j/83517005191?pwd=6WcGqaNfnAbeqWunYgOuO78M4YyxGh.1" target="_blank"><button class="join-btn" id="Join">Join Meeting</button></a>
                            <?php elseif ($appointment['communication_medium'] === 'WhatsApp Call' && $appointment['status'] === 'confirmed') : ?>
                            0322-7860217
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($appointment['status']) ?> - <?= htmlspecialchars($appointment['cancellation_reason'] ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>You have no appointments.</p>
<?php endif; ?>

<a href="homiee.php" class="go-back active" aria-label="Go Back">
  <ion-icon name="arrow-back-outline"></ion-icon>
</a>

  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top  active" aria-label="Go To Top" data-go-top>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
