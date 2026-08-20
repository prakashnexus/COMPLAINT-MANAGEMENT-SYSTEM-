<?php
session_start();
include("db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT * FROM students ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}

$studentCount = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Students | Royal Luxury Admin</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

/* =========================================================
   ROOT
========================================================= */

:root{

    --gold:#d4af37;
    --gold-light:#f7d774;
    --gold-dark:#9b7618;

    --black:#050505;
    --black-2:#0b0b0b;
    --black-3:#111111;

    --white:#ffffff;
    --text:#e8e8e8;
    --muted:#999;

    --glass:rgba(255,255,255,.055);

    --border:rgba(212,175,55,.22);

    --shadow:
        0 25px 70px rgba(0,0,0,.65);

    --gold-shadow:
        0 0 25px rgba(212,175,55,.15);

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


html{

    scroll-behavior:smooth;

}


body{

    min-height:100vh;

    color:var(--text);

    background:

        radial-gradient(
            circle at 15% 20%,
            rgba(212,175,55,.12),
            transparent 28%
        ),

        radial-gradient(
            circle at 85% 75%,
            rgba(212,175,55,.08),
            transparent 30%
        ),

        linear-gradient(
            135deg,
            #020202,
            #090909,
            #111111,
            #030303
        );

    background-size:200% 200%;

    animation:
        backgroundLuxury 18s ease infinite;

    overflow-x:hidden;

}


@keyframes backgroundLuxury{

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
   AMBIENT GOLD LIGHT
========================================================= */

body::before{

    content:"";

    position:fixed;

    width:500px;
    height:500px;

    left:-220px;
    top:-200px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(212,175,55,.12),
            transparent 68%
        );

    filter:blur(20px);

    pointer-events:none;

    animation:
        luxuryOrb 12s ease-in-out infinite;

    z-index:-2;

}


body::after{

    content:"";

    position:fixed;

    width:450px;
    height:450px;

    right:-200px;
    bottom:-200px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(212,175,55,.09),
            transparent 68%
        );

    filter:blur(25px);

    pointer-events:none;

    animation:
        luxuryOrb2 15s ease-in-out infinite;

    z-index:-2;

}


@keyframes luxuryOrb{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(180px,120px);
    }

}


@keyframes luxuryOrb2{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-140px,-100px);
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

    width:3px;
    height:3px;

    border-radius:50%;

    background:var(--gold-light);

    box-shadow:

        0 0 8px var(--gold),

        0 0 18px rgba(212,175,55,.65);

    animation:
        goldParticle linear infinite;

}


@keyframes goldParticle{

    0%{

        transform:
            translateY(110vh)
            scale(.3);

        opacity:0;

    }

    15%{
        opacity:1;
    }

    80%{
        opacity:.8;
    }

    100%{

        transform:
            translateY(-15vh)
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

    height:80px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:0 28px;

    z-index:1000;

    background:

        linear-gradient(
            135deg,
            rgba(5,5,5,.97),
            rgba(18,18,18,.94)
        );

    backdrop-filter:blur(20px);

    border-bottom:
        1px solid rgba(212,175,55,.20);

    box-shadow:

        0 15px 50px rgba(0,0,0,.6);

}


/* GOLD LINE */

.header::after{

    content:"";

    position:absolute;

    left:0;
    bottom:0;

    width:100%;

    height:2px;

    background:

        linear-gradient(
            90deg,
            transparent,
            var(--gold-dark),
            var(--gold-light),
            var(--gold),
            var(--gold-light),
            var(--gold-dark),
            transparent
        );

    background-size:300% 100%;

    animation:
        goldLine 5s linear infinite;

}


@keyframes goldLine{

    0%{
        background-position:0% 50%;
    }

    100%{
        background-position:300% 50%;
    }

}


/* =========================================================
   HEADER LEFT
========================================================= */

.header-left{

    display:flex;

    align-items:center;

    gap:15px;

}


.logo-icon{

    width:50px;
    height:50px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:15px;

    color:var(--gold-light);

    font-size:21px;

    background:

        linear-gradient(
            145deg,
            rgba(212,175,55,.20),
            rgba(212,175,55,.035)
        );

    border:
        1px solid rgba(212,175,55,.35);

    box-shadow:

        inset 0 0 25px rgba(212,175,55,.08),

        0 8px 25px rgba(0,0,0,.5),

        0 0 20px rgba(212,175,55,.08);

    transform:
        translateZ(20px);

    animation:
        crownFloat 4s ease-in-out infinite;

}


@keyframes crownFloat{

    0%,100%{

        transform:
            translateY(0)
            rotateY(0deg);

    }

    50%{

        transform:
            translateY(-4px)
            rotateY(12deg);

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

    color:#8f8f8f;

    font-size:10px;

    letter-spacing:2px;

    text-transform:uppercase;

    margin-top:3px;

}


/* =========================================================
   HEADER ACTIONS
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

    background:

        rgba(212,175,55,.06);

    border:

        1px solid rgba(212,175,55,.20);

    color:#c9b873;

    font-size:12px;

}


.admin-badge i{

    color:var(--gold-light);

}


.logout a{

    display:flex;

    align-items:center;

    gap:8px;

    text-decoration:none;

    color:#fff;

    padding:10px 17px;

    border-radius:11px;

    background:

        linear-gradient(
            135deg,
            #751d1d,
            #b32626
        );

    border:
        1px solid rgba(255,255,255,.08);

    box-shadow:
        0 8px 25px rgba(0,0,0,.4);

    transition:.35s;

}


.logout a:hover{

    transform:
        translateY(-3px)
        scale(1.03);

    box-shadow:

        0 15px 35px rgba(0,0,0,.6),

        0 0 20px rgba(180,30,30,.18);

}


/* =========================================================
   MOBILE MENU
========================================================= */

.menu-btn{

    display:none;

    width:42px;
    height:42px;

    border:

        1px solid
        rgba(212,175,55,.25);

    border-radius:11px;

    background:
        rgba(212,175,55,.06);

    color:var(--gold-light);

    cursor:pointer;

    font-size:17px;

}


/* =========================================================
   SIDEBAR
========================================================= */

.sidebar{

    position:fixed;

    top:80px;
    left:0;

    width:245px;

    height:calc(100vh - 80px);

    padding:22px 14px;

    background:

        linear-gradient(
            180deg,
            rgba(10,10,10,.98),
            rgba(3,3,3,.98)
        );

    backdrop-filter:blur(20px);

    border-right:

        1px solid
        rgba(212,175,55,.16);

    box-shadow:

        15px 0 45px rgba(0,0,0,.55);

    z-index:900;

    overflow-y:auto;

}


.sidebar-title{

    padding:
        7px 14px 15px;

    color:#665d45;

    font-size:10px;

    letter-spacing:3px;

    text-transform:uppercase;

    font-weight:700;

    font-family:'Cinzel',serif;

}


.sidebar ul{

    list-style:none;

}


.sidebar li{

    margin-bottom:6px;

}


.sidebar li a{

    display:flex;

    align-items:center;

    gap:13px;

    padding:13px 15px;

    border-radius:12px;

    color:#aaa;

    text-decoration:none;

    font-size:13px;

    font-weight:500;

    border:

        1px solid transparent;

    position:relative;

    overflow:hidden;

    transition:.35s;

}


.sidebar li a i{

    width:22px;

    text-align:center;

    color:#807143;

    transition:.35s;

}


/* SHINE */

.sidebar li a::after{

    content:"";

    position:absolute;

    top:0;

    left:-100%;

    width:70%;

    height:100%;

    background:

        linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.08),
            transparent
        );

    transform:skewX(-20deg);

    transition:.6s;

}


.sidebar li a:hover::after{

    left:130%;

}


.sidebar li a::before{

    content:"";

    position:absolute;

    left:0;

    top:20%;

    width:3px;

    height:60%;

    background:var(--gold);

    border-radius:20px;

    transform:scaleY(0);

    transition:.3s;

}


.sidebar li a:hover,
.sidebar li.active a{

    color:#fff;

    background:

        linear-gradient(
            135deg,
            rgba(212,175,55,.13),
            rgba(255,255,255,.025)
        );

    border-color:

        rgba(212,175,55,.20);

    transform:
        translateX(5px)
        translateZ(8px);

    box-shadow:

        0 10px 30px rgba(0,0,0,.4),

        inset 0 0 20px
        rgba(212,175,55,.025);

}


.sidebar li a:hover::before,
.sidebar li.active a::before{

    transform:scaleY(1);

}


.sidebar li a:hover i,
.sidebar li.active a i{

    color:var(--gold-light);

    transform:
        scale(1.15)
        rotateY(15deg);

}


/* =========================================================
   CONTENT
========================================================= */

.content{

    margin-left:245px;

    padding:
        110px
        30px
        50px;

    min-height:100vh;

}


/* =========================================================
   PAGE HEADING
========================================================= */

.page-heading{

    display:flex;

    align-items:center;

    justify-content:space-between;

    margin-bottom:27px;

    animation:
        pageReveal .9s ease;

}


.page-heading h1{

    font-family:'Cinzel',serif;

    font-size:30px;

    color:#fff;

    font-weight:700;

    letter-spacing:.5px;

}


.page-heading h1 i{

    color:var(--gold-light);

    margin-right:8px;

    filter:
        drop-shadow(
            0 0 8px
            rgba(212,175,55,.3)
        );

}


.page-heading p{

    color:#777;

    font-size:12px;

    margin-top:5px;

}


@keyframes pageReveal{

    from{

        opacity:0;

        transform:
            translateY(30px)
            rotateX(10deg);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0);

    }

}


/* =========================================================
   STAT CARDS
========================================================= */

.stats{

    display:grid;

    grid-template-columns:
        repeat(3,1fr);

    gap:20px;

    margin-bottom:25px;

}


.stat-card{

    position:relative;

    min-height:135px;

    padding:23px;

    border-radius:20px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.075),
            rgba(255,255,255,.025)
        );

    border:

        1px solid
        rgba(212,175,55,.18);

    backdrop-filter:blur(20px);

    box-shadow:

        var(--shadow),

        inset 0 0 25px
        rgba(212,175,55,.018);

    overflow:hidden;

    transform-style:preserve-3d;

    transition:

        transform .25s ease,

        box-shadow .3s ease;

    animation:
        cardReveal .8s ease both;

}


.stat-card:nth-child(2){

    animation-delay:.12s;

}


.stat-card:nth-child(3){

    animation-delay:.24s;

}


@keyframes cardReveal{

    from{

        opacity:0;

        transform:
            translateY(35px)
            rotateX(15deg);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0);

    }

}


/* GOLD CORNER */

.stat-card::before{

    content:"";

    position:absolute;

    width:170px;
    height:170px;

    right:-80px;
    top:-80px;

    border-radius:50%;

    background:

        radial-gradient(
            circle,
            rgba(212,175,55,.18),
            transparent 70%
        );

}


.stat-card::after{

    content:"";

    position:absolute;

    left:10%;
    right:10%;

    bottom:0;

    height:1px;

    background:

        linear-gradient(
            90deg,
            transparent,
            var(--gold-dark),
            transparent
        );

}


.stat-icon{

    position:absolute;

    right:20px;
    top:20px;

    width:50px;
    height:50px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:15px;

    color:var(--gold-light);

    font-size:19px;

    background:

        linear-gradient(
            135deg,
            rgba(212,175,55,.16),
            rgba(212,175,55,.035)
        );

    border:

        1px solid
        rgba(212,175,55,.22);

    box-shadow:

        inset 0 0 15px
        rgba(212,175,55,.06);

    transform:
        translateZ(30px);

}


.stat-card h4{

    color:#888;

    font-size:11px;

    letter-spacing:1.5px;

    text-transform:uppercase;

    margin-bottom:8px;

}


.stat-number{

    font-size:32px;

    font-weight:800;

    color:var(--gold-light);

    text-shadow:

        0 0 20px
        rgba(212,175,55,.18);

    transform:
        translateZ(25px);

}


.stat-card small{

    display:block;

    color:#5f5f5f;

    font-size:10px;

    margin-top:4px;

}


/* =========================================================
   MAIN BOX
========================================================= */

.box{

    position:relative;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.075),
            rgba(255,255,255,.025)
        );

    border:

        1px solid
        rgba(212,175,55,.18);

    border-radius:22px;

    padding:25px;

    backdrop-filter:blur(22px);

    box-shadow:

        0 30px 80px rgba(0,0,0,.65),

        inset 0 0 35px
        rgba(212,175,55,.015);

    transform-style:preserve-3d;

    animation:
        boxReveal 1s ease;

}


@keyframes boxReveal{

    from{

        opacity:0;

        transform:
            translateY(40px)
            rotateX(7deg);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0);

    }

}


.box::before{

    content:"";

    position:absolute;

    left:7%;
    top:0;

    width:86%;

    height:1px;

    background:

        linear-gradient(
            90deg,
            transparent,
            var(--gold-dark),
            var(--gold-light),
            var(--gold-dark),
            transparent
        );

    box-shadow:

        0 0 18px
        rgba(212,175,55,.4);

}


.box-header{

    display:flex;

    align-items:center;

    justify-content:space-between;

    margin-bottom:20px;

}


.box-header h2{

    font-family:'Cinzel',serif;

    font-size:20px;

    color:#fff;

}


.box-header h2 i{

    color:var(--gold-light);

    margin-right:8px;

}


.record-count{

    padding:8px 13px;

    border-radius:20px;

    background:

        rgba(212,175,55,.07);

    border:

        1px solid
        rgba(212,175,55,.20);

    color:#cdbb79;

    font-size:11px;

}


/* =========================================================
   TOOLBAR
========================================================= */

.toolbar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:18px;

}


.search-box{

    position:relative;

    width:100%;

    max-width:430px;

}


.search-box i{

    position:absolute;

    left:15px;

    top:50%;

    transform:
        translateY(-50%);

    color:#74653b;

}


.search-box input{

    width:100%;

    padding:
        12px
        15px
        12px
        43px;

    outline:none;

    border-radius:12px;

    border:

        1px solid
        rgba(212,175,55,.17);

    background:

        rgba(0,0,0,.35);

    color:#fff;

    font-size:12px;

    transition:.35s;

}


.search-box input::placeholder{

    color:#555;

}


.search-box input:focus{

    border-color:
        rgba(212,175,55,.55);

    box-shadow:

        0 0 25px
        rgba(212,175,55,.10);

}


/* =========================================================
   TABLE
========================================================= */

.table-wrapper{

    overflow-x:auto;

    border-radius:15px;

    border:

        1px solid
        rgba(212,175,55,.12);

}


table{

    width:100%;

    border-collapse:collapse;

    min-width:900px;

}


thead th{

    padding:15px 12px;

    text-align:center;

    color:#d9c987;

    font-size:10px;

    letter-spacing:1px;

    text-transform:uppercase;

    background:

        linear-gradient(
            135deg,
            rgba(212,175,55,.13),
            rgba(255,255,255,.025)
        );

    border-bottom:

        1px solid
        rgba(212,175,55,.20);

}


thead th i{

    color:var(--gold);

    margin-right:4px;

}


tbody tr{

    background:

        rgba(255,255,255,.018);

    transition:.35s;

    animation:
        rowReveal .5s ease both;

}


@keyframes rowReveal{

    from{

        opacity:0;

        transform:
            translateX(-18px);

    }

    to{

        opacity:1;

        transform:
            translateX(0);

    }

}


tbody tr:hover{

    background:

        linear-gradient(
            90deg,
            rgba(212,175,55,.075),
            rgba(255,255,255,.02)
        );

    transform:
        scale(1.004);

    box-shadow:

        inset 4px 0 0
        var(--gold);

}


tbody td{

    padding:14px 12px;

    text-align:center;

    color:#aaa;

    font-size:11px;

    border-bottom:

        1px solid
        rgba(255,255,255,.045);

}


.student-id{

    color:var(--gold-light);

    font-weight:700;

}


.student-name{

    color:#fff;

    font-weight:600;

}


.email{

    color:#777;

}


.course-badge{

    display:inline-block;

    padding:6px 11px;

    border-radius:20px;

    background:

        linear-gradient(
            135deg,
            rgba(212,175,55,.12),
            rgba(212,175,55,.025)
        );

    border:

        1px solid
        rgba(212,175,55,.20);

    color:#d7c276;

    font-size:10px;

    font-weight:600;

}


/* =========================================================
   EMPTY
========================================================= */

.empty{

    padding:55px !important;

    color:#555 !important;

    text-align:center;

}


.empty i{

    display:block;

    font-size:40px;

    color:#493f25;

    margin-bottom:12px;

}


/* =========================================================
   BACK BUTTON
========================================================= */

.back{

    margin-top:22px;

}


.back a{

    display:inline-flex;

    align-items:center;

    gap:9px;

    text-decoration:none;

    color:#0b0b0b;

    padding:11px 18px;

    border-radius:12px;

    font-size:12px;

    font-weight:700;

    background:

        linear-gradient(
            135deg,
            #a37d1d,
            #f4d66d,
            #b48b24
        );

    background-size:200% 100%;

    box-shadow:

        0 12px 30px rgba(0,0,0,.45),

        0 0 20px
        rgba(212,175,55,.08);

    transition:.35s;

}


.back a:hover{

    background-position:100% 0;

    transform:
        translateY(-3px)
        scale(1.02);

    box-shadow:

        0 18px 40px rgba(0,0,0,.6),

        0 0 30px
        rgba(212,175,55,.15);

}


/* =========================================================
   FOOTER
========================================================= */

.footer{

    text-align:center;

    padding:30px 10px;

    color:#4f4f4f;

    font-size:10px;

    line-height:2;

}


.footer i{

    color:#806a32;

}


/* =========================================================
   SCROLLBAR
========================================================= */

::-webkit-scrollbar{

    width:7px;
    height:7px;

}


::-webkit-scrollbar-track{

    background:#050505;

}


::-webkit-scrollbar-thumb{

    background:

        linear-gradient(
            #806522,
            #d4af37,
            #806522
        );

    border-radius:20px;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .stats{

        grid-template-columns:
            repeat(2,1fr);

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

    }


    .sidebar.open{

        transform:
            translateX(0);

    }


    .content{

        margin-left:0;

        padding:
            105px
            18px
            40px;

    }


    .admin-badge{

        display:none;

    }


    .header-title{

        font-size:14px;

    }


    .header-subtitle{

        display:none;

    }

}


@media(max-width:600px){

    .header{

        padding:0 14px;

    }


    .logo-icon{

        width:40px;
        height:40px;

        font-size:17px;

    }


    .header-title{

        font-size:12px;

    }


    .logout a{

        padding:8px 10px;

        font-size:10px;

    }


    .logout a i{

        margin:0;

    }


    .logout a{

        font-size:0;

    }


    .logout a i{

        font-size:13px;

    }


    .stats{

        grid-template-columns:1fr;

    }


    .page-heading{

        display:block;

    }


    .page-heading h1{

        font-size:23px;

    }


    .box{

        padding:16px;

    }


    .box-header{

        display:block;

    }


    .record-count{

        display:inline-block;

        margin-top:10px;

    }


    .search-box{

        max-width:none;

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
     GOLD PARTICLES
===================================================== -->

<div class="particles" id="particles"></div>


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


        <div class="logo-icon">

            <i class="fas fa-crown"></i>

        </div>


        <div>

            <div class="header-title">

                College Complaint Management System

            </div>

            <div class="header-subtitle">

                Royal Luxury Administration

            </div>

        </div>

    </div>


    <div class="header-actions">

        <div class="admin-badge">

            <i class="fas fa-user-shield"></i>

            Administrator

        </div>


        <div class="logout">

            <a href="admin_logout.php">

                <i class="fas fa-power-off"></i>

                Logout

            </a>

        </div>

    </div>

</header>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside class="sidebar" id="sidebar">

    <div class="sidebar-title">

        Royal Administration

    </div>


    <ul>

        <li>

            <a href="admin_dashboard.php">

                <i class="fas fa-gauge-high"></i>

                <span>Dashboard</span>

            </a>

        </li>


        <li class="active">

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

                <i class="fas fa-chart-pie"></i>

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

                <i class="fas fa-right-from-bracket"></i>

                <span>Logout</span>

            </a>

        </li>

    </ul>

</aside>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<main class="content">


    <!-- PAGE TITLE -->

    <div class="page-heading">

        <div>

            <h1>

                <i class="fas fa-crown"></i>

                Student Management

            </h1>

            <p>

                Royal administration portal for registered student records

            </p>

        </div>

    </div>


    <!-- =================================================
         STATISTICS
    ================================================== -->

    <section class="stats">


        <!-- TOTAL -->

        <div class="stat-card tilt-card">

            <div class="stat-icon">

                <i class="fas fa-user-graduate"></i>

            </div>

            <h4>

                Total Students

            </h4>

            <div
                class="stat-number"
                id="studentCounter">

                0

            </div>

            <small>

                Registered students

            </small>

        </div>


        <!-- RECORDS -->

        <div class="stat-card tilt-card">

            <div class="stat-icon">

                <i class="fas fa-id-card"></i>

            </div>

            <h4>

                Student Records

            </h4>

            <div
                class="stat-number"
                id="recordCounter">

                0

            </div>

            <small>

                Available records

            </small>

        </div>


        <!-- DATABASE -->

        <div class="stat-card tilt-card">

            <div class="stat-icon">

                <i class="fas fa-database"></i>

            </div>

            <h4>

                Database Status

            </h4>

            <div
                class="stat-number"
                style="font-size:22px;">

                ONLINE

            </div>

            <small>

                System connected

            </small>

        </div>


    </section>


    <!-- =================================================
         STUDENT TABLE
    ================================================== -->

    <section class="box tilt-panel">


        <div class="box-header">

            <h2>

                <i class="fas fa-users-viewfinder"></i>

                Registered Students

            </h2>


            <div class="record-count">

                <i class="fas fa-database"></i>

                <span id="visibleCount">
                    <?php echo $studentCount; ?>
                </span>

                Records

            </div>

        </div>


        <!-- SEARCH -->

        <div class="toolbar">

            <div class="search-box">

                <i class="fas fa-search"></i>

                <input
                    type="text"
                    id="studentSearch"
                    placeholder="Search student, register number, email or course..."
                    autocomplete="off">

            </div>

        </div>


        <!-- TABLE -->

        <div class="table-wrapper">

            <table id="studentTable">

                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>

                            <i class="fas fa-id-badge"></i>

                            Register No

                        </th>

                        <th>

                            <i class="fas fa-user"></i>

                            Student Name

                        </th>

                        <th>

                            <i class="fas fa-envelope"></i>

                            Email

                        </th>

                        <th>

                            <i class="fas fa-phone"></i>

                            Mobile

                        </th>

                        <th>

                            <i class="fas fa-book"></i>

                            Course

                        </th>

                    </tr>

                </thead>


                <tbody>


                <?php

                if ($studentCount > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {

                ?>

                    <tr>

                        <td class="student-id">

                            #

                            <?php
                            echo htmlspecialchars(
                                $row['id'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['register_no'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td class="student-name">

                            <?php
                            echo htmlspecialchars(
                                $row['student_name'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td class="email">

                            <?php
                            echo htmlspecialchars(
                                $row['email'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['mobile'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td>

                            <span class="course-badge">

                                <?php
                                echo htmlspecialchars(
                                    $row['course'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>

                            </span>

                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td
                            colspan="6"
                            class="empty">

                            <i class="fas fa-user-slash"></i>

                            No Student Records Found.

                        </td>

                    </tr>

                <?php

                }

                ?>

                </tbody>

            </table>

        </div>


        <!-- BACK -->

        <div class="back">

            <a href="admin_dashboard.php">

                <i class="fas fa-arrow-left"></i>

                Back to Dashboard

            </a>

        </div>


    </section>


    <!-- FOOTER -->

    <footer class="footer">

        <i class="fas fa-crown"></i>

        © 2026 College Complaint Management System

        <br>

        Royal Luxury Administration Control Panel

    </footer>


</main>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>


/* =========================================================
   GOLD PARTICLES
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
        (8 + Math.random() * 13) + "s";


    particle.style.animationDelay =
        Math.random() * 12 + "s";


    const size =
        2 + Math.random() * 3;


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

        sidebar.classList.toggle(
            "open"
        );


        const icon =
            menuBtn.querySelector("i");


        if(
            sidebar.classList.contains("open")
        ){

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
   CLOSE SIDEBAR
========================================================= */

document
    .querySelectorAll(".sidebar a")
    .forEach(function(link){

        link.addEventListener(
            "click",
            function(){

                if(
                    window.innerWidth <= 850
                ){

                    sidebar.classList.remove(
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

    });


/* =========================================================
   3D CARD TILT
========================================================= */

const tiltCards =
    document.querySelectorAll(
        ".tilt-card"
    );


tiltCards.forEach(function(card){

    card.addEventListener(
        "mousemove",
        function(e){

            if(window.innerWidth < 850)
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
                ((y - centerY) / centerY) * -7;


            const rotateY =
                ((x - centerX) / centerX) * 7;


            card.style.transform =

                `perspective(900px)
                 rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)
                 translateY(-5px)
                 translateZ(10px)`;

        }
    );


    card.addEventListener(
        "mouseleave",
        function(){

            card.style.transform =

                "perspective(900px)
                 rotateX(0deg)
                 rotateY(0deg)
                 translateY(0)
                 translateZ(0)";

        }
    );

});


/* =========================================================
   MAIN PANEL 3D EFFECT
========================================================= */

const panel =
    document.querySelector(
        ".tilt-panel"
    );


if(panel){

    panel.addEventListener(
        "mousemove",
        function(e){

            if(window.innerWidth < 1000)
                return;


            const rect =
                panel.getBoundingClientRect();


            const x =
                e.clientX - rect.left;


            const y =
                e.clientY - rect.top;


            const centerX =
                rect.width / 2;


            const centerY =
                rect.height / 2;


            const rotateX =
                ((y - centerY) / centerY) * -1.1;


            const rotateY =
                ((x - centerX) / centerX) * 1.1;


            panel.style.transform =

                `perspective(1500px)
                 rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)`;

        }
    );


    panel.addEventListener(
        "mouseleave",
        function(){

            panel.style.transform =

                "perspective(1500px)
                 rotateX(0deg)
                 rotateY(0deg)";

        }
    );

}


/* =========================================================
   COUNTER
========================================================= */

function animateCounter(
    element,
    target,
    duration
){

    let start = 0;

    const startTime =
        performance.now();


    function update(currentTime){

        const progress =
            Math.min(
                (currentTime - startTime)
                / duration,
                1
            );


        const eased =
            1 -
            Math.pow(
                1 - progress,
                3
            );


        const value =
            Math.floor(
                eased * target
            );


        element.textContent =
            value.toLocaleString();


        if(progress < 1){

            requestAnimationFrame(
                update
            );

        }

        else{

            element.textContent =
                target.toLocaleString();

        }

    }


    requestAnimationFrame(update);

}


/* =========================================================
   START COUNTERS
========================================================= */

const totalStudents =
    <?php echo (int)$studentCount; ?>;


animateCounter(

    document.getElementById(
        "studentCounter"
    ),

    totalStudents,

    1400

);


animateCounter(

    document.getElementById(
        "recordCounter"
    ),

    totalStudents,

    1700

);


/* =========================================================
   SEARCH
========================================================= */

const searchInput =
    document.getElementById(
        "studentSearch"
    );


const table =
    document.getElementById(
        "studentTable"
    );


const visibleCount =
    document.getElementById(
        "visibleCount"
    );


searchInput.addEventListener(
    "input",
    function(){

        const search =
            this.value
            .toLowerCase()
            .trim();


        const rows =
            table.querySelectorAll(
                "tbody tr"
            );


        let visible = 0;


        rows.forEach(
            function(row){

                if(
                    row.querySelector(
                        ".empty"
                    )
                ){

                    return;

                }


                const text =
                    row.textContent
                    .toLowerCase();


                if(
                    text.includes(search)
                ){

                    row.style.display =
                        "";


                    visible++;

                }

                else{

                    row.style.display =
                        "none";

                }

            }
        );


        visibleCount.textContent =
            visible.toLocaleString();

    }
);


/* =========================================================
   TABLE STAGGER
========================================================= */

document
    .querySelectorAll(
        "#studentTable tbody tr"
    )
    .forEach(
        function(row,index){

            row.style.animationDelay =
                (index * 0.045) + "s";

        }
    );


/* =========================================================
   GOLD CURSOR LIGHT
========================================================= */

const cursorLight =
    document.createElement("div");


cursorLight.style.position =
    "fixed";


cursorLight.style.width =
    "300px";


cursorLight.style.height =
    "300px";


cursorLight.style.borderRadius =
    "50%";


cursorLight.style.pointerEvents =
    "none";


cursorLight.style.zIndex =
    "-1";


cursorLight.style.background =

    "radial-gradient(circle, rgba(212,175,55,.07), transparent 70%)";


cursorLight.style.transform =
    "translate(-50%,-50%)";


cursorLight.style.transition =
    "left .12s ease, top .12s ease";


document.body.appendChild(
    cursorLight
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
   KEYBOARD ESC SEARCH CLEAR
========================================================= */

document.addEventListener(
    "keydown",
    function(e){

        if(e.key === "Escape"){

            searchInput.value = "";

            searchInput.dispatchEvent(
                new Event("input")
            );

        }

    }
);


/* =========================================================
   PAGE TITLE
========================================================= */

document.addEventListener(
    "visibilitychange",
    function(){

        if(document.hidden){

            document.title =
                "Students | Royal Admin";

        }

        else{

            document.title =
                "Manage Students | Royal Luxury Admin";

        }

    }
);


/* =========================================================
   GOLDEN CLICK RIPPLE
========================================================= */

document.addEventListener(
    "click",
    function(e){

        const ripple =
            document.createElement("span");


        ripple.style.position =
            "fixed";


        ripple.style.left =
            e.clientX + "px";


        ripple.style.top =
            e.clientY + "px";


        ripple.style.width =
            "8px";


        ripple.style.height =
            "8px";


        ripple.style.borderRadius =
            "50%";


        ripple.style.border =
            "1px solid #d4af37";


        ripple.style.pointerEvents =
            "none";


        ripple.style.zIndex =
            "9999";


        ripple.style.transform =
            "translate(-50%,-50%)";


        ripple.style.boxShadow =
            "0 0 12px rgba(212,175,55,.5)";


        document.body.appendChild(
            ripple
        );


        ripple.animate(

            [

                {
                    width:"8px",
                    height:"8px",
                    opacity:1
                },

                {
                    width:"100px",
                    height:"100px",
                    opacity:0
                }

            ],

            {

                duration:650,

                easing:"ease-out"

            }

        ).onfinish =
            function(){

                ripple.remove();

            };

    }
);


/* =========================================================
   ACTIVE SIDEBAR
========================================================= */

document
    .querySelectorAll(".sidebar li a")
    .forEach(function(link){

        link.addEventListener(
            "mouseenter",
            function(){

                this.style.textShadow =
                    "0 0 12px rgba(212,175,55,.25)";

            }
        );


        link.addEventListener(
            "mouseleave",
            function(){

                this.style.textShadow =
                    "none";

            }
        );

    });

</script>


</body>
</html>