<?php
session_start();
include("db.php");

// ==========================================
// GET STUDENT RECORD
// ==========================================

$sql = "SELECT * FROM students LIMIT 1";

$result = mysqli_query($conn, $sql);

if(!$result){
    die("Query Error: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) > 0)
{
    $student = mysqli_fetch_assoc($result);
}
else
{
    die("No student records found in the students table.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Profile | Premium Portal</title>

<!-- GOOGLE FONT -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;500;600;600;700;700;800&display=swap" rel="stylesheet">

<!-- FONT AWESOME -->
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
    font-family:'Poppins',sans-serif;
}

html{
    scroll-behavior:smooth;
}

body{

    min-height:100vh;

    color:#fff;

    overflow-x:hidden;

    background:

        radial-gradient(
            circle at 15% 15%,
            rgba(99,102,241,.25),
            transparent 28%
        ),

        radial-gradient(
            circle at 85% 20%,
            rgba(14,165,233,.18),
            transparent 30%
        ),

        radial-gradient(
            circle at 50% 90%,
            rgba(168,85,247,.18),
            transparent 30%
        ),

        linear-gradient(
            135deg,
            #020617,
            #071329,
            #0b1735,
            #030712
        );

    background-size:200% 200%;

    animation:
        backgroundMove 18s ease infinite;

    perspective:1200px;
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
   GLOWING BACKGROUND ORBS
========================================================= */

body::before{

    content:"";

    position:fixed;

    width:500px;
    height:500px;

    left:-220px;
    top:-180px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(59,130,246,.20),
            transparent 70%
        );

    filter:blur(25px);

    animation:
        orbOne 12s ease-in-out infinite;

    pointer-events:none;

    z-index:-2;
}


body::after{

    content:"";

    position:fixed;

    width:500px;
    height:500px;

    right:-220px;
    bottom:-220px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(139,92,246,.18),
            transparent 70%
        );

    filter:blur(30px);

    animation:
        orbTwo 15s ease-in-out infinite;

    pointer-events:none;

    z-index:-2;
}


@keyframes orbOne{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(180px,120px);
    }

}


@keyframes orbTwo{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-150px,-100px);
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

    background:#93c5fd;

    box-shadow:
        0 0 8px #60a5fa,
        0 0 18px rgba(96,165,250,.7);

    animation:
        particleFloat linear infinite;
}


@keyframes particleFloat{

    0%{

        transform:
            translateY(110vh)
            scale(.4);

        opacity:0;

    }

    15%{
        opacity:1;
    }

    80%{
        opacity:1;
    }

    100%{

        transform:
            translateY(-15vh)
            scale(1.3);

        opacity:0;

    }

}


/* =========================================================
   TOP HEADER
========================================================= */

.header{

    position:relative;

    width:100%;

    padding:22px 20px;

    text-align:center;

    background:

        linear-gradient(
            135deg,
            rgba(8,20,45,.92),
            rgba(15,23,42,.86)
        );

    backdrop-filter:blur(22px);

    border-bottom:
        1px solid rgba(255,255,255,.10);

    box-shadow:
        0 15px 50px rgba(0,0,0,.35);

    z-index:20;

    overflow:hidden;
}


.header::before{

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
            #38bdf8,
            #818cf8,
            #c084fc,
            #38bdf8,
            transparent
        );

    background-size:300% 100%;

    animation:
        royalLine 5s linear infinite;
}


@keyframes royalLine{

    0%{
        background-position:-300% 0;
    }

    100%{
        background-position:300% 0;
    }

}


.header-content{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:15px;
}


.header-icon{

    width:50px;
    height:50px;

    display:flex;

    justify-content:center;
    align-items:center;

    border-radius:15px;

    color:#93c5fd;

    font-size:21px;

    background:
        linear-gradient(
            145deg,
            rgba(59,130,246,.20),
            rgba(139,92,246,.20)
        );

    border:
        1px solid rgba(147,197,253,.25);

    box-shadow:
        inset 0 0 20px rgba(96,165,250,.08),
        0 10px 30px rgba(0,0,0,.3);

    transform-style:preserve-3d;

    animation:
        iconFloat 4s ease-in-out infinite;
}


@keyframes iconFloat{

    0%,100%{
        transform:
            translateY(0)
            rotateY(0deg);
    }

    50%{
        transform:
            translateY(-5px)
            rotateY(12deg);
    }

}


.header h1{

    font-size:24px;

    font-weight:700;

    letter-spacing:.5px;

    color:#fff;

    text-shadow:
        0 0 25px rgba(96,165,250,.18);
}


.header p{

    margin-top:2px;

    color:#94a3b8;

    font-size:11px;

    letter-spacing:1px;
}


/* =========================================================
   MAIN CONTAINER
========================================================= */

.container{

    width:92%;

    max-width:850px;

    margin:60px auto;

    position:relative;

    transform-style:preserve-3d;

    animation:
        containerEnter 1s cubic-bezier(.2,.8,.2,1);
}


@keyframes containerEnter{

    from{

        opacity:0;

        transform:
            translateY(60px)
            rotateX(12deg)
            scale(.96);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0)
            scale(1);

    }

}


/* =========================================================
   PREMIUM PROFILE CARD
========================================================= */

.profile-card{

    position:relative;

    padding:38px;

    border-radius:28px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.105),
            rgba(255,255,255,.035)
        );

    border:
        1px solid rgba(255,255,255,.13);

    backdrop-filter:
        blur(25px)
        saturate(130%);

    box-shadow:

        0 35px 90px rgba(0,0,0,.42),

        inset 0 1px 0
        rgba(255,255,255,.10);

    transform-style:preserve-3d;

    overflow:hidden;
}


/* CARD LIGHT */

.profile-card::before{

    content:"";

    position:absolute;

    width:400px;
    height:400px;

    top:-220px;
    right:-180px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(96,165,250,.16),
            transparent 70%
        );

    pointer-events:none;
}


/* TOP GLOW */

.profile-card::after{

    content:"";

    position:absolute;

    top:0;
    left:8%;

    width:84%;
    height:2px;

    background:

        linear-gradient(
            90deg,
            transparent,
            #38bdf8,
            #818cf8,
            #c084fc,
            #38bdf8,
            transparent
        );

    box-shadow:
        0 0 20px rgba(56,189,248,.5);
}


/* =========================================================
   PROFILE HERO
========================================================= */

.profile-hero{

    text-align:center;

    margin-bottom:30px;

    transform:translateZ(30px);
}


.profile-avatar{

    width:92px;
    height:92px;

    margin:0 auto 18px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:50%;

    color:#bfdbfe;

    font-size:34px;

    background:

        linear-gradient(
            145deg,
            rgba(59,130,246,.25),
            rgba(139,92,246,.25)
        );

    border:
        1px solid rgba(147,197,253,.35);

    box-shadow:

        0 0 0 7px
        rgba(96,165,250,.05),

        0 0 35px
        rgba(59,130,246,.20),

        inset 0 0 25px
        rgba(255,255,255,.06);

    animation:
        avatarFloat 4s ease-in-out infinite;

    transform-style:preserve-3d;
}


@keyframes avatarFloat{

    0%,100%{
        transform:
            translateY(0)
            rotateY(0deg);
    }

    50%{
        transform:
            translateY(-7px)
            rotateY(8deg);
    }

}


.profile-hero h2{

    color:#fff;

    font-size:27px;

    font-weight:700;

    margin-bottom:5px;

    text-shadow:
        0 8px 25px rgba(0,0,0,.3);
}


.profile-hero p{

    color:#94a3b8;

    font-size:13px;
}


/* =========================================================
   STATUS
========================================================= */

.status-badge{

    display:inline-flex;

    align-items:center;

    gap:8px;

    margin-top:14px;

    padding:7px 14px;

    border-radius:30px;

    color:#a7f3d0;

    background:
        rgba(16,185,129,.08);

    border:
        1px solid rgba(52,211,153,.18);

    font-size:11px;

    font-weight:600;

    letter-spacing:.4px;
}


.status-dot{

    width:7px;
    height:7px;

    border-radius:50%;

    background:#34d399;

    box-shadow:
        0 0 10px #34d399;

    animation:
        statusPulse 1.8s infinite;
}


@keyframes statusPulse{

    0%,100%{
        opacity:1;
        transform:scale(1);
    }

    50%{
        opacity:.45;
        transform:scale(.75);
    }

}


/* =========================================================
   SECTION TITLE
========================================================= */

.section-title{

    display:flex;

    align-items:center;

    gap:10px;

    margin-bottom:15px;

    color:#e2e8f0;

    font-size:14px;

    font-weight:600;

    letter-spacing:.4px;
}


.section-title i{

    color:#60a5fa;

}


/* =========================================================
   INFORMATION GRID
========================================================= */

.info-grid{

    display:grid;

    grid-template-columns:
        repeat(2,1fr);

    gap:14px;

    transform-style:preserve-3d;
}


/* =========================================================
   INFORMATION ITEM
========================================================= */

.info-item{

    position:relative;

    min-height:92px;

    padding:18px;

    border-radius:17px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.065),
            rgba(255,255,255,.025)
        );

    border:
        1px solid rgba(255,255,255,.09);

    transition:
        transform .3s ease,
        border-color .3s ease,
        box-shadow .3s ease;

    transform-style:preserve-3d;

    overflow:hidden;

    animation:
        infoEnter .7s ease both;
}


.info-item:nth-child(2){
    animation-delay:.08s;
}

.info-item:nth-child(3){
    animation-delay:.16s;
}

.info-item:nth-child(4){
    animation-delay:.24s;
}

.info-item:nth-child(5){
    animation-delay:.32s;
}

.info-item:nth-child(6){
    animation-delay:.40s;
}


@keyframes infoEnter{

    from{

        opacity:0;

        transform:
            translateY(20px)
            translateZ(-20px);

    }

    to{

        opacity:1;

        transform:
            translateY(0)
            translateZ(0);

    }

}


.info-item::before{

    content:"";

    position:absolute;

    width:120px;
    height:120px;

    top:-70px;
    right:-60px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(59,130,246,.12),
            transparent 70%
        );

    pointer-events:none;
}


.info-item:hover{

    border-color:
        rgba(96,165,250,.30);

    transform:
        translateY(-5px)
        translateZ(12px);

    box-shadow:

        0 15px 35px rgba(0,0,0,.25),

        0 0 25px
        rgba(59,130,246,.06);
}


.info-label{

    display:flex;

    align-items:center;

    gap:8px;

    margin-bottom:7px;

    color:#64748b;

    font-size:10px;

    text-transform:uppercase;

    letter-spacing:1px;

    font-weight:600;
}


.info-label i{

    color:#60a5fa;

    font-size:11px;
}


.info-value{

    color:#f8fafc;

    font-size:14px;

    font-weight:500;

    word-break:break-word;
}


/* =========================================================
   SPECIAL REGISTER NUMBER
========================================================= */

.register-value{

    color:#93c5fd;

    font-weight:700;

    letter-spacing:.5px;
}


/* =========================================================
   BUTTON AREA
========================================================= */

.button-area{

    display:flex;

    justify-content:center;

    margin-top:28px;

    transform:translateZ(25px);
}


.btn{

    position:relative;

    display:inline-flex;

    align-items:center;

    justify-content:center;

    gap:10px;

    min-width:220px;

    padding:13px 25px;

    text-decoration:none;

    color:#fff;

    border-radius:13px;

    background:

        linear-gradient(
            135deg,
            #2563eb,
            #4f46e5,
            #7c3aed
        );

    background-size:200% 200%;

    border:
        1px solid rgba(255,255,255,.15);

    box-shadow:

        0 12px 30px
        rgba(37,99,235,.28),

        inset 0 1px 0
        rgba(255,255,255,.20);

    font-size:13px;

    font-weight:600;

    overflow:hidden;

    transition:
        transform .3s ease,
        box-shadow .3s ease;

    animation:
        buttonGradient 5s ease infinite;
}


@keyframes buttonGradient{

    0%,100%{
        background-position:0% 50%;
    }

    50%{
        background-position:100% 50%;
    }

}


.btn::before{

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
            rgba(255,255,255,.25),
            transparent
        );

    transform:skewX(-20deg);

    transition:.7s;
}


.btn:hover::before{

    left:130%;
}


.btn:hover{

    transform:
        translateY(-4px)
        translateZ(10px);

    box-shadow:

        0 18px 40px
        rgba(37,99,235,.42),

        0 0 25px
        rgba(96,165,250,.14);
}


.btn:active{

    transform:
        translateY(0)
        scale(.98);
}


/* =========================================================
   FOOTER
========================================================= */

.footer{

    position:relative;

    margin-top:30px;

    padding:22px 15px;

    text-align:center;

    color:#64748b;

    font-size:11px;

    background:
        rgba(2,6,23,.65);

    border-top:
        1px solid rgba(255,255,255,.07);

    backdrop-filter:blur(15px);
}


.footer i{

    color:#60a5fa;

    margin-right:5px;
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
            #2563eb,
            #7c3aed
        );

    border-radius:20px;
}


/* =========================================================
   MOBILE
========================================================= */

@media(max-width:700px){

    .header{
        padding:18px 12px;
    }

    .header h1{
        font-size:17px;
    }

    .header p{
        font-size:9px;
    }

    .header-icon{
        width:42px;
        height:42px;
        font-size:17px;
    }

    .container{

        width:94%;

        margin:
            35px auto;

    }

    .profile-card{

        padding:25px 18px;

        border-radius:22px;

    }

    .profile-hero h2{

        font-size:22px;

    }

    .info-grid{

        grid-template-columns:1fr;

    }

    .info-item{

        min-height:85px;

    }

    .button-area{

        width:100%;

    }

    .btn{

        width:100%;

    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media(max-width:400px){

    .profile-card{

        padding:
            22px 14px;

    }

    .profile-avatar{

        width:78px;
        height:78px;

        font-size:28px;

    }

    .profile-hero h2{

        font-size:20px;

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


<!-- ======================================================
     PARTICLES
====================================================== -->

<div class="particles" id="particles"></div>


<!-- ======================================================
     HEADER
====================================================== -->

<header class="header">

    <div class="header-content">

        <div class="header-icon">

            <i class="fas fa-graduation-cap"></i>

        </div>

        <div>

            <h1>
                Online Complaint Management System
            </h1>

            <p>
                STUDENT PREMIUM PORTAL
            </p>

        </div>

    </div>

</header>


<!-- ======================================================
     MAIN
====================================================== -->

<main class="container">


    <section class="profile-card" id="profileCard">


        <!-- PROFILE HERO -->

        <div class="profile-hero">

            <div class="profile-avatar">

                <i class="fas fa-user-graduate"></i>

            </div>


            <h2>

                <?php

                echo htmlspecialchars(
                    $student['student_name']
                );

                ?>

            </h2>


            <p>
                Student Profile
            </p>


            <div class="status-badge">

                <span class="status-dot"></span>

                Active Student

            </div>

        </div>



        <!-- INFORMATION -->

        <div class="section-title">

            <i class="fas fa-id-card"></i>

            Personal Information

        </div>


        <div class="info-grid">


            <!-- REGISTER NUMBER -->

            <div class="info-item">

                <div class="info-label">

                    <i class="fas fa-hashtag"></i>

                    Register Number

                </div>

                <div class="info-value register-value">

                    <?php

                    echo htmlspecialchars(
                        $student['register_no']
                    );

                    ?>

                </div>

            </div>


            <!-- STUDENT NAME -->

            <div class="info-item">

                <div class="info-label">

                    <i class="fas fa-user"></i>

                    Student Name

                </div>

                <div class="info-value">

                    <?php

                    echo htmlspecialchars(
                        $student['student_name']
                    );

                    ?>

                </div>

            </div>


            <!-- EMAIL -->

            <div class="info-item">

                <div class="info-label">

                    <i class="fas fa-envelope"></i>

                    Email Address

                </div>

                <div class="info-value">

                    <?php

                    echo htmlspecialchars(
                        $student['email']
                    );

                    ?>

                </div>

            </div>


            <!-- MOBILE -->

            <div class="info-item">

                <div class="info-label">

                    <i class="fas fa-mobile-screen-button"></i>

                    Mobile Number

                </div>

                <div class="info-value">

                    <?php

                    echo htmlspecialchars(
                        $student['mobile']
                    );

                    ?>

                </div>

            </div>


            <!-- COURSE -->

            <div class="info-item">

                <div class="info-label">

                    <i class="fas fa-book-open"></i>

                    Course

                </div>

                <div class="info-value">

                    <?php

                    echo htmlspecialchars(
                        $student['course']
                    );

                    ?>

                </div>

            </div>


            <!-- ACCOUNT CREATED -->

            <div class="info-item">

                <div class="info-label">

                    <i class="fas fa-calendar-days"></i>

                    Account Created

                </div>

                <div class="info-value">

                    <?php

                    echo htmlspecialchars(
                        $student['created_at']
                    );

                    ?>

                </div>

            </div>


        </div>


        <!-- BUTTON -->

        <div class="button-area">

            <a
                href="student_dashboard.php"
                class="btn"
                id="backButton"
            >

                <i class="fas fa-arrow-left"></i>

                Back to Dashboard

            </a>

        </div>


    </section>


</main>


<!-- ======================================================
     FOOTER
====================================================== -->

<footer class="footer">

    <i class="fas fa-shield-halved"></i>

    © 2026 Online Complaint Management System

    <br>

    Premium Student Portal

</footer>



<script>

/* =========================================================
   PARTICLE GENERATOR
========================================================= */

const particleContainer =
    document.getElementById("particles");


const particleCount = 45;


for(let i = 0; i < particleCount; i++){

    const particle =
        document.createElement("span");

    particle.className =
        "particle";


    particle.style.left =
        Math.random() * 100 + "%";


    const size =
        2 + Math.random() * 4;


    particle.style.width =
        size + "px";


    particle.style.height =
        size + "px";


    particle.style.animationDuration =
        (7 + Math.random() * 13) + "s";


    particle.style.animationDelay =
        Math.random() * 12 + "s";


    particleContainer.appendChild(
        particle
    );

}



/* =========================================================
   3D PROFILE CARD TILT
========================================================= */

const profileCard =
    document.getElementById("profileCard");


if(profileCard){

    profileCard.addEventListener(
        "mousemove",
        function(e){

            if(window.innerWidth <= 700)
                return;


            const rect =
                profileCard.getBoundingClientRect();


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
                centerY) * -2.2;


            const rotateY =
                ((x - centerX) /
                centerX) * 2.2;


            profileCard.style.transform =

                `perspective(1400px)
                 rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)
                 translateZ(5px)`;

        }
    );


    profileCard.addEventListener(
        "mouseleave",
        function(){

            profileCard.style.transform =

                "perspective(1400px) " +
                "rotateX(0deg) " +
                "rotateY(0deg) " +
                "translateZ(0)";

        }
    );

}



/* =========================================================
   INFORMATION CARD 3D TILT
========================================================= */

const infoItems =
    document.querySelectorAll(
        ".info-item"
    );


infoItems.forEach(function(item){

    item.addEventListener(
        "mousemove",
        function(e){

            if(window.innerWidth <= 700)
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
                ((y - centerY) /
                centerY) * -3;


            const rotateY =
                ((x - centerX) /
                centerX) * 3;


            item.style.transform =

                `perspective(700px)
                 rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)
                 translateY(-5px)
                 translateZ(8px)`;

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
   MOUSE FOLLOW LIGHT
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
    "radial-gradient(" +
    "circle," +
    "rgba(96,165,250,.08)," +
    "transparent 70%)";


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
   BUTTON CLICK EFFECT
========================================================= */

const backButton =
    document.getElementById(
        "backButton"
    );


if(backButton){

    backButton.addEventListener(
        "click",
        function(){

            this.style.transform =
                "scale(.96)";

        }
    );

}



/* =========================================================
   3D AVATAR MOUSE EFFECT
========================================================= */

const avatar =
    document.querySelector(
        ".profile-avatar"
    );


if(avatar){

    avatar.addEventListener(
        "mousemove",
        function(e){

            const rect =
                avatar.getBoundingClientRect();


            const x =
                e.clientX - rect.left;


            const y =
                e.clientY - rect.top;


            const rotateY =
                ((x - rect.width / 2) /
                rect.width) * 25;


            const rotateX =
                ((y - rect.height / 2) /
                rect.height) * -25;


            avatar.style.transform =

                `rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)
                 translateY(-5px)`;

        }
    );


    avatar.addEventListener(
        "mouseleave",
        function(){

            avatar.style.transform =
                "";

        }
    );

}



/* =========================================================
   ESC KEY RESET
========================================================= */

document.addEventListener(
    "keydown",
    function(e){

        if(e.key === "Escape"){

            if(profileCard){

                profileCard.style.transform =
                    "perspective(1400px)" +
                    " rotateX(0deg)" +
                    " rotateY(0deg)" +
                    " translateZ(0)";

            }

        }

    }
);



/* =========================================================
   VISIBILITY TITLE
========================================================= */

document.addEventListener(
    "visibilitychange",
    function(){

        if(document.hidden){

            document.title =
                "Student Profile";

        }
        else{

            document.title =
                "Student Profile | Premium Portal";

        }

    }
);

</script>


</body>

</html>