<?php
include("db.php");

$message = "";

if(isset($_POST['submit']))
{
    $register_no = trim($_POST['register_no']);
    $student_name = trim($_POST['student_name']);
    $course = trim($_POST['course']);
    $department = trim($_POST['department']);
    $category = trim($_POST['category']);
    $subject = trim($_POST['subject']);
    $details = trim($_POST['details']);
    $date = $_POST['date'];

    /*
    ==========================================
       SECURE INSERT
    ==========================================
    */

    $stmt = mysqli_prepare($conn, "
        INSERT INTO complaints
        (
            register_no,
            student_name,
            course,
            department,
            complaint_category,
            complaint_subject,
            complaint_details,
            complaint_date
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if($stmt)
    {
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssss",
            $register_no,
            $student_name,
            $course,
            $department,
            $category,
            $subject,
            $details,
            $date
        );

        if(mysqli_stmt_execute($stmt))
        {
            header("Location: student_dashboard.php");
            exit();
        }
        else
        {
            $message = "
                <div class='error-message'>
                    <i class='fas fa-circle-exclamation'></i>
                    Unable to submit complaint. Please try again.
                </div>
            ";
        }

        mysqli_stmt_close($stmt);
    }
    else
    {
        $message = "
            <div class='error-message'>
                <i class='fas fa-circle-exclamation'></i>
                Database error occurred.
            </div>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register Complaint | Royal Complaint Portal</title>

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- Font Awesome -->
<link
rel="stylesheet"
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

    min-height:100vh;

    font-family:'Poppins',sans-serif;

    color:#fff;

    overflow-x:hidden;

    background:
        radial-gradient(
            circle at 15% 20%,
            rgba(255,215,100,.12),
            transparent 25%
        ),
        radial-gradient(
            circle at 85% 80%,
            rgba(99,102,241,.18),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #08060d,
            #151020,
            #090711,
            #1b1323,
            #07060b
        );

    background-size:200% 200%;

    animation:
        backgroundLuxury 18s ease infinite;

    perspective:1600px;
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
   AMBIENT LIGHTS
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
            rgba(255,196,80,.12),
            transparent 68%
        );

    filter:blur(25px);

    top:-220px;
    left:-180px;

    pointer-events:none;

    animation:
        ambientOne 12s ease-in-out infinite;

    z-index:-2;
}

body::after{

    content:"";

    position:fixed;

    width:500px;
    height:500px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(124,58,237,.13),
            transparent 68%
        );

    filter:blur(30px);

    right:-200px;
    bottom:-220px;

    pointer-events:none;

    animation:
        ambientTwo 15s ease-in-out infinite;

    z-index:-2;
}

@keyframes ambientOne{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(180px,130px);
    }
}

@keyframes ambientTwo{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-150px,-120px);
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

    background:#f8d477;

    box-shadow:
        0 0 7px #f8d477,
        0 0 16px rgba(248,212,119,.6);

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
        opacity:.8;
    }

    80%{
        opacity:.8;
    }

    100%{

        transform:
            translateY(-20vh)
            scale(1.3);

        opacity:0;
    }
}


/* =========================================================
   TOP BAR
========================================================= */

.topbar{

    width:100%;

    min-height:75px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:14px 35px;

    position:relative;

    background:
        linear-gradient(
            135deg,
            rgba(20,15,29,.92),
            rgba(10,8,16,.88)
        );

    border-bottom:
        1px solid rgba(248,212,119,.18);

    backdrop-filter:blur(20px);

    box-shadow:
        0 15px 50px rgba(0,0,0,.45);

    z-index:100;
}

.brand{

    display:flex;

    align-items:center;

    gap:13px;
}

.brand-icon{

    width:46px;
    height:46px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:14px;

    color:#f8d477;

    font-size:19px;

    background:
        linear-gradient(
            145deg,
            rgba(248,212,119,.15),
            rgba(255,255,255,.04)
        );

    border:
        1px solid rgba(248,212,119,.35);

    box-shadow:
        inset 0 0 20px rgba(248,212,119,.06),
        0 8px 30px rgba(0,0,0,.35);

    transform:
        translateZ(30px);

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
            translateY(-4px)
            rotateY(12deg);
    }
}

.brand-title{

    font-family:'Cinzel',serif;

    font-size:18px;

    font-weight:700;

    letter-spacing:1px;

    color:#fff;
}

.brand-subtitle{

    color:#a8a1b1;

    font-size:10px;

    margin-top:2px;

    letter-spacing:1px;
}

.back-dashboard{

    text-decoration:none;

    color:#f8d477;

    display:flex;

    align-items:center;

    gap:8px;

    padding:10px 16px;

    border-radius:12px;

    border:
        1px solid rgba(248,212,119,.25);

    background:
        rgba(248,212,119,.06);

    transition:.35s;

    font-size:12px;
}

.back-dashboard:hover{

    color:#fff;

    background:
        rgba(248,212,119,.15);

    transform:
        translateY(-3px)
        translateZ(10px);

    box-shadow:
        0 10px 30px rgba(248,212,119,.12);
}


/* =========================================================
   MAIN WRAPPER
========================================================= */

.page{

    width:100%;

    min-height:calc(100vh - 75px);

    display:flex;

    align-items:center;

    justify-content:center;

    padding:45px 20px 70px;
}


/* =========================================================
   3D FORM CARD
========================================================= */

.form-card{

    width:100%;

    max-width:850px;

    position:relative;

    padding:42px;

    border-radius:28px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.095),
            rgba(255,255,255,.025)
        );

    border:
        1px solid rgba(248,212,119,.18);

    backdrop-filter:
        blur(25px);

    box-shadow:
        0 40px 100px rgba(0,0,0,.55),
        inset 0 1px 0 rgba(255,255,255,.08);

    transform-style:preserve-3d;

    animation:
        cardEnter 1s cubic-bezier(.2,.8,.2,1);
}

@keyframes cardEnter{

    from{

        opacity:0;

        transform:
            translateY(60px)
            rotateX(12deg)
            scale(.94);
    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0)
            scale(1);
    }
}


/* Golden edge */

.form-card::before{

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
            #f8d477,
            #fff2b8,
            #f8d477,
            transparent
        );

    box-shadow:
        0 0 18px rgba(248,212,119,.6);
}


/* Glow */

.form-card::after{

    content:"";

    position:absolute;

    width:180px;
    height:180px;

    right:-70px;
    top:-70px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(248,212,119,.13),
            transparent 70%
        );

    pointer-events:none;
}


/* =========================================================
   HEADER
========================================================= */

.form-header{

    text-align:center;

    margin-bottom:30px;

    transform:
        translateZ(35px);
}

.crown{

    width:65px;
    height:65px;

    margin:0 auto 15px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:20px;

    font-size:25px;

    color:#f8d477;

    background:
        linear-gradient(
            145deg,
            rgba(248,212,119,.16),
            rgba(255,255,255,.04)
        );

    border:
        1px solid rgba(248,212,119,.3);

    box-shadow:
        0 15px 35px rgba(0,0,0,.3),
        inset 0 0 20px rgba(248,212,119,.06);

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
            translateY(-6px)
            rotateY(15deg);
    }
}

.form-header h1{

    font-family:'Cinzel',serif;

    font-size:31px;

    letter-spacing:1px;

    color:#fff;

    margin-bottom:7px;

    text-shadow:
        0 5px 25px rgba(0,0,0,.4);
}

.form-header h1 span{

    color:#f8d477;
}

.form-header p{

    color:#aaa3b0;

    font-size:13px;
}


/* =========================================================
   SECTION TITLE
========================================================= */

.section-title{

    display:flex;

    align-items:center;

    gap:10px;

    color:#f8d477;

    font-family:'Cinzel',serif;

    font-size:14px;

    margin:25px 0 17px;

    letter-spacing:.8px;
}

.section-title::after{

    content:"";

    flex:1;

    height:1px;

    background:
        linear-gradient(
            90deg,
            rgba(248,212,119,.3),
            transparent
        );
}


/* =========================================================
   GRID
========================================================= */

.form-grid{

    display:grid;

    grid-template-columns:
        repeat(2,1fr);

    gap:18px;
}

.full{

    grid-column:
        1 / -1;
}


/* =========================================================
   FIELD
========================================================= */

.field{

    position:relative;

    transform-style:preserve-3d;
}

.field label{

    display:block;

    margin-bottom:8px;

    color:#d7d1dc;

    font-size:12px;

    font-weight:600;

    letter-spacing:.3px;
}

.field label i{

    color:#f8d477;

    margin-right:6px;
}


/* =========================================================
   INPUT
========================================================= */

.field input,
.field select,
.field textarea{

    width:100%;

    border:none;

    outline:none;

    color:#fff;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.075),
            rgba(0,0,0,.15)
        );

    border:
        1px solid rgba(255,255,255,.11);

    border-radius:13px;

    padding:14px 15px;

    font-family:'Poppins',sans-serif;

    font-size:13px;

    transition:
        border .3s,
        box-shadow .3s,
        transform .3s,
        background .3s;
}

.field input:hover,
.field select:hover,
.field textarea:hover{

    border-color:
        rgba(248,212,119,.25);
}

.field input:focus,
.field select:focus,
.field textarea:focus{

    border-color:#f8d477;

    background:
        rgba(248,212,119,.045);

    box-shadow:
        0 0 0 3px rgba(248,212,119,.07),
        0 12px 30px rgba(0,0,0,.2);

    transform:
        translateZ(7px);
}

.field input::placeholder,
.field textarea::placeholder{

    color:#716a77;
}


/* SELECT */

.field select{

    appearance:none;

    cursor:pointer;

    background-image:
        linear-gradient(45deg,transparent 50%,#f8d477 50%),
        linear-gradient(135deg,#f8d477 50%,transparent 50%);

    background-position:
        calc(100% - 18px) 50%,
        calc(100% - 13px) 50%;

    background-size:
        5px 5px,
        5px 5px;

    background-repeat:no-repeat;
}

.field select option{

    color:#222;

    background:#fff;
}


/* TEXTAREA */

.field textarea{

    min-height:150px;

    resize:vertical;
}


/* =========================================================
   DATE
========================================================= */

input[type="date"]{

    color-scheme:dark;
}


/* =========================================================
   CHARACTER COUNTER
========================================================= */

.char-count{

    text-align:right;

    margin-top:-14px;

    margin-bottom:5px;

    color:#716a77;

    font-size:10px;
}


/* =========================================================
   SUBMIT BUTTON
========================================================= */

.submit-area{

    margin-top:28px;
}

.submit-btn{

    width:100%;

    position:relative;

    overflow:hidden;

    border:none;

    outline:none;

    cursor:pointer;

    padding:16px 22px;

    border-radius:14px;

    color:#1a1308;

    background:
        linear-gradient(
            135deg,
            #b8862f,
            #f8d477,
            #fff0ae,
            #d4a846,
            #f8d477
        );

    background-size:250% 100%;

    font-family:'Poppins',sans-serif;

    font-size:15px;

    font-weight:800;

    letter-spacing:.4px;

    box-shadow:
        0 15px 35px rgba(0,0,0,.4),
        0 0 25px rgba(248,212,119,.13);

    transition:
        .35s;

    transform-style:preserve-3d;
}

.submit-btn:hover{

    background-position:
        100% 0;

    transform:
        translateY(-4px)
        rotateX(5deg)
        translateZ(12px);

    box-shadow:
        0 22px 45px rgba(0,0,0,.5),
        0 0 35px rgba(248,212,119,.25);
}

.submit-btn:active{

    transform:
        translateY(0)
        scale(.98);
}

.submit-btn i{

    margin-right:8px;
}


/* Shine */

.submit-btn::before{

    content:"";

    position:absolute;

    top:-80%;

    left:-30%;

    width:30%;

    height:260%;

    transform:rotate(25deg);

    background:
        rgba(255,255,255,.45);

    filter:blur(8px);

    transition:1s;
}

.submit-btn:hover::before{

    left:120%;
}


/* =========================================================
   ERROR
========================================================= */

.error-message{

    padding:13px 16px;

    margin-bottom:20px;

    border-radius:12px;

    color:#fecaca;

    background:
        rgba(127,29,29,.2);

    border:
        1px solid rgba(248,113,113,.2);

    text-align:center;

    font-size:12px;
}

.error-message i{

    margin-right:6px;
}


/* =========================================================
   SECURITY NOTE
========================================================= */

.security-note{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:7px;

    margin-top:17px;

    color:#77717e;

    font-size:10px;
}

.security-note i{

    color:#f8d477;
}


/* =========================================================
   SUCCESS LOADER
========================================================= */

.loading-overlay{

    position:fixed;

    inset:0;

    display:none;

    align-items:center;

    justify-content:center;

    background:
        rgba(5,4,8,.88);

    backdrop-filter:blur(12px);

    z-index:9999;
}

.loading-box{

    text-align:center;

    transform:
        translateZ(50px);
}

.loader-ring{

    width:65px;
    height:65px;

    margin:0 auto 15px;

    border-radius:50%;

    border:
        3px solid rgba(248,212,119,.15);

    border-top-color:#f8d477;

    border-right-color:#fff0ae;

    animation:
        spin 1s linear infinite;
}

@keyframes spin{

    to{
        transform:rotate(360deg);
    }
}

.loading-box p{

    color:#f8d477;

    font-size:13px;

    font-weight:600;
}


/* =========================================================
   FOOTER
========================================================= */

.footer{

    text-align:center;

    padding:0 20px 30px;

    color:#625d67;

    font-size:10px;

    letter-spacing:.3px;
}


/* =========================================================
   SCROLLBAR
========================================================= */

::-webkit-scrollbar{

    width:7px;
}

::-webkit-scrollbar-track{

    background:#09070d;
}

::-webkit-scrollbar-thumb{

    background:
        linear-gradient(
            #b8862f,
            #f8d477
        );

    border-radius:20px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:700px){

    .topbar{

        padding:12px 16px;
    }

    .brand-title{

        font-size:13px;
    }

    .brand-subtitle{

        display:none;
    }

    .brand-icon{

        width:40px;
        height:40px;
    }

    .back-dashboard span{

        display:none;
    }

    .page{

        padding:
            25px 12px 50px;
    }

    .form-card{

        padding:25px 18px;

        border-radius:22px;
    }

    .form-header h1{

        font-size:23px;
    }

    .form-grid{

        grid-template-columns:1fr;

        gap:15px;
    }

    .full{

        grid-column:auto;
    }

    .section-title{

        margin-top:22px;
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
     TOP BAR
===================================================== -->

<header class="topbar">

    <div class="brand">

        <div class="brand-icon">

            <i class="fas fa-building-columns"></i>

        </div>

        <div>

            <div class="brand-title">
                COLLEGE COMPLAINT PORTAL
            </div>

            <div class="brand-subtitle">
                SECURE STUDENT SERVICES
            </div>

        </div>

    </div>


    <a
        href="student_dashboard.php"
        class="back-dashboard"
    >

        <i class="fas fa-arrow-left"></i>

        <span>Dashboard</span>

    </a>

</header>


<!-- =====================================================
     PAGE
===================================================== -->

<main class="page">


    <!-- =================================================
         FORM CARD
    ================================================== -->

    <section
        class="form-card"
        id="formCard"
    >


        <!-- FORM HEADER -->

        <div class="form-header">

            <div class="crown">

                <i class="fas fa-crown"></i>

            </div>

            <h1>
                Register <span>Complaint</span>
            </h1>

            <p>
                Submit your concern securely to the college administration
            </p>

        </div>


        <!-- PHP MESSAGE -->

        <?php echo $message; ?>


        <!-- =================================================
             FORM
        ================================================== -->

        <form
            method="POST"
            id="complaintForm"
        >


            <!-- STUDENT INFORMATION -->

            <div class="section-title">

                <i class="fas fa-user-graduate"></i>

                Student Information

            </div>


            <div class="form-grid">


                <!-- REGISTER NUMBER -->

                <div class="field">

                    <label>

                        <i class="fas fa-id-card"></i>

                        Register Number

                    </label>

                    <input
                        type="text"
                        name="register_no"
                        placeholder="Enter register number"
                        required
                        maxlength="30"
                        autocomplete="off"
                    >

                </div>


                <!-- STUDENT NAME -->

                <div class="field">

                    <label>

                        <i class="fas fa-user"></i>

                        Student Name

                    </label>

                    <input
                        type="text"
                        name="student_name"
                        placeholder="Enter student name"
                        required
                        maxlength="100"
                    >

                </div>


                <!-- COURSE -->

                <div class="field">

                    <label>

                        <i class="fas fa-book-open"></i>

                        Course

                    </label>

                    <input
                        type="text"
                        name="course"
                        placeholder="Example: B.Sc Computer Science"
                        required
                        maxlength="100"
                    >

                </div>


                <!-- DEPARTMENT -->

                <div class="field">

                    <label>

                        <i class="fas fa-building"></i>

                        Department

                    </label>

                    <input
                        type="text"
                        name="department"
                        placeholder="Enter department"
                        required
                        maxlength="100"
                    >

                </div>

            </div>


            <!-- COMPLAINT INFORMATION -->

            <div class="section-title">

                <i class="fas fa-file-circle-exclamation"></i>

                Complaint Information

            </div>


            <div class="form-grid">


                <!-- CATEGORY -->

                <div class="field">

                    <label>

                        <i class="fas fa-layer-group"></i>

                        Complaint Category

                    </label>

                    <select
                        name="category"
                        required
                    >

                        <option value="">
                            Select Complaint Category
                        </option>

                        <option>Academic</option>

                        <option>Examination</option>

                        <option>Library</option>

                        <option>Hostel</option>

                        <option>Transport</option>

                        <option>Fee</option>

                        <option>Scholarship</option>

                        <option>Laboratory</option>

                        <option>Classroom</option>

                        <option>Wi-Fi / Internet</option>

                        <option>Canteen</option>

                        <option>Anti Ragging</option>

                        <option>Others</option>

                    </select>

                </div>


                <!-- DATE -->

                <div class="field">

                    <label>

                        <i class="fas fa-calendar-days"></i>

                        Complaint Date

                    </label>

                    <input
                        type="date"
                        name="date"
                        id="complaintDate"
                        required
                    >

                </div>


                <!-- SUBJECT -->

                <div class="field full">

                    <label>

                        <i class="fas fa-heading"></i>

                        Complaint Subject

                    </label>

                    <input
                        type="text"
                        name="subject"
                        placeholder="Enter a short subject"
                        required
                        maxlength="150"
                    >

                </div>


                <!-- DETAILS -->

                <div class="field full">

                    <label>

                        <i class="fas fa-align-left"></i>

                        Complaint Details

                    </label>

                    <textarea
                        name="details"
                        id="details"
                        placeholder="Describe your complaint clearly..."
                        required
                        maxlength="1000"
                    ></textarea>

                    <div
                        class="char-count"
                        id="charCount"
                    >
                        0 / 1000
                    </div>

                </div>

            </div>


            <!-- SUBMIT -->

            <div class="submit-area">

                <button
                    type="submit"
                    name="submit"
                    class="submit-btn"
                    id="submitBtn"
                >

                    <i class="fas fa-paper-plane"></i>

                    Submit Complaint

                </button>

            </div>


            <div class="security-note">

                <i class="fas fa-shield-halved"></i>

                Your complaint is securely submitted to the administration.

            </div>


        </form>

    </section>

</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer">

    © 2026 College Complaint Management System

    <br>

    Secure Student Complaint Portal

</footer>


<!-- =====================================================
     LOADING OVERLAY
===================================================== -->

<div
    class="loading-overlay"
    id="loadingOverlay"
>

    <div class="loading-box">

        <div class="loader-ring"></div>

        <p>
            Submitting your complaint...
        </p>

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

for(let i = 0; i < 45; i++){

    const particle =
        document.createElement("span");

    particle.className =
        "particle";

    particle.style.left =
        Math.random() * 100 + "%";

    particle.style.animationDuration =
        (8 + Math.random() * 12) + "s";

    particle.style.animationDelay =
        Math.random() * 10 + "s";

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
   3D FORM CARD TILT
========================================================= */

const formCard =
    document.getElementById("formCard");

document.addEventListener(
    "mousemove",
    function(e){

        if(window.innerWidth < 850){
            return;
        }

        const rect =
            formCard.getBoundingClientRect();

        const x =
            e.clientX - rect.left;

        const y =
            e.clientY - rect.top;

        const centerX =
            rect.width / 2;

        const centerY =
            rect.height / 2;

        const rotateX =
            ((y - centerY) / centerY) * -1.5;

        const rotateY =
            ((x - centerX) / centerX) * 1.5;

        formCard.style.transform =
            `perspective(1600px)
             rotateX(${rotateX}deg)
             rotateY(${rotateY}deg)`;

    }
);


formCard.addEventListener(
    "mouseleave",
    function(){

        formCard.style.transform =
            "perspective(1600px) rotateX(0deg) rotateY(0deg)";

    }
);


/* =========================================================
   FIELD 3D EFFECT
========================================================= */

const fields =
    document.querySelectorAll(
        ".field input, .field select, .field textarea"
    );

fields.forEach(function(field){

    field.addEventListener(
        "focus",
        function(){

            this.parentElement.style.transform =
                "translateZ(8px)";

        }
    );

    field.addEventListener(
        "blur",
        function(){

            this.parentElement.style.transform =
                "translateZ(0)";

        }
    );

});


/* =========================================================
   CHARACTER COUNTER
========================================================= */

const details =
    document.getElementById("details");

const charCount =
    document.getElementById("charCount");

details.addEventListener(
    "input",
    function(){

        const length =
            this.value.length;

        charCount.textContent =
            length + " / 1000";

        if(length > 900){

            charCount.style.color =
                "#f8d477";

        }
        else{

            charCount.style.color =
                "#716a77";

        }

    }
);


/* =========================================================
   AUTO DATE
========================================================= */

const complaintDate =
    document.getElementById("complaintDate");

if(!complaintDate.value){

    const today =
        new Date();

    const year =
        today.getFullYear();

    const month =
        String(
            today.getMonth() + 1
        ).padStart(2,"0");

    const day =
        String(
            today.getDate()
        ).padStart(2,"0");

    complaintDate.value =
        `${year}-${month}-${day}`;

}


/* =========================================================
   INPUT TEXT EFFECT
========================================================= */

document
.querySelectorAll(
    'input[type="text"], textarea'
)
.forEach(function(input){

    input.addEventListener(
        "input",
        function(){

            this.style.borderColor =
                "rgba(248,212,119,.22)";

        }
    );

});


/* =========================================================
   FORM SUBMIT LOADING
========================================================= */

const form =
    document.getElementById(
        "complaintForm"
    );

const loadingOverlay =
    document.getElementById(
        "loadingOverlay"
    );

form.addEventListener(
    "submit",
    function(){

        if(!form.checkValidity()){
            return;
        }

        const button =
            document.getElementById(
                "submitBtn"
            );

        button.innerHTML =
            '<i class="fas fa-spinner fa-spin"></i> Processing...';

        button.style.pointerEvents =
            "none";

        loadingOverlay.style.display =
            "flex";

    }
);


/* =========================================================
   BUTTON MAGNETIC EFFECT
========================================================= */

const submitBtn =
    document.getElementById(
        "submitBtn"
    );

submitBtn.addEventListener(
    "mousemove",
    function(e){

        if(window.innerWidth < 700){
            return;
        }

        const rect =
            this.getBoundingClientRect();

        const x =
            e.clientX - rect.left;

        const y =
            e.clientY - rect.top;

        const moveX =
            (x - rect.width / 2) * .06;

        const moveY =
            (y - rect.height / 2) * .12;

        this.style.transform =
            `translate(${moveX}px,${moveY}px)
             translateY(-3px)
             rotateX(3deg)`;

    }
);

submitBtn.addEventListener(
    "mouseleave",
    function(){

        this.style.transform =
            "";

    }
);


/* =========================================================
   ESCAPE KEY
========================================================= */

document.addEventListener(
    "keydown",
    function(e){

        if(e.key === "Escape"){

            document.activeElement.blur();

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
                "Complaint Portal";

        }
        else{

            document.title =
                "Register Complaint | Royal Complaint Portal";

        }

    }
);

</script>


</body>
</html>