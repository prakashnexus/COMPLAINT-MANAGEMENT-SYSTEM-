<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<meta name="description"
      content="Royal Online Complaint Management System - NIFT-TEA College of Knitwear & Fashion">

<title>Online Complaint Management System | NIFT-TEA College</title>


<!-- =====================================================
     GOOGLE FONTS
===================================================== -->

<link rel="preconnect"
      href="https://fonts.googleapis.com">

<link rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">


<!-- =====================================================
     FONT AWESOME
===================================================== -->

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

/* =====================================================
   ROOT
===================================================== */

:root{

    --royal:#07152f;

    --royal2:#0d2b59;

    --blue:#123f7a;

    --gold:#d4af37;

    --gold-light:#f7df86;

    --white:#ffffff;

    --text:#eef4ff;

    --muted:#aebbd0;

    --glass:rgba(255,255,255,.075);

    --glass-border:rgba(255,255,255,.14);

    --shadow:
        0 25px 70px rgba(0,0,0,.35);

    --gold-shadow:
        0 15px 40px rgba(212,175,55,.25);

}


/* =====================================================
   RESET
===================================================== */

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

    background:

        radial-gradient(
            circle at 10% 20%,
            rgba(20,75,145,.35),
            transparent 30%
        ),

        radial-gradient(
            circle at 90% 70%,
            rgba(212,175,55,.12),
            transparent 30%
        ),

        var(--royal);

    color:var(--text);

    overflow-x:hidden;

}


/* =====================================================
   PAGE LOADER
===================================================== */

#loader{

    position:fixed;

    inset:0;

    z-index:99999;

    background:

        radial-gradient(
            circle,
            #123d76,
            #020914 75%
        );

    display:flex;

    align-items:center;

    justify-content:center;

    flex-direction:column;

    transition:
        opacity .8s ease,
        visibility .8s ease;

}


#loader.hide{

    opacity:0;

    visibility:hidden;

}


.loader-logo{

    width:100px;

    height:100px;

    object-fit:cover;

    border-radius:50%;

    padding:5px;

    background:white;

    border:3px solid var(--gold);

    box-shadow:

        0 0 30px rgba(212,175,55,.5);

    animation:

        loaderPulse 2s infinite;

}


.loader-ring{

    width:150px;

    height:150px;

    position:absolute;

    border-radius:50%;

    border:2px solid transparent;

    border-top-color:var(--gold);

    border-bottom-color:#3e82d5;

    animation:

        spin 2s linear infinite;

}


.loader-title{

    margin-top:30px;

    font-family:'Cinzel',serif;

    color:var(--gold-light);

    letter-spacing:2px;

}


.loader-subtitle{

    color:#9eabc0;

    margin-top:8px;

}


@keyframes spin{

    to{

        transform:rotate(360deg);

    }

}


@keyframes loaderPulse{

    0%,100%{

        transform:scale(1);

    }

    50%{

        transform:scale(1.08);

    }

}


/* =====================================================
   3D BACKGROUND
===================================================== */

#particles{

    position:fixed;

    inset:0;

    z-index:-1;

    pointer-events:none;

}


.particle{

    position:absolute;

    width:4px;

    height:4px;

    border-radius:50%;

    background:var(--gold-light);

    box-shadow:

        0 0 12px var(--gold);

    opacity:.6;

    animation:

        particleFloat linear infinite;

}


@keyframes particleFloat{

    from{

        transform:
            translate3d(
                0,
                110vh,
                0
            )
            rotate(0deg);

    }

    to{

        transform:
            translate3d(
                80px,
                -120vh,
                0
            )
            rotate(360deg);

    }

}


/* =====================================================
   HEADER
===================================================== */

header{

    position:fixed;

    top:0;

    left:0;

    width:100%;

    z-index:5000;

    padding:15px 6%;

    display:flex;

    justify-content:space-between;

    align-items:center;

    background:

        linear-gradient(
            180deg,
            rgba(3,12,29,.94),
            rgba(3,12,29,.65)
        );

    backdrop-filter:blur(18px);

    border-bottom:

        1px solid
        rgba(212,175,55,.15);

    transition:.4s;

}


header.scrolled{

    padding:9px 6%;

    background:

        rgba(3,12,29,.96);

    box-shadow:

        0 10px 40px rgba(0,0,0,.35);

}


/* =====================================================
   LOGO
===================================================== */

.logo{

    display:flex;

    align-items:center;

    gap:14px;

}


.logo img{

    width:62px;

    height:62px;

    object-fit:cover;

    border-radius:50%;

    padding:3px;

    background:#fff;

    border:2px solid var(--gold);

    box-shadow:

        0 0 20px rgba(212,175,55,.25);

    transition:.5s;

}


.logo:hover img{

    transform:
        rotateY(180deg)
        scale(1.08);

}


.college-name h2{

    font-family:'Cinzel',serif;

    color:var(--gold-light);

    font-size:18px;

    font-weight:700;

}


.college-name p{

    color:#b5c2d7;

    font-size:12px;

    margin-top:2px;

}


/* =====================================================
   NAVIGATION
===================================================== */

nav{

    display:flex;

    align-items:center;

    gap:8px;

}


nav a{

    position:relative;

    color:white;

    text-decoration:none;

    padding:10px 15px;

    font-size:14px;

    font-weight:500;

    border-radius:30px;

    transition:.35s;

}


nav a::before{

    content:'';

    position:absolute;

    inset:0;

    border-radius:30px;

    background:

        linear-gradient(
            135deg,
            rgba(212,175,55,.18),
            transparent
        );

    opacity:0;

    transition:.35s;

}


nav a:hover{

    color:var(--gold-light);

    transform:translateY(-2px);

}


nav a:hover::before{

    opacity:1;

}


/* =====================================================
   MOBILE MENU
===================================================== */

.menu-toggle{

    display:none;

    width:45px;

    height:45px;

    border:1px solid rgba(212,175,55,.4);

    background:rgba(255,255,255,.06);

    color:var(--gold-light);

    border-radius:12px;

    font-size:20px;

    cursor:pointer;

}


/* =====================================================
   HERO
===================================================== */

.hero{

    min-height:100vh;

    position:relative;

    display:flex;

    align-items:center;

    justify-content:center;

    padding:

        150px 7%
        100px;

    overflow:hidden;

}


.hero::before{

    content:'';

    position:absolute;

    width:600px;

    height:600px;

    border-radius:50%;

    background:

        radial-gradient(
            circle,
            rgba(35,101,180,.25),
            transparent 70%
        );

    top:-200px;

    left:-200px;

    animation:

        orbMove 10s infinite alternate;

}


.hero::after{

    content:'';

    position:absolute;

    width:500px;

    height:500px;

    border-radius:50%;

    background:

        radial-gradient(
            circle,
            rgba(212,175,55,.12),
            transparent 70%
        );

    bottom:-200px;

    right:-150px;

    animation:

        orbMove2 12s infinite alternate;

}


@keyframes orbMove{

    to{

        transform:
            translate(180px,120px)
            scale(1.2);

    }

}


@keyframes orbMove2{

    to{

        transform:
            translate(-100px,-120px)
            scale(1.2);

    }

}


/* =====================================================
   HERO GRID
===================================================== */

.hero-container{

    width:100%;

    max-width:1250px;

    display:grid;

    grid-template-columns:
        1.1fr
        .9fr;

    align-items:center;

    gap:60px;

    position:relative;

    z-index:2;

}


/* =====================================================
   HERO CONTENT
===================================================== */

.hero-content{

    animation:

        heroIn 1.2s ease;

}


.hero-badge{

    display:inline-flex;

    align-items:center;

    gap:10px;

    padding:8px 17px;

    border-radius:30px;

    border:

        1px solid
        rgba(212,175,55,.35);

    background:

        rgba(212,175,55,.08);

    color:var(--gold-light);

    font-size:13px;

    margin-bottom:25px;

    box-shadow:

        0 10px 30px rgba(0,0,0,.15);

}


.hero-badge i{

    animation:
        pulse 1.5s infinite;

}


@keyframes pulse{

    50%{

        transform:scale(1.3);

    }

}


.hero h1{

    font-family:'Cinzel',serif;

    font-size:

        clamp(
            40px,
            5vw,
            72px
        );

    line-height:1.12;

    margin-bottom:25px;

    color:white;

}


.hero h1 span{

    display:block;

    background:

        linear-gradient(
            90deg,
            #f8e7a1,
            #d4af37,
            #fff0a8,
            #d4af37
        );

    background-size:300%;

    -webkit-background-clip:text;

    -webkit-text-fill-color:transparent;

    animation:

        goldShine 5s linear infinite;

}


@keyframes goldShine{

    to{

        background-position:
            300% center;

    }

}


.hero p{

    max-width:700px;

    color:#bac7dc;

    font-size:17px;

    line-height:1.9;

    margin-bottom:30px;

}


/* =====================================================
   HERO BUTTONS
===================================================== */

.hero-buttons{

    display:flex;

    flex-wrap:wrap;

    gap:15px;

}


.btn{

    position:relative;

    overflow:hidden;

    display:inline-flex;

    align-items:center;

    gap:10px;

    padding:14px 25px;

    border-radius:12px;

    text-decoration:none;

    font-weight:600;

    transition:.4s;

    transform-style:preserve-3d;

}


.btn-primary{

    color:#111;

    background:

        linear-gradient(
            135deg,
            #f5d76e,
            #b8860b
        );

    box-shadow:

        0 15px 35px
        rgba(212,175,55,.25);

}


.btn-secondary{

    color:white;

    border:

        1px solid
        rgba(212,175,55,.45);

    background:

        rgba(255,255,255,.06);

    backdrop-filter:blur(10px);

}


.btn:hover{

    transform:
        translateY(-6px)
        translateZ(15px);

}


.btn-primary:hover{

    box-shadow:

        0 20px 50px
        rgba(212,175,55,.4);

}


.btn-secondary:hover{

    border-color:var(--gold);

    color:var(--gold-light);

}


/* =====================================================
   HERO 3D CARD
===================================================== */

.hero-visual{

    display:flex;

    justify-content:center;

    perspective:1200px;

}


.cube-card{

    width:390px;

    height:450px;

    position:relative;

    transform-style:preserve-3d;

    transition:
        transform .2s ease;

}


.card-face{

    position:absolute;

    inset:0;

    border-radius:35px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.14),
            rgba(255,255,255,.035)
        );

    border:

        1px solid
        rgba(255,255,255,.18);

    backdrop-filter:blur(20px);

    box-shadow:

        0 40px 90px
        rgba(0,0,0,.45);

    display:flex;

    flex-direction:column;

    align-items:center;

    justify-content:center;

    overflow:hidden;

}


.card-face::before{

    content:'';

    position:absolute;

    width:250px;

    height:250px;

    border-radius:50%;

    border:

        1px solid
        rgba(212,175,55,.25);

    animation:

        rotateRing 10s linear infinite;

}


.card-face::after{

    content:'';

    position:absolute;

    width:320px;

    height:320px;

    border-radius:50%;

    border:

        1px dashed
        rgba(212,175,55,.15);

    animation:

        rotateRingReverse 14s linear infinite;

}


@keyframes rotateRing{

    to{

        transform:rotate(360deg);

    }

}


@keyframes rotateRingReverse{

    to{

        transform:rotate(-360deg);

    }

}


.hero-logo{

    width:120px;

    height:120px;

    border-radius:50%;

    padding:6px;

    background:white;

    border:3px solid var(--gold);

    object-fit:cover;

    position:relative;

    z-index:3;

    box-shadow:

        0 0 45px
        rgba(212,175,55,.35);

    animation:

        floatingLogo 4s ease-in-out infinite;

}


@keyframes floatingLogo{

    0%,100%{

        transform:
            translateY(0)
            rotateY(0);

    }

    50%{

        transform:
            translateY(-15px)
            rotateY(180deg);

    }

}


.hero-visual h2{

    font-family:'Cinzel',serif;

    margin-top:30px;

    color:var(--gold-light);

    font-size:24px;

    text-align:center;

    position:relative;

    z-index:3;

}


.hero-visual p{

    color:#adb9cb;

    font-size:13px;

    text-align:center;

    max-width:280px;

    margin-top:8px;

    position:relative;

    z-index:3;

}


/* =====================================================
   GOLD ORNAMENT
===================================================== */

.gold-line{

    width:100px;

    height:3px;

    margin:20px auto;

    background:

        linear-gradient(
            90deg,
            transparent,
            var(--gold),
            transparent
        );

}


/* =====================================================
   SECTION
===================================================== */

.section{

    padding:110px 7%;

    position:relative;

}


.section-header{

    text-align:center;

    max-width:750px;

    margin:
        0 auto 60px;

}


.section-header .small-title{

    color:var(--gold);

    text-transform:uppercase;

    letter-spacing:4px;

    font-size:12px;

    font-weight:600;

}


.section h2{

    font-family:'Cinzel',serif;

    font-size:

        clamp(
            30px,
            4vw,
            48px
        );

    margin:12px 0;

    color:white;

}


.section-header p{

    color:#9daac0;

    line-height:1.8;

}


/* =====================================================
   3D FEATURE CARDS
===================================================== */

.cards{

    max-width:1250px;

    margin:auto;

    display:grid;

    grid-template-columns:
        repeat(3,1fr);

    gap:25px;

    perspective:1200px;

}


.card{

    position:relative;

    padding:35px 30px;

    min-height:260px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.10),
            rgba(255,255,255,.035)
        );

    border:

        1px solid
        rgba(255,255,255,.11);

    border-radius:25px;

    backdrop-filter:blur(18px);

    box-shadow:

        0 25px 55px
        rgba(0,0,0,.22);

    transition:

        transform .35s ease,
        border .35s ease,
        box-shadow .35s ease;

    transform-style:preserve-3d;

    overflow:hidden;

}


.card::before{

    content:'';

    position:absolute;

    width:160px;

    height:160px;

    border-radius:50%;

    background:

        radial-gradient(
            circle,
            rgba(212,175,55,.16),
            transparent 70%
        );

    top:-80px;

    right:-70px;

}


.card::after{

    content:'';

    position:absolute;

    left:0;

    top:0;

    width:100%;

    height:3px;

    background:

        linear-gradient(
            90deg,
            transparent,
            var(--gold),
            transparent
        );

    transform:scaleX(0);

    transition:.4s;

}


.card:hover{

    transform:
        translateY(-15px)
        rotateX(4deg)
        rotateY(-4deg);

    border-color:

        rgba(212,175,55,.35);

    box-shadow:

        0 35px 70px
        rgba(0,0,0,.38);

}


.card:hover::after{

    transform:scaleX(1);

}


.card-icon{

    width:65px;

    height:65px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:18px;

    color:#111;

    font-size:25px;

    background:

        linear-gradient(
            135deg,
            #f7df86,
            #b8860b
        );

    box-shadow:

        0 15px 30px
        rgba(212,175,55,.18);

    margin-bottom:25px;

    transform:translateZ(30px);

}


.card h3{

    font-family:'Cinzel',serif;

    color:#f7df86;

    font-size:20px;

    margin-bottom:12px;

    transform:translateZ(20px);

}


.card p{

    color:#aab7ca;

    font-size:14px;

    line-height:1.8;

    transform:translateZ(15px);

}


/* =====================================================
   STATS
===================================================== */

.stats{

    position:relative;

    padding:90px 7%;

    background:

        linear-gradient(
            135deg,
            #081a39,
            #0c3268
        );

    border-top:

        1px solid
        rgba(212,175,55,.12);

    border-bottom:

        1px solid
        rgba(212,175,55,.12);

}


.stats-grid{

    max-width:1200px;

    margin:auto;

    display:grid;

    grid-template-columns:
        repeat(4,1fr);

    gap:25px;

}


.stat{

    text-align:center;

    padding:35px 20px;

    border-radius:20px;

    background:

        rgba(255,255,255,.06);

    border:

        1px solid
        rgba(255,255,255,.09);

    transition:.4s;

}


.stat:hover{

    transform:
        translateY(-10px)
        scale(1.03);

    border-color:

        rgba(212,175,55,.35);

}


.stat i{

    color:var(--gold);

    font-size:25px;

    margin-bottom:15px;

}


.stat h1{

    font-family:'Cinzel',serif;

    font-size:45px;

    color:var(--gold-light);

}


.stat p{

    color:#aebbd0;

}


/* =====================================================
   DEPARTMENTS
===================================================== */

.department-grid{

    max-width:1100px;

    margin:auto;

    display:grid;

    grid-template-columns:
        repeat(4,1fr);

    gap:20px;

}


.department{

    padding:30px 20px;

    text-align:center;

    min-height:150px;

    display:flex;

    align-items:center;

    justify-content:center;

    flex-direction:column;

    border-radius:20px;

    background:

        linear-gradient(
            145deg,
            rgba(255,255,255,.08),
            rgba(255,255,255,.025)
        );

    border:

        1px solid
        rgba(255,255,255,.1);

    transition:.4s;

}


.department i{

    font-size:28px;

    color:var(--gold);

    margin-bottom:15px;

}


.department h3{

    font-family:'Cinzel',serif;

    color:#e9edf5;

    font-size:16px;

}


.department:hover{

    transform:

        translateY(-8px)
        rotateX(5deg);

    border-color:

        rgba(212,175,55,.4);

    box-shadow:

        var(--gold-shadow);

}


/* =====================================================
   CTA
===================================================== */

.cta{

    max-width:1100px;

    margin:auto;

    padding:70px 40px;

    text-align:center;

    border-radius:35px;

    position:relative;

    overflow:hidden;

    background:

        linear-gradient(
            135deg,
            rgba(212,175,55,.15),
            rgba(13,58,112,.5)
        );

    border:

        1px solid
        rgba(212,175,55,.25);

    box-shadow:

        0 30px 80px
        rgba(0,0,0,.25);

}


.cta::before{

    content:'';

    position:absolute;

    width:350px;

    height:350px;

    border-radius:50%;

    border:

        1px solid
        rgba(212,175,55,.15);

    top:-180px;

    left:-100px;

}


.cta h2{

    font-family:'Cinzel',serif;

    color:var(--gold-light);

    font-size:35px;

    margin-bottom:15px;

}


.cta p{

    color:#b7c2d4;

    max-width:650px;

    margin:0 auto 25px;

}


/* =====================================================
   FOOTER
===================================================== */

footer{

    padding:55px 20px 25px;

    text-align:center;

    background:#020914;

    border-top:

        1px solid
        rgba(212,175,55,.15);

}


.footer-logo{

    width:75px;

    height:75px;

    object-fit:cover;

    border-radius:50%;

    background:white;

    padding:4px;

    border:2px solid var(--gold);

    margin-bottom:15px;

}


footer h3{

    font-family:'Cinzel',serif;

    color:var(--gold-light);

    margin-bottom:8px;

}


footer p{

    color:#8795aa;

    font-size:13px;

}


.footer-icons{

    display:flex;

    justify-content:center;

    gap:14px;

    margin:25px 0;

}


.footer-icons a{

    width:48px;

    height:48px;

    display:flex;

    align-items:center;

    justify-content:center;

    color:#c4cfdf;

    border:

        1px solid
        rgba(255,255,255,.1);

    border-radius:50%;

    text-decoration:none;

    transition:.4s;

}


.footer-icons a:hover{

    color:#111;

    background:var(--gold);

    border-color:var(--gold);

    transform:
        translateY(-7px)
        rotate(360deg);

}


/* =====================================================
   BACK TO TOP
===================================================== */

#topBtn{

    position:fixed;

    right:25px;

    bottom:25px;

    width:50px;

    height:50px;

    border:none;

    border-radius:50%;

    background:

        linear-gradient(
            135deg,
            #f7df86,
            #b8860b
        );

    color:#111;

    font-size:18px;

    cursor:pointer;

    z-index:4000;

    opacity:0;

    visibility:hidden;

    transition:.4s;

    box-shadow:

        0 10px 30px
        rgba(212,175,55,.25);

}


#topBtn.show{

    opacity:1;

    visibility:visible;

}


#topBtn:hover{

    transform:
        translateY(-5px)
        rotate(360deg);

}


/* =====================================================
   SCROLL REVEAL
===================================================== */

.reveal{

    opacity:0;

    transform:
        translateY(60px)
        scale(.96);

    transition:

        opacity .8s ease,
        transform .8s ease;

}


.reveal.active{

    opacity:1;

    transform:
        translateY(0)
        scale(1);

}


/* =====================================================
   CURSOR GLOW
===================================================== */

.cursor-glow{

    position:fixed;

    width:180px;

    height:180px;

    border-radius:50%;

    background:

        radial-gradient(
            circle,
            rgba(212,175,55,.08),
            transparent 70%
        );

    pointer-events:none;

    transform:
        translate(-50%,-50%);

    z-index:999;

}


/* =====================================================
   TOAST
===================================================== */

#toast{

    position:fixed;

    right:25px;

    top:100px;

    padding:15px 22px;

    border-radius:14px;

    background:

        rgba(4,13,29,.95);

    border:

        1px solid
        rgba(212,175,55,.35);

    color:white;

    box-shadow:

        0 15px 40px rgba(0,0,0,.35);

    transform:
        translateX(150%);

    transition:.5s;

    z-index:9999;

}


#toast.show{

    transform:
        translateX(0);

}


#toast i{

    color:var(--gold);

    margin-right:8px;

}


/* =====================================================
   HERO FLOATING ELEMENTS
===================================================== */

.floating-shape{

    position:absolute;

    border:

        1px solid
        rgba(212,175,55,.18);

    border-radius:50%;

    pointer-events:none;

}


.shape-one{

    width:100px;

    height:100px;

    top:25%;

    left:5%;

    animation:
        floatShape 7s ease-in-out infinite;

}


.shape-two{

    width:50px;

    height:50px;

    bottom:20%;

    right:7%;

    animation:
        floatShape 5s ease-in-out infinite reverse;

}


@keyframes floatShape{

    0%,100%{

        transform:
            translateY(0)
            rotate(0deg);

    }

    50%{

        transform:
            translateY(-30px)
            rotate(180deg);

    }

}


/* =====================================================
   HERO ENTRANCE
===================================================== */

@keyframes heroIn{

    from{

        opacity:0;

        transform:
            translateY(60px);

    }

    to{

        opacity:1;

        transform:
            translateY(0);

    }

}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:1000px){

    .hero-container{

        grid-template-columns:1fr;

        text-align:center;

    }


    .hero-content p{

        margin-left:auto;

        margin-right:auto;

    }


    .hero-buttons{

        justify-content:center;

    }


    .hero-visual{

        margin-top:30px;

    }


    .cards{

        grid-template-columns:
            repeat(2,1fr);

    }


    .department-grid{

        grid-template-columns:
            repeat(2,1fr);

    }


    .stats-grid{

        grid-template-columns:
            repeat(2,1fr);

    }

}


@media(max-width:768px){

    header{

        padding:12px 20px;

    }


    .college-name h2{

        font-size:14px;

    }


    .college-name p{

        font-size:10px;

    }


    .logo img{

        width:52px;

        height:52px;

    }


    nav{

        position:absolute;

        top:100%;

        left:0;

        width:100%;

        padding:15px;

        flex-direction:column;

        background:

            rgba(3,12,29,.98);

        transform:
            translateY(-20px);

        opacity:0;

        pointer-events:none;

        transition:.4s;

    }


    nav.active{

        transform:
            translateY(0);

        opacity:1;

        pointer-events:auto;

    }


    nav a{

        width:100%;

        text-align:center;

    }


    .menu-toggle{

        display:block;

    }


    .hero{

        padding:
            130px 20px
            70px;

    }


    .cube-card{

        width:310px;

        height:360px;

    }


    .hero-logo{

        width:90px;

        height:90px;

    }


    .cards{

        grid-template-columns:1fr;

    }


    .department-grid{

        grid-template-columns:1fr 1fr;

    }


    .section{

        padding:
            80px 20px;

    }

}


@media(max-width:500px){

    .hero h1{

        font-size:37px;

    }


    .hero p{

        font-size:15px;

    }


    .hero-buttons{

        flex-direction:column;

    }


    .btn{

        justify-content:center;

    }


    .cube-card{

        width:280px;

        height:330px;

    }


    .stats-grid{

        grid-template-columns:1fr;

    }


    .department-grid{

        grid-template-columns:1fr;

    }


    .cta{

        padding:
            50px 20px;

    }


    .cta h2{

        font-size:27px;

    }

}

</style>

</head>


<body>


<!-- =====================================================
     LOADER
===================================================== -->

<div id="loader">

    <div class="loader-ring"></div>

    <img
        src="nift tea.png"
        class="loader-logo"
        alt="NIFT-TEA Logo"
    >

    <h3 class="loader-title">
        NIFT-TEA COLLEGE
    </h3>

    <p class="loader-subtitle">
        Initializing Complaint Management System...
    </p>

</div>


<!-- =====================================================
     PARTICLES
===================================================== -->

<div id="particles"></div>


<!-- =====================================================
     CURSOR GLOW
===================================================== -->

<div class="cursor-glow"
     id="cursorGlow"></div>


<!-- =====================================================
     TOAST
===================================================== -->

<div id="toast">

    <i class="fa-solid fa-crown"></i>

    <span id="toastText">
        Welcome
    </span>

</div>


<!-- =====================================================
     HEADER
===================================================== -->

<header id="header">

    <div class="logo">

        <img
            src="nift tea.png"
            alt="NIFT-TEA College Logo"
        >

        <div class="college-name">

            <h2>
                NIFT-TEA College
            </h2>

            <p>
                Knitwear & Fashion • Autonomous • Tiruppur
            </p>

        </div>

    </div>


    <button
        class="menu-toggle"
        id="menuToggle"
        aria-label="Open Menu"
    >

        <i class="fa-solid fa-bars"></i>

    </button>


    <nav id="mainNav">

        <a href="#home">
            <i class="fa-solid fa-house"></i>
            Home
        </a>

        <a href="#features">
            <i class="fa-solid fa-layer-group"></i>
            Features
        </a>

        <a href="#departments">
            <i class="fa-solid fa-building-columns"></i>
            Departments
        </a>

        <a href="#about">
            <i class="fa-solid fa-circle-info"></i>
            About
        </a>

        <a href="login.php">
            <i class="fa-solid fa-user"></i>
            Student
        </a>

    </nav>

</header>


<!-- =====================================================
     HERO
===================================================== -->

<section
    class="hero"
    id="home"
>

    <div class="floating-shape shape-one"></div>

    <div class="floating-shape shape-two"></div>


    <div class="hero-container">


        <!-- HERO TEXT -->

        <div class="hero-content">

            <div class="hero-badge">

                <i class="fa-solid fa-crown"></i>

                ROYAL DIGITAL CAMPUS PLATFORM

            </div>


            <h1>

                Online

                <span>
                    Complaint Management
                </span>

                System

            </h1>


            <p>

                A modern and secure digital platform
                designed for students, faculty and
                administration to submit, manage and
                monitor complaints efficiently.

            </p>


            <div class="hero-buttons">

                <a
                    href="login.php"
                    class="btn btn-primary"
                    id="studentLogin"
                >

                    <i class="fa-solid fa-user-graduate"></i>

                    Student Login

                </a>


                <a
                    href="admin_login.php"
                    class="btn btn-secondary"
                    id="adminLogin"
                >

                    <i class="fa-solid fa-shield-halved"></i>

                    Admin Login

                </a>

            </div>

        </div>


        <!-- 3D VISUAL -->

        <div class="hero-visual">

            <div
                class="cube-card"
                id="heroCard"
            >

                <div class="card-face">

                    <img
                        src="nift tea.png"
                        class="hero-logo"
                        alt="College Logo"
                    >


                    <h2>
                        NIFT-TEA College
                    </h2>


                    <div class="gold-line"></div>


                    <p>

                        Knitwear & Fashion

                        <br>

                        Autonomous Institution

                        <br>

                        Tiruppur

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     FEATURES
===================================================== -->

<section
    class="section"
    id="features"
>

    <div class="section-header reveal">

        <span class="small-title">
            Premium Services
        </span>

        <h2>
            Powerful Digital Features
        </h2>

        <div class="gold-line"></div>

        <p>

            Everything required to create a transparent,
            organized and efficient digital complaint
            management workflow.

        </p>

    </div>


    <div class="cards">


        <div class="card reveal">

            <div class="card-icon">

                <i class="fa-solid fa-user-graduate"></i>

            </div>

            <h3>
                Student Management
            </h3>

            <p>

                Maintain student information and
                provide a simple digital environment
                for complaint submission.

            </p>

        </div>


        <div class="card reveal">

            <div class="card-icon">

                <i class="fa-solid fa-book-open"></i>

            </div>

            <h3>
                Academic Management
            </h3>

            <p>

                Organize academic information,
                courses and department-related
                activities efficiently.

            </p>

        </div>


        <div class="card reveal">

            <div class="card-icon">

                <i class="fa-solid fa-file-circle-check"></i>

            </div>

            <h3>
                Complaint Tracking
            </h3>

            <p>

                Students can submit complaints and
                track their progress through a
                centralized workflow.

            </p>

        </div>


        <div class="card reveal">

            <div class="card-icon">

                <i class="fa-solid fa-shield-halved"></i>

            </div>

            <h3>
                Secure System
            </h3>

            <p>

                Role-based access and protected
                information help keep institutional
                data secure.

            </p>

        </div>


        <div class="card reveal">

            <div class="card-icon">

                <i class="fa-solid fa-chart-line"></i>

            </div>

            <h3>
                Administration
            </h3>

            <p>

                Administrators can monitor complaints,
                manage users and review system activity.

            </p>

        </div>


        <div class="card reveal">

            <div class="card-icon">

                <i class="fa-solid fa-bolt"></i>

            </div>

            <h3>
                Fast Processing
            </h3>

            <p>

                A streamlined workflow reduces manual
                work and improves response time.

            </p>

        </div>


    </div>

</section>


<!-- =====================================================
     STATS
===================================================== -->

<section class="stats">

    <div class="stats-grid">


        <div class="stat reveal">

            <i class="fa-solid fa-users"></i>

            <h1
                class="counter"
                data-target="1000"
            >
                0
            </h1>

            <p>
                Students
            </p>

        </div>


        <div class="stat reveal">

            <i class="fa-solid fa-chalkboard-user"></i>

            <h1
                class="counter"
                data-target="50"
            >
                0
            </h1>

            <p>
                Faculty
            </p>

        </div>


        <div class="stat reveal">

            <i class="fa-solid fa-book"></i>

            <h1
                class="counter"
                data-target="12"
            >
                0
            </h1>

            <p>
                Courses
            </p>

        </div>


        <div class="stat reveal">

            <i class="fa-solid fa-building"></i>

            <h1
                class="counter"
                data-target="15"
            >
                0
            </h1>

            <p>
                Departments
            </p>

        </div>


    </div>

</section>


<!-- =====================================================
     DEPARTMENTS
===================================================== -->

<section
    class="section"
    id="departments"
>

    <div class="section-header reveal">

        <span class="small-title">
            Academic Excellence
        </span>

        <h2>
            Our Departments
        </h2>

        <div class="gold-line"></div>

        <p>

            Explore the academic departments
            supporting the NIFT-TEA educational
            ecosystem.

        </p>

    </div>


    <div class="department-grid">


        <div class="department reveal">

            <i class="fa-solid fa-computer"></i>

            <h3>
                Computer Science
            </h3>

        </div>


        <div class="department reveal">

            <i class="fa-solid fa-coins"></i>

            <h3>
                Commerce
            </h3>

        </div>


        <div class="department reveal">

            <i class="fa-solid fa-briefcase"></i>

            <h3>
                Business Management
            </h3>

        </div>


        <div class="department reveal">

            <i class="fa-solid fa-shirt"></i>

            <h3>
                Apparel Fashion Designing
            </h3>

        </div>


        <div class="department reveal">

            <i class="fa-solid fa-scissors"></i>

            <h3>
                Costume Design & Fashion
            </h3>

        </div>


        <div class="department reveal">

            <i class="fa-solid fa-calculator"></i>

            <h3>
                Mathematics
            </h3>

        </div>


        <div class="department reveal">

            <i class="fa-solid fa-industry"></i>

            <h3>
                Apparel Production & Technology
            </h3>

        </div>


        <div class="department reveal">

            <i class="fa-solid fa-graduation-cap"></i>

            <h3>
                Academic Services
            </h3>

        </div>


    </div>

</section>


<!-- =====================================================
     ABOUT / CTA
===================================================== -->

<section
    class="section"
    id="about"
>

    <div class="cta reveal">

        <span class="small-title">
            Digital Transformation
        </span>

        <h2>
            A Smarter Campus Experience
        </h2>

        <div class="gold-line"></div>

        <p>

            The Online Complaint Management System
            provides a centralized digital platform for
            students and administrators to communicate,
            track issues and improve institutional services.

        </p>


        <div class="hero-buttons"
             style="justify-content:center;">

            <a
                href="login.php"
                class="btn btn-primary"
            >

                <i class="fa-solid fa-arrow-right-to-bracket"></i>

                Enter Student Portal

            </a>


            <a
                href="admin_login.php"
                class="btn btn-secondary"
            >

                <i class="fa-solid fa-user-shield"></i>

                Administration Portal

            </a>

        </div>

    </div>

</section>


<!-- =====================================================
     FOOTER
===================================================== -->

<footer>

    <img
        src="nift tea.png"
        class="footer-logo"
        alt="NIFT-TEA Logo"
    >


    <h3>
        NIFT-TEA College of Knitwear & Fashion
    </h3>


    <p>
        (Autonomous), Tiruppur
    </p>


    <p>
        NAAC A+ Grade
    </p>


    <div class="footer-icons">

        <a
            href="https://www.instagram.com/"
            target="_blank"
            aria-label="Instagram"
        >

            <i class="fab fa-instagram"></i>

        </a>


        <a
            href="https://wa.me/919876543210"
            target="_blank"
            aria-label="WhatsApp"
        >

            <i class="fab fa-whatsapp"></i>

        </a>


        <a
            href="https://www.youtube.com/"
            target="_blank"
            aria-label="YouTube"
        >

            <i class="fab fa-youtube"></i>

        </a>

    </div>


    <p>

        ©
        <span id="year"></span>

        Online Complaint Management System.

        All Rights Reserved.

    </p>

</footer>


<!-- =====================================================
     BACK TO TOP
===================================================== -->

<button
    id="topBtn"
    aria-label="Back to top"
>

    <i class="fa-solid fa-arrow-up"></i>

</button>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>

/* =====================================================
   PAGE LOADER
===================================================== */

window.addEventListener(
    "load",
    function(){

        setTimeout(
            function(){

                document
                    .getElementById("loader")
                    .classList
                    .add("hide");

            },
            1000
        );

    }
);


/* =====================================================
   CURRENT YEAR
===================================================== */

document
    .getElementById("year")
    .textContent =
    new Date().getFullYear();


/* =====================================================
   PARTICLE SYSTEM
===================================================== */

const particles =
    document.getElementById("particles");


for(let i = 0; i < 70; i++){

    const particle =
        document.createElement("div");

    particle.className =
        "particle";

    particle.style.left =
        Math.random() * 100 + "%";

    particle.style.animationDuration =
        (8 + Math.random() * 15) + "s";

    particle.style.animationDelay =
        Math.random() * 10 + "s";

    particle.style.opacity =
        .2 + Math.random() * .7;

    const size =
        2 + Math.random() * 4;

    particle.style.width =
        size + "px";

    particle.style.height =
        size + "px";

    particles.appendChild(
        particle
    );

}


/* =====================================================
   MOBILE NAVIGATION
===================================================== */

const menuToggle =
    document.getElementById(
        "menuToggle"
    );


const mainNav =
    document.getElementById(
        "mainNav"
    );


menuToggle.addEventListener(
    "click",
    function(){

        mainNav.classList.toggle(
            "active"
        );


        const icon =
            menuToggle.querySelector(
                "i"
            );


        if(mainNav.classList.contains("active")){

            icon.className =
                "fa-solid fa-xmark";

        }
        else{

            icon.className =
                "fa-solid fa-bars";

        }

    }
);


/* =====================================================
   CLOSE MOBILE NAV
===================================================== */

document
    .querySelectorAll("#mainNav a")
    .forEach(
        function(link){

            link.addEventListener(
                "click",
                function(){

                    mainNav.classList.remove(
                        "active"
                    );

                    menuToggle
                        .querySelector("i")
                        .className =
                        "fa-solid fa-bars";

                }
            );

        }
    );


/* =====================================================
   HEADER SCROLL EFFECT
===================================================== */

const header =
    document.getElementById(
        "header"
    );


window.addEventListener(
    "scroll",
    function(){

        if(window.scrollY > 50){

            header.classList.add(
                "scrolled"
            );

        }
        else{

            header.classList.remove(
                "scrolled"
            );

        }

    }
);


/* =====================================================
   3D HERO CARD
===================================================== */

const heroCard =
    document.getElementById(
        "heroCard"
    );


document.addEventListener(
    "mousemove",
    function(event){

        if(window.innerWidth < 768)
            return;


        const x =
            (window.innerWidth / 2 -
             event.clientX) / 30;


        const y =
            (window.innerHeight / 2 -
             event.clientY) / 30;


        heroCard.style.transform =
            `rotateY(${x}deg)
             rotateX(${y * -1}deg)
             translateZ(10px)`;

    }
);


/* =====================================================
   RESET HERO CARD
===================================================== */

document.addEventListener(
    "mouseleave",
    function(){

        heroCard.style.transform =
            "rotateY(0deg) rotateX(0deg)";

    }
);


/* =====================================================
   3D CARD MOUSE EFFECT
===================================================== */

document
    .querySelectorAll(".card")
    .forEach(
        function(card){

            card.addEventListener(
                "mousemove",
                function(event){

                    if(window.innerWidth < 768)
                        return;


                    const rect =
                        card.getBoundingClientRect();


                    const x =
                        event.clientX -
                        rect.left;


                    const y =
                        event.clientY -
                        rect.top;


                    const centerX =
                        rect.width / 2;


                    const centerY =
                        rect.height / 2;


                    const rotateY =
                        ((x - centerX) /
                        centerX) * 6;


                    const rotateX =
                        ((centerY - y) /
                        centerY) * 6;


                    card.style.transform =
                        `translateY(-15px)
                         rotateX(${rotateX}deg)
                         rotateY(${rotateY}deg)`;

                }
            );


            card.addEventListener(
                "mouseleave",
                function(){

                    card.style.transform =
                        "";

                }
            );

        }
    );


/* =====================================================
   SCROLL REVEAL
===================================================== */

const revealElements =
    document.querySelectorAll(
        ".reveal"
    );


const revealObserver =
    new IntersectionObserver(
        function(entries){

            entries.forEach(
                function(entry){

                    if(entry.isIntersecting){

                        entry.target
                            .classList
                            .add("active");

                        revealObserver
                            .unobserve(
                                entry.target
                            );

                    }

                }
            );

        },
        {
            threshold:.15
        }
    );


revealElements.forEach(
    function(element){

        revealObserver.observe(
            element
        );

    }
);


/* =====================================================
   COUNTER ANIMATION
===================================================== */

let countersStarted = false;


function startCounters(){

    if(countersStarted)
        return;


    countersStarted = true;


    document
        .querySelectorAll(".counter")
        .forEach(
            function(counter){

                const target =
                    Number(
                        counter.dataset.target
                    );


                let current = 0;


                const increment =
                    Math.max(
                        1,
                        Math.ceil(
                            target / 100
                        )
                    );


                const timer =
                    setInterval(
                        function(){

                            current +=
                                increment;


                            if(current >= target){

                                current =
                                    target;

                                clearInterval(
                                    timer
                                );

                            }


                            counter.textContent =
                                current.toLocaleString()
                                + "+";

                        },
                        20
                    );

            }
        );

}


const stats =
    document.querySelector(
        ".stats"
    );


const statsObserver =
    new IntersectionObserver(
        function(entries){

            if(entries[0].isIntersecting){

                startCounters();

                statsObserver.disconnect();

            }

        },
        {
            threshold:.3
        }
    );


statsObserver.observe(stats);


/* =====================================================
   BACK TO TOP
===================================================== */

const topBtn =
    document.getElementById(
        "topBtn"
    );


window.addEventListener(
    "scroll",
    function(){

        if(window.scrollY > 500){

            topBtn.classList.add(
                "show"
            );

        }
        else{

            topBtn.classList.remove(
                "show"
            );

        }

    }
);


topBtn.addEventListener(
    "click",
    function(){

        window.scrollTo({

            top:0,

            behavior:"smooth"

        });

    }
);


/* =====================================================
   CURSOR GLOW
===================================================== */

const cursorGlow =
    document.getElementById(
        "cursorGlow"
    );


document.addEventListener(
    "mousemove",
    function(event){

        if(window.innerWidth > 768){

            cursorGlow.style.left =
                event.clientX + "px";

            cursorGlow.style.top =
                event.clientY + "px";

        }

    }
);


/* =====================================================
   TOAST
===================================================== */

function showToast(message){

    const toast =
        document.getElementById(
            "toast"
        );


    const text =
        document.getElementById(
            "toastText"
        );


    text.textContent =
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
        2500
    );

}


/* =====================================================
   LOGIN BUTTON EFFECT
===================================================== */

document
    .getElementById("studentLogin")
    .addEventListener(
        "click",
        function(){

            showToast(
                "Opening Student Portal..."
            );

        }
    );


document
    .getElementById("adminLogin")
    .addEventListener(
        "click",
        function(){

            showToast(
                "Opening Administration Portal..."
            );

        }
    );


/* =====================================================
   BUTTON RIPPLE EFFECT
===================================================== */

document
    .querySelectorAll(".btn")
    .forEach(
        function(button){

            button.addEventListener(
                "click",
                function(event){

                    const ripple =
                        document.createElement(
                            "span"
                        );


                    ripple.style.position =
                        "absolute";

                    ripple.style.width =
                        "10px";

                    ripple.style.height =
                        "10px";

                    ripple.style.borderRadius =
                        "50%";

                    ripple.style.background =
                        "rgba(255,255,255,.45)";

                    ripple.style.left =
                        event.offsetX + "px";

                    ripple.style.top =
                        event.offsetY + "px";

                    ripple.style.transform =
                        "translate(-50%,-50%)";

                    ripple.style.pointerEvents =
                        "none";

                    ripple.style.animation =
                        "ripple .6s ease-out";


                    button.appendChild(
                        ripple
                    );


                    setTimeout(
                        function(){

                            ripple.remove();

                        },
                        600
                    );

                }
            );

        }
    );


/* =====================================================
   RIPPLE CSS
===================================================== */

const rippleStyle =
document.createElement("style");


rippleStyle.innerHTML = `

@keyframes ripple{

    from{

        width:10px;

        height:10px;

        opacity:.8;

    }

    to{

        width:400px;

        height:400px;

        opacity:0;

    }

}

`;


document.head.appendChild(
    rippleStyle
);


/* =====================================================
   ACTIVE NAVIGATION
===================================================== */

const sections =
    document.querySelectorAll(
        "section[id]"
    );


const navigationLinks =
    document.querySelectorAll(
        "nav a"
    );


window.addEventListener(
    "scroll",
    function(){

        let current = "";


        sections.forEach(
            function(section){

                const sectionTop =
                    section.offsetTop - 180;


                if(
                    window.scrollY >=
                    sectionTop
                ){

                    current =
                        section.getAttribute(
                            "id"
                        );

                }

            }
        );


        navigationLinks.forEach(
            function(link){

                link.style.color = "";

                if(
                    link.getAttribute(
                        "href"
                    ) === "#" + current
                ){

                    link.style.color =
                        "#f7df86";

                }

            }
        );

    }
);


/* =====================================================
   PAGE VISIBILITY
===================================================== */

document.addEventListener(
    "visibilitychange",
    function(){

        if(document.hidden){

            document.title =
                "Come Back | NIFT-TEA Complaint System";

        }
        else{

            document.title =
                "Online Complaint Management System | NIFT-TEA College";

        }

    }
);


/* =====================================================
   WELCOME MESSAGE
===================================================== */

setTimeout(
    function(){

        showToast(
            "Welcome to the Royal Digital Complaint Portal"
        );

    },
    1800
);


/* =====================================================
   REDUCE MOTION SUPPORT
===================================================== */

if(
    window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches
){

    document
        .querySelectorAll("*")
        .forEach(
            function(element){

                element.style.animationDuration =
                    "0.01ms";

                element.style.transitionDuration =
                    "0.01ms";

            }
        );

}

</script>


</body>

</html>