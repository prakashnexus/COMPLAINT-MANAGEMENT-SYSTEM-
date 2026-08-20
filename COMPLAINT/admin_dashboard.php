<?php
session_start();
include("db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

/* =========================================================
   DASHBOARD STATISTICS
========================================================= */

$totalStudents = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM students")
)['total'];

$totalComplaints = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM complaints")
)['total'];

$pendingComplaints = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM complaints WHERE status='Pending'")
)['total'];

$resolvedComplaints = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM complaints WHERE status='Resolved'")
)['total'];

$recentComplaints = mysqli_query(
    $conn,
    "SELECT * FROM complaints ORDER BY complaint_date DESC LIMIT 10"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Royal Admin Dashboard | Complaint Management System</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

/* =========================================================
   GLOBAL
========================================================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{

    font-family:'Poppins',sans-serif;

    min-height:100vh;

    color:#fff;

    overflow-x:hidden;

    background:
    radial-gradient(circle at 15% 20%,rgba(38,117,255,.22),transparent 30%),
    radial-gradient(circle at 85% 80%,rgba(255,193,7,.12),transparent 30%),
    linear-gradient(135deg,#020617,#06183b,#03112b,#020617);

}

/* =========================================================
   ANIMATED BACKGROUND
========================================================= */

.background{

    position:fixed;

    inset:0;

    overflow:hidden;

    pointer-events:none;

    z-index:-5;

}

.orb{

    position:absolute;

    border-radius:50%;

    filter:blur(3px);

    opacity:.35;

    animation:orbFloat 12s ease-in-out infinite;

}

.orb.one{

    width:300px;
    height:300px;

    background:#0066ff;

    top:-100px;
    left:-80px;

}

.orb.two{

    width:250px;
    height:250px;

    background:#d4af37;

    right:-80px;
    top:30%;

    animation-delay:2s;

}

.orb.three{

    width:350px;
    height:350px;

    background:#003cff;

    bottom:-150px;
    left:35%;

    animation-delay:4s;

}

@keyframes orbFloat{

    0%,100%{
        transform:translate3d(0,0,0) scale(1);
    }

    50%{
        transform:translate3d(40px,-50px,0) scale(1.15);
    }

}

/* =========================================================
   PARTICLES
========================================================= */

.particle{

    position:fixed;

    width:3px;
    height:3px;

    background:#ffd76a;

    border-radius:50%;

    box-shadow:0 0 12px #ffd76a;

    pointer-events:none;

    opacity:.5;

    animation:particleMove linear infinite;

    z-index:-2;

}

@keyframes particleMove{

    from{
        transform:translateY(110vh);
    }

    to{
        transform:translateY(-10vh);
    }

}

/* =========================================================
   HEADER
========================================================= */

.header{

    position:fixed;

    top:0;
    left:0;

    width:100%;

    height:78px;

    z-index:2000;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:0 30px;

    background:

    linear-gradient(
        135deg,
        rgba(4,19,51,.94),
        rgba(8,35,82,.88)
    );

    backdrop-filter:blur(20px);

    border-bottom:1px solid rgba(255,215,100,.25);

    box-shadow:
        0 10px 40px rgba(0,0,0,.35),
        inset 0 -1px 0 rgba(255,255,255,.04);

}

/* Gold line */

.header::after{

    content:"";

    position:absolute;

    bottom:0;
    left:0;

    width:100%;
    height:2px;

    background:
    linear-gradient(
        90deg,
        transparent,
        #d4af37,
        #fff0a3,
        #d4af37,
        transparent
    );

    animation:goldLine 4s linear infinite;

}

@keyframes goldLine{

    0%{
        opacity:.4;
    }

    50%{
        opacity:1;
    }

    100%{
        opacity:.4;
    }

}

/* =========================================================
   BRAND
========================================================= */

.brand{

    display:flex;

    align-items:center;

    gap:15px;

}

.brand-icon{

    width:48px;
    height:48px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:14px;

    color:#ffd95c;

    font-size:22px;

    background:
    linear-gradient(
        145deg,
        rgba(255,215,80,.25),
        rgba(255,255,255,.05)
    );

    border:1px solid rgba(255,215,80,.35);

    box-shadow:
        0 10px 30px rgba(0,0,0,.3),
        inset 0 1px 0 rgba(255,255,255,.15);

    transform:perspective(500px) rotateY(-8deg);

}

.header h2{

    font-family:'Cinzel',serif;

    font-size:20px;

    letter-spacing:1px;

    color:#fff;

}

.header small{

    display:block;

    color:#aebedb;

    font-size:11px;

    letter-spacing:2px;

    margin-top:2px;

}

/* =========================================================
   HEADER BUTTONS
========================================================= */

.header-actions{

    display:flex;

    align-items:center;

    gap:12px;

}

.admin-badge{

    display:flex;

    align-items:center;

    gap:8px;

    padding:9px 15px;

    border-radius:30px;

    color:#ffe48a;

    background:rgba(255,215,90,.08);

    border:1px solid rgba(255,215,90,.22);

    font-size:13px;

}

.logout-btn{

    display:flex;

    align-items:center;

    gap:8px;

    text-decoration:none;

    color:white;

    padding:10px 17px;

    border-radius:12px;

    background:
    linear-gradient(
        135deg,
        #b91c1c,
        #ef4444
    );

    box-shadow:
        0 8px 20px rgba(239,68,68,.25);

    transition:.35s;

}

.logout-btn:hover{

    transform:translateY(-3px);

    box-shadow:
        0 15px 30px rgba(239,68,68,.4);

}

/* =========================================================
   SIDEBAR
========================================================= */

.sidebar{

    position:fixed;

    top:78px;
    left:0;

    width:260px;

    height:calc(100vh - 78px);

    padding:25px 15px;

    z-index:1500;

    background:
    linear-gradient(
        180deg,
        rgba(3,17,43,.96),
        rgba(2,10,27,.94)
    );

    backdrop-filter:blur(20px);

    border-right:1px solid rgba(255,215,90,.15);

    box-shadow:
        15px 0 40px rgba(0,0,0,.25);

    overflow-y:auto;

}

/* Sidebar crown */

.sidebar-title{

    padding:0 15px 20px;

    color:#d4af37;

    font-family:'Cinzel',serif;

    font-size:12px;

    letter-spacing:2px;

}

/* Navigation */

.sidebar ul{

    list-style:none;

}

.sidebar li{

    margin-bottom:8px;

}

.sidebar a{

    position:relative;

    display:flex;

    align-items:center;

    gap:14px;

    padding:14px 16px;

    color:#aebedb;

    text-decoration:none;

    border-radius:14px;

    border:1px solid transparent;

    transition:.35s;

    overflow:hidden;

}

.sidebar a i{

    width:24px;

    text-align:center;

    color:#7395c8;

    transition:.35s;

}

.sidebar a:hover,
.sidebar a.active{

    color:#fff;

    background:
    linear-gradient(
        135deg,
        rgba(13,82,180,.65),
        rgba(24,57,115,.5)
    );

    border-color:rgba(91,155,255,.25);

    transform:translateX(5px);

    box-shadow:
        0 10px 25px rgba(0,70,180,.18);

}

.sidebar a:hover i,
.sidebar a.active i{

    color:#ffd95c;

    transform:scale(1.15);

}

/* Active glow */

.sidebar a.active::before{

    content:"";

    position:absolute;

    left:0;
    top:20%;

    width:3px;
    height:60%;

    border-radius:10px;

    background:#ffd95c;

    box-shadow:0 0 15px #ffd95c;

}

/* =========================================================
   MAIN
========================================================= */

.main{

    margin-left:260px;

    padding:110px 35px 40px;

    min-height:100vh;

}

/* =========================================================
   WELCOME
========================================================= */

.welcome{

    position:relative;

    padding:30px;

    margin-bottom:30px;

    border-radius:24px;

    background:
    linear-gradient(
        135deg,
        rgba(13,58,120,.65),
        rgba(5,25,60,.55)
    );

    border:1px solid rgba(255,255,255,.08);

    box-shadow:
        0 20px 50px rgba(0,0,0,.25),
        inset 0 1px 0 rgba(255,255,255,.08);

    overflow:hidden;

}

.welcome::before{

    content:"";

    position:absolute;

    width:300px;
    height:300px;

    right:-100px;
    top:-160px;

    border-radius:50%;

    background:rgba(255,215,90,.1);

    filter:blur(2px);

}

.welcome h1{

    font-family:'Cinzel',serif;

    font-size:30px;

    color:#fff;

    margin-bottom:6px;

}

.welcome h1 span{

    color:#ffd95c;

}

.welcome p{

    color:#9fb3d5;

}

.crown{

    color:#ffd95c;

    margin-right:8px;

}

/* =========================================================
   STAT CARDS
========================================================= */

.cards{

    display:grid;

    grid-template-columns:
    repeat(4,minmax(200px,1fr));

    gap:22px;

    margin-bottom:30px;

}

.card{

    position:relative;

    min-height:190px;

    padding:25px;

    border-radius:22px;

    overflow:hidden;

    transform-style:preserve-3d;

    background:
    linear-gradient(
        145deg,
        rgba(17,57,113,.78),
        rgba(4,24,57,.72)
    );

    border:1px solid rgba(255,255,255,.08);

    box-shadow:
        0 20px 45px rgba(0,0,0,.25),
        inset 0 1px 0 rgba(255,255,255,.08);

    transition:
        transform .15s ease,
        box-shadow .3s ease;

    cursor:pointer;

}

/* Shine */

.card::before{

    content:"";

    position:absolute;

    width:180px;
    height:180px;

    border-radius:50%;

    right:-80px;
    top:-90px;

    background:rgba(255,215,90,.1);

    filter:blur(3px);

}

.card::after{

    content:"";

    position:absolute;

    top:0;
    left:-120%;

    width:80%;
    height:100%;

    background:
    linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,.08),
        transparent
    );

    transform:skewX(-20deg);

    transition:.7s;

}

.card:hover::after{

    left:140%;

}

.card:hover{

    box-shadow:
        0 30px 70px rgba(0,0,0,.4),
        0 0 25px rgba(50,130,255,.12);

}

.card-icon{

    width:58px;
    height:58px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:16px;

    font-size:23px;

    color:#ffd95c;

    background:
    linear-gradient(
        145deg,
        rgba(255,215,90,.18),
        rgba(255,255,255,.03)
    );

    border:1px solid rgba(255,215,90,.22);

    box-shadow:
        0 12px 25px rgba(0,0,0,.2);

    transform:translateZ(30px);

}

.card h3{

    margin-top:20px;

    font-size:14px;

    color:#9fb3d5;

    font-weight:500;

    transform:translateZ(25px);

}

.card h1{

    margin-top:5px;

    font-family:'Cinzel',serif;

    font-size:36px;

    color:#fff;

    transform:translateZ(35px);

}

.card.gold{

    border-color:rgba(255,215,90,.18);

}

/* =========================================================
   SECTION HEADER
========================================================= */

.section-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:18px;

}

.section-header h2{

    font-family:'Cinzel',serif;

    font-size:21px;

    color:#fff;

}

.section-header span{

    color:#ffd95c;

    font-size:12px;

}

/* =========================================================
   TABLE BOX
========================================================= */

.table-box{

    position:relative;

    background:
    linear-gradient(
        145deg,
        rgba(10,39,80,.78),
        rgba(3,18,43,.8)
    );

    border:1px solid rgba(255,255,255,.08);

    border-radius:22px;

    padding:25px;

    box-shadow:
        0 25px 60px rgba(0,0,0,.28),
        inset 0 1px 0 rgba(255,255,255,.06);

    overflow:hidden;

}

.table-box::before{

    content:"";

    position:absolute;

    width:200px;
    height:200px;

    border-radius:50%;

    right:-100px;
    bottom:-120px;

    background:rgba(0,110,255,.12);

    filter:blur(10px);

}

.table-wrapper{

    overflow-x:auto;

}

table{

    width:100%;

    min-width:900px;

    border-collapse:separate;

    border-spacing:0 8px;

}

thead th{

    padding:15px;

    text-align:center;

    color:#ffd95c;

    font-size:12px;

    text-transform:uppercase;

    letter-spacing:1px;

    background:rgba(255,215,90,.05);

}

thead th:first-child{

    border-radius:10px 0 0 10px;

}

thead th:last-child{

    border-radius:0 10px 10px 0;

}

tbody tr{

    background:rgba(255,255,255,.035);

    transition:.3s;

    animation:rowAppear .6s ease both;

}

tbody tr:hover{

    background:rgba(35,105,205,.15);

    transform:scale(1.008);

}

tbody td{

    padding:15px;

    text-align:center;

    color:#c7d3e8;

    font-size:13px;

    border-top:1px solid rgba(255,255,255,.025);

    border-bottom:1px solid rgba(255,255,255,.025);

}

tbody td:first-child{

    border-radius:10px 0 0 10px;

}

tbody td:last-child{

    border-radius:0 10px 10px 0;

}

@keyframes rowAppear{

    from{

        opacity:0;

        transform:translateY(15px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}

/* =========================================================
   STATUS
========================================================= */

.status{

    display:inline-flex;

    align-items:center;

    gap:6px;

    padding:6px 12px;

    border-radius:30px;

    font-size:11px;

    font-weight:600;

}

.status::before{

    content:"";

    width:6px;
    height:6px;

    border-radius:50%;

}

.status-pending{

    color:#ffb4b4;

    background:rgba(239,68,68,.12);

    border:1px solid rgba(239,68,68,.2);

}

.status-pending::before{

    background:#ef4444;

    box-shadow:0 0 8px #ef4444;

}

.status-resolved{

    color:#9ef2c2;

    background:rgba(34,197,94,.1);

    border:1px solid rgba(34,197,94,.2);

}

.status-resolved::before{

    background:#22c55e;

    box-shadow:0 0 8px #22c55e;

}

/* =========================================================
   EMPTY TABLE
========================================================= */

.empty{

    padding:40px;

    text-align:center;

    color:#8ea3c5;

}

/* =========================================================
   FOOTER
========================================================= */

.footer{

    text-align:center;

    padding:35px 10px 10px;

    color:#7185a8;

    font-size:12px;

}

.footer span{

    color:#d4af37;

}

/* =========================================================
   MOBILE MENU
========================================================= */

.menu-btn{

    display:none;

    width:42px;
    height:42px;

    border:none;

    border-radius:12px;

    background:rgba(255,255,255,.08);

    color:#fff;

    cursor:pointer;

    font-size:19px;

}

/* =========================================================
   SCROLLBAR
========================================================= */

::-webkit-scrollbar{

    width:8px;
    height:8px;

}

::-webkit-scrollbar-track{

    background:#020b1e;

}

::-webkit-scrollbar-thumb{

    background:
    linear-gradient(
        #1d5fc4,
        #d4af37
    );

    border-radius:20px;

}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1200px){

    .cards{

        grid-template-columns:
        repeat(2,1fr);

    }

}

@media(max-width:900px){

    .menu-btn{

        display:flex;

        align-items:center;

        justify-content:center;

    }

    .sidebar{

        transform:translateX(-100%);

        transition:.4s;

    }

    .sidebar.open{

        transform:translateX(0);

    }

    .main{

        margin-left:0;

    }

    .admin-badge{

        display:none;

    }

}

@media(max-width:650px){

    .header{

        padding:0 15px;

    }

    .header h2{

        font-size:14px;

    }

    .brand-icon{

        width:40px;
        height:40px;

    }

    .logout-btn span{

        display:none;

    }

    .logout-btn{

        width:40px;
        height:40px;

        justify-content:center;

        padding:0;

    }

    .main{

        padding:
        100px 15px 30px;

    }

    .cards{

        grid-template-columns:1fr;

    }

    .welcome{

        padding:22px;

    }

    .welcome h1{

        font-size:23px;

    }

    .table-box{

        padding:15px;

    }

}

/* =========================================================
   REDUCED MOTION
========================================================= */

@media(prefers-reduced-motion:reduce){

    *,
    *::before,
    *::after{

        animation-duration:.01ms !important;

        animation-iteration-count:1 !important;

        transition-duration:.01ms !important;

    }

}

</style>

</head>

<body>

<!-- =======================================================
     ANIMATED BACKGROUND
======================================================= -->

<div class="background">

    <div class="orb one"></div>
    <div class="orb two"></div>
    <div class="orb three"></div>

</div>

<!-- =======================================================
     HEADER
======================================================= -->

<header class="header">

    <div class="brand">

        <button class="menu-btn" id="menuBtn">
            <i class="fas fa-bars"></i>
        </button>

        <div class="brand-icon">
            <i class="fas fa-crown"></i>
        </div>

        <div>

            <h2>Complaint Management System</h2>

            <small>ROYAL ADMINISTRATION PANEL</small>

        </div>

    </div>

    <div class="header-actions">

        <div class="admin-badge">

            <i class="fas fa-user-shield"></i>

            Admin:
            <?php echo htmlspecialchars($_SESSION['admin']); ?>

        </div>

        <a href="admin_logout.php" class="logout-btn">

            <i class="fas fa-right-from-bracket"></i>

            <span>Logout</span>

        </a>

    </div>

</header>


<!-- =======================================================
     SIDEBAR
======================================================= -->

<aside class="sidebar" id="sidebar">

    <div class="sidebar-title">
        <i class="fas fa-gem"></i>
        ADMIN CONTROL
    </div>

    <ul>

        <li>
            <a href="admin_dashboard.php" class="active">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="students.php">
                <i class="fas fa-user-graduate"></i>
                <span>Manage Students</span>
            </a>
        </li>

        <li>
            <a href="complaints.php">
                <i class="fas fa-file-pen"></i>
                <span>Complaint Details</span>
            </a>
        </li>

        <li>
            <a href="pending_complaints.php">
                <i class="fas fa-hourglass-half"></i>
                <span>Pending Complaints</span>
            </a>
        </li>

        <li>
            <a href="resolved_complaints.php">
                <i class="fas fa-circle-check"></i>
                <span>Resolved Complaints</span>
            </a>
        </li>

        <li>
            <a href="reports.php">
                <i class="fas fa-chart-column"></i>
                <span>Reports</span>
            </a>
        </li>

        <li>
            <a href="change_password.php">
                <i class="fas fa-key"></i>
                <span>Change Password</span>
            </a>
        </li>

        <li>
            <a href="admin_logout.php">
                <i class="fas fa-power-off"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

</aside>


<!-- =======================================================
     MAIN CONTENT
======================================================= -->

<main class="main">


    <!-- Welcome -->

    <section class="welcome">

        <h1>

            <span class="crown">
                <i class="fas fa-crown"></i>
            </span>

            Welcome,
            <span>
                <?php echo htmlspecialchars($_SESSION['admin']); ?>
            </span>

        </h1>

        <p>
            Manage students, complaints and administrative activities
            from your royal control center.
        </p>

    </section>


    <!-- ===================================================
         STATISTICS
    =================================================== -->

    <section class="cards">


        <!-- Students -->

        <div class="card tilt-card gold">

            <div class="card-icon">

                <i class="fas fa-user-graduate"></i>

            </div>

            <h3>Total Students</h3>

            <h1 class="counter"
                data-target="<?php echo $totalStudents; ?>">
                0
            </h1>

        </div>


        <!-- Complaints -->

        <div class="card tilt-card">

            <div class="card-icon">

                <i class="fas fa-file-circle-exclamation"></i>

            </div>

            <h3>Total Complaints</h3>

            <h1 class="counter"
                data-target="<?php echo $totalComplaints; ?>">
                0
            </h1>

        </div>


        <!-- Pending -->

        <div class="card tilt-card">

            <div class="card-icon">

                <i class="fas fa-hourglass-half"></i>

            </div>

            <h3>Pending Complaints</h3>

            <h1 class="counter"
                data-target="<?php echo $pendingComplaints; ?>">
                0
            </h1>

        </div>


        <!-- Resolved -->

        <div class="card tilt-card gold">

            <div class="card-icon">

                <i class="fas fa-circle-check"></i>

            </div>

            <h3>Resolved Complaints</h3>

            <h1 class="counter"
                data-target="<?php echo $resolvedComplaints; ?>">
                0
            </h1>

        </div>


    </section>


    <!-- ===================================================
         RECENT COMPLAINTS
    =================================================== -->

    <section>

        <div class="section-header">

            <h2>

                <i class="fas fa-scroll"></i>

                Recent Complaints

            </h2>

            <span>

                <i class="fas fa-clock"></i>

                Latest 10 Records

            </span>

        </div>


        <div class="table-box">

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Register No</th>

                            <th>Name</th>

                            <th>Category</th>

                            <th>Subject</th>

                            <th>Date</th>

                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php

                    if(mysqli_num_rows($recentComplaints) > 0)
                    {

                        $delay = 0;

                        while($row = mysqli_fetch_assoc($recentComplaints))
                        {

                            $delay += 0.05;

                    ?>

                        <tr style="animation-delay:<?php echo $delay; ?>s;">

                            <td>
                                #<?php echo htmlspecialchars($row['id']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['register_no']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['student_name']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['complaint_category']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['complaint_subject']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['complaint_date']); ?>
                            </td>

                            <td>

                            <?php

                            if($row['status']=="Pending")
                            {

                                echo '
                                <span class="status status-pending">
                                    Pending
                                </span>';

                            }
                            elseif(
                                strtolower($row['status'])=="in progress" ||
                                strtolower($row['status'])=="progress"
                            )
                            {

                                echo '
                                <span class="status status-pending">
                                    In Progress
                                </span>';

                            }
                            else
                            {

                                echo '
                                <span class="status status-resolved">
                                    Resolved
                                </span>';

                            }

                            ?>

                            </td>

                        </tr>

                    <?php

                        }

                    }
                    else
                    {

                    ?>

                        <tr>

                            <td colspan="7">

                                <div class="empty">

                                    <i class="fas fa-inbox"
                                       style="font-size:35px;margin-bottom:10px;">
                                    </i>

                                    <br>

                                    No complaints available.

                                </div>

                            </td>

                        </tr>

                    <?php

                    }

                    ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>


    <!-- ===================================================
         FOOTER
    =================================================== -->

    <footer class="footer">

        <h4>

            <i class="fas fa-crown"></i>

            © 2026 College Complaint Management System

            <span>| Royal Admin Dashboard</span>

        </h4>

    </footer>


</main>


<!-- =======================================================
     JAVASCRIPT
======================================================= -->

<script>

/* =========================================================
   MOBILE SIDEBAR
========================================================= */

const menuBtn = document.getElementById("menuBtn");

const sidebar = document.getElementById("sidebar");

if(menuBtn){

    menuBtn.addEventListener("click",function(){

        sidebar.classList.toggle("open");

        const icon = menuBtn.querySelector("i");

        if(sidebar.classList.contains("open")){

            icon.classList.remove("fa-bars");

            icon.classList.add("fa-xmark");

        }
        else{

            icon.classList.remove("fa-xmark");

            icon.classList.add("fa-bars");

        }

    });

}


/* =========================================================
   CLOSE MOBILE SIDEBAR AFTER CLICK
========================================================= */

document.querySelectorAll(".sidebar a").forEach(function(link){

    link.addEventListener("click",function(){

        if(window.innerWidth <= 900){

            sidebar.classList.remove("open");

        }

    });

});


/* =========================================================
   3D CARD TILT
========================================================= */

const cards = document.querySelectorAll(".tilt-card");

cards.forEach(function(card){

    card.addEventListener("mousemove",function(e){

        const rect = card.getBoundingClientRect();

        const x = e.clientX - rect.left;

        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;

        const centerY = rect.height / 2;

        const rotateX =
            ((y - centerY) / centerY) * -7;

        const rotateY =
            ((x - centerX) / centerX) * 7;

        card.style.transform =
            `perspective(900px)
             rotateX(${rotateX}deg)
             rotateY(${rotateY}deg)
             translateY(-6px)
             scale(1.02)`;

    });


    card.addEventListener("mouseleave",function(){

        card.style.transform =
            "perspective(900px) rotateX(0deg) rotateY(0deg) translateY(0) scale(1)";

    });

});


/* =========================================================
   ANIMATED NUMBER COUNTERS
========================================================= */

const counters = document.querySelectorAll(".counter");

const counterSpeed = 35;

function startCounter(counter){

    const target =
        Number(counter.getAttribute("data-target"));

    let current = 0;

    const increment =
        Math.max(1, Math.ceil(target / 50));

    function update(){

        current += increment;

        if(current >= target){

            current = target;

            counter.textContent =
                current.toLocaleString();

            return;

        }

        counter.textContent =
            current.toLocaleString();

        requestAnimationFrame(update);

    }

    update();

}


/* =========================================================
   COUNTER OBSERVER
========================================================= */

const observer = new IntersectionObserver(

    function(entries,observer){

        entries.forEach(function(entry){

            if(entry.isIntersecting){

                startCounter(entry.target);

                observer.unobserve(entry.target);

            }

        });

    },

    {
        threshold:.5
    }

);


counters.forEach(function(counter){

    observer.observe(counter);

});


/* =========================================================
   CREATE FLOATING PARTICLES
========================================================= */

const particleCount = 35;

for(let i=0;i<particleCount;i++){

    const particle =
        document.createElement("span");

    particle.className = "particle";

    particle.style.left =
        Math.random() * 100 + "%";

    particle.style.animationDuration =
        (7 + Math.random() * 12) + "s";

    particle.style.animationDelay =
        (Math.random() * 10) + "s";

    particle.style.opacity =
        (.2 + Math.random() * .6);

    const size =
        (1 + Math.random() * 3) + "px";

    particle.style.width = size;

    particle.style.height = size;

    document.body.appendChild(particle);

}


/* =========================================================
   MOUSE FOLLOW SPOTLIGHT
========================================================= */

const spotlight = document.createElement("div");

spotlight.style.position = "fixed";

spotlight.style.width = "300px";

spotlight.style.height = "300px";

spotlight.style.borderRadius = "50%";

spotlight.style.pointerEvents = "none";

spotlight.style.zIndex = "-1";

spotlight.style.background =
    "radial-gradient(circle, rgba(80,150,255,.10), transparent 70%)";

spotlight.style.transform =
    "translate(-50%,-50%)";

document.body.appendChild(spotlight);


document.addEventListener("mousemove",function(e){

    spotlight.style.left = e.clientX + "px";

    spotlight.style.top = e.clientY + "px";

});


/* =========================================================
   RIPPLE EFFECT ON SIDEBAR
========================================================= */

document.querySelectorAll(".sidebar a").forEach(function(link){

    link.addEventListener("click",function(e){

        const ripple =
            document.createElement("span");

        ripple.style.position = "absolute";

        ripple.style.width = "5px";

        ripple.style.height = "5px";

        ripple.style.borderRadius = "50%";

        ripple.style.background =
            "rgba(255,215,90,.5)";

        ripple.style.left =
            e.offsetX + "px";

        ripple.style.top =
            e.offsetY + "px";

        ripple.style.pointerEvents = "none";

        ripple.style.transform =
            "translate(-50%,-50%) scale(1)";

        ripple.style.transition =
            "transform .6s ease, opacity .6s ease";

        link.appendChild(ripple);

        requestAnimationFrame(function(){

            ripple.style.transform =
                "translate(-50%,-50%) scale(40)";

            ripple.style.opacity = "0";

        });

        setTimeout(function(){

            ripple.remove();

        },700);

    });

});


/* =========================================================
   LIVE CLOCK EFFECT
========================================================= */

const clock = document.createElement("div");

clock.style.position = "fixed";

clock.style.right = "25px";

clock.style.bottom = "20px";

clock.style.padding = "8px 14px";

clock.style.borderRadius = "20px";

clock.style.fontSize = "11px";

clock.style.color = "#9fb3d5";

clock.style.background =
    "rgba(2,15,40,.75)";

clock.style.border =
    "1px solid rgba(255,215,90,.12)";

clock.style.backdropFilter =
    "blur(10px)";

clock.style.zIndex = "1000";

document.body.appendChild(clock);


function updateClock(){

    const now = new Date();

    clock.innerHTML =
        '<i class="fas fa-clock"></i> ' +
        now.toLocaleTimeString();

}

updateClock();

setInterval(updateClock,1000);


/* =========================================================
   PAGE LOAD ANIMATION
========================================================= */

window.addEventListener("load",function(){

    document.body.classList.add("loaded");

});

</script>

</body>
</html>