<?php
session_start();
include("db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

if(!isset($_GET['id']))
{
    header("Location: complaint_details.php");
    exit();
}

$id = $_GET['id'];

// Fetch complaint
$sql = "SELECT * FROM complaints WHERE id='$id'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==0)
{
    die("Complaint not found.");
}

$row = mysqli_fetch_assoc($result);

// Update status
if(isset($_POST['update']))
{
    $status = $_POST['status'];

    $update = "UPDATE complaints
               SET status='$status'
               WHERE id='$id'";

    if(mysqli_query($conn,$update))
    {
        echo "<script>
        alert('Complaint Status Updated Successfully');
        window.location='complaint_details.php';
        </script>";
        exit();
    }
    else
    {
        echo "Error : ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Update Complaint</title>

<style>

body{
    font-family:Arial;
    background:#f4f6f9;
}

.container{
    width:500px;
    margin:50px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px #ccc;
}

h2{
    text-align:center;
    color:#0d6efd;
    margin-bottom:20px;
}

label{
    font-weight:bold;
}

input, textarea, select{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    width:100%;
    padding:12px;
    background:#0d6efd;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#084298;
}

.back{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
    color:#0d6efd;
}

</style>

</head>
<body>

<div class="container">

<h2>Update Complaint Status</h2>

<label>Register Number</label>
<input type="text" value="<?php echo $row['register_no']; ?>" readonly>

<label>Student Name</label>
<input type="text" value="<?php echo $row['student_name']; ?>" readonly>

<label>Complaint Subject</label>
<input type="text" value="<?php echo $row['complaint_subject']; ?>" readonly>

<label>Complaint Details</label>
<textarea readonly><?php echo $row['complaint_details']; ?></textarea>

<form method="post">

<label>Status</label>

<select name="status" required>
    <option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>
    <option value="Verified" <?php if($row['status']=="Verified") echo "selected"; ?>>Verified</option>
    <option value="Resolved" <?php if($row['status']=="Resolved") echo "selected"; ?>>Resolved</option>
</select>

<button type="submit" name="update">
Update Status
</button>

</form>

<a href="complaint_details.php" class="back">← Back to Complaint List</a>

</div>

</body>
</html>