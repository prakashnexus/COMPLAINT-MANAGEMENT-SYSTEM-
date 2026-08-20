<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="theme-color" content="#070b1f">

<title>Student Login | Online Complaint Management System</title>

<!-- =====================================================
     GOOGLE FONT
===================================================== -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- =====================================================
     FONT AWESOME
===================================================== -->
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

<style>

/* =====================================================
   ROOT
===================================================== */

:root{

    --royal-blue:#071b52;
    --deep-blue:#020617;
    --blue:#123f9a;
    --gold:#d4af37;
    --gold-light:#ffe58a;
    --white:#ffffff;
    --glass:rgba(255,255,255,.09);
    --glass-border:rgba(255,255,255,.18);

}

/* =====================================================
   RESET
===================================================== */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

    font-family:'Poppins',sans-serif;

}

/* =====================================================
   BODY
===================================================== */

body{

    min-height:100vh;

    overflow:hidden;

    display:flex;

    justify-content:center;

    align-items:center;

    position:relative;

    background:

        radial-gradient(
            circle at 15% 20%,
            rgba(30,85,180,.45),
            transparent 30%
        ),

        radial-gradient(
            circle at 85% 80%,
            rgba(212,175,55,.12),
            transparent 25%
        ),

        linear-gradient(
            135deg,
            #020617,
            #071b52,
            #020617
        );

    color:white;

}

/* =====================================================
   ANIMATED BACKGROUND
===================================================== */

.background{

    position:fixed;

    inset:0;

    overflow:hidden;

    pointer-events:none;

    z-index:0;

}

/* =====================================================
   GLOW
===================================================== */

.glow{

    position:absolute;

    border-radius:50%;

    filter:blur(5px);

    animation:
        glowMove 8s ease-in-out infinite alternate;

}

.glow.one{

    width:350px;
    height:350px;

    left:-120px;
    top:-120px;

    background:
        radial-gradient(
            circle,
            rgba(0,123,255,.35),
            transparent 70%
        );

}

.glow.two{

    width:400px;
    height:400px;

    right:-160px;
    bottom:-180px;

    background:
        radial-gradient(
            circle,
            rgba(212,175,55,.22),
            transparent 70%
        );

    animation-delay:2s;

}

@keyframes glowMove{

    0%{
        transform:translate(0,0) scale(1);
    }

    100%{
        transform:translate(50px,-30px) scale(1.15);
    }

}

/* =====================================================
   PARTICLE CANVAS
===================================================== */

#particles{

    position:fixed;

    inset:0;

    width:100%;
    height:100%;

    z-index:1;

    pointer-events:none;

}

/* =====================================================
   FLOATING 3D OBJECTS
===================================================== */

.shape{

    position:absolute;

    border:1px solid rgba(212,175,55,.25);

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.05),
            rgba(212,175,55,.04)
        );

    backdrop-filter:blur(3px);

    animation:
        shapeFloat 7s ease-in-out infinite;

}

.cube{

    width:75px;
    height:75px;

    left:8%;
    top:18%;

    transform:
        rotateX(55deg)
        rotateZ(45deg);

}

.cube.two{

    width:55px;
    height:55px;

    right:10%;
    top:15%;

    animation-delay:2s;

}

.cube.three{

    width:100px;
    height:100px;

    right:12%;
    bottom:15%;

    animation-delay:4s;

}

.diamond{

    width:55px;
    height:55px;

    left:13%;
    bottom:15%;

    transform:rotate(45deg);

    animation-delay:1s;

}

@keyframes shapeFloat{

    0%,100%{

        transform:
            translateY(0)
            rotateX(40deg)
            rotateZ(45deg);

    }

    50%{

        transform:
            translateY(-30px)
            rotateX(80deg)
            rotateZ(130deg);

    }

}

/* =====================================================
   HOME BUTTON
===================================================== */

.home-btn{

    position:fixed;

    top:25px;
    left:25px;

    z-index:20;

    display:flex;

    align-items:center;

    gap:10px;

    padding:12px 22px;

    border-radius:50px;

    color:white;

    text-decoration:none;

    background:
        rgba(255,255,255,.08);

    border:
        1px solid
        rgba(212,175,55,.4);

    backdrop-filter:blur(15px);

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.3);

    transition:.4s;

}

.home-btn i{

    color:var(--gold-light);

}

.home-btn:hover{

    color:#071b52;

    background:
        linear-gradient(
            135deg,
            var(--gold-light),
            var(--gold)
        );

    transform:
        translateY(-4px)
        scale(1.04);

    box-shadow:
        0 15px 35px
        rgba(212,175,55,.3);

}

/* =====================================================
   MAIN CONTAINER
===================================================== */

.login-wrapper{

    position:relative;

    z-index:10;

    width:min(1100px,94%);

    display:flex;

    justify-content:center;

    align-items:center;

    perspective:1600px;

}

/* =====================================================
   3D CARD
===================================================== */

.login-box{

    width:440px;

    padding:45px;

    position:relative;

    border-radius:30px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.14),
            rgba(255,255,255,.045)
        );

    border:
        1px solid
        rgba(212,175,55,.35);

    backdrop-filter:
        blur(25px);

    -webkit-backdrop-filter:
        blur(25px);

    box-shadow:

        0 35px 80px
        rgba(0,0,0,.55),

        inset 0 1px 0
        rgba(255,255,255,.15);

    text-align:center;

    transform-style:preserve-3d;

    transition:
        transform .15s ease,
        box-shadow .4s ease;

    animation:
        cardEnter 1.2s cubic-bezier(.2,.8,.2,1);

}

/* =====================================================
   CARD GOLD BORDER
===================================================== */

.login-box::before{

    content:"";

    position:absolute;

    inset:-1px;

    border-radius:30px;

    padding:1px;

    background:
        linear-gradient(
            135deg,
            transparent,
            var(--gold),
            transparent,
            var(--gold-light),
            transparent
        );

    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);

    -webkit-mask-composite:xor;

    mask-composite:exclude;

    opacity:.7;

    pointer-events:none;

}

/* =====================================================
   CARD LIGHT
===================================================== */

.login-box::after{

    content:"";

    position:absolute;

    width:180px;
    height:180px;

    top:-100px;
    right:-100px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(255,220,100,.18),
            transparent 70%
        );

    pointer-events:none;

}

/* =====================================================
   CARD HOVER
===================================================== */

.login-box:hover{

    box-shadow:

        0 45px 100px
        rgba(0,0,0,.65),

        0 0 45px
        rgba(212,175,55,.12);

}

/* =====================================================
   LOGO / CROWN
===================================================== */

.logo-icon{

    width:88px;
    height:88px;

    margin:0 auto 22px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:50%;

    background:

        radial-gradient(
            circle at 30% 30%,
            #fff3a5,
            #d4af37 45%,
            #806515 100%
        );

    color:#071b52;

    font-size:36px;

    box-shadow:

        0 0 0 5px
        rgba(212,175,55,.08),

        0 15px 35px
        rgba(212,175,55,.25);

    transform:translateZ(45px);

    animation:
        crownFloat 4s ease-in-out infinite;

}

@keyframes crownFloat{

    0%,100%{
        transform:
            translateZ(45px)
            translateY(0);
    }

    50%{
        transform:
            translateZ(45px)
            translateY(-8px);
    }

}

/* =====================================================
   TITLE
===================================================== */

.login-box h1{

    font-family:'Cinzel',serif;

    font-size:29px;

    line-height:1.4;

    color:white;

    margin-bottom:8px;

    transform:translateZ(35px);

}

.login-box h2{

    font-size:16px;

    font-weight:400;

    color:
        var(--gold-light);

    letter-spacing:2px;

    margin-bottom:28px;

    transform:translateZ(30px);

}

/* =====================================================
   ROYAL LINE
===================================================== */

.royal-line{

    display:flex;

    align-items:center;

    gap:10px;

    margin:0 auto 25px;

    width:80%;

}

.royal-line span{

    height:1px;

    flex:1;

    background:
        linear-gradient(
            90deg,
            transparent,
            var(--gold)
        );

}

.royal-line span:last-child{

    background:
        linear-gradient(
            90deg,
            var(--gold),
            transparent
        );

}

.royal-line i{

    color:var(--gold);

    font-size:12px;

}

/* =====================================================
   FORM
===================================================== */

.form-group{

    position:relative;

    margin:17px 0;

    transform:translateZ(25px);

}

.form-group input{

    width:100%;

    padding:
        16px
        50px
        16px
        48px;

    border:none;

    outline:none;

    border-radius:15px;

    background:
        rgba(255,255,255,.09);

    border:
        1px solid
        rgba(255,255,255,.12);

    color:white;

    font-size:15px;

    transition:.35s;

}

.form-group input::placeholder{

    color:
        rgba(255,255,255,.55);

}

.form-group input:focus{

    background:
        rgba(255,255,255,.16);

    border-color:
        var(--gold);

    box-shadow:
        0 0 0 4px
        rgba(212,175,55,.08),

        0 10px 30px
        rgba(0,0,0,.2);

    transform:
        translateY(-2px);

}

.input-icon{

    position:absolute;

    left:17px;

    top:50%;

    transform:translateY(-50%);

    color:var(--gold);

    pointer-events:none;

}

.password-toggle{

    position:absolute;

    right:16px;

    top:50%;

    transform:translateY(-50%);

    border:none;

    background:none;

    color:
        rgba(255,255,255,.65);

    cursor:pointer;

    padding:5px;

    width:auto;

    margin:0;

    box-shadow:none;

}

.password-toggle:hover{

    color:var(--gold-light);

    transform:
        translateY(-50%)
        scale(1.1);

    box-shadow:none;

}

/* =====================================================
   LOGIN BUTTON
===================================================== */

.login-button{

    width:100%;

    margin-top:18px;

    padding:16px;

    border:none;

    border-radius:50px;

    cursor:pointer;

    position:relative;

    overflow:hidden;

    color:#071b52;

    font-size:16px;

    font-weight:700;

    letter-spacing:.5px;

    background:

        linear-gradient(
            135deg,
            #fff1a8,
            #d4af37,
            #fff1a8
        );

    background-size:200% 100%;

    box-shadow:

        0 12px 30px
        rgba(212,175,55,.25),

        inset 0 1px 0
        rgba(255,255,255,.7);

    transition:.4s;

    transform:translateZ(30px);

}

.login-button:hover{

    background-position:100% 0;

    transform:
        translateZ(30px)
        translateY(-4px)
        scale(1.02);

    box-shadow:

        0 20px 40px
        rgba(212,175,55,.35);

}

.login-button:active{

    transform:
        translateZ(20px)
        scale(.97);

}

/* =====================================================
   BUTTON SHINE
===================================================== */

.login-button::before{

    content:"";

    position:absolute;

    top:0;

    left:-100%;

    width:50%;

    height:100%;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.6),
            transparent
        );

    transform:skewX(-25deg);

    transition:.6s;

}

.login-button:hover::before{

    left:130%;

}

/* =====================================================
   RIPPLE
===================================================== */

.ripple{

    position:absolute;

    border-radius:50%;

    background:
        rgba(255,255,255,.55);

    transform:scale(0);

    animation:rippleAnimation .6s linear;

    pointer-events:none;

}

@keyframes rippleAnimation{

    to{

        transform:scale(5);

        opacity:0;

    }

}

/* =====================================================
   LINKS
===================================================== */

.links{

    margin-top:25px;

    font-size:14px;

    color:
        rgba(255,255,255,.7);

    transform:translateZ(20px);

}

.links p{

    margin:8px 0;

}

.links a{

    color:
        var(--gold-light);

    text-decoration:none;

    font-weight:600;

    transition:.3s;

}

.links a:hover{

    color:white;

    text-shadow:
        0 0 10px
        rgba(255,220,100,.5);

}

/* =====================================================
   FOOTER
===================================================== */

.footer{

    margin-top:25px;

    padding-top:20px;

    border-top:
        1px solid
        rgba(255,255,255,.1);

    font-size:12px;

    color:
        rgba(255,255,255,.5);

    transform:translateZ(15px);

}

/* =====================================================
   SECURITY BADGE
===================================================== */

.security{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:7px;

    margin-top:14px;

    font-size:11px;

    color:
        rgba(255,255,255,.45);

}

.security i{

    color:#6ee7b7;

}

/* =====================================================
   LOADING
===================================================== */

.loading-overlay{

    position:fixed;

    inset:0;

    z-index:999;

    display:none;

    justify-content:center;

    align-items:center;

    background:
        rgba(2,6,23,.85);

    backdrop-filter:blur(10px);

}

.loading-overlay.active{

    display:flex;

}

.loader{

    width:70px;

    height:70px;

    border-radius:50%;

    border:
        3px solid
        rgba(212,175,55,.2);

    border-top-color:
        var(--gold);

    animation:
        spin 1s linear infinite;

}

@keyframes spin{

    to{
        transform:rotate(360deg);
    }

}

/* =====================================================
   TOAST
===================================================== */

.toast{

    position:fixed;

    right:25px;

    bottom:25px;

    z-index:1000;

    padding:14px 20px;

    border-radius:14px;

    background:
        rgba(10,15,35,.92);

    border:
        1px solid
        rgba(212,175,55,.3);

    box-shadow:
        0 15px 35px
        rgba(0,0,0,.4);

    color:white;

    display:flex;

    align-items:center;

    gap:10px;

    transform:
        translateX(130%);

    transition:.5s;

}

.toast.show{

    transform:
        translateX(0);

}

.toast i{

    color:var(--gold);

}

/* =====================================================
   CARD ENTER
===================================================== */

@keyframes cardEnter{

    0%{

        opacity:0;

        transform:
            rotateX(20deg)
            translateY(80px)
            scale(.85);

    }

    100%{

        opacity:1;

        transform:
            rotateX(0)
            translateY(0)
            scale(1);

    }

}

/* =====================================================
   MOBILE
===================================================== */

@media(max-width:600px){

    body{

        overflow:auto;

        padding:
            80px 15px 30px;

    }

    .home-btn{

        top:15px;
        left:15px;

        padding:
            10px 16px;

        font-size:13px;

    }

    .login-box{

        width:100%;

        padding:
            32px 23px;

        border-radius:24px;

    }

    .login-box h1{

        font-size:23px;

    }

    .login-box h2{

        font-size:13px;

        letter-spacing:1.5px;

    }

    .logo-icon{

        width:72px;
        height:72px;

        font-size:28px;

    }

    .shape{

        opacity:.3;

    }

}

/* =====================================================
   REDUCE MOTION
===================================================== */

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
     BACKGROUND
===================================================== -->

<div class="background">

    <div class="glow one"></div>

    <div class="glow two"></div>

    <div class="shape cube"></div>

    <div class="shape cube two"></div>

    <div class="shape cube three"></div>

    <div class="shape diamond"></div>

</div>

<canvas id="particles"></canvas>


<!-- =====================================================
     HOME
===================================================== -->

<a href="index.php" class="home-btn">

    <i class="fa-solid fa-house"></i>

    <span>Home</span>

</a>


<!-- =====================================================
     LOGIN WRAPPER
===================================================== -->

<div class="login-wrapper">

    <div class="login-box" id="loginCard">

        <!-- ROYAL ICON -->

        <div class="logo-icon">

            <i class="fa-solid fa-crown"></i>

        </div>


        <!-- TITLE -->

        <h1>
            Online Complaint
            Management System
        </h1>

        <h2>
            STUDENT PORTAL
        </h2>


        <!-- DECORATIVE LINE -->

        <div class="royal-line">

            <span></span>

            <i class="fa-solid fa-gem"></i>

            <span></span>

        </div>


        <!-- =================================================
             LOGIN FORM
        ================================================== -->

        <form
            action="student_dashboard.php"
            method="POST"
            id="loginForm"
        >

            <!-- STUDENT ID -->

            <div class="form-group">

                <i class="fa-solid fa-id-card input-icon"></i>

                <input
                    type="text"
                    name="student_id"
                    id="student_id"
                    placeholder="Enter Student ID"
                    autocomplete="username"
                    required
                >

            </div>


            <!-- PASSWORD -->

            <div class="form-group">

                <i class="fa-solid fa-lock input-icon"></i>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter Password"
                    autocomplete="current-password"
                    required
                >

                <button
                    type="button"
                    class="password-toggle"
                    id="passwordToggle"
                    aria-label="Show password"
                >

                    <i class="fa-solid fa-eye"></i>

                </button>

            </div>


            <!-- LOGIN -->

            <button
                type="submit"
                class="login-button"
                id="loginButton"
            >

                <i class="fa-solid fa-right-to-bracket"></i>

                &nbsp; Sign In Securely

            </button>

        </form>


        <!-- LINKS -->

        <div class="links">

            <p>

                <a href="forgot_password.php">

                    <i class="fa-solid fa-key"></i>

                    Forgot Password?

                </a>

            </p>


            <p>

                Don't have an account?

                <a href="register.php">

                    Create Account

                </a>

            </p>

        </div>


        <!-- SECURITY -->

        <div class="security">

            <i class="fa-solid fa-shield-halved"></i>

            Secure Student Authentication

        </div>


        <!-- FOOTER -->

        <div class="footer">

            © 2026 Online Complaint Management System

            <br>

            NIFT-TEA College of Knitwear & Fashion

        </div>

    </div>

</div>


<!-- =====================================================
     LOADING
===================================================== -->

<div class="loading-overlay" id="loadingOverlay">

    <div class="loader"></div>

</div>


<!-- =====================================================
     TOAST
===================================================== -->

<div class="toast" id="toast">

    <i class="fa-solid fa-circle-check"></i>

    <span id="toastMessage">
        Welcome to Student Portal
    </span>

</div>


<script>

/* =====================================================
   ELEMENTS
===================================================== */

const loginCard =
    document.getElementById("loginCard");

const loginForm =
    document.getElementById("loginForm");

const loginButton =
    document.getElementById("loginButton");

const loadingOverlay =
    document.getElementById("loadingOverlay");

const password =
    document.getElementById("password");

const passwordToggle =
    document.getElementById("passwordToggle");

const toast =
    document.getElementById("toast");

const toastMessage =
    document.getElementById("toastMessage");


/* =====================================================
   PASSWORD SHOW / HIDE
===================================================== */

passwordToggle.addEventListener(
    "click",
    function(){

        if(password.type === "password"){

            password.type = "text";

            this.innerHTML =
                '<i class="fa-solid fa-eye-slash"></i>';

            this.setAttribute(
                "aria-label",
                "Hide password"
            );

        }

        else{

            password.type = "password";

            this.innerHTML =
                '<i class="fa-solid fa-eye"></i>';

            this.setAttribute(
                "aria-label",
                "Show password"
            );

        }

    }
);


/* =====================================================
   3D MOUSE TILT
===================================================== */

document.addEventListener(
    "mousemove",
    function(event){

        if(window.innerWidth < 700){

            return;

        }

        const x =
            (window.innerWidth / 2 - event.clientX)
            / 35;

        const y =
            (window.innerHeight / 2 - event.clientY)
            / 35;

        loginCard.style.transform =
            `
            rotateY(${x}deg)
            rotateX(${y}deg)
            translateY(0)
            `;
        
    }
);


/* =====================================================
   RESET 3D
===================================================== */

document.addEventListener(
    "mouseleave",
    function(){

        loginCard.style.transform =
            "rotateY(0deg) rotateX(0deg)";

    }
);


/* =====================================================
   INPUT 3D EFFECT
===================================================== */

document
.querySelectorAll(
    ".form-group input"
)
.forEach(
    function(input){

        input.addEventListener(
            "focus",
            function(){

                this.parentElement.style.transform =
                    "translateZ(35px)";

            }
        );

        input.addEventListener(
            "blur",
            function(){

                this.parentElement.style.transform =
                    "translateZ(25px)";

            }
        );

    }
);


/* =====================================================
   RIPPLE EFFECT
===================================================== */

loginButton.addEventListener(
    "click",
    function(event){

        const rect =
            this.getBoundingClientRect();

        const ripple =
            document.createElement("span");

        ripple.classList.add("ripple");

        const size =
            Math.max(
                rect.width,
                rect.height
            );

        ripple.style.width =
            size + "px";

        ripple.style.height =
            size + "px";

        ripple.style.left =
            event.clientX -
            rect.left -
            size / 2 +
            "px";

        ripple.style.top =
            event.clientY -
            rect.top -
            size / 2 +
            "px";

        this.appendChild(ripple);

        setTimeout(
            function(){

                ripple.remove();

            },
            600
        );

    }
);


/* =====================================================
   FORM SUBMIT LOADING
===================================================== */

loginForm.addEventListener(
    "submit",
    function(){

        loginButton.innerHTML =
            `
            <i class="fa-solid fa-spinner fa-spin"></i>
            &nbsp; Authenticating...
            `;

        loginButton.disabled = true;

        loadingOverlay.classList.add(
            "active"
        );

    }
);


/* =====================================================
   TOAST
===================================================== */

function showToast(message){

    toastMessage.textContent =
        message;

    toast.classList.add(
        "show"
    );

    setTimeout(
        function(){

            toast.classList.remove(
                "show"
            );

        },
        3000
    );

}


/* =====================================================
   WELCOME MESSAGE
===================================================== */

window.addEventListener(
    "load",
    function(){

        setTimeout(
            function(){

                showToast(
                    "Welcome to the Student Portal"
                );

            },
            1000
        );

    }
);


/* =====================================================
   PARTICLE SYSTEM
===================================================== */

const canvas =
    document.getElementById(
        "particles"
    );

const ctx =
    canvas.getContext("2d");

let particles = [];

function resizeCanvas(){

    canvas.width =
        window.innerWidth;

    canvas.height =
        window.innerHeight;

}

resizeCanvas();

window.addEventListener(
    "resize",
    resizeCanvas
);


/* =====================================================
   CREATE PARTICLES
===================================================== */

function createParticles(){

    particles = [];

    const amount =
        window.innerWidth < 600
        ? 35
        : 75;

    for(
        let i = 0;
        i < amount;
        i++
    ){

        particles.push({

            x:
                Math.random()
                * canvas.width,

            y:
                Math.random()
                * canvas.height,

            size:
                Math.random()
                * 2.2 + .5,

            speedX:
                (Math.random() - .5)
                * .35,

            speedY:
                (Math.random() - .5)
                * .35,

            alpha:
                Math.random()
                * .7 + .1

        });

    }

}

createParticles();


/* =====================================================
   DRAW PARTICLES
===================================================== */

function drawParticles(){

    ctx.clearRect(
        0,
        0,
        canvas.width,
        canvas.height
    );

    particles.forEach(
        function(p){

            p.x += p.speedX;

            p.y += p.speedY;

            if(
                p.x < 0 ||
                p.x > canvas.width
            ){

                p.speedX *= -1;

            }

            if(
                p.y < 0 ||
                p.y > canvas.height
            ){

                p.speedY *= -1;

            }

            ctx.beginPath();

            ctx.arc(
                p.x,
                p.y,
                p.size,
                0,
                Math.PI * 2
            );

            ctx.fillStyle =
                `rgba(212,175,55,${p.alpha})`;

            ctx.fill();

        }
    );


    connectParticles();

    requestAnimationFrame(
        drawParticles
    );

}

drawParticles();


/* =====================================================
   CONNECT PARTICLES
===================================================== */

function connectParticles(){

    for(
        let i = 0;
        i < particles.length;
        i++
    ){

        for(
            let j = i + 1;
            j < particles.length;
            j++
        ){

            const dx =
                particles[i].x -
                particles[j].x;

            const dy =
                particles[i].y -
                particles[j].y;

            const distance =
                Math.sqrt(
                    dx * dx +
                    dy * dy
                );

            if(distance < 110){

                const opacity =
                    .12 -
                    distance / 1000;

                ctx.beginPath();

                ctx.moveTo(
                    particles[i].x,
                    particles[i].y
                );

                ctx.lineTo(
                    particles[j].x,
                    particles[j].y
                );

                ctx.strokeStyle =
                    `rgba(212,175,55,${opacity})`;

                ctx.lineWidth = .6;

                ctx.stroke();

            }

        }

    }

}


/* =====================================================
   PARALLAX BACKGROUND
===================================================== */

document.addEventListener(
    "mousemove",
    function(event){

        const x =
            event.clientX /
            window.innerWidth;

        const y =
            event.clientY /
            window.innerHeight;

        document.querySelectorAll(
            ".shape"
        ).forEach(
            function(shape,index){

                const strength =
                    (index + 1) * 8;

                shape.style.marginLeft =
                    ((x - .5) * strength)
                    + "px";

                shape.style.marginTop =
                    ((y - .5) * strength)
                    + "px";

            }
        );

    }
);


/* =====================================================
   ENTER KEY ANIMATION
===================================================== */

document.addEventListener(
    "keydown",
    function(event){

        if(event.key === "Enter"){

            loginCard.style.transform =
                "scale(.99)";

            setTimeout(
                function(){

                    loginCard.style.transform =
                        "";

                },
                120
            );

        }

    }
);


/* =====================================================
   PREVENT DOUBLE SUBMIT
===================================================== */

let submitted = false;

loginForm.addEventListener(
    "submit",
    function(){

        if(submitted){

            return false;

        }

        submitted = true;

    }
);


/* =====================================================
   VISIBILITY EFFECT
===================================================== */

document.addEventListener(
    "visibilitychange",
    function(){

        if(document.hidden){

            document.title =
                "Come Back | Student Portal";

        }

        else{

            document.title =
                "Student Login | Online Complaint Management System";

        }

    }
);

</script>

</body>
</html>