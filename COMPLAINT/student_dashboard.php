<?php
session_start();

/*
|--------------------------------------------------------------------------
| LOGIN PROTECTION
|--------------------------------------------------------------------------
| Uncomment after your student login system is ready.
|
if(!isset($_SESSION['student_name']))
{
    header("Location: login.php");
    exit();
}
*/

$studentName = isset($_SESSION['student_name'])
    ? $_SESSION['student_name']
    : "Student";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Dashboard | Online Complaint Management System</title>

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

/* =========================================================
   ROOT
========================================================= */

:root{

    --royal-blue:#061a40;
    --deep-blue:#020b1f;
    --blue:#0b5ed7;

    --gold:#f5c451;
    --gold-light:#ffe7a3;
    --gold-dark:#b8860b;

    --white:#ffffff;
    --text:#dce7f7;
    --muted:#8ea3c0;

    --glass:rgba(255,255,255,.065);

    --border:rgba(255,255,255,.12);

    --shadow:
        0 25px 70px rgba(0,0,0,.45);

}


/* =========================================================
   GLOBAL
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

    font-family:'Poppins',sans-serif;

}

html{

    scroll-behavior:smooth;

}

body{

    min-height:100vh;

    color:var(--text);

    background:

        radial-gradient(
            circle at 15% 20%,
            rgba(11,94,215,.28),
            transparent 28%
        ),

        radial-gradient(
            circle at 85% 75%,
            rgba(245,196,81,.12),
            transparent 25%
        ),

        linear-gradient(
            135deg,
            #020617,
            #041638,
            #061f4d,
            #020617
        );

    background-size:200% 200%;

    animation:
        backgroundMove 18s ease infinite;

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
   LIGHT ORBS
========================================================= */

body::before{

    content:"";

    position:fixed;

    width:500px;
    height:500px;

    border-radius:50%;

    background:

        radial-gradient(
            circle,
            rgba(11,94,215,.15),
            transparent 70%
        );

    filter:blur(20px);

    left:-180px;
    top:-180px;

    pointer-events:none;

    animation:
        orbOne 12s ease-in-out infinite;

    z-index:-2;

}


body::after{

    content:"";

    position:fixed;

    width:450px;
    height:450px;

    border-radius:50%;

    background:

        radial-gradient(
            circle,
            rgba(245,196,81,.10),
            transparent 70%
        );

    filter:blur(25px);

    right:-180px;
    bottom:-180px;

    pointer-events:none;

    animation:
        orbTwo 15s ease-in-out infinite;

    z-index:-2;

}


@keyframes orbOne{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(160px,120px);
    }

}


@keyframes orbTwo{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-130px,-100px);
    }

}


/* =========================================================
   PARTICLES
========================================================= */

.particles{

    position:fixed;

    inset:0;

    overflow:hidden;

    pointer-events:none;

    z-index:-1;

}


.particle{

    position:absolute;

    width:4px;
    height:4px;

    border-radius:50%;

    background:var(--gold);

    box-shadow:

        0 0 8px var(--gold),
        0 0 18px rgba(245,196,81,.5);

    animation:

        particleMove
        linear
        infinite;

}


@keyframes particleMove{

    0%{

        transform:
            translateY(110vh)
            scale(.4);

        opacity:0;

    }

    20%{
        opacity:1;
    }

    80%{
        opacity:1;
    }

    100%{

        transform:
            translateY(-20vh)
            scale(1.3);

        opacity:0;

    }

}


/* =========================================================
   TOP HEADER
========================================================= */

.header{

    position:fixed;

    top:0;
    left:0;

    width:100%;

    height:78px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:0 30px;

    background:

        linear-gradient(
            135deg,
            rgba(2,15,40,.96),
            rgba(5,34,79,.92)
        );

    backdrop-filter:blur(20px);

    border-bottom:
        1px solid rgba(245,196,81,.18);

    box-shadow:

        0 15px 50px rgba(0,0,0,.35);

    z-index:1000;

}


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
            var(--gold),
            #fff1b8,
            var(--gold),
            transparent
        );

    background-size:400px 100%;

    animation:
        goldLine 5s linear infinite;

}


@keyframes goldLine{

    from{
        background-position:-400px;
    }

    to{
        background-position:400px;
    }

}


/* =========================================================
   HEADER LEFT
========================================================= */

.header-left{

    display:flex;

    align-items:center;

    gap:14px;

}


.logo{

    width:48px;
    height:48px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:15px;

    color:var(--gold);

    font-size:21px;

    background:

        linear-gradient(
            145deg,
            rgba(245,196,81,.16),
            rgba(11,94,215,.25)
        );

    border:
        1px solid rgba(245,196,81,.28);

    box-shadow:

        inset 0 0 20px rgba(245,196,81,.06),
        0 10px 30px rgba(0,0,0,.3);

    animation:

        logoFloat 4s ease-in-out infinite;

}


@keyframes logoFloat{

    0%,100%{
        transform:
            translateY(0)
            rotateY(0);
    }

    50%{
        transform:
            translateY(-4px)
            rotateY(15deg);
    }

}


.header-title{

    font-family:'Cinzel',serif;

    font-size:19px;

    font-weight:700;

    color:#fff;

    letter-spacing:.5px;

}


.header-subtitle{

    color:var(--gold-light);

    font-size:10px;

    margin-top:2px;

    letter-spacing:1.5px;

    text-transform:uppercase;

}


/* =========================================================
   STUDENT BADGE
========================================================= */

.student-badge{

    display:flex;

    align-items:center;

    gap:10px;

    padding:9px 15px;

    border-radius:30px;

    background:

        rgba(255,255,255,.055);

    border:
        1px solid rgba(245,196,81,.18);

    color:#dbeafe;

    font-size:12px;

}


.student-badge i{

    color:var(--gold);

}


/* =========================================================
   NAVBAR
========================================================= */

.navbar{

    position:fixed;

    top:78px;

    left:0;

    width:100%;

    height:62px;

    z-index:900;

    display:flex;

    align-items:center;

    justify-content:center;

    gap:8px;

    background:

        rgba(2,12,30,.88);

    backdrop-filter:blur(18px);

    border-bottom:
        1px solid rgba(255,255,255,.08);

}


.navbar a{

    position:relative;

    display:flex;

    align-items:center;

    gap:7px;

    padding:9px 15px;

    border-radius:10px;

    color:#aebed4;

    text-decoration:none;

    font-size:12px;

    font-weight:600;

    transition:.3s;

}


.navbar a i{

    color:#6ea8ff;

}


.navbar a:hover{

    color:#fff;

    background:

        linear-gradient(
            135deg,
            rgba(11,94,215,.25),
            rgba(245,196,81,.08)
        );

    transform:
        translateY(-2px);

    box-shadow:

        0 8px 25px rgba(0,0,0,.25);

}


.navbar a:hover i{

    color:var(--gold);

}


.navbar a.active{

    color:#fff;

    background:

        linear-gradient(
            135deg,
            rgba(11,94,215,.32),
            rgba(245,196,81,.10)
        );

    border:
        1px solid rgba(245,196,81,.12);

}


.navbar a.active::after{

    content:"";

    position:absolute;

    left:20%;

    right:20%;

    bottom:-7px;

    height:2px;

    background:var(--gold);

    box-shadow:
        0 0 10px var(--gold);

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

    color:#fff;

    background:
        rgba(255,255,255,.08);

    cursor:pointer;

    font-size:17px;

}


/* =========================================================
   MAIN
========================================================= */

.container{

    width:92%;

    max-width:1400px;

    margin:auto;

    padding-top:170px;

    padding-bottom:50px;

}


/* =========================================================
   HERO / WELCOME
========================================================= */

.welcome{

    position:relative;

    padding:35px;

    margin-bottom:28px;

    border-radius:25px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.09),
            rgba(255,255,255,.035)
        );

    border:
        1px solid rgba(245,196,81,.15);

    backdrop-filter:blur(20px);

    box-shadow:var(--shadow);

    overflow:hidden;

    transform-style:preserve-3d;

    animation:
        welcomeEnter .8s ease;

}


@keyframes welcomeEnter{

    from{

        opacity:0;

        transform:
            translateY(35px)
            rotateX(8deg);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0);

    }

}


.welcome::before{

    content:"";

    position:absolute;

    width:260px;
    height:260px;

    right:-90px;
    top:-110px;

    border-radius:50%;

    background:

        radial-gradient(
            circle,
            rgba(245,196,81,.18),
            transparent 70%
        );

}


.welcome::after{

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


.welcome h2{

    position:relative;

    font-family:'Cinzel',serif;

    color:#fff;

    font-size:27px;

    margin-bottom:8px;

    z-index:1;

}


.welcome h2 span{

    color:var(--gold);

    text-shadow:

        0 0 15px rgba(245,196,81,.25);

}


.welcome p{

    position:relative;

    color:var(--muted);

    font-size:13px;

    z-index:1;

}


/* =========================================================
   DASHBOARD SECTION TITLE
========================================================= */

.section-title{

    display:flex;

    align-items:center;

    gap:10px;

    margin:28px 0 18px;

}


.section-title i{

    color:var(--gold);

}


.section-title h3{

    font-family:'Cinzel',serif;

    color:#fff;

    font-size:19px;

}


.section-title span{

    flex:1;

    height:1px;

    background:

        linear-gradient(
            90deg,
            rgba(245,196,81,.3),
            transparent
        );

}


/* =========================================================
   DASHBOARD CARDS
========================================================= */

.cards{

    display:grid;

    grid-template-columns:
        repeat(4,1fr);

    gap:20px;

}


.card{

    position:relative;

    min-height:240px;

    padding:28px 22px;

    text-align:center;

    border-radius:22px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.09),
            rgba(255,255,255,.025)
        );

    border:
        1px solid rgba(255,255,255,.11);

    backdrop-filter:blur(18px);

    box-shadow:

        0 20px 50px rgba(0,0,0,.28);

    transform-style:preserve-3d;

    overflow:hidden;

    transition:
        box-shadow .35s;

    animation:
        cardEnter .7s ease both;

}


.card:nth-child(2){
    animation-delay:.08s;
}

.card:nth-child(3){
    animation-delay:.16s;
}

.card:nth-child(4){
    animation-delay:.24s;
}


@keyframes cardEnter{

    from{

        opacity:0;

        transform:
            translateY(40px)
            rotateX(12deg);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0);

    }

}


.card:hover{

    box-shadow:

        0 30px 70px rgba(0,0,0,.42),

        0 0 35px
        rgba(245,196,81,.08);

}


.card::before{

    content:"";

    position:absolute;

    width:150px;
    height:150px;

    border-radius:50%;

    top:-75px;
    right:-75px;

    background:

        radial-gradient(
            circle,
            rgba(245,196,81,.15),
            transparent 70%
        );

}


.card-icon{

    width:65px;
    height:65px;

    margin:auto;
    margin-bottom:17px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:20px;

    font-size:25px;

    color:var(--gold);

    background:

        linear-gradient(
            145deg,
            rgba(245,196,81,.14),
            rgba(11,94,215,.18)
        );

    border:
        1px solid rgba(245,196,81,.18);

    box-shadow:

        inset 0 0 20px
        rgba(245,196,81,.04),

        0 10px 30px
        rgba(0,0,0,.25);

    transform:
        translateZ(35px);

}


.card h3{

    font-family:'Cinzel',serif;

    color:#fff;

    font-size:17px;

    margin-bottom:9px;

    transform:
        translateZ(25px);

}


.card p{

    color:#8ea3c0;

    font-size:11px;

    line-height:1.7;

    min-height:58px;

    margin-bottom:18px;

    transform:
        translateZ(15px);

}


/* =========================================================
   CARD BUTTON
========================================================= */

.card a{

    display:inline-flex;

    align-items:center;

    gap:8px;

    text-decoration:none;

    color:#07152f;

    padding:10px 18px;

    border-radius:10px;

    font-size:11px;

    font-weight:700;

    background:

        linear-gradient(
            135deg,
            #ffe7a3,
            #f5c451,
            #c9972b
        );

    box-shadow:

        0 8px 22px
        rgba(245,196,81,.20);

    transition:.35s;

    transform:
        translateZ(30px);

}


.card a:hover{

    transform:
        translateZ(30px)
        translateY(-4px);

    box-shadow:

        0 15px 35px
        rgba(245,196,81,.35);

}


/* =========================================================
   CATEGORY PANEL
========================================================= */

.category-panel{

    position:relative;

    padding:28px;

    border-radius:24px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.08),
            rgba(255,255,255,.025)
        );

    border:
        1px solid rgba(255,255,255,.11);

    backdrop-filter:blur(20px);

    box-shadow:var(--shadow);

    overflow:hidden;

}


.category-panel::before{

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


.categories{

    display:grid;

    grid-template-columns:
        repeat(5,1fr);

    gap:12px;

}


.category{

    position:relative;

    min-height:85px;

    padding:15px;

    display:flex;

    flex-direction:column;

    align-items:center;

    justify-content:center;

    gap:7px;

    text-align:center;

    border-radius:16px;

    background:

        rgba(255,255,255,.035);

    border:
        1px solid rgba(255,255,255,.07);

    color:#aebed4;

    font-size:10px;

    cursor:default;

    transition:
        .3s ease;

    transform-style:preserve-3d;

}


.category i{

    color:#6ea8ff;

    font-size:18px;

    transform:
        translateZ(15px);

}


.category:hover{

    color:#fff;

    background:

        linear-gradient(
            145deg,
            rgba(11,94,215,.20),
            rgba(245,196,81,.08)
        );

    border-color:
        rgba(245,196,81,.20);

    transform:
        translateY(-5px)
        rotateX(5deg);

    box-shadow:

        0 15px 30px
        rgba(0,0,0,.25);

}


.category:hover i{

    color:var(--gold);

    transform:
        translateZ(25px)
        scale(1.15);

}


/* =========================================================
   FOOTER
========================================================= */

.footer{

    margin-top:45px;

    padding:25px 10px;

    text-align:center;

    color:#64748b;

    font-size:11px;

    border-top:
        1px solid rgba(255,255,255,.06);

}


.footer i{

    color:var(--gold);

    margin-right:5px;

}


/* =========================================================
   CURSOR GLOW
========================================================= */

.cursor-light{

    position:fixed;

    width:260px;
    height:260px;

    border-radius:50%;

    pointer-events:none;

    z-index:-1;

    background:

        radial-gradient(
            circle,
            rgba(245,196,81,.07),
            transparent 70%
        );

    transform:
        translate(-50%,-50%);

}


/* =========================================================
   SCROLLBAR
========================================================= */

::-webkit-scrollbar{

    width:7px;

}


::-webkit-scrollbar-track{

    background:#020617;

}


::-webkit-scrollbar-thumb{

    background:

        linear-gradient(
            var(--gold-dark),
            var(--gold)
        );

    border-radius:20px;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .cards{

        grid-template-columns:
            repeat(2,1fr);

    }

    .categories{

        grid-template-columns:
            repeat(4,1fr);

    }

}


@media(max-width:800px){

    .header{

        padding:0 15px;

    }

    .header-title{

        font-size:14px;

    }

    .header-subtitle{

        display:none;

    }

    .student-badge{

        display:none;

    }

    .navbar{

        position:fixed;

        left:0;
        right:0;

        height:auto;

        padding:10px;

        display:none;

        flex-direction:column;

        align-items:stretch;

    }

    .navbar.open{

        display:flex;

    }

    .navbar a{

        justify-content:center;

    }

    .menu-btn{

        display:flex;

        align-items:center;

        justify-content:center;

    }

    .header-left{

        gap:8px;

    }

    .container{

        padding-top:100px;

    }

}


@media(max-width:600px){

    .logo{

        width:40px;
        height:40px;

    }

    .header-title{

        font-size:12px;

    }

    .cards{

        grid-template-columns:1fr;

    }

    .categories{

        grid-template-columns:
            repeat(2,1fr);

    }

    .welcome{

        padding:24px 20px;

    }

    .welcome h2{

        font-size:21px;

    }

    .category-panel{

        padding:20px 15px;

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


<!-- =====================================================
     PARTICLES
===================================================== -->

<div class="particles" id="particles"></div>


<!-- =====================================================
     CURSOR LIGHT
===================================================== -->

<div class="cursor-light" id="cursorLight"></div>


<!-- =====================================================
     HEADER
===================================================== -->

<header class="header">

    <div class="header-left">

        <button
            class="menu-btn"
            id="menuBtn"
            aria-label="Open menu">

            <i class="fas fa-bars"></i>

        </button>


        <div class="logo">

            <i class="fas fa-graduation-cap"></i>

        </div>


        <div>

            <div class="header-title">

                ONLINE COMPLAINT MANAGEMENT SYSTEM

            </div>

            <div class="header-subtitle">

                Student Service Portal

            </div>

        </div>

    </div>


    <div class="student-badge">

        <i class="fas fa-user-graduate"></i>

        <span>
            <?php echo htmlspecialchars($studentName); ?>
        </span>

    </div>

</header>


<!-- =====================================================
     NAVIGATION
===================================================== -->

<nav class="navbar" id="navbar">

    <a
        href="student_dashboard.php"
        class="active">

        <i class="fas fa-house"></i>

        Home

    </a>


    <a href="complaint.php">

        <i class="fas fa-file-circle-plus"></i>

        Register Complaint

    </a>


    <a href="view_complaints.php">

        <i class="fas fa-list-check"></i>

        My Complaints

    </a>


    <a href="profile.php">

        <i class="fas fa-user-circle"></i>

        Profile

    </a>


    <a href="login.php">

        <i class="fas fa-right-from-bracket"></i>

        Logout

    </a>

</nav>


<!-- =====================================================
     MAIN
===================================================== -->

<main class="container">


    <!-- =================================================
         WELCOME
    ================================================== -->

    <section class="welcome">

        <h2>

            Welcome,

            <span>
                <?php
                echo htmlspecialchars($studentName);
                ?>
            </span>

            👋

        </h2>


        <p>

            Welcome to your student complaint management
            dashboard. Submit complaints, monitor progress
            and receive updates through one secure portal.

        </p>

    </section>


    <!-- =================================================
         SECTION TITLE
    ================================================== -->

    <div class="section-title">

        <i class="fas fa-crown"></i>

        <h3>Student Services</h3>

        <span></span>

    </div>


    <!-- =================================================
         DASHBOARD CARDS
    ================================================== -->

    <section class="cards">


        <!-- REGISTER -->

        <div class="card tilt-card">

            <div class="card-icon">

                <i class="fas fa-file-circle-plus"></i>

            </div>


            <h3>
                Register Complaint
            </h3>


            <p>

                Submit a new complaint related to
                academics, facilities, hostel or
                other college services.

            </p>


            <a href="complaint.php">

                Open

                <i class="fas fa-arrow-right"></i>

            </a>

        </div>


        <!-- MY COMPLAINTS -->

        <div class="card tilt-card">

            <div class="card-icon">

                <i class="fas fa-folder-open"></i>

            </div>


            <h3>
                My Complaints
            </h3>


            <p>

                View the complaints submitted from
                your student account.

            </p>


            <a href="view_complaints.php">

                View

                <i class="fas fa-arrow-right"></i>

            </a>

        </div>


        <!-- STATUS -->

        <div class="card tilt-card">

            <div class="card-icon">

                <i class="fas fa-chart-line"></i>

            </div>


            <h3>
                Complaint Status
            </h3>


            <p>

                Track whether your complaint is
                Pending, Processing or Resolved.

            </p>


            <a href="view_complaints.php">

                Check Status

                <i class="fas fa-arrow-right"></i>

            </a>

        </div>


        <!-- PROFILE -->

        <div class="card tilt-card">

            <div class="card-icon">

                <i class="fas fa-user-gear"></i>

            </div>


            <h3>
                Student Profile
            </h3>


            <p>

                View your student information and
                manage your profile details.

            </p>


            <a href="profile.php">

                Profile

                <i class="fas fa-arrow-right"></i>

            </a>

        </div>


    </section>


    <!-- =================================================
         CATEGORY TITLE
    ================================================== -->

    <div class="section-title">

        <i class="fas fa-layer-group"></i>

        <h3>Complaint Categories</h3>

        <span></span>

    </div>


    <!-- =================================================
         CATEGORY PANEL
    ================================================== -->

    <section class="category-panel">


        <div class="categories">


            <div class="category">

                <i class="fas fa-book"></i>

                <span>Academic Issues</span>

            </div>


            <div class="category">

                <i class="fas fa-pen-to-square"></i>

                <span>Examination</span>

            </div>


            <div class="category">

                <i class="fas fa-book-open"></i>

                <span>Library</span>

            </div>


            <div class="category">

                <i class="fas fa-bed"></i>

                <span>Hostel</span>

            </div>


            <div class="category">

                <i class="fas fa-bus"></i>

                <span>Transport</span>

            </div>


            <div class="category">

                <i class="fas fa-money-bill-wave"></i>

                <span>Fees</span>

            </div>


            <div class="category">

                <i class="fas fa-graduation-cap"></i>

                <span>Scholarship</span>

            </div>


            <div class="category">

                <i class="fas fa-flask"></i>

                <span>Laboratory</span>

            </div>


            <div class="category">

                <i class="fas fa-wifi"></i>

                <span>Internet / Wi-Fi</span>

            </div>


            <div class="category">

                <i class="fas fa-school"></i>

                <span>Classroom Facilities</span>

            </div>


            <div class="category">

                <i class="fas fa-utensils"></i>

                <span>Canteen</span>

            </div>


            <div class="category">

                <i class="fas fa-shield-halved"></i>

                <span>Anti-Ragging</span>

            </div>


            <div class="category">

                <i class="fas fa-ellipsis"></i>

                <span>Others</span>

            </div>


        </div>


    </section>


    <!-- =================================================
         FOOTER
    ================================================== -->

    <footer class="footer">

        <i class="fas fa-crown"></i>

        © 2026 Online Complaint Management System

        <br>

        College Student Service Portal

    </footer>


</main>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>

/* =========================================================
   PARTICLES
========================================================= */

const particleContainer =
    document.getElementById("particles");


for(let i = 0; i < 55; i++){

    const particle =
        document.createElement("span");

    particle.className =
        "particle";

    particle.style.left =
        Math.random() * 100 + "%";

    particle.style.animationDuration =
        (7 + Math.random() * 14) + "s";

    particle.style.animationDelay =
        Math.random() * 12 + "s";

    const size =
        2 + Math.random() * 4;

    particle.style.width =
        size + "px";

    particle.style.height =
        size + "px";

    particleContainer.appendChild(
        particle
    );

}


/* =========================================================
   MOBILE NAVIGATION
========================================================= */

const menuBtn =
    document.getElementById("menuBtn");

const navbar =
    document.getElementById("navbar");


menuBtn.addEventListener(
    "click",
    function(){

        navbar.classList.toggle("open");

        const icon =
            menuBtn.querySelector("i");

        if(navbar.classList.contains("open")){

            icon.classList.remove(
                "fa-bars"
            );

            icon.classList.add(
                "fa-xmark"
            );

        }
        else{

            icon.classList.remove(
                "fa-xmark"
            );

            icon.classList.add(
                "fa-bars"
            );

        }

    }
);


/* =========================================================
   CLOSE MOBILE MENU
========================================================= */

document
.querySelectorAll(".navbar a")
.forEach(function(link){

    link.addEventListener(
        "click",
        function(){

            navbar.classList.remove(
                "open"
            );

            const icon =
                menuBtn.querySelector("i");

            icon.classList.remove(
                "fa-xmark"
            );

            icon.classList.add(
                "fa-bars"
            );

        }
    );

});


/* =========================================================
   3D CARD TILT
========================================================= */

const cards =
    document.querySelectorAll(
        ".tilt-card"
    );


cards.forEach(function(card){

    card.addEventListener(
        "mousemove",
        function(e){

            if(window.innerWidth < 800)
                return;

            const rect =
                card.getBoundingClientRect();

            const x =
                e.clientX - rect.left;

            const y =
                e.clientY - rect.top;

            const centerX =
                rect.width / 2;

            const centerY =
                rect.height / 2;

            const rotateX =
                ((y - centerY) /
                centerY) * -7;

            const rotateY =
                ((x - centerX) /
                centerX) * 7;


            card.style.transform =

                `perspective(900px)
                 rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)
                 translateY(-7px)
                 translateZ(10px)`;

        }
    );


    card.addEventListener(
        "mouseleave",
        function(){

            card.style.transform =

                `perspective(900px)
                 rotateX(0deg)
                 rotateY(0deg)
                 translateY(0)
                 translateZ(0)`;

        }
    );

});


/* =========================================================
   CATEGORY 3D TILT
========================================================= */

const categoryItems =
    document.querySelectorAll(
        ".category"
    );


categoryItems.forEach(function(item){

    item.addEventListener(
        "mousemove",
        function(e){

            if(window.innerWidth < 800)
                return;

            const rect =
                item.getBoundingClientRect();

            const x =
                e.clientX - rect.left;

            const y =
                e.clientY - rect.top;

            const centerX =
                rect.width / 2;

            const centerY =
                rect.height / 2;

            const rotateX =
                ((y-centerY) /
                centerY) * -6;

            const rotateY =
                ((x-centerX) /
                centerX) * 6;


            item.style.transform =

                `perspective(700px)
                 rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)
                 translateY(-5px)`;

        }
    );


    item.addEventListener(
        "mouseleave",
        function(){

            item.style.transform =
                "";

        }
    );

});


/* =========================================================
   CURSOR GOLD LIGHT
========================================================= */

const cursorLight =
    document.getElementById(
        "cursorLight"
    );


document.addEventListener(
    "mousemove",
    function(e){

        cursorLight.style.left =
            e.clientX + "px";

        cursorLight.style.top =
            e.clientY + "px";

    }
);


/* =========================================================
   WELCOME TEXT EFFECT
========================================================= */

const welcome =
    document.querySelector(
        ".welcome"
    );


if(welcome){

    welcome.addEventListener(
        "mousemove",
        function(e){

            if(window.innerWidth < 800)
                return;

            const rect =
                welcome.getBoundingClientRect();

            const x =
                e.clientX - rect.left;

            const y =
                e.clientY - rect.top;

            const rotateX =
                ((y - rect.height/2) /
                (rect.height/2)) * -1.5;

            const rotateY =
                ((x - rect.width/2) /
                (rect.width/2)) * 1.5;

            welcome.style.transform =

                `perspective(1300px)
                 rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)`;

        }
    );


    welcome.addEventListener(
        "mouseleave",
        function(){

            welcome.style.transform =
                "";

        }
    );

}


/* =========================================================
   NAVBAR SCROLL EFFECT
========================================================= */

window.addEventListener(
    "scroll",
    function(){

        const navbar =
            document.getElementById(
                "navbar"
            );

        if(window.scrollY > 20){

            navbar.style.boxShadow =
                "0 12px 35px rgba(0,0,0,.30)";

        }
        else{

            navbar.style.boxShadow =
                "none";

        }

    }
);


/* =========================================================
   PAGE VISIBILITY
========================================================= */

document.addEventListener(
    "visibilitychange",
    function(){

        if(document.hidden){

            document.title =
                "Student Portal";

        }
        else{

            document.title =
                "Student Dashboard | Online Complaint Management System";

        }

    }
);


/* =========================================================
   KEYBOARD ESCAPE
========================================================= */

document.addEventListener(
    "keydown",
    function(e){

        if(e.key === "Escape"){

            navbar.classList.remove(
                "open"
            );

            const icon =
                menuBtn.querySelector("i");

            icon.classList.remove(
                "fa-xmark"
            );

            icon.classList.add(
                "fa-bars"
            );

        }

    }
);

</script>


</body>
</html>