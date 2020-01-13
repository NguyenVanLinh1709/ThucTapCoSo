<?php
    // kết nối csdl
    $conn = mysqli_connect('localhost', 'root', '', 'intership_food')
        or die('Không thể kết nối tới database' . mysqli_connect_error());
    mysqli_set_charset($conn, 'UTF8');
?>