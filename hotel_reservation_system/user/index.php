<?php
session_start();

// Check if user is logged in, else redirect
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
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

<body>

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
            <a href="book_room.php">Reservaton</a>
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

    <!-- MAIN -->
    <main>
    <section class="rooms">
        <div class="container">
            <h1 class="section-heading">Explore Our Rooms</h1>
            <div class="room-container">
                <!-- ROOM 1 -->
                <div class="room">
                    <img src="../images\hotel\hotel-1.jpg" alt="Room 1">
                    <div class="room-info">
                        <h2>Room 1 Deluxe</h2>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="features">
                            <span><i class="fas fa-bed"></i> 2 Bed</span>
                            <span><i class="fas fa-bath"></i> 1 Bath</span>
                            <span><i class="fas fa-wifi"></i> Wifi</span>
                        </div>
                        <p class="description">Enjoy the comfort of our Deluxe Room with a stunning view of the city. Perfect for business travelers and couples.</p>
                        <button class="btn btn-dark btn-book-now" id="bookNowBtn">Book Now</button>
                    </div>
                </div>

                <!-- ROOM 2 -->
                <div class="room">
                    <img src="../images\hotel\hotel-2.jpg" alt="Room 2">
                    <div class="room-info">
                        <h2>Room 2 Studio</h2>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="features">
                            <span><i class="fas fa-bed"></i> 2 Bed</span>
                            <span><i class="fas fa-bath"></i> 1 Bath</span>
                            <span><i class="fas fa-wifi"></i> Wifi</span>
                        </div>
                        <p class="description">Enjoy the comfort of our Deluxe Room with a stunning view of the city. Perfect for business travelers and couples.</p>
                        <button class="btn btn-view-detail">View Detail</button>
                        <button class="btn btn-dark btn-book-now" id="bookNowBtn">Book Now</button>
                    </div>
                </div>

                <!-- ROOM 3 -->
                <div class="room">
                    <img src="../images\hotel\hotel-3.jpg" alt="Room 3">
                    <div class="room-info">
                        <h2>Room 3 Hostel</h2>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="features">
                            <span><i class="fas fa-bed"></i> 2 Bed</span>
                            <span><i class="fas fa-bath"></i> 1 Bath</span>
                            <span><i class="fas fa-wifi"></i> Wifi</span>
                        </div>
                        <p class="description">Enjoy the comfort of our Deluxe Room with a stunning view of the city. Perfect for business travelers and couples.</p>
                        <button class="btn btn-view-detail">View Detail</button>
                        <button class="btn btn-dark btn-book-now" id="bookNowBtn">Book Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- END OF MAIN -->

    <!-- FOOTER -->
    <footer class="footer">
    <div class="container">
        <p>&copy; 2024 LodgiGo. All rights reserved.</p>
    </div>
    </footer>
    <!-- END OF FOOTER -->

    <!-- MODAL -->
    <div class="modal" id="bookingModal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Book Deluxe Room</h2>
        <form action="../user/book_room.php" method="POST">
        <div class="form-group">
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
</div>
<div class="form-group">
    <label for="phone">Phone Number</label>
    <input type="tel" id="phone" name="phone" required>
</div>
<div class="form-group">
    <label for="checkInDate">Check-in Date</label>
    <input type="date" id="checkInDate" name="checkInDate" required>
</div>
<div class="form-group">
    <label for="checkOutDate">Check-out Date</label>
    <input type="date" id="checkOutDate" name="checkOutDate" required>
</div>
<div class="form-group">
    <label for="numberOfGuests">Number of Guests</label>
    <input type="number" id="numberOfGuests" name="numberOfGuests" min="1" required>
</div>
<button type="submit" class="btn btn-primary" name="submitBooking">Submit</button>
</form>

    </div>
    </div>
    <!-- END OF MODAL -->

    <!-- SCRIPT -->
    <script src="../js/modal.js"></script>

</body>
</html>