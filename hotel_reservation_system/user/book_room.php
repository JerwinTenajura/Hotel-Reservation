<?php
session_start();
// Check if user is logged in, else redirect
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'hotel_reservation_system';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submitBooking'])) {
    $room_id = 1; // Assuming room_id 1 is the Deluxe Room
    $user_id = $_SESSION['user_id'];
    $check_in_date = $_POST['checkInDate'];
    $check_out_date = $_POST['checkOutDate'];
    $number_of_guests = $_POST['numberOfGuests'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // Prepare and bind parameters to prevent SQL injection
    $sql = "INSERT INTO bookings (room_id, user_id, check_in_date, check_out_date, number_of_guests, name, phone) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iisssis", $room_id, $user_id, $check_in_date, $check_out_date, $number_of_guests, $name, $phone);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Room booked successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

// Fetch user reservations
$user_id = $_SESSION['user_id'];
$reservation_query = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $reservation_query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$reservation_result = mysqli_stmt_get_result($stmt);

$reservations = [];
while ($row = mysqli_fetch_assoc($reservation_result)) {
    $reservations[] = $row;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-left: 4em;
            margin-: 4em;
            
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f0f0f0;
            font-weight: 500;
            color: #333;
        }

        td {
            background-color: #fff;
            color: #333;
        }

        .actions {
            display: flex;
            justify-content: space-around;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-transform: uppercase;
        }

        .btn-view {
            background-color: #007bff;
            color: #fff;
        }

        .btn-edit {
            background-color: #28a745;
            color: #fff;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }
    </style>

<body?>

<!-- HEADER -->
    <header>
    <div class="navbar">
        <a href="#" class="logo">LodgiGo</a>
        <nav>
        <ul>
            <li>
            <a href="../index.php">Home</a>
            </li>
            <li>
            <a href="index.php">Rooms</a>
            </li>
            <li>
            <a href="book_room.php">Reservation</a>
            </li>
            <li>
            <a href="#">Contact</a>
            </li>
            <li>
            <li>
            <i class="fas fa-user-circle"></i>
            </li>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>
        </nav>
    </div>
    </header>


    <!-- User Reservations -->
    <section class="reservations">
        <h2>My Reservations</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Number of Guests</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo $reservation['name']; ?></td>
                        <td><?php echo $reservation['phone']; ?></td>
                        <td><?php echo $reservation['check_in_date']; ?></td>
                        <td><?php echo $reservation['check_out_date']; ?></td>
                        <td><?php echo $reservation['number_of_guests']; ?></td>
                        <td>
                            <a href="view_reservation.php?id=<?php echo $reservation['id']; ?>">View</a> |
                            <a href="edit_reservation.php?id=<?php echo $reservation['id']; ?>">Edit</a> |
                            <a href="delete_reservation.php?id=<?php echo $reservation['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- SCRIPT -->
    <script src="../js/modal.js"></script>

</body>
</html>