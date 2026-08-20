<?php
session_start();
include("db.php");

if(!isset($_SESSION['admin']))
{
    header("Location:admin_login.php");
    exit();
}

if(isset($_POST['update']))
{
    $id=$_POST['complaint_id'];
    $status=$_POST['status'];

    $sql="UPDATE complaints
          SET status='$status'
          WHERE id='$id'";

    if(mysqli_query($conn,$sql))
    {
        header("Location:view_complaints.php?msg=updated");
        exit();
    }
    else
    {
        echo "Update Failed";
    }
}
?>