<?php
$conn = mysqli_connect("localhost","root","","complaint");

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>