<?php
session_start();

$_SESSION['register_no'] = $row['register_no'];
$_SESSION['student_name'] = $row['student_name'];

header("Location: student_dashboard.php");
exit();
?>