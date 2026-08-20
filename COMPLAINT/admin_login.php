<?php
session_start();
include("db.php");

$message = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === "" || $password === "") {

        $message = "Please enter username and password.";

    } else {

        /*
        =====================================================
        SECURE DATABASE QUERY
        =====================================================
        */

        $stmt = mysqli_prepare(
            $conn,
            "SELECT username, password FROM admin WHERE username = ? LIMIT 1"
        );

        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "s",
                $username
            );

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) === 1) {

                $admin = mysqli_fetch_assoc($result);

                $storedPassword = $admin['password'];

                /*
                =====================================================
                PASSWORD CHECK

                Supports:
                1. password_hash() passwords
                2. Existing plain-text passwords
                =====================================================
                */

                $validPassword = false;

                if (
                    password_verify(
                        $password,
                        $storedPassword
                    )
                ) {

                    $validPassword = true;

                } elseif (
                    hash_equals(
                        (string)$storedPassword,
                        (string)$password
                    )
                ) {

                    /*
                    Temporary compatibility with
                    existing plain-text password.
                    */

                    $validPassword = true;
                }


                if ($validPassword) {

                    session_regenerate_id(true);

                    $_SESSION['admin'] = $username;

                    header(
                        "Location: admin_dashboard.php"
                    );

                    exit();

                } else {

                    $message =
                        "Invalid Username or Password!";
                }

            } else {

                $message =
                    "Invalid Username or Password!";
            }

            mysqli_stmt_close($stmt);

        } else {

            $message =
                "Unable to process login. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<meta
    name="description"
    content="Royal Admin Login - Online Complaint Management System"
>

<title>
    Royal Admin Login | Complaint Management System
</title>


<!-- =====================================================
     GOOGLE FONT
====================================================== -->

<link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
>


<!-- =====================================================
     FONT AWESOME
====================================================== -->

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>


<style>

/* =====================================================
   ROOT
===================================================== */

:root{

    --royal-blue:#071a3d;

    --royal-blue-2:#0d2b5c;

    --blue:#123d7a;

    --gold:#d4af37;

    --gold-light:#f7df82;

    --white:#ffffff;

    --glass:
        rgba(255,255,255,.10);

    --border:
        rgba(255,255,255,.20);

    --shadow:
        rgba(0,0,0,.45);

}


/* =====================================================
   RESET
===================================================== */

*{

    margin:0;

    padding:0;

    box-sizing:border-box;

}


/* =====================================================
   BODY
===================================================== */

body{

    min-height:100vh;

    font-family:'Poppins',sans-serif;

    display:flex;

    justify-content:center;

    align-items:center;

    overflow:hidden;

    position:relative;

    color:white;

    background:

        radial-gradient(
            circle at 20% 20%,
            rgba(212,175,55,.18),
            transparent 25%
        ),

        radial-gradient(
            circle at 80% 80%,
            rgba(24,80,150,.35),
            transparent 30%
        ),

        linear-gradient(
            135deg,
            #020914,
            #071a3d,
            #0d2b5c,
            #020914
        );

    background-size:
        auto,
        auto,
        400% 400%;

    animation:
        royalBackground 15s ease infinite;

}


/* =====================================================
   BACKGROUND GRID
===================================================== */

body::before{

    content:"";

    position:absolute;

    inset:0;

    background-image:

        linear-gradient(
            rgba(255,255,255,.025) 1px,
            transparent 1px
        ),

        linear-gradient(
            90deg,
            rgba(255,255,255,.025) 1px,
            transparent 1px
        );

    background-size:
        45px 45px;

    pointer-events:none;

    mask-image:
        linear-gradient(
            to bottom,
            transparent,
            black 20%,
            black 80%,
            transparent
        );

}


/* =====================================================
   ROYAL LIGHT
===================================================== */

.royal-light{

    position:absolute;

    width:600px;

    height:600px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(212,175,55,.15),
            transparent 65%
        );

    filter:
        blur(10px);

    animation:
        lightMove 12s ease-in-out infinite;

    pointer-events:none;

}


/* =====================================================
   PARTICLE CONTAINER
===================================================== */

#particles{

    position:absolute;

    inset:0;

    overflow:hidden;

    pointer-events:none;

}


/* =====================================================
   PARTICLES
===================================================== */

.particle{

    position:absolute;

    width:3px;

    height:3px;

    border-radius:50%;

    background:
        var(--gold-light);

    box-shadow:
        0 0 10px
        rgba(247,223,130,.9);

    opacity:.7;

    animation:
        particleMove linear infinite;

}


/* =====================================================
   3D STAGE
===================================================== */

.stage{

    width:100%;

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    perspective:1400px;

    position:relative;

    padding:30px;

}


/* =====================================================
   LOGIN CARD
===================================================== */

.login-box{

    width:440px;

    max-width:100%;

    padding:45px;

    position:relative;

    border-radius:30px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.14),
            rgba(255,255,255,.045)
        );

    backdrop-filter:
        blur(25px);

    -webkit-backdrop-filter:
        blur(25px);

    border:
        1px solid
        rgba(255,255,255,.20);

    box-shadow:

        0 40px 90px
        rgba(0,0,0,.55),

        inset 0 1px 0
        rgba(255,255,255,.25),

        inset 0 -1px 0
        rgba(0,0,0,.25);

    transform-style:preserve-3d;

    animation:
        cardEntrance 1.2s cubic-bezier(.2,.8,.2,1);

    transition:
        transform .15s ease;

    z-index:10;

}


/* =====================================================
   CARD ROYAL BORDER
===================================================== */

.login-box::before{

    content:"";

    position:absolute;

    inset:-2px;

    border-radius:32px;

    background:

        linear-gradient(
            135deg,
            transparent 20%,
            rgba(212,175,55,.8),
            transparent 45%,
            rgba(255,255,255,.3),
            transparent 70%,
            rgba(212,175,55,.7)
        );

    z-index:-2;

    animation:
        borderRotate 8s linear infinite;

}


/* =====================================================
   CARD INNER
===================================================== */

.login-box::after{

    content:"";

    position:absolute;

    inset:1px;

    border-radius:29px;

    background:

        linear-gradient(
            145deg,
            rgba(7,26,61,.78),
            rgba(13,43,92,.60)
        );

    z-index:-1;

}


/* =====================================================
   ROYAL EMBLEM
===================================================== */

.emblem{

    width:92px;

    height:92px;

    margin:
        0 auto 20px;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    position:relative;

    color:var(--gold-light);

    font-size:38px;

    background:

        radial-gradient(
            circle at 35% 30%,
            #fff4ae,
            #d4af37 35%,
            #8c6b15 75%,
            #4c3908
        );

    border:
        3px solid
        rgba(255,255,255,.6);

    box-shadow:

        0 15px 35px
        rgba(0,0,0,.4),

        0 0 35px
        rgba(212,175,55,.35);

    transform:
        translateZ(55px);

    animation:
        emblemFloat 4s ease-in-out infinite;

}


/* =====================================================
   EMBLEM ICON
===================================================== */

.emblem i{

    color:
        #fff8c9;

    text-shadow:
        0 2px 5px
        rgba(0,0,0,.4);

}


/* =====================================================
   TITLE
===================================================== */

.brand-title{

    text-align:center;

    font-family:'Cinzel',serif;

    font-size:27px;

    font-weight:700;

    letter-spacing:1px;

    color:#fff;

    transform:
        translateZ(40px);

}


/* =====================================================
   GOLD LINE
===================================================== */

.gold-line{

    width:90px;

    height:3px;

    margin:
        14px auto 12px;

    border-radius:20px;

    background:

        linear-gradient(
            90deg,
            transparent,
            var(--gold-light),
            transparent
        );

    box-shadow:
        0 0 15px
        rgba(212,175,55,.6);

}


/* =====================================================
   SUBTITLE
===================================================== */

.subtitle{

    text-align:center;

    color:
        rgba(255,255,255,.72);

    font-size:13px;

    margin-bottom:30px;

    letter-spacing:.5px;

    transform:
        translateZ(30px);

}


/* =====================================================
   ERROR
===================================================== */

.error{

    display:flex;

    align-items:center;

    gap:10px;

    padding:13px 15px;

    margin-bottom:20px;

    border-radius:13px;

    color:#ffd9d9;

    background:
        rgba(211,47,47,.18);

    border:
        1px solid
        rgba(255,100,100,.35);

    box-shadow:
        inset 0 1px 0
        rgba(255,255,255,.1);

    animation:
        shake .5s ease;

}


/* =====================================================
   FORM GROUP
===================================================== */

.form-group{

    position:relative;

    margin-bottom:20px;

    transform:
        translateZ(25px);

}


/* =====================================================
   LABEL
===================================================== */

label{

    display:block;

    color:
        rgba(255,255,255,.85);

    font-size:13px;

    font-weight:500;

    margin-bottom:8px;

}


/* =====================================================
   INPUT WRAPPER
===================================================== */

.input-wrap{

    position:relative;

}


/* =====================================================
   INPUT ICON
===================================================== */

.input-icon{

    position:absolute;

    left:16px;

    top:50%;

    transform:
        translateY(-50%);

    color:
        var(--gold-light);

    font-size:15px;

    transition:.3s;

    pointer-events:none;

}


/* =====================================================
   INPUT
===================================================== */

input{

    width:100%;

    height:54px;

    padding:
        0 48px;

    border:none;

    outline:none;

    border-radius:14px;

    color:white;

    background:
        rgba(255,255,255,.09);

    border:
        1px solid
        rgba(255,255,255,.13);

    font-size:14px;

    transition:
        .35s ease;

    box-shadow:
        inset 0 2px 8px
        rgba(0,0,0,.15);

}


/* =====================================================
   PLACEHOLDER
===================================================== */

input::placeholder{

    color:
        rgba(255,255,255,.45);

}


/* =====================================================
   INPUT FOCUS
===================================================== */

input:focus{

    background:
        rgba(255,255,255,.15);

    border-color:
        rgba(212,175,55,.8);

    box-shadow:

        0 0 0 3px
        rgba(212,175,55,.10),

        0 10px 25px
        rgba(0,0,0,.15);

    transform:
        translateY(-2px);

}


input:focus + .input-icon{

    color:#fff;

}


/* =====================================================
   PASSWORD TOGGLE
===================================================== */

.password-toggle{

    position:absolute;

    right:15px;

    top:50%;

    transform:
        translateY(-50%);

    border:none;

    background:none;

    color:
        rgba(255,255,255,.6);

    cursor:pointer;

    font-size:15px;

    padding:5px;

    transition:.3s;

}


.password-toggle:hover{

    color:
        var(--gold-light);

    transform:
        translateY(-50%) scale(1.1);

}


/* =====================================================
   LOGIN BUTTON
===================================================== */

.login-btn{

    width:100%;

    height:56px;

    border:none;

    border-radius:16px;

    cursor:pointer;

    position:relative;

    overflow:hidden;

    color:#1d1602;

    font-size:15px;

    font-weight:700;

    letter-spacing:.5px;

    background:

        linear-gradient(
            135deg,
            #fff2a6,
            #d4af37 45%,
            #9c7716
        );

    box-shadow:

        0 12px 25px
        rgba(0,0,0,.3),

        0 0 25px
        rgba(212,175,55,.18);

    transform:
        translateZ(35px);

    transition:
        .35s ease;

}


/* =====================================================
   BUTTON SHINE
===================================================== */

.login-btn::before{

    content:"";

    position:absolute;

    top:0;

    left:-120%;

    width:70%;

    height:100%;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.75),
            transparent
        );

    transform:
        skewX(-20deg);

    transition:
        left .7s ease;

}


.login-btn:hover::before{

    left:140%;

}


.login-btn:hover{

    transform:
        translateZ(45px)
        translateY(-4px)
        scale(1.01);

    box-shadow:

        0 18px 35px
        rgba(0,0,0,.35),

        0 0 35px
        rgba(212,175,55,.35);

}


/* =====================================================
   BUTTON LOADING
===================================================== */

.login-btn.loading{

    pointer-events:none;

    opacity:.8;

}


.login-btn.loading .button-text{

    visibility:hidden;

}


.login-btn.loading::after{

    content:"";

    position:absolute;

    width:22px;

    height:22px;

    border:
        3px solid
        rgba(0,0,0,.25);

    border-top-color:
        #1d1602;

    border-radius:50%;

    left:50%;

    top:50%;

    margin:
        -11px 0 0 -11px;

    animation:
        spin .8s linear infinite;

}


/* =====================================================
   LINKS
===================================================== */

.links{

    text-align:center;

    margin-top:25px;

    transform:
        translateZ(20px);

}


.links a{

    color:
        var(--gold-light);

    text-decoration:none;

    font-size:13px;

    transition:.3s;

}


.links a:hover{

    color:#fff;

    text-shadow:
        0 0 10px
        rgba(247,223,130,.7);

}


/* =====================================================
   FOOTER
===================================================== */

.footer{

    text-align:center;

    margin-top:25px;

    color:
        rgba(255,255,255,.5);

    font-size:11px;

    transform:
        translateZ(15px);

}


/* =====================================================
   HOME BUTTON
===================================================== */

.home-btn{

    position:fixed;

    top:25px;

    left:25px;

    z-index:100;

    display:flex;

    align-items:center;

    gap:9px;

    padding:12px 19px;

    color:white;

    text-decoration:none;

    border-radius:50px;

    background:
        rgba(255,255,255,.08);

    backdrop-filter:
        blur(15px);

    border:
        1px solid
        rgba(255,255,255,.2);

    box-shadow:
        0 10px 25px
        rgba(0,0,0,.25);

    transition:
        .35s ease;

}


.home-btn i{

    color:
        var(--gold-light);

}


.home-btn:hover{

    color:#15100a;

    background:
        linear-gradient(
            135deg,
            #fff2a6,
            #d4af37
        );

    transform:
        translateY(-4px)
        scale(1.04);

    box-shadow:
        0 15px 30px
        rgba(0,0,0,.35);

}


/* =====================================================
   ROYAL ORNAMENTS
===================================================== */

.ornament{

    position:absolute;

    color:
        rgba(212,175,55,.25);

    font-size:45px;

    pointer-events:none;

}


.ornament.one{

    top:8%;

    left:12%;

    animation:
        ornamentFloat 6s ease-in-out infinite;

}


.ornament.two{

    right:12%;

    top:18%;

    font-size:30px;

    animation:
        ornamentFloat 7s ease-in-out infinite reverse;

}


.ornament.three{

    left:15%;

    bottom:15%;

    font-size:25px;

    animation:
        ornamentFloat 8s ease-in-out infinite;

}


/* =====================================================
   ANIMATIONS
===================================================== */

@keyframes royalBackground{

    0%{
        background-position:
            center,
            center,
            0% 50%;
    }

    50%{
        background-position:
            center,
            center,
            100% 50%;
    }

    100%{
        background-position:
            center,
            center,
            0% 50%;
    }

}


@keyframes cardEntrance{

    0%{

        opacity:0;

        transform:
            rotateX(20deg)
            rotateY(-15deg)
            translateY(80px)
            scale(.85);

    }

    100%{

        opacity:1;

        transform:
            rotateX(0)
            rotateY(0)
            translateY(0)
            scale(1);

    }

}


@keyframes emblemFloat{

    0%,100%{

        transform:
            translateZ(55px)
            translateY(0)
            rotateY(0deg);

    }

    50%{

        transform:
            translateZ(55px)
            translateY(-8px)
            rotateY(12deg);

    }

}


@keyframes borderRotate{

    0%{
        transform:rotate(0deg);
    }

    100%{
        transform:rotate(360deg);
    }

}


@keyframes lightMove{

    0%,100%{

        transform:
            translate(-25vw,-10vh);

    }

    50%{

        transform:
            translate(25vw,15vh);

    }

}


@keyframes particleMove{

    from{

        transform:
            translateY(110vh)
            rotate(0deg);

    }

    to{

        transform:
            translateY(-20vh)
            rotate(360deg);

    }

}


@keyframes ornamentFloat{

    0%,100%{

        transform:
            translateY(0)
            rotate(0deg);

    }

    50%{

        transform:
            translateY(-20px)
            rotate(10deg);

    }

}


@keyframes shake{

    0%,100%{
        transform:translateX(0);
    }

    20%{
        transform:translateX(-8px);
    }

    40%{
        transform:translateX(8px);
    }

    60%{
        transform:translateX(-5px);
    }

    80%{
        transform:translateX(5px);
    }

}


@keyframes spin{

    to{
        transform:rotate(360deg);
    }

}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:600px){

    body{

        overflow:auto;

    }

    .stage{

        min-height:100vh;

        padding:
            80px 18px 30px;

    }


    .login-box{

        width:100%;

        padding:
            32px 24px;

        border-radius:25px;

    }


    .brand-title{

        font-size:22px;

    }


    .emblem{

        width:75px;

        height:75px;

        font-size:30px;

    }


    .home-btn{

        top:15px;

        left:15px;

        padding:
            10px 15px;

        font-size:13px;

    }


    .ornament{

        display:none;

    }

}


/* =====================================================
   REDUCED MOTION
===================================================== */

@media(prefers-reduced-motion:reduce){

    *{

        animation-duration:.01ms !important;

        animation-iteration-count:1 !important;

        transition-duration:.01ms !important;

    }

}

</style>

</head>


<body>


<!-- =====================================================
     BACKGROUND EFFECTS
====================================================== -->

<div class="royal-light"></div>

<div id="particles"></div>


<div class="ornament one">
    ✦
</div>

<div class="ornament two">
    ◆
</div>

<div class="ornament three">
    ✧
</div>


<!-- =====================================================
     HOME
====================================================== -->

<a
    href="index.php"
    class="home-btn"
>

    <i class="fa-solid fa-house"></i>

    <span>Home</span>

</a>


<!-- =====================================================
     3D STAGE
====================================================== -->

<div class="stage">


    <!-- =================================================
         LOGIN CARD
    ================================================== -->

    <div
        class="login-box"
        id="loginCard"
    >


        <!-- ROYAL EMBLEM -->

        <div class="emblem">

            <i class="fa-solid fa-crown"></i>

        </div>


        <!-- TITLE -->

        <div class="brand-title">

            Administrator

        </div>


        <div class="gold-line"></div>


        <div class="subtitle">

            Online Complaint Management System

            <br>

            Secure Administrative Portal

        </div>


        <!-- =================================================
             ERROR
        ================================================== -->

        <?php

        if ($message != "") {

            echo '

            <div class="error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <span>
                    ' . htmlspecialchars($message) . '
                </span>

            </div>

            ';

        }

        ?>


        <!-- =================================================
             LOGIN FORM
        ================================================== -->

        <form
            method="post"
            id="loginForm"
        >


            <!-- USERNAME -->

            <div class="form-group">

                <label for="username">

                    Username

                </label>


                <div class="input-wrap">

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter administrator username"
                        autocomplete="username"
                        required
                    >

                    <i
                        class="fa-solid fa-user-shield input-icon"
                    ></i>

                </div>

            </div>


            <!-- PASSWORD -->

            <div class="form-group">

                <label for="password">

                    Password

                </label>


                <div class="input-wrap">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter secure password"
                        autocomplete="current-password"
                        required
                    >


                    <i
                        class="fa-solid fa-lock input-icon"
                    ></i>


                    <button
                        type="button"
                        class="password-toggle"
                        id="passwordToggle"
                        aria-label="Show password"
                    >

                        <i
                            class="fa-solid fa-eye"
                        ></i>

                    </button>

                </div>

            </div>


            <!-- LOGIN -->

            <button
                type="submit"
                name="login"
                class="login-btn"
                id="loginButton"
            >

                <span class="button-text">

                    <i
                        class="fa-solid fa-right-to-bracket"
                    ></i>

                    &nbsp;

                    Secure Login

                </span>

            </button>


        </form>


        <!-- =================================================
             LINKS
        ================================================== -->

        <div class="links">

            <a href="index.php">

                <i class="fa-solid fa-arrow-left"></i>

                Return to Home

            </a>

        </div>


        <!-- =================================================
             FOOTER
        ================================================== -->

        <div class="footer">

            <i class="fa-solid fa-shield-halved"></i>

            Protected Administrative Access

            <br>

            ©
            <span id="year"></span>

            Online Complaint Management System

        </div>


    </div>

</div>


<script>

/* =====================================================
   CURRENT YEAR
===================================================== */

document.getElementById("year").textContent =
    new Date().getFullYear();


/* =====================================================
   PARTICLE SYSTEM
===================================================== */

const particleContainer =
    document.getElementById("particles");


const particleCount =
    window.innerWidth < 600 ? 25 : 55;


for(let i = 0; i < particleCount; i++){

    const particle =
        document.createElement("span");

    particle.className =
        "particle";


    const size =
        Math.random() * 3 + 1;


    particle.style.width =
        size + "px";

    particle.style.height =
        size + "px";


    particle.style.left =
        Math.random() * 100 + "%";


    particle.style.animationDuration =
        (Math.random() * 12 + 8) + "s";


    particle.style.animationDelay =
        -(Math.random() * 15) + "s";


    particleContainer.appendChild(
        particle
    );

}


/* =====================================================
   3D MOUSE TILT
===================================================== */

const card =
    document.getElementById("loginCard");


const stage =
    document.querySelector(".stage");


const isTouchDevice =
    window.matchMedia("(pointer: coarse)").matches;


if(!isTouchDevice){

    stage.addEventListener(
        "mousemove",
        function(event){

            const rect =
                card.getBoundingClientRect();


            const x =
                event.clientX -
                (rect.left + rect.width / 2);


            const y =
                event.clientY -
                (rect.top + rect.height / 2);


            const rotateY =
                (x / rect.width) * 12;


            const rotateX =
                -(y / rect.height) * 12;


            card.style.transform = `

                rotateX(${rotateX}deg)

                rotateY(${rotateY}deg)

                translateZ(10px)

            `;

        }
    );


    stage.addEventListener(
        "mouseleave",
        function(){

            card.style.transform =

                "rotateX(0deg) rotateY(0deg)";

        }
    );

}


/* =====================================================
   PASSWORD SHOW / HIDE
===================================================== */

const password =
    document.getElementById("password");


const passwordToggle =
    document.getElementById("passwordToggle");


passwordToggle.addEventListener(
    "click",
    function(){

        const isPassword =
            password.type === "password";


        password.type =
            isPassword
            ? "text"
            : "password";


        this.innerHTML =
            isPassword

            ? '<i class="fa-solid fa-eye-slash"></i>'

            : '<i class="fa-solid fa-eye"></i>';


        this.setAttribute(
            "aria-label",
            isPassword
            ? "Hide password"
            : "Show password"
        );

    }
);


/* =====================================================
   INPUT 3D EFFECT
===================================================== */

document
.querySelectorAll("input")
.forEach(
    function(input){

        input.addEventListener(
            "focus",
            function(){

                this.closest(".form-group")
                    .style.transform =
                    "translateZ(35px)";

            }
        );


        input.addEventListener(
            "blur",
            function(){

                this.closest(".form-group")
                    .style.transform =
                    "translateZ(25px)";

            }
        );

    }
);


/* =====================================================
   LOGIN BUTTON LOADING
===================================================== */

const loginForm =
    document.getElementById("loginForm");


const loginButton =
    document.getElementById("loginButton");


loginForm.addEventListener(
    "submit",
    function(event){

        const username =
            document.getElementById("username")
            .value.trim();


        const passwordValue =
            document.getElementById("password")
            .value;


        if(
            username === "" ||
            passwordValue === ""
        ){

            event.preventDefault();

            return;

        }


        loginButton.classList.add(
            "loading"
        );

    }
);


/* =====================================================
   BUTTON RIPPLE EFFECT
===================================================== */

loginButton.addEventListener(
    "click",
    function(event){

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
            "rgba(255,255,255,.65)";

        ripple.style.left =
            event.offsetX + "px";

        ripple.style.top =
            event.offsetY + "px";

        ripple.style.transform =
            "translate(-50%,-50%) scale(1)";

        ripple.style.pointerEvents =
            "none";

        ripple.style.animation =
            "ripple .7s ease-out";


        this.appendChild(ripple);


        setTimeout(
            function(){

                ripple.remove();

            },
            700
        );

    }
);


/* =====================================================
   RIPPLE STYLE
===================================================== */

const rippleStyle =
document.createElement("style");


rippleStyle.textContent = `

@keyframes ripple{

    from{

        opacity:.7;

        transform:
            translate(-50%,-50%)
            scale(1);

    }

    to{

        opacity:0;

        transform:
            translate(-50%,-50%)
            scale(25);

    }

}

`;


document.head.appendChild(
    rippleStyle
);


/* =====================================================
   KEYBOARD SHORTCUT
===================================================== */

document.addEventListener(
    "keydown",
    function(event){

        /*
        Alt + H = Home
        */

        if(
            event.altKey &&
            event.key.toLowerCase() === "h"
        ){

            window.location.href =
                "index.php";

        }

        /*
        Escape = clear password
        */

        if(
            event.key === "Escape"
        ){

            password.value = "";

        }

    }
);


/* =====================================================
   CARD PARALLAX ON MOBILE DEVICE MOTION
===================================================== */

if(
    window.DeviceOrientationEvent &&
    !isTouchDevice
){

    window.addEventListener(
        "deviceorientation",
        function(event){

            if(
                event.beta === null ||
                event.gamma === null
            ){

                return;

            }


            const rotateX =
                Math.max(
                    -8,
                    Math.min(
                        8,
                        event.beta / 10
                    )
                );


            const rotateY =
                Math.max(
                    -8,
                    Math.min(
                        8,
                        event.gamma / 10
                    )
                );


            card.style.transform = `

                rotateX(${rotateX}deg)

                rotateY(${rotateY}deg)

            `;

        }
    );

}


/* =====================================================
   PAGE VISIBILITY
===================================================== */

document.addEventListener(
    "visibilitychange",
    function(){

        if(document.hidden){

            document.title =
                "Come Back | Admin Portal";

        }
        else{

            document.title =
                "Royal Admin Login | Complaint Management System";

        }

    }
);


/* =====================================================
   CONSOLE MESSAGE
===================================================== */

console.log(
    "%c Royal Admin Portal ",
    "background:#071a3d;color:#f7df82;font-size:18px;font-weight:bold;padding:8px;border-radius:6px;"
);

console.log(
    "Secure administrative access enabled."
);

</script>


</body>

</html>