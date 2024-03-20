<?php
function get_rooms() {
    global $conn;
    $query = "SELECT * FROM rooms";
    $result = mysqli_query($conn, $query);
    return $result;
}
