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
die("Complaint ID Missing");
}


$id=$_GET['id'];



// Update Status

if(isset($_POST['update']))
{

$status=$_POST['status'];


$sql="UPDATE complaints 
SET status='$status'
WHERE id='$id'";


if(mysqli_query($conn,$sql))
{
$message="Status Updated Successfully";
}

}




// Get Complaint Details


$query="SELECT * FROM complaints WHERE id='$id'";

$result=mysqli_query($conn,$query);


$row=mysqli_fetch_assoc($result);



?>

<!DOCTYPE html>

<html>

<head>

<title>Complaint Details</title>


<style>


/*==================================================
            GOOGLE FONT
==================================================*/
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f5f7fb;
    color:#333;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px 20px;
}

/*==================================================
                MAIN BOX
==================================================*/

.box{

    width:100%;
    max-width:760px;

    background:#fff;

    border-radius:18px;

    padding:35px;

    box-shadow:0 12px 35px rgba(0,0,0,.08);

    border-top:5px solid #0d6efd;

}

/*==================================================
                TITLE
==================================================*/

h2{

    text-align:center;

    color:#0d6efd;

    margin-bottom:30px;

    font-size:30px;

    font-weight:700;

}

/*==================================================
                TABLE
==================================================*/

table{

    width:100%;

    border-collapse:collapse;

}

td{

    padding:16px;

    border-bottom:1px solid #ececec;

    font-size:15px;

}

/*==================================================
                LABEL
==================================================*/

.label{

    width:220px;

    background:#f8f9fc;

    color:#0d6efd;

    font-weight:600;

}

/*==================================================
                VALUE
==================================================*/

.value{

    color:#444;

    font-weight:500;

}

/*==================================================
                SELECT
==================================================*/

select{

    width:100%;

    padding:12px 15px;

    border:1px solid #d6dbe4;

    border-radius:10px;

    background:#fff;

    font-size:15px;

    transition:.3s;

}

select:focus{

    outline:none;

    border-color:#0d6efd;

    box-shadow:0 0 0 4px rgba(13,110,253,.15);

}

/*==================================================
                BUTTON
==================================================*/

button{

    width:100%;

    margin-top:25px;

    padding:14px;

    background:#0d6efd;

    color:#fff;

    border:none;

    border-radius:10px;

    font-size:16px;

    font-weight:600;

    cursor:pointer;

    transition:.3s;

    box-shadow:0 8px 18px rgba(13,110,253,.25);

}

button:hover{

    background:#084298;

    transform:translateY(-2px);

}

/*==================================================
                STATUS BADGES
==================================================*/

.pending{

    display:inline-block;

    background:#ffe5e5;

    color:#d32f2f;

    padding:6px 14px;

    border-radius:20px;

    font-size:14px;

    font-weight:600;

}

.processing{

    display:inline-block;

    background:#fff3cd;

    color:#b7791f;

    padding:6px 14px;

    border-radius:20px;

    font-size:14px;

    font-weight:600;

}

.finished{

    display:inline-block;

    background:#d4edda;

    color:#198754;

    padding:6px 14px;

    border-radius:20px;

    font-size:14px;

    font-weight:600;

}

/*==================================================
                RESPONSIVE
==================================================*/

@media(max-width:768px){

.box{

    padding:25px;

}

h2{

    font-size:24px;

}

table,
tbody,
tr,
td{

    display:block;

    width:100%;

}

.label{

    margin-top:10px;

}

button{

    font-size:15px;

}

}
</style>


</head>


<body>


<div class="box">


<h2>Complaint Details</h2>


<?php

if(isset($message))
{
echo $message;
}

?>


<table>


<tr>

<td class="label">ID</td>

<td><?php echo $row['id']; ?></td>

</tr>



<tr>

<td class="label">Register No</td>

<td><?php echo $row['register_no']; ?></td>

</tr>



<tr>

<td class="label">Student Name</td>

<td><?php echo $row['student_name']; ?></td>

</tr>



<tr>

<td class="label">Course</td>

<td><?php echo $row['course']; ?></td>

</tr>



<tr>

<td class="label">Department</td>

<td><?php echo $row['department']; ?></td>

</tr>



<tr>

<td class="label">Category</td>

<td><?php echo $row['complaint_category']; ?></td>

</tr>



<tr>

<td class="label">Subject</td>

<td><?php echo $row['complaint_subject']; ?></td>

</tr>



<tr>

<td class="label">Complaint</td>

<td><?php echo $row['complaint_details']; ?></td>

</tr>



<tr>

<td class="label">Date</td>

<td><?php echo $row['complaint_date']; ?></td>

</tr>



<tr>

<td class="label">Current Status</td>

<td>


<?php

if($row['status']=="Pending")
echo "<span class='pending'>Pending</span>";

elseif($row['status']=="Processing")
echo "<span class='processing'>Processing</span>";

elseif($row['status']=="Finished")
echo "<span class='finished'>Finished</span>";

?>


</td>

</tr>


</table>


<br>


<form method="post">


<select name="status">


<option value="Pending">
Pending
</option>


<option value="Processing">
Processing
</option>


<option value="Finished">
Finished
</option>


</select>


<br><br>


<button name="update">
Update Status
</button>


</form>


</div>


</body>

</html>