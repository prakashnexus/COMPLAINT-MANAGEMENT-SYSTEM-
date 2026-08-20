<?php
session_start();
include("db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT * FROM complaints ORDER BY id ASC";
$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>All Complaints | Royal Admin Panel</title>

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

/* =========================================================
   ROOT
========================================================= */

:root{

    --royal-blue:#071a52;
    --deep-blue:#020617;
    --blue:#0d6efd;
    --cyan:#00d9ff;

    --gold:#ffd700;
    --gold-light:#fff2a8;
    --gold-dark:#b8860b;

    --white:#ffffff;
    --text:#e5e7eb;
    --muted:#94a3b8;

    --glass:rgba(255,255,255,.075);
    --glass-border:rgba(255,255,255,.14);

    --shadow:
    0 25px 60px rgba(0,0,0,.35);

}


/* =========================================================
   RESET
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

    font-family:'Poppins',sans-serif;

}


/* =========================================================
   BODY
========================================================= */

body{

    min-height:100vh;

    color:var(--text);

    background:

    radial-gradient(
        circle at 10% 20%,
        rgba(0,102,255,.28),
        transparent 30%
    ),

    radial-gradient(
        circle at 90% 80%,
        rgba(255,215,0,.12),
        transparent 28%
    ),

    linear-gradient(
        135deg,
        #020617,
        #061747,
        #071a52,
        #020617
    );

    background-size:200% 200%;

    animation:
    backgroundMove 15s ease infinite;

    overflow-x:hidden;

}


/* =========================================================
   BACKGROUND ANIMATION
========================================================= */

@keyframes backgroundMove{

    0%{
        background-position:0% 50%;
    }

    50%{
        background-position:100% 50%;
    }

    100%{
        background-position:0% 50%;
    }

}


/* =========================================================
   3D PARTICLE BACKGROUND
========================================================= */

.particles{

    position:fixed;

    inset:0;

    pointer-events:none;

    overflow:hidden;

    z-index:-1;

}

.particle{

    position:absolute;

    width:5px;
    height:5px;

    background:var(--gold);

    border-radius:50%;

    box-shadow:
    0 0 10px var(--gold),
    0 0 25px rgba(255,215,0,.7);

    animation:
    particleFloat linear infinite;

    opacity:.6;

}


@keyframes particleFloat{

    0%{

        transform:
        translate3d(0,100vh,0)
        scale(.5);

        opacity:0;

    }

    15%{
        opacity:.8;
    }

    85%{
        opacity:.8;
    }

    100%{

        transform:
        translate3d(100px,-20vh,0)
        scale(1.5);

        opacity:0;

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

    height:75px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:0 28px;

    z-index:1000;

    background:

    linear-gradient(
        135deg,
        rgba(3,15,55,.94),
        rgba(7,26,82,.88)
    );

    backdrop-filter:blur(18px);

    border-bottom:

    1px solid
    rgba(255,215,0,.25);

    box-shadow:

    0 10px 40px
    rgba(0,0,0,.35);

}


/* =========================================================
   HEADER TITLE
========================================================= */

.header-title{

    display:flex;

    align-items:center;

    gap:14px;

}


.header-logo{

    width:45px;
    height:45px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:14px;

    color:#111;

    font-size:20px;

    background:

    linear-gradient(
        135deg,
        var(--gold-light),
        var(--gold),
        var(--gold-dark)
    );

    box-shadow:

    0 0 20px
    rgba(255,215,0,.35),

    inset 0 1px 3px
    rgba(255,255,255,.7);

    transform:
    perspective(500px)
    rotateY(-10deg);

}


.header h2{

    font-size:20px;

    color:white;

    font-weight:700;

    letter-spacing:.3px;

}


.header h2 span{

    color:var(--gold);

}


/* =========================================================
   LOGOUT
========================================================= */

.logout a{

    display:flex;

    align-items:center;

    gap:8px;

    text-decoration:none;

    color:white;

    padding:11px 20px;

    border-radius:12px;

    font-weight:600;

    background:

    linear-gradient(
        135deg,
        #ff416c,
        #dc3545
    );

    box-shadow:

    0 10px 25px
    rgba(220,53,69,.28);

    transition:.4s;

}


.logout a:hover{

    transform:

    translateY(-3px)
    scale(1.03);

    box-shadow:

    0 15px 35px
    rgba(220,53,69,.5);

}


/* =========================================================
   SIDEBAR
========================================================= */

.sidebar{

    position:fixed;

    top:75px;
    left:0;

    width:250px;

    height:calc(100vh - 75px);

    padding:20px 14px;

    background:

    linear-gradient(
        180deg,
        rgba(3,15,55,.96),
        rgba(2,6,23,.96)
    );

    border-right:

    1px solid
    rgba(255,215,0,.16);

    box-shadow:

    15px 0 45px
    rgba(0,0,0,.25);

    overflow-y:auto;

    z-index:900;

}


/* =========================================================
   SIDEBAR TITLE
========================================================= */

.sidebar-title{

    color:var(--gold);

    font-size:11px;

    font-weight:700;

    letter-spacing:2px;

    padding:10px 15px;

    text-transform:uppercase;

}


/* =========================================================
   SIDEBAR UL
========================================================= */

.sidebar ul{

    list-style:none;

}


/* =========================================================
   SIDEBAR ITEMS
========================================================= */

.sidebar li{

    margin:7px 0;

}


.sidebar a{

    position:relative;

    display:flex;

    align-items:center;

    gap:13px;

    padding:14px 15px;

    color:#cbd5e1;

    text-decoration:none;

    border-radius:14px;

    font-size:14px;

    font-weight:500;

    overflow:hidden;

    transition:.35s;

}


/* Icon */

.sidebar a i{

    width:24px;

    text-align:center;

    color:var(--gold);

    transition:.35s;

}


/* Shine */

.sidebar a::before{

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
        rgba(255,255,255,.15),
        transparent
    );

    transform:skewX(-20deg);

    transition:.6s;

}


.sidebar a:hover::before{

    left:130%;

}


.sidebar a:hover{

    color:white;

    background:

    linear-gradient(
        135deg,
        rgba(13,110,253,.35),
        rgba(255,215,0,.08)
    );

    transform:
    translateX(7px)
    perspective(600px)
    rotateY(-3deg);

    box-shadow:

    0 10px 25px
    rgba(0,0,0,.25);

}


.sidebar a:hover i{

    transform:
    rotateY(360deg)
    scale(1.15);

}


/* Active */

.sidebar a.active{

    color:white;

    background:

    linear-gradient(
        135deg,
        #0d6efd,
        #071a52
    );

    border:

    1px solid
    rgba(255,215,0,.28);

    box-shadow:

    0 12px 30px
    rgba(13,110,253,.3);

}


/* =========================================================
   CONTENT
========================================================= */

.content{

    margin-left:250px;

    padding:

    110px 35px
    50px;

    min-height:100vh;

}


/* =========================================================
   TOP PAGE AREA
========================================================= */

.page-heading{

    display:flex;

    align-items:center;

    justify-content:space-between;

    gap:20px;

    margin-bottom:28px;

}


.page-heading h1{

    font-size:32px;

    color:white;

    font-weight:700;

}


.page-heading h1 span{

    color:var(--gold);

}


.page-heading p{

    color:var(--muted);

    font-size:13px;

    margin-top:5px;

}


/* =========================================================
   SEARCH AREA
========================================================= */

.toolbar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:15px;

    margin-bottom:22px;

}


.search-box{

    position:relative;

    width:350px;

}


.search-box i{

    position:absolute;

    left:16px;
    top:50%;

    transform:translateY(-50%);

    color:var(--gold);

}


.search-box input{

    width:100%;

    padding:13px 15px 13px 45px;

    border-radius:14px;

    border:

    1px solid
    rgba(255,255,255,.12);

    outline:none;

    color:white;

    background:

    rgba(255,255,255,.07);

    backdrop-filter:blur(15px);

    transition:.3s;

}


.search-box input::placeholder{

    color:#94a3b8;

}


.search-box input:focus{

    border-color:

    rgba(255,215,0,.6);

    box-shadow:

    0 0 25px
    rgba(255,215,0,.12);

}


/* =========================================================
   COMPLAINT BOX
========================================================= */

.box{

    position:relative;

    padding:25px;

    border-radius:22px;

    background:

    linear-gradient(
        145deg,
        rgba(255,255,255,.10),
        rgba(255,255,255,.035)
    );

    border:

    1px solid
    rgba(255,255,255,.12);

    backdrop-filter:blur(20px);

    box-shadow:

    0 30px 70px
    rgba(0,0,0,.35);

    transform:
    perspective(1200px)
    rotateX(0deg);

    transition:.5s;

}


.box:hover{

    box-shadow:

    0 40px 90px
    rgba(0,0,0,.45);

}


.box::before{

    content:"";

    position:absolute;

    top:0;
    left:8%;

    width:84%;
    height:1px;

    background:

    linear-gradient(
        90deg,
        transparent,
        var(--gold),
        transparent
    );

}


/* =========================================================
   BOX TITLE
========================================================= */

.box-header{

    display:flex;

    align-items:center;

    justify-content:space-between;

    margin-bottom:20px;

}


.box-header h2{

    color:white;

    font-size:20px;

}


.box-header h2 i{

    color:var(--gold);

    margin-right:8px;

}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.table-wrapper{

    width:100%;

    overflow-x:auto;

    border-radius:15px;

}


/* =========================================================
   TABLE
========================================================= */

table{

    width:100%;

    min-width:1100px;

    border-collapse:separate;

    border-spacing:0 7px;

}


/* Header */

th{

    padding:15px 12px;

    color:#111827;

    font-size:12px;

    font-weight:700;

    text-transform:uppercase;

    letter-spacing:.5px;

    background:

    linear-gradient(
        135deg,
        var(--gold-light),
        var(--gold)
    );

}


th:first-child{

    border-radius:12px 0 0 12px;

}


th:last-child{

    border-radius:0 12px 12px 0;

}


/* Rows */

tbody tr{

    opacity:0;

    transform:

    translateY(25px)
    rotateX(-5deg);

    animation:
    rowAppear .7s forwards;

    transition:.4s;

}


@keyframes rowAppear{

    to{

        opacity:1;

        transform:
        translateY(0)
        rotateX(0);

    }

}


tbody tr:hover{

    transform:
    translateY(-4px)
    scale(1.005);

}


/* Cells */

td{

    padding:14px 12px;

    color:#dbeafe;

    font-size:13px;

    text-align:center;

    background:

    rgba(255,255,255,.055);

    border-top:

    1px solid
    rgba(255,255,255,.05);

    border-bottom:

    1px solid
    rgba(255,255,255,.05);

}


td:first-child{

    border-left:

    1px solid
    rgba(255,255,255,.05);

    border-radius:12px 0 0 12px;

}


td:last-child{

    border-right:

    1px solid
    rgba(255,255,255,.05);

    border-radius:0 12px 12px 0;

}


/* =========================================================
   ID BADGE
========================================================= */

.id-badge{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    min-width:38px;

    padding:5px 9px;

    border-radius:8px;

    color:#111;

    font-weight:700;

    background:

    linear-gradient(
        135deg,
        var(--gold-light),
        var(--gold)
    );

    box-shadow:

    0 5px 15px
    rgba(255,215,0,.18);

}


/* =========================================================
   STATUS
========================================================= */

.status{

    display:inline-flex;

    align-items:center;

    gap:6px;

    padding:7px 12px;

    border-radius:30px;

    font-size:11px;

    font-weight:700;

}


.status::before{

    content:"";

    width:7px;
    height:7px;

    border-radius:50%;

    animation:
    statusPulse 1.5s infinite;

}


@keyframes statusPulse{

    0%,100%{
        transform:scale(1);
    }

    50%{
        transform:scale(1.5);
    }

}


.pending{

    color:#ffb4b4;

    background:
    rgba(220,53,69,.14);

    border:
    1px solid
    rgba(220,53,69,.25);

}


.pending::before{

    background:#ff4757;

    box-shadow:
    0 0 10px #ff4757;

}


.processing{

    color:#ffd699;

    background:
    rgba(253,126,20,.14);

    border:
    1px solid
    rgba(253,126,20,.25);

}


.processing::before{

    background:#ff9800;

    box-shadow:
    0 0 10px #ff9800;

}


.finished{

    color:#a7f3d0;

    background:
    rgba(25,135,84,.14);

    border:
    1px solid
    rgba(25,135,84,.25);

}


.finished::before{

    background:#20c997;

    box-shadow:
    0 0 10px #20c997;

}


/* =========================================================
   DETAILS BUTTON
========================================================= */

.btn{

    position:relative;

    display:inline-flex;

    align-items:center;

    gap:7px;

    padding:9px 15px;

    color:#111827;

    text-decoration:none;

    font-size:12px;

    font-weight:700;

    border-radius:10px;

    background:

    linear-gradient(
        135deg,
        var(--gold-light),
        var(--gold),
        var(--gold-dark)
    );

    box-shadow:

    0 7px 20px
    rgba(255,215,0,.2);

    overflow:hidden;

    transition:.4s;

}


.btn::before{

    content:"";

    position:absolute;

    top:0;
    left:-100%;

    width:60%;
    height:100%;

    background:

    linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,.7),
        transparent
    );

    transform:skewX(-20deg);

}


.btn:hover::before{

    left:130%;

    transition:.6s;

}


.btn:hover{

    transform:

    translateY(-3px)
    scale(1.04);

    box-shadow:

    0 12px 30px
    rgba(255,215,0,.4);

}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty{

    padding:60px 20px;

    text-align:center;

}


.empty i{

    font-size:50px;

    color:var(--gold);

    margin-bottom:15px;

    animation:
    floatingIcon 3s ease-in-out infinite;

}


@keyframes floatingIcon{

    0%,100%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-10px);
    }

}


.empty h3{

    color:white;

    margin-bottom:5px;

}


.empty p{

    color:var(--muted);

    font-size:13px;

}


/* =========================================================
   FOOTER
========================================================= */

.footer{

    text-align:center;

    padding:35px 10px 10px;

    color:#64748b;

    font-size:12px;

}


.footer span{

    color:var(--gold);

}


/* =========================================================
   SCROLLBAR
========================================================= */

::-webkit-scrollbar{

    width:8px;
    height:8px;

}


::-webkit-scrollbar-track{

    background:#020617;

}


::-webkit-scrollbar-thumb{

    background:

    linear-gradient(
        var(--blue),
        var(--gold)
    );

    border-radius:20px;

}


/* =========================================================
   MOBILE MENU
========================================================= */

.menu-btn{

    display:none;

    position:fixed;

    top:17px;
    left:18px;

    width:42px;
    height:42px;

    border:none;

    border-radius:12px;

    color:white;

    background:

    linear-gradient(
        135deg,
        var(--blue),
        var(--royal-blue)
    );

    z-index:1200;

    cursor:pointer;

    box-shadow:

    0 10px 25px
    rgba(0,0,0,.3);

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .sidebar{

        width:220px;

    }

    .content{

        margin-left:220px;

    }

}


@media(max-width:850px){

    .menu-btn{

        display:flex;

        align-items:center;

        justify-content:center;

    }

    .sidebar{

        transform:
        translateX(-100%);

        transition:.4s;

        width:260px;

    }

    .sidebar.open{

        transform:
        translateX(0);

    }

    .content{

        margin-left:0;

        padding:
        100px 18px 35px;

    }

    .header{

        padding-left:75px;

    }

    .header h2{

        font-size:15px;

    }

    .header-logo{

        display:none;

    }

    .page-heading{

        flex-direction:column;

        align-items:flex-start;

    }

    .toolbar{

        flex-direction:column;

        align-items:stretch;

    }

    .search-box{

        width:100%;

    }

}


@media(max-width:500px){

    .header{

        height:65px;

    }

    .logout a{

        padding:9px 12px;

        font-size:11px;

    }

    .logout a span{

        display:none;

    }

    .page-heading h1{

        font-size:25px;

    }

    .box{

        padding:15px;

        border-radius:17px;

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

        scroll-behavior:auto !important;

    }

}

</style>

</head>


<body>


<!-- =====================================================
     PARTICLE BACKGROUND
===================================================== -->

<div class="particles" id="particles"></div>


<!-- =====================================================
     MOBILE MENU
===================================================== -->

<button class="menu-btn" id="menuBtn">

    <i class="fas fa-bars"></i>

</button>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="header">

    <div class="header-title">

        <div class="header-logo">

            <i class="fas fa-crown"></i>

        </div>

        <h2>
            College Complaint Management System
            <span>• Admin Panel</span>
        </h2>

    </div>


    <div class="logout">

        <a href="admin_logout.php">

            <i class="fas fa-power-off"></i>

            <span>Logout</span>

        </a>

    </div>

</div>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar" id="sidebar">

    <div class="sidebar-title">
        Administration
    </div>

    <ul>

        <li>

            <a href="admin_dashboard.php">

                <i class="fas fa-chart-pie"></i>

                Dashboard

            </a>

        </li>


        <li>

            <a href="students.php">

                <i class="fas fa-user-graduate"></i>

                Manage Students

            </a>

        </li>


        <li>

            <a href="complaints.php" class="active">

                <i class="fas fa-file-circle-exclamation"></i>

                Complaint Details

            </a>

        </li>


        <li>

            <a href="pending_complaints.php">

                <i class="fas fa-hourglass-half"></i>

                Pending Complaints

            </a>

        </li>


        <li>

            <a href="resolved_complaints.php">

                <i class="fas fa-circle-check"></i>

                Finished Complaints

            </a>

        </li>


        <li>

            <a href="reports.php">

                <i class="fas fa-chart-line"></i>

                Reports

            </a>

        </li>


        <li>

            <a href="change_password.php">

                <i class="fas fa-key"></i>

                Change Password

            </a>

        </li>


        <li>

            <a href="admin_logout.php">

                <i class="fas fa-right-from-bracket"></i>

                Logout

            </a>

        </li>

    </ul>

</div>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="content">


    <!-- PAGE HEADER -->

    <div class="page-heading">

        <div>

            <h1>
                <span>Complaint</span> Management
            </h1>

            <p>
                Monitor, review and manage all student complaints.
            </p>

        </div>

    </div>


    <!-- TOOLBAR -->

    <div class="toolbar">

        <div class="search-box">

            <i class="fas fa-search"></i>

            <input
                type="text"
                id="searchInput"
                placeholder="Search complaints..."
            >

        </div>

    </div>


    <!-- COMPLAINT TABLE -->

    <div class="box">

        <div class="box-header">

            <h2>

                <i class="fas fa-layer-group"></i>

                All Complaints

            </h2>

        </div>


        <div class="table-wrapper">

            <table id="complaintTable">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Register No</th>

                        <th>Name</th>

                        <th>Course</th>

                        <th>Department</th>

                        <th>Category</th>

                        <th>Subject</th>

                        <th>Date</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                if(mysqli_num_rows($result)>0)
                {

                    $delay = 0;

                    while($row=mysqli_fetch_assoc($result))
                    {

                ?>

                    <tr style="animation-delay:<?php echo $delay; ?>s;">

                        <td>

                            <span class="id-badge">

                                #<?php echo htmlspecialchars($row['id']); ?>

                            </span>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['register_no']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['student_name']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['course']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['department']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['complaint_category']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['complaint_subject']);
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars($row['complaint_date']);
                            ?>

                        </td>


                        <td>

                            <?php

                            if($row['status']=="Pending")
                            {

                                echo '
                                <span class="status pending">
                                    Pending
                                </span>';

                            }

                            elseif($row['status']=="Processing")
                            {

                                echo '
                                <span class="status processing">
                                    Processing
                                </span>';

                            }

                            elseif(
                                $row['status']=="Finished" ||
                                $row['status']=="Resolved"
                            )
                            {

                                echo '
                                <span class="status finished">
                                    Finished
                                </span>';

                            }

                            else
                            {

                                echo htmlspecialchars(
                                    $row['status']
                                );

                            }

                            ?>

                        </td>


                        <td>

                            <a
                                class="btn"
                                href="complaint_details.php?id=<?php echo urlencode($row['id']); ?>"
                            >

                                <i class="fas fa-eye"></i>

                                Details

                            </a>

                        </td>

                    </tr>

                <?php

                        $delay += .06;

                    }

                }

                else

                {

                ?>

                    <tr>

                        <td colspan="10">

                            <div class="empty">

                                <i class="fas fa-inbox"></i>

                                <h3>
                                    No Complaints Found
                                </h3>

                                <p>
                                    There are currently no complaint records.
                                </p>

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


    <!-- FOOTER -->

    <div class="footer">

        <h4>

            <span>✦</span>

            © 2026 College Complaint Management System

            <span>✦</span>

            Admin Dashboard

        </h4>

    </div>


</div>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>

/* =========================================================
   PARTICLE GENERATOR
========================================================= */

const particleContainer =
document.getElementById("particles");

const particleCount = 45;


for(let i = 0; i < particleCount; i++){

    const particle =
    document.createElement("div");

    particle.className =
    "particle";

    particle.style.left =
    Math.random() * 100 + "%";

    particle.style.animationDuration =
    (7 + Math.random() * 12) + "s";

    particle.style.animationDelay =
    (Math.random() * 8) + "s";

    const size =
    2 + Math.random() * 5;

    particle.style.width =
    size + "px";

    particle.style.height =
    size + "px";

    particleContainer.appendChild(
        particle
    );

}


/* =========================================================
   MOBILE SIDEBAR
========================================================= */

const menuBtn =
document.getElementById("menuBtn");

const sidebar =
document.getElementById("sidebar");


menuBtn.addEventListener(
    "click",
    function(){

        sidebar.classList.toggle("open");

        const icon =
        menuBtn.querySelector("i");

        if(
            sidebar.classList.contains("open")
        ){

            icon.className =
            "fas fa-xmark";

        }

        else{

            icon.className =
            "fas fa-bars";

        }

    }
);


/* =========================================================
   CLOSE SIDEBAR WHEN LINK CLICKED
========================================================= */

document
.querySelectorAll(".sidebar a")
.forEach(link => {

    link.addEventListener(
        "click",
        function(){

            if(
                window.innerWidth <= 850
            ){

                sidebar.classList.remove(
                    "open"
                );

                menuBtn
                .querySelector("i")
                .className =
                "fas fa-bars";

            }

        }
    );

});


/* =========================================================
   SEARCH / FILTER
========================================================= */

const searchInput =
document.getElementById("searchInput");

const table =
document.getElementById("complaintTable");

searchInput.addEventListener(
    "input",
    function(){

        const value =
        this.value.toLowerCase().trim();

        const rows =
        table.querySelectorAll(
            "tbody tr"
        );

        rows.forEach(row => {

            const text =
            row.innerText.toLowerCase();

            if(text.includes(value)){

                row.style.display =
                "";

            }

            else{

                row.style.display =
                "none";

            }

        });

    }
);


/* =========================================================
   3D TABLE TILT
========================================================= */

const box =
document.querySelector(".box");


box.addEventListener(
    "mousemove",
    function(e){

        if(window.innerWidth < 900)
            return;

        const rect =
        box.getBoundingClientRect();

        const x =
        e.clientX - rect.left;

        const y =
        e.clientY - rect.top;

        const centerX =
        rect.width / 2;

        const centerY =
        rect.height / 2;

        const rotateX =
        ((y - centerY) / centerY) * -1.2;

        const rotateY =
        ((x - centerX) / centerX) * 1.2;

        box.style.transform =
        `
        perspective(1200px)
        rotateX(${rotateX}deg)
        rotateY(${rotateY}deg)
        `;

    }
);


box.addEventListener(
    "mouseleave",
    function(){

        box.style.transform =
        `
        perspective(1200px)
        rotateX(0deg)
        rotateY(0deg)
        `;

    }
);


/* =========================================================
   3D BUTTON CLICK EFFECT
========================================================= */

document
.querySelectorAll(".btn")
.forEach(button => {

    button.addEventListener(
        "click",
        function(e){

            const ripple =
            document.createElement("span");

            ripple.style.position =
            "absolute";

            ripple.style.width =
            "10px";

            ripple.style.height =
            "10px";

            ripple.style.borderRadius =
            "50%";

            ripple.style.background =
            "rgba(255,255,255,.8)";

            ripple.style.transform =
            "scale(0)";

            ripple.style.pointerEvents =
            "none";

            ripple.style.left =
            e.offsetX + "px";

            ripple.style.top =
            e.offsetY + "px";

            ripple.style.animation =
            "ripple .6s linear";

            this.appendChild(ripple);

            setTimeout(
                () => ripple.remove(),
                600
            );

        }
    );

});


/* =========================================================
   RIPPLE STYLE
========================================================= */

const rippleStyle =
document.createElement("style");

rippleStyle.innerHTML = `

@keyframes ripple{

    to{

        transform:scale(25);

        opacity:0;

    }

}

`;

document.head.appendChild(
    rippleStyle
);


/* =========================================================
   TABLE ROW HOVER SOUND-LIKE EFFECT
   Visual pulse only — no external audio required.
========================================================= */

document
.querySelectorAll("#complaintTable tbody tr")
.forEach(row => {

    row.addEventListener(
        "mouseenter",
        function(){

            this.style.boxShadow =
            "0 10px 30px rgba(0,0,0,.22)";

        }
    );

    row.addEventListener(
        "mouseleave",
        function(){

            this.style.boxShadow =
            "none";

        }
    );

});


/* =========================================================
   PARALLAX BACKGROUND
========================================================= */

document.addEventListener(
    "mousemove",
    function(e){

        const x =
        (e.clientX / window.innerWidth - .5);

        const y =
        (e.clientY / window.innerHeight - .5);

        particleContainer.style.transform =
        `
        translate(
            ${x * 12}px,
            ${y * 12}px
        )
        `;

    }
);


/* =========================================================
   ESC KEY CLOSE MOBILE SIDEBAR
========================================================= */

document.addEventListener(
    "keydown",
    function(e){

        if(e.key === "Escape"){

            sidebar.classList.remove(
                "open"
            );

            menuBtn
            .querySelector("i")
            .className =
            "fas fa-bars";

        }

    }
);

</script>


</body>
</html>