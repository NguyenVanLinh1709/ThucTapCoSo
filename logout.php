<?php
session_start();
session_destroy();
header('location:' . 'http://localhost:8080/learnphp/Internship_TastyFood/index.php');
?>