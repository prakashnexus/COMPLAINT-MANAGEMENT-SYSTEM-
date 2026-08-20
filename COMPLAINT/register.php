<?php
include("db.php");

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {

    $register_no = trim($_POST['register_no'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    /* =========================================
       SERVER-SIDE VALIDATION
    ========================================= */

    if (
        empty($register_no) ||
        empty($name) ||
        empty($email) ||
        empty($mobile) ||
        empty($course) ||
        empty($password) ||
        empty($confirm_password)
    ) {

        $message = "Please fill in all required fields.";
        $messageType = "error";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Please enter a valid email address.";
        $messageType = "error";

    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {

        $message = "Mobile number must contain exactly 10 digits.";
        $messageType = "error";

    } elseif ($password !== $confirm_password) {

        $message = "Passwords do not match.";
        $messageType = "error";

    } elseif (strlen($password) < 8) {

        $message = "Password must contain at least 8 characters.";
        $messageType = "error";

    } else {

        /* =========================================
           CHECK EXISTING STUDENT
        ========================================= */

        $checkStmt = mysqli_prepare(
            $conn,
            "SELECT id FROM students
             WHERE register_no = ? OR email = ?
             LIMIT 1"
        );

        if ($checkStmt) {

            mysqli_stmt_bind_param(
                $checkStmt,
                "ss",
                $register_no,
                $email
            );

            mysqli_stmt_execute($checkStmt);

            mysqli_stmt_store_result($checkStmt);

            if (mysqli_stmt_num_rows($checkStmt) > 0) {

                $message = "Register Number or Email already exists.";
                $messageType = "error";

                mysqli_stmt_close($checkStmt);

            } else {

                mysqli_stmt_close($checkStmt);

                /* =========================================
                   HASH PASSWORD
                ========================================= */

                $hashedPassword =
                    password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );

                /* =========================================
                   INSERT STUDENT
                ========================================= */

                $insertStmt = mysqli_prepare(
                    $conn,
                    "INSERT INTO students
                    (
                        register_no,
                        student_name,
                        email,
                        mobile,
                        course,
                        password
                    )
                    VALUES (?, ?, ?, ?, ?, ?)"
                );

                if ($insertStmt) {

                    mysqli_stmt_bind_param(
                        $insertStmt,
                        "ssssss",
                        $register_no,
                        $name,
                        $email,
                        $mobile,
                        $course,
                        $hashedPassword
                    );

                    if (mysqli_stmt_execute($insertStmt)) {

                        mysqli_stmt_close($insertStmt);

                        ?>

                        <!DOCTYPE html>
                        <html lang="en">
                        <head>

                            <meta charset="UTF-8">

                            <meta
                                name="viewport"
                                content="width=device-width, initial-scale=1.0"
                            >

                            <title>Registration Successful</title>

                            <style>

                                *{
                                    margin:0;
                                    padding:0;
                                    box-sizing:border-box;
                                    font-family:Arial,sans-serif;
                                }

                                body{

                                    min-height:100vh;

                                    display:flex;

                                    justify-content:center;

                                    align-items:center;

                                    background:
                                    linear-gradient(
                                        135deg,
                                        #020617,
                                        #071b4d,
                                        #0b3b91,
                                        #020617
                                    );

                                    color:white;

                                }

                                .success{

                                    width:90%;

                                    max-width:500px;

                                    text-align:center;

                                    padding:55px 35px;

                                    border-radius:30px;

                                    background:
                                    rgba(255,255,255,.08);

                                    backdrop-filter:
                                    blur(25px);

                                    border:
                                    1px solid
                                    rgba(255,255,255,.2);

                                    box-shadow:
                                    0 35px 90px
                                    rgba(0,0,0,.45);

                                    animation:
                                    successIn .8s ease;

                                }

                                .success-icon{

                                    width:90px;

                                    height:90px;

                                    margin:
                                    0 auto 25px;

                                    display:flex;

                                    align-items:center;

                                    justify-content:center;

                                    border-radius:50%;

                                    background:
                                    linear-gradient(
                                        135deg,
                                        #ffd700,
                                        #ff9800
                                    );

                                    color:#071b4d;

                                    font-size:45px;

                                    box-shadow:
                                    0 0 40px
                                    rgba(255,215,0,.5);

                                }

                                .success h1{

                                    margin-bottom:12px;

                                    color:#ffd700;

                                }

                                .success p{

                                    color:#dbeafe;

                                    margin-bottom:25px;

                                }

                                .success a{

                                    display:inline-block;

                                    padding:
                                    13px 28px;

                                    border-radius:50px;

                                    text-decoration:none;

                                    background:
                                    linear-gradient(
                                        135deg,
                                        #ffd700,
                                        #ff9800
                                    );

                                    color:#071b4d;

                                    font-weight:bold;

                                }

                                @keyframes successIn{

                                    from{

                                        opacity:0;

                                        transform:
                                        translateY(50px)
                                        scale(.9);

                                    }

                                    to{

                                        opacity:1;

                                        transform:
                                        translateY(0)
                                        scale(1);

                                    }

                                }

                            </style>

                        </head>

                        <body>

                            <div class="success">

                                <div class="success-icon">
                                    ✓
                                </div>

                                <h1>
                                    Registration Successful
                                </h1>

                                <p>
                                    Your student account has been
                                    created successfully.
                                </p>

                                <a href="login.php">
                                    Continue to Login
                                </a>

                            </div>

                        </body>
                        </html>

                        <?php

                        exit();

                    } else {

                        $message =
                            "Registration failed. Please try again.";

                        $messageType = "error";

                        mysqli_stmt_close($insertStmt);
                    }

                } else {

                    $message =
                        "Unable to prepare registration request.";

                    $messageType = "error";
                }
            }

        } else {

            $message =
                "Unable to verify registration details.";

            $messageType = "error";
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
    content="Student Registration - Online Complaint Management System"
>

<title>
    Student Registration | OCMS
</title>

<!-- =========================================
     GOOGLE FONT
========================================= -->

<link
href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet"
>

<!-- =========================================
     ICONS
========================================= -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

<style>

/* =====================================================
   GLOBAL
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

    min-height:100vh;

    overflow-x:hidden;

    color:white;

    background:

    radial-gradient(
        circle at 15% 20%,
        rgba(30,100,255,.28),
        transparent 30%
    ),

    radial-gradient(
        circle at 85% 80%,
        rgba(255,215,0,.14),
        transparent 30%
    ),

    linear-gradient(
        135deg,
        #020617,
        #061747,
        #0b2c70,
        #020617
    );

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

.orb{

    position:absolute;

    border-radius:50%;

    filter:blur(1px);

    opacity:.45;

    animation:
    orbFloat 12s ease-in-out infinite;

}

.orb.one{

    width:280px;

    height:280px;

    left:-100px;

    top:10%;

    background:
    radial-gradient(
        circle,
        rgba(0,153,255,.4),
        transparent 70%
    );

}

.orb.two{

    width:350px;

    height:350px;

    right:-130px;

    bottom:5%;

    background:
    radial-gradient(
        circle,
        rgba(255,215,0,.25),
        transparent 70%
    );

    animation-delay:2s;

}

.orb.three{

    width:180px;

    height:180px;

    left:45%;

    top:-70px;

    background:
    radial-gradient(
        circle,
        rgba(255,255,255,.15),
        transparent 70%
    );

    animation-delay:4s;

}


/* =====================================================
   PARTICLES
===================================================== */

.particle{

    position:absolute;

    width:4px;

    height:4px;

    background:#ffd700;

    border-radius:50%;

    box-shadow:
    0 0 12px
    rgba(255,215,0,.8);

    animation:
    particleMove linear infinite;

}


/* =====================================================
   ROYAL TOP BAR
===================================================== */

.top-bar{

    position:fixed;

    top:0;

    left:0;

    right:0;

    height:70px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:
    0 35px;

    z-index:20;

    background:
    rgba(2,6,23,.55);

    backdrop-filter:
    blur(18px);

    border-bottom:
    1px solid
    rgba(255,215,0,.15);

}

.brand{

    display:flex;

    align-items:center;

    gap:12px;

}

.brand-icon{

    width:42px;

    height:42px;

    border-radius:12px;

    display:flex;

    justify-content:center;

    align-items:center;

    color:#081b4b;

    background:
    linear-gradient(
        135deg,
        #fff4a3,
        #ffd700,
        #ff9800
    );

    box-shadow:
    0 0 25px
    rgba(255,215,0,.25);

}

.brand span{

    font-size:13px;

    color:#cbd5e1;

}

.home-btn{

    text-decoration:none;

    color:#ffd700;

    padding:
    10px 18px;

    border:
    1px solid
    rgba(255,215,0,.35);

    border-radius:50px;

    transition:.3s;

    background:
    rgba(255,255,255,.04);

}

.home-btn:hover{

    color:#071b4d;

    background:#ffd700;

    transform:
    translateY(-2px);

    box-shadow:
    0 8px 25px
    rgba(255,215,0,.25);

}


/* =====================================================
   MAIN
===================================================== */

.page{

    position:relative;

    z-index:5;

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:
    110px 20px 50px;

}


/* =====================================================
   3D SCENE
===================================================== */

.scene{

    perspective:1400px;

    width:100%;

    max-width:520px;

}


/* =====================================================
   REGISTRATION CARD
===================================================== */

.container{

    position:relative;

    width:100%;

    padding:42px;

    border-radius:30px;

    background:

    linear-gradient(
        145deg,
        rgba(255,255,255,.15),
        rgba(255,255,255,.055)
    );

    backdrop-filter:
    blur(25px);

    border:
    1px solid
    rgba(255,255,255,.18);

    box-shadow:

    0 40px 100px
    rgba(0,0,0,.55),

    inset 0 1px 0
    rgba(255,255,255,.2);

    transform-style:preserve-3d;

    transition:
    transform .18s ease;

    animation:
    cardEntrance 1s ease both;

}


/* GOLD BORDER */

.container::before{

    content:"";

    position:absolute;

    inset:-1px;

    border-radius:31px;

    padding:1px;

    background:
    linear-gradient(
        135deg,
        transparent,
        rgba(255,215,0,.8),
        transparent,
        rgba(255,215,0,.45),
        transparent
    );

    -webkit-mask:
    linear-gradient(#fff 0 0)
    content-box,
    linear-gradient(#fff 0 0);

    -webkit-mask-composite:
    xor;

    mask-composite:exclude;

    pointer-events:none;

}


/* =====================================================
   ROYAL EMBLEM
===================================================== */

.emblem{

    width:82px;

    height:82px;

    margin:
    0 auto 20px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:50%;

    background:

    radial-gradient(
        circle,
        #fff3a0,
        #ffd700 55%,
        #b8860b
    );

    color:#071b4d;

    font-size:34px;

    box-shadow:

    0 0 0 5px
    rgba(255,215,0,.08),

    0 0 40px
    rgba(255,215,0,.25);

    transform:
    translateZ(40px);

    animation:
    emblemFloat 4s ease-in-out infinite;

}


/* =====================================================
   HEADINGS
===================================================== */

.title{

    text-align:center;

    font-family:'Cinzel',serif;

    font-size:29px;

    color:#ffe77a;

    margin-bottom:7px;

    transform:
    translateZ(30px);

}

.subtitle{

    text-align:center;

    color:#cbd5e1;

    font-size:13px;

    margin-bottom:30px;

    transform:
    translateZ(20px);

}


/* =====================================================
   MESSAGE
===================================================== */

.message{

    display:flex;

    align-items:center;

    gap:10px;

    padding:12px 15px;

    border-radius:12px;

    margin-bottom:18px;

    font-size:13px;

}

.message.error{

    color:#fecaca;

    background:
    rgba(220,38,38,.15);

    border:
    1px solid
    rgba(248,113,113,.3);

}


/* =====================================================
   FORM GROUP
===================================================== */

.field{

    position:relative;

    margin-bottom:17px;

    transform:
    translateZ(18px);

}

.field i.left-icon{

    position:absolute;

    left:16px;

    top:50%;

    transform:
    translateY(-50%);

    color:#ffd700;

    pointer-events:none;

    transition:.3s;

}

input,
select{

    width:100%;

    height:54px;

    border:none;

    outline:none;

    border-radius:14px;

    padding:
    0 45px 0 45px;

    color:white;

    font-size:14px;

    background:
    rgba(255,255,255,.08);

    border:
    1px solid
    rgba(255,255,255,.12);

    transition:.3s;

}

select{

    appearance:none;

    cursor:pointer;

}

select option{

    color:#111827;

    background:white;

}

input::placeholder{

    color:#aebbd0;

}

input:focus,
select:focus{

    border-color:#ffd700;

    background:
    rgba(255,255,255,.12);

    box-shadow:
    0 0 0 3px
    rgba(255,215,0,.08),

    0 10px 30px
    rgba(0,0,0,.12);

    transform:
    translateY(-2px);

}

.field:focus-within
.left-icon{

    transform:
    translateY(-50%)
    scale(1.15);

}


/* =====================================================
   PASSWORD EYE
===================================================== */

.password-toggle{

    position:absolute;

    right:15px;

    top:50%;

    transform:
    translateY(-50%);

    border:none;

    background:none;

    color:#aebbd0;

    cursor:pointer;

    font-size:16px;

    padding:5px;

}

.password-toggle:hover{

    color:#ffd700;

}


/* =====================================================
   STRENGTH
===================================================== */

.strength{

    height:5px;

    border-radius:10px;

    background:
    rgba(255,255,255,.1);

    overflow:hidden;

    margin-top:-9px;

    margin-bottom:14px;

}

.strength-bar{

    width:0;

    height:100%;

    border-radius:10px;

    transition:.4s;

}

.strength-text{

    font-size:11px;

    color:#9caec8;

    margin-top:-10px;

    margin-bottom:14px;

}


/* =====================================================
   REGISTER BUTTON
===================================================== */

.register-btn{

    width:100%;

    height:56px;

    border:none;

    border-radius:15px;

    cursor:pointer;

    font-size:16px;

    font-weight:700;

    color:#071b4d;

    background:

    linear-gradient(
        135deg,
        #fff1a8,
        #ffd700 45%,
        #ffad00
    );

    box-shadow:

    0 15px 35px
    rgba(255,180,0,.2),

    inset 0 1px 0
    rgba(255,255,255,.7);

    transition:.35s;

    position:relative;

    overflow:hidden;

}

.register-btn::before{

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
        rgba(255,255,255,.7),
        transparent
    );

    transform:
    skewX(-20deg);

    transition:.7s;

}

.register-btn:hover::before{

    left:130%;

}

.register-btn:hover{

    transform:
    translateY(-4px)
    translateZ(15px);

    box-shadow:
    0 20px 45px
    rgba(255,180,0,.35);

}

.register-btn:active{

    transform:
    translateY(1px);

}


/* =====================================================
   BOTTOM LINKS
===================================================== */

.login-link{

    text-align:center;

    margin-top:22px;

    color:#aebbd0;

    font-size:13px;

}

.login-link a{

    color:#ffd700;

    text-decoration:none;

    font-weight:600;

}

.login-link a:hover{

    text-decoration:underline;

}


/* =====================================================
   SECURITY
===================================================== */

.security{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:7px;

    margin-top:20px;

    color:#91a4c0;

    font-size:11px;

}

.security i{

    color:#ffd700;

}


/* =====================================================
   LOADING
===================================================== */

.loading-overlay{

    position:fixed;

    inset:0;

    z-index:100;

    display:none;

    justify-content:center;

    align-items:center;

    background:
    rgba(2,6,23,.82);

    backdrop-filter:
    blur(10px);

}

.loading-overlay.active{

    display:flex;

}

.loader{

    text-align:center;

}

.loader-ring{

    width:65px;

    height:65px;

    border-radius:50%;

    border:
    4px solid
    rgba(255,255,255,.15);

    border-top-color:#ffd700;

    animation:
    spin 1s linear infinite;

    margin:auto auto 15px;

}


/* =====================================================
   ANIMATIONS
===================================================== */

@keyframes cardEntrance{

    from{

        opacity:0;

        transform:
        rotateX(18deg)
        translateY(60px)
        scale(.92);

    }

    to{

        opacity:1;

        transform:
        rotateX(0)
        translateY(0)
        scale(1);

    }

}

@keyframes emblemFloat{

    0%,100%{

        transform:
        translateZ(40px)
        translateY(0)
        rotateY(0);

    }

    50%{

        transform:
        translateZ(40px)
        translateY(-8px)
        rotateY(10deg);

    }

}

@keyframes orbFloat{

    0%,100%{

        transform:
        translate3d(0,0,0)
        scale(1);

    }

    50%{

        transform:
        translate3d(50px,-40px,0)
        scale(1.12);

    }

}

@keyframes particleMove{

    0%{

        transform:
        translateY(100vh)
        scale(.4);

        opacity:0;

    }

    20%{

        opacity:.8;

    }

    80%{

        opacity:.8;

    }

    100%{

        transform:
        translateY(-20vh)
        translateX(80px)
        scale(1);

        opacity:0;

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

    .top-bar{

        height:62px;

        padding:
        0 15px;

    }

    .brand span{

        display:none;

    }

    .page{

        padding:
        90px 12px 30px;

    }

    .container{

        padding:
        30px 20px;

        border-radius:24px;

    }

    .title{

        font-size:23px;

    }

    .emblem{

        width:70px;

        height:70px;

        font-size:28px;

    }

}

</style>

</head>

<body>


<!-- =====================================================
     BACKGROUND
===================================================== -->

<div class="background">

    <div class="orb one"></div>

    <div class="orb two"></div>

    <div class="orb three"></div>

</div>


<!-- =====================================================
     TOP BAR
===================================================== -->

<header class="top-bar">

    <div class="brand">

        <div class="brand-icon">

            <i class="fa-solid fa-graduation-cap"></i>

        </div>

        <span>
            Online Complaint Management System
        </span>

    </div>

    <a
        href="login.php"
        class="home-btn"
    >

        <i class="fa-solid fa-arrow-left"></i>

        Login

    </a>

</header>


<!-- =====================================================
     PARTICLES
===================================================== -->

<script>

for(let i = 0; i < 35; i++){

    const particle =
        document.createElement("span");

    particle.className =
        "particle";

    particle.style.left =
        Math.random() * 100 + "%";

    particle.style.animationDuration =
        (6 + Math.random() * 10) + "s";

    particle.style.animationDelay =
        (Math.random() * 8) + "s";

    particle.style.opacity =
        Math.random();

    document
        .querySelector(".background")
        .appendChild(particle);

}

</script>


<!-- =====================================================
     MAIN
===================================================== -->

<main class="page">

    <div class="scene">

        <div
            class="container"
            id="registerCard"
        >

            <!-- ROYAL EMBLEM -->

            <div class="emblem">

                <i class="fa-solid fa-user-graduate"></i>

            </div>


            <h1 class="title">
                Student Registration
            </h1>

            <p class="subtitle">

                Create your secure academic account

            </p>


            <!-- MESSAGE -->

            <?php if(!empty($message)): ?>

                <div class="message error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        <?php echo htmlspecialchars($message); ?>
                    </span>

                </div>

            <?php endif; ?>


            <!-- FORM -->

            <form
                method="POST"
                id="registrationForm"
                autocomplete="on"
            >


                <!-- REGISTER NUMBER -->

                <div class="field">

                    <i class="fa-solid fa-id-card left-icon"></i>

                    <input
                        type="text"
                        name="register_no"
                        placeholder="Register Number"
                        maxlength="30"
                        required
                        autocomplete="username"
                        value="<?php
                            echo htmlspecialchars(
                                $_POST['register_no'] ?? ''
                            );
                        ?>"
                    >

                </div>


                <!-- NAME -->

                <div class="field">

                    <i class="fa-solid fa-user left-icon"></i>

                    <input
                        type="text"
                        name="name"
                        placeholder="Student Name"
                        maxlength="100"
                        required
                        autocomplete="name"
                        value="<?php
                            echo htmlspecialchars(
                                $_POST['name'] ?? ''
                            );
                        ?>"
                    >

                </div>


                <!-- EMAIL -->

                <div class="field">

                    <i class="fa-solid fa-envelope left-icon"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        maxlength="150"
                        required
                        autocomplete="email"
                        value="<?php
                            echo htmlspecialchars(
                                $_POST['email'] ?? ''
                            );
                        ?>"
                    >

                </div>


                <!-- MOBILE -->

                <div class="field">

                    <i class="fa-solid fa-phone left-icon"></i>

                    <input
                        type="tel"
                        name="mobile"
                        id="mobile"
                        placeholder="Mobile Number"
                        maxlength="10"
                        pattern="[0-9]{10}"
                        inputmode="numeric"
                        required
                        value="<?php
                            echo htmlspecialchars(
                                $_POST['mobile'] ?? ''
                            );
                        ?>"
                    >

                </div>


                <!-- COURSE -->

                <div class="field">

                    <i class="fa-solid fa-book-open left-icon"></i>

                    <select
                        name="course"
                        required
                    >

                        <option value="">
                            Select Course
                        </option>

                        <?php

                        $courses = [

                            "BCA",

                            "B.Sc Computer Science",

                            "B.Com",

                            "BBA",

                            "BA English",

                            "B.E Computer Science",

                            "B.E Mechanical",

                            "B.E Civil",

                            "MCA",

                            "MBA"

                        ];

                        foreach($courses as $item):

                            $selected =
                                (
                                    ($_POST['course'] ?? '')
                                    === $item
                                )
                                ? "selected"
                                : "";

                        ?>

                            <option
                                value="<?php
                                    echo htmlspecialchars($item);
                                ?>"
                                <?php echo $selected; ?>
                            >

                                <?php
                                    echo htmlspecialchars($item);
                                ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- PASSWORD -->

                <div class="field">

                    <i class="fa-solid fa-lock left-icon"></i>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Create Password"
                        minlength="8"
                        required
                        autocomplete="new-password"
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        data-target="password"
                        aria-label="Show password"
                    >

                        <i class="fa-solid fa-eye"></i>

                    </button>

                </div>


                <!-- STRENGTH -->

                <div class="strength">

                    <div
                        class="strength-bar"
                        id="strengthBar"
                    ></div>

                </div>

                <div
                    class="strength-text"
                    id="strengthText"
                >
                    Password strength
                </div>


                <!-- CONFIRM PASSWORD -->

                <div class="field">

                    <i class="fa-solid fa-shield-halved left-icon"></i>

                    <input
                        type="password"
                        name="confirm_password"
                        id="confirmPassword"
                        placeholder="Confirm Password"
                        minlength="8"
                        required
                        autocomplete="new-password"
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        data-target="confirmPassword"
                        aria-label="Show password"
                    >

                        <i class="fa-solid fa-eye"></i>

                    </button>

                </div>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    name="register"
                    class="register-btn"
                    id="registerButton"
                >

                    <i class="fa-solid fa-crown"></i>

                    Create Student Account

                </button>


            </form>


            <!-- LOGIN -->

            <div class="login-link">

                Already have an account?

                <a href="login.php">
                    Login Here
                </a>

            </div>


            <!-- SECURITY -->

            <div class="security">

                <i class="fa-solid fa-shield-halved"></i>

                Your password is securely encrypted

            </div>

        </div>

    </div>

</main>


<!-- =====================================================
     LOADING
===================================================== -->

<div
    class="loading-overlay"
    id="loadingOverlay"
>

    <div class="loader">

        <div class="loader-ring"></div>

        <p>
            Creating your account...
        </p>

    </div>

</div>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>

/* =====================================================
   3D MOUSE TILT
===================================================== */

const card =
    document.getElementById("registerCard");

const scene =
    document.querySelector(".scene");

scene.addEventListener(
    "mousemove",
    function(event){

        if(window.innerWidth < 700){
            return;
        }

        const rect =
            scene.getBoundingClientRect();

        const x =
            event.clientX - rect.left;

        const y =
            event.clientY - rect.top;

        const centerX =
            rect.width / 2;

        const centerY =
            rect.height / 2;

        const rotateY =
            ((x - centerX) / centerX) * 5;

        const rotateX =
            ((centerY - y) / centerY) * 5;

        card.style.transform =
            `
            rotateX(${rotateX}deg)
            rotateY(${rotateY}deg)
            translateZ(8px)
            `;

    }
);


scene.addEventListener(
    "mouseleave",
    function(){

        card.style.transform =
            "rotateX(0deg) rotateY(0deg) translateZ(0)";

    }
);


/* =====================================================
   MOBILE RESET
===================================================== */

window.addEventListener(
    "resize",
    function(){

        if(window.innerWidth < 700){

            card.style.transform =
                "none";

        }

    }
);


/* =====================================================
   PASSWORD SHOW / HIDE
===================================================== */

document
.querySelectorAll(".password-toggle")
.forEach(function(button){

    button.addEventListener(
        "click",
        function(){

            const target =
                document.getElementById(
                    this.dataset.target
                );

            const icon =
                this.querySelector("i");

            if(target.type === "password"){

                target.type = "text";

                icon.classList.remove(
                    "fa-eye"
                );

                icon.classList.add(
                    "fa-eye-slash"
                );

            }
            else{

                target.type = "password";

                icon.classList.remove(
                    "fa-eye-slash"
                );

                icon.classList.add(
                    "fa-eye"
                );

            }

        }
    );

});


/* =====================================================
   PASSWORD STRENGTH
===================================================== */

const password =
    document.getElementById("password");

const strengthBar =
    document.getElementById("strengthBar");

const strengthText =
    document.getElementById("strengthText");


password.addEventListener(
    "input",
    function(){

        const value =
            this.value;

        let score = 0;

        if(value.length >= 8){
            score++;
        }

        if(/[A-Z]/.test(value)){
            score++;
        }

        if(/[a-z]/.test(value)){
            score++;
        }

        if(/[0-9]/.test(value)){
            score++;
        }

        if(/[^A-Za-z0-9]/.test(value)){
            score++;
        }

        const widths = [
            "0%",
            "20%",
            "40%",
            "60%",
            "80%",
            "100%"
        ];

        strengthBar.style.width =
            widths[score];

        if(value.length === 0){

            strengthText.textContent =
                "Password strength";

        }
        else if(score <= 2){

            strengthText.textContent =
                "Weak password";

        }
        else if(score === 3){

            strengthText.textContent =
                "Medium password";

        }
        else if(score === 4){

            strengthText.textContent =
                "Strong password";

        }
        else{

            strengthText.textContent =
                "Very strong password";

        }

    }
);


/* =====================================================
   MOBILE NUMBER
===================================================== */

const mobile =
    document.getElementById("mobile");

mobile.addEventListener(
    "input",
    function(){

        this.value =
            this.value
            .replace(/\D/g,"")
            .slice(0,10);

    }
);


/* =====================================================
   NAME VALIDATION
===================================================== */

const nameInput =
    document.querySelector(
        'input[name="name"]'
    );

nameInput.addEventListener(
    "input",
    function(){

        this.value =
            this.value.replace(
                /[^a-zA-Z .'-]/g,
                ""
            );

    }
);


/* =====================================================
   FORM VALIDATION
===================================================== */

const form =
    document.getElementById(
        "registrationForm"
    );

const confirmPassword =
    document.getElementById(
        "confirmPassword"
    );

form.addEventListener(
    "submit",
    function(event){

        const pass =
            password.value;

        const confirm =
            confirmPassword.value;

        const mobileValue =
            mobile.value;

        if(mobileValue.length !== 10){

            event.preventDefault();

            alert(
                "Please enter a valid 10-digit mobile number."
            );

            mobile.focus();

            return;

        }

        if(pass.length < 8){

            event.preventDefault();

            alert(
                "Password must contain at least 8 characters."
            );

            password.focus();

            return;

        }

        if(pass !== confirm){

            event.preventDefault();

            alert(
                "Passwords do not match."
            );

            confirmPassword.focus();

            return;

        }

        /*
           Show loading animation.
        */

        document
        .getElementById("loadingOverlay")
        .classList.add("active");

    }
);


/* =====================================================
   INPUT ENTER EFFECT
===================================================== */

document
.querySelectorAll("input,select")
.forEach(function(input){

    input.addEventListener(
        "keydown",
        function(event){

            if(event.key === "Enter"){

                this.style.transform =
                    "translateY(-2px)";

            }

        }
    );

});


/* =====================================================
   PREVENT ACCIDENTAL DOUBLE SUBMIT
===================================================== */

form.addEventListener(
    "submit",
    function(){

        const button =
            document.getElementById(
                "registerButton"
            );

        setTimeout(
            function(){

                button.disabled = true;

                button.innerHTML =
                    `
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    Creating Account...
                    `;

            },
            10
        );

    }
);


/* =====================================================
   PAGE LOAD ANIMATION
===================================================== */

window.addEventListener(
    "load",
    function(){

        document.body.classList.add(
            "loaded"
        );

    }
);


/* =====================================================
   GOLDEN CURSOR GLOW
===================================================== */

const cursorGlow =
    document.createElement("div");

cursorGlow.style.position =
    "fixed";

cursorGlow.style.width =
    "180px";

cursorGlow.style.height =
    "180px";

cursorGlow.style.borderRadius =
    "50%";

cursorGlow.style.pointerEvents =
    "none";

cursorGlow.style.zIndex =
    "1";

cursorGlow.style.background =
    "radial-gradient(circle, rgba(255,215,0,.08), transparent 70%)";

cursorGlow.style.transform =
    "translate(-50%,-50%)";

document.body.appendChild(
    cursorGlow
);

document.addEventListener(
    "mousemove",
    function(event){

        cursorGlow.style.left =
            event.clientX + "px";

        cursorGlow.style.top =
            event.clientY + "px";

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
                "Come Back | Student Registration";

        }
        else{

            document.title =
                "Student Registration | OCMS";

        }

    }
);

</script>

</body>
</html>