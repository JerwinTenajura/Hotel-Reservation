<?php
session_start();

// Check if user is logged in as admin, else redirect
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Include database connection
require_once('../includes/db.php');

// Fetch all bookings
$sql = "SELECT * FROM bookings";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<header>
    <div class="navbar">
        <a href="#" class="logo">Admin Panel</a>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Bookings</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="bookings">
        <div class="container">
            <h1 class="section-heading">All Bookings</h1>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Room ID</th>
                    <th>User ID</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Number of Guests</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['room_id'] . "</td>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['check_in_date'] . "</td>";
                        echo "<td>" . $row['check_out_date'] . "</td>";
                        echo "<td>" . $row['number_of_guests'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td><a href='#' class='edit-btn' data-id='" . $row['id'] . "'>Edit</a> | <a href='#' class='delete-btn' data-id='" . $row['id'] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No bookings found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Booking</h2>
        <!-- Form for editing booking -->
        <form id="editForm" action="edit_booking.php" method="post">
            <input type="hidden" name="booking_id" id="booking_id">
            <label for="room_id">Room ID:</label>
            <input type="text" name="room_id" id="room_id" required><br>
            <label for="user_id">User ID:</label>
            <input type="text" name="user_id" id="user_id" required><br>
            <label for="check_in_date">Check-in Date:</label>
            <input type="date" name="check_in_date" id="check_in_date" required><br>
            <label for="check_out_date">Check-out Date:</label>
            <input type="date" name="check_out_date" id="check_out_date" required><br>
            <label for="number_of_guests">Number of Guests:</label>
            <input type="number" name="number_of_guests" id="number_of_guests" required><br>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required><br>
            <button type="submit">Update</button>
        </form>
    </div>
</div>

<script>
    // Get the modal
    var editModal = document.getElementById('editModal');

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the edit button, open the modal
    var editBtns = document.getElementsByClassName("edit-btn");
    for (var i = 0; i < editBtns.length; i++) {
        editBtns[i].onclick = function() {
            var bookingId = this.getAttribute("data-id");
            // Populate the modal with booking data using AJAX or fetch
            // For simplicity, I'll just show the modal without data
            editModal.style.display = "block";
        }
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        editModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    }

    // Delete functionality
    var deleteBtns = document.getElementsByClassName("delete-btn");
    for (var i = 0; i < deleteBtns.length; i++) {
        deleteBtns[i].onclick = function() {
            if (confirm("Are you sure you want to delete this booking?")) {
                var bookingId = this.getAttribute("data-id");
                // Implement the delete logic using AJAX or fetch
                // For simplicity, I'll just reload the page
                window.location.href = "delete_booking.php?id=" + bookingId;
            }
        }
    }
</script>

</body>
</html>
