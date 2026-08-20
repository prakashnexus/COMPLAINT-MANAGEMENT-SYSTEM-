<?php
include("db.php");

// Get all complaints
$sql = "SELECT * FROM complaints ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Complaints | Royal Portal</title>

<!-- GOOGLE FONT -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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

    background:
        radial-gradient(
            circle at 10% 15%,
            rgba(37,99,235,.22),
            transparent 30%
        ),
        radial-gradient(
            circle at 90% 80%,
            rgba(124,58,237,.20),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #020617,
            #07152f,
            #0b1f45,
            #020617
        );

    background-size:200% 200%;

    animation:
        backgroundMove 18s ease infinite;

    overflow-x:hidden;
}

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
   AMBIENT LIGHT
========================================================= */

body::before{

    content:"";

    position:fixed;

    width:450px;
    height:450px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(59,130,246,.16),
            transparent 70%
        );

    filter:blur(25px);

    top:-180px;
    left:-150px;

    animation:
        lightMove 12s ease-in-out infinite;

    pointer-events:none;

    z-index:-2;
}

body::after{

    content:"";

    position:fixed;

    width:420px;
    height:420px;

    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(139,92,246,.14),
            transparent 70%
        );

    filter:blur(25px);

    right:-150px;
    bottom:-150px;

    animation:
        lightMove2 15s ease-in-out infinite;

    pointer-events:none;

    z-index:-2;
}

@keyframes lightMove{

    0%,100%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(180px,120px);
    }

}

@keyframes lightMove2{

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

    pointer-events:none;

    overflow:hidden;

    z-index:-1;
}

.particle{

    position:absolute;

    width:4px;
    height:4px;

    border-radius:50%;

    background:#60a5fa;

    box-shadow:
        0 0 8px #60a5fa,
        0 0 18px rgba(96,165,250,.6);

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
            translateY(-20vh)
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

    min-height:90px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:18px 5%;

    background:
        linear-gradient(
            135deg,
            rgba(4,18,48,.96),
            rgba(13,45,94,.92)
        );

    backdrop-filter:blur(20px);

    border-bottom:
        1px solid rgba(255,255,255,.12);

    box-shadow:
        0 15px 50px rgba(0,0,0,.35);

    overflow:hidden;

    z-index:10;
}


/* Header shine */

.header::after{

    content:"";

    position:absolute;

    left:-20%;

    bottom:0;

    width:140%;

    height:2px;

    background:
        linear-gradient(
            90deg,
            transparent,
            #60a5fa,
            #a78bfa,
            #60a5fa,
            transparent
        );

    animation:
        shineLine 5s linear infinite;
}

@keyframes shineLine{

    0%{
        transform:translateX(-30%);
    }

    100%{
        transform:translateX(30%);
    }

}


.header-left{

    display:flex;

    align-items:center;

    gap:16px;
}


/* =========================================================
   LOGO
========================================================= */

.logo{

    width:55px;
    height:55px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:16px;

    color:#bfdbfe;

    font-size:23px;

    background:
        linear-gradient(
            145deg,
            rgba(59,130,246,.25),
            rgba(139,92,246,.25)
        );

    border:
        1px solid rgba(147,197,253,.25);

    box-shadow:
        inset 0 0 20px rgba(96,165,250,.08),
        0 12px 30px rgba(0,0,0,.35);

    transform-style:preserve-3d;

    animation:
        logoFloat 4s ease-in-out infinite;
}

@keyframes logoFloat{

    0%,100%{
        transform:
            translateY(0)
            rotateY(0deg);
    }

    50%{
        transform:
            translateY(-5px)
            rotateY(15deg);
    }

}


.header-title h1{

    font-size:21px;

    font-weight:700;

    color:#fff;

    letter-spacing:.3px;
}

.header-title p{

    color:#94a3b8;

    font-size:11px;

    margin-top:2px;
}


/* =========================================================
   HEADER RIGHT
========================================================= */

.header-status{

    display:flex;

    align-items:center;

    gap:10px;

    padding:9px 15px;

    border-radius:30px;

    background:
        rgba(255,255,255,.06);

    border:
        1px solid rgba(255,255,255,.10);

    color:#cbd5e1;

    font-size:12px;
}

.online-dot{

    width:8px;
    height:8px;

    border-radius:50%;

    background:#22c55e;

    box-shadow:
        0 0 10px #22c55e;

    animation:
        onlinePulse 1.8s infinite;
}

@keyframes onlinePulse{

    0%,100%{
        opacity:1;
        transform:scale(1);
    }

    50%{
        opacity:.5;
        transform:scale(.75);
    }

}


/* =========================================================
   MAIN CONTAINER
========================================================= */

.container{

    width:94%;

    max-width:1450px;

    margin:35px auto 0;

}


/* =========================================================
   PAGE TITLE
========================================================= */

.page-heading{

    display:flex;

    align-items:center;

    justify-content:space-between;

    margin-bottom:25px;

    animation:
        pageEnter .8s ease;
}

.page-heading h2{

    font-size:30px;

    font-weight:700;

    color:#fff;

    text-shadow:
        0 8px 25px rgba(0,0,0,.35);
}

.page-heading p{

    color:#94a3b8;

    font-size:13px;

    margin-top:4px;
}

@keyframes pageEnter{

    from{

        opacity:0;

        transform:
            translateY(25px)
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
   SUMMARY CARDS
========================================================= */

.summary{

    display:grid;

    grid-template-columns:
        repeat(3,1fr);

    gap:20px;

    margin-bottom:25px;
}

.summary-card{

    position:relative;

    min-height:120px;

    padding:22px;

    border-radius:20px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.10),
            rgba(255,255,255,.035)
        );

    border:
        1px solid rgba(255,255,255,.12);

    backdrop-filter:blur(20px);

    box-shadow:
        0 20px 50px rgba(0,0,0,.25);

    overflow:hidden;

    transform-style:preserve-3d;

    transition:.25s;

    animation:
        cardEnter .7s ease both;
}

.summary-card:nth-child(2){
    animation-delay:.12s;
}

.summary-card:nth-child(3){
    animation-delay:.24s;
}

@keyframes cardEnter{

    from{

        opacity:0;

        transform:
            translateY(30px)
            rotateX(12deg);
    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0);
    }

}

.summary-card::before{

    content:"";

    position:absolute;

    width:160px;
    height:160px;

    border-radius:50%;

    right:-80px;
    top:-80px;

    background:
        radial-gradient(
            circle,
            rgba(96,165,250,.18),
            transparent 70%
        );
}

.summary-icon{

    position:absolute;

    right:20px;
    top:20px;

    width:48px;
    height:48px;

    display:flex;

    align-items:center;
    justify-content:center;

    border-radius:14px;

    color:#93c5fd;

    background:
        linear-gradient(
            135deg,
            rgba(59,130,246,.18),
            rgba(139,92,246,.18)
        );

    transform:
        translateZ(25px);

    font-size:20px;
}

.summary-card h4{

    color:#94a3b8;

    text-transform:uppercase;

    font-size:11px;

    letter-spacing:1px;

    margin-bottom:8px;
}

.summary-number{

    color:#fff;

    font-size:30px;

    font-weight:800;

    transform:
        translateZ(20px);
}


/* =========================================================
   MAIN TABLE PANEL
========================================================= */

.table-panel{

    position:relative;

    padding:25px;

    border-radius:24px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.10),
            rgba(255,255,255,.035)
        );

    border:
        1px solid rgba(255,255,255,.12);

    backdrop-filter:blur(22px);

    box-shadow:
        0 30px 70px rgba(0,0,0,.30);

    transform-style:preserve-3d;

    animation:
        panelEnter .9s ease;
}

@keyframes panelEnter{

    from{

        opacity:0;

        transform:
            translateY(35px)
            rotateX(6deg);
    }

    to{

        opacity:1;

        transform:
            translateY(0)
            rotateX(0);
    }

}


/* top glow */

.table-panel::before{

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
            #60a5fa,
            #a78bfa,
            #60a5fa,
            transparent
        );

    box-shadow:
        0 0 20px rgba(96,165,250,.5);
}


/* =========================================================
   PANEL HEADER
========================================================= */

.panel-header{

    display:flex;

    align-items:center;

    justify-content:space-between;

    gap:20px;

    margin-bottom:20px;
}

.panel-header h3{

    font-size:20px;

    color:#fff;
}

.panel-header h3 i{

    color:#60a5fa;

    margin-right:8px;
}

.record-badge{

    padding:8px 14px;

    border-radius:30px;

    color:#bfdbfe;

    background:
        rgba(59,130,246,.10);

    border:
        1px solid rgba(96,165,250,.18);

    font-size:12px;
}


/* =========================================================
   SEARCH BAR
========================================================= */

.toolbar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:15px;

    margin-bottom:18px;
}

.search{

    position:relative;

    max-width:420px;

    width:100%;
}

.search i{

    position:absolute;

    left:15px;

    top:50%;

    transform:
        translateY(-50%);

    color:#64748b;
}

.search input{

    width:100%;

    padding:13px 15px 13px 43px;

    border-radius:13px;

    outline:none;

    border:
        1px solid rgba(255,255,255,.12);

    background:
        rgba(0,0,0,.18);

    color:#fff;

    font-size:13px;

    transition:.3s;
}

.search input::placeholder{
    color:#64748b;
}

.search input:focus{

    border-color:#60a5fa;

    box-shadow:
        0 0 25px rgba(59,130,246,.12);
}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.table-wrapper{

    width:100%;

    overflow-x:auto;

    border-radius:17px;

    border:
        1px solid rgba(255,255,255,.08);

    box-shadow:
        inset 0 0 30px rgba(0,0,0,.10);
}


/* =========================================================
   TABLE
========================================================= */

table{

    width:100%;

    min-width:1150px;

    border-collapse:separate;

    border-spacing:0;
}

thead th{

    padding:16px 12px;

    color:#bfdbfe;

    font-size:10px;

    text-transform:uppercase;

    letter-spacing:.8px;

    background:
        linear-gradient(
            135deg,
            rgba(30,64,175,.45),
            rgba(76,29,149,.35)
        );

    border-bottom:
        1px solid rgba(255,255,255,.12);

    white-space:nowrap;

    text-align:center;
}

thead th:first-child{
    border-radius:16px 0 0 0;
}

thead th:last-child{
    border-radius:0 16px 0 0;
}


/* =========================================================
   TABLE ROW
========================================================= */

tbody tr{

    background:
        rgba(255,255,255,.025);

    transition:
        transform .3s ease,
        background .3s ease,
        box-shadow .3s ease;

    animation:
        rowEnter .5s ease both;
}

@keyframes rowEnter{

    from{

        opacity:0;

        transform:
            translateX(-20px)
            rotateX(5deg);
    }

    to{

        opacity:1;

        transform:
            translateX(0)
            rotateX(0);
    }

}

tbody tr:hover{

    background:
        linear-gradient(
            90deg,
            rgba(59,130,246,.10),
            rgba(124,58,237,.07)
        );

    transform:
        translateY(-2px)
        scale(1.002);

    box-shadow:
        inset 4px 0 0 #60a5fa,
        0 10px 25px rgba(0,0,0,.12);
}

tbody td{

    padding:15px 12px;

    text-align:center;

    color:#cbd5e1;

    font-size:12px;

    border-bottom:
        1px solid rgba(255,255,255,.06);

    vertical-align:middle;
}


/* =========================================================
   ID
========================================================= */

.id-badge{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    width:36px;
    height:36px;

    border-radius:11px;

    color:#bfdbfe;

    font-weight:700;

    background:
        linear-gradient(
            135deg,
            rgba(59,130,246,.18),
            rgba(124,58,237,.15)
        );

    border:
        1px solid rgba(96,165,250,.18);

    box-shadow:
        0 5px 15px rgba(0,0,0,.15);
}


/* =========================================================
   TEXT
========================================================= */

.register{

    color:#60a5fa;

    font-weight:600;
}

.student-name{

    color:#fff;

    font-weight:600;
}

.category{

    color:#c4b5fd;

    font-weight:500;
}

.subject{

    color:#e2e8f0;

    font-weight:500;
}

.details{

    max-width:260px;

    color:#94a3b8;

    line-height:1.5;
}


/* =========================================================
   STATUS BADGES
========================================================= */

.status{

    display:inline-flex;

    align-items:center;

    gap:7px;

    padding:7px 13px;

    border-radius:30px;

    font-size:11px;

    font-weight:700;

    white-space:nowrap;

    box-shadow:
        0 5px 15px rgba(0,0,0,.15);
}

.status-dot{

    width:7px;
    height:7px;

    border-radius:50%;
}


/* Pending */

.pending{

    color:#fecaca;

    background:
        rgba(239,68,68,.12);

    border:
        1px solid rgba(239,68,68,.22);
}

.pending .status-dot{

    background:#ef4444;

    box-shadow:
        0 0 9px #ef4444;

    animation:
        statusPulse 1.5s infinite;
}


/* Progress */

.progress{

    color:#fde68a;

    background:
        rgba(245,158,11,.12);

    border:
        1px solid rgba(245,158,11,.22);
}

.progress .status-dot{

    background:#f59e0b;

    box-shadow:
        0 0 9px #f59e0b;

    animation:
        statusPulse 1.5s infinite;
}


/* Resolved */

.resolved{

    color:#bbf7d0;

    background:
        rgba(34,197,94,.12);

    border:
        1px solid rgba(34,197,94,.22);
}

.resolved .status-dot{

    background:#22c55e;

    box-shadow:
        0 0 9px #22c55e;
}

@keyframes statusPulse{

    0%,100%{
        opacity:1;
        transform:scale(1);
    }

    50%{
        opacity:.5;
        transform:scale(.75);
    }

}


/* =========================================================
   EMPTY
========================================================= */

.empty{

    padding:60px !important;

    color:#64748b !important;

    text-align:center !important;
}

.empty i{

    display:block;

    font-size:42px;

    color:#334155;

    margin-bottom:12px;
}


/* =========================================================
   BACK BUTTON
========================================================= */

.bottom-area{

    margin-top:22px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:15px;
}

.home-btn{

    display:inline-flex;

    align-items:center;

    gap:9px;

    text-decoration:none;

    padding:12px 19px;

    border-radius:13px;

    color:#fff;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #4f46e5
        );

    box-shadow:
        0 10px 25px rgba(37,99,235,.25);

    font-size:13px;

    font-weight:600;

    transition:.35s;
}

.home-btn:hover{

    transform:
        translateY(-4px)
        rotateX(5deg);

    box-shadow:
        0 18px 35px rgba(37,99,235,.40);
}


/* =========================================================
   FOOTER
========================================================= */

.footer{

    margin-top:35px;

    padding:25px 10px;

    text-align:center;

    color:#64748b;

    font-size:11px;
}

.footer i{

    color:#60a5fa;

    margin-right:5px;
}


/* =========================================================
   CURSOR LIGHT
========================================================= */

.cursor-light{

    position:fixed;

    width:280px;
    height:280px;

    border-radius:50%;

    pointer-events:none;

    background:
        radial-gradient(
            circle,
            rgba(96,165,250,.07),
            transparent 70%
        );

    transform:
        translate(-50%,-50%);

    z-index:-1;
}


/* =========================================================
   SCROLLBAR
========================================================= */

::-webkit-scrollbar{

    width:7px;
    height:7px;
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
   RESPONSIVE
========================================================= */

@media(max-width:1000px){

    .summary{

        grid-template-columns:
            repeat(2,1fr);
    }

}

@media(max-width:700px){

    .header{

        padding:15px 18px;
    }

    .header-title h1{

        font-size:15px;
    }

    .header-title p{

        display:none;
    }

    .logo{

        width:45px;
        height:45px;
    }

    .header-status{

        display:none;
    }

    .container{

        width:96%;

        margin-top:25px;
    }

    .page-heading{

        display:block;
    }

    .page-heading h2{

        font-size:24px;
    }

    .summary{

        grid-template-columns:1fr;
    }

    .table-panel{

        padding:16px;
    }

    .panel-header{

        display:block;
    }

    .record-badge{

        display:inline-block;

        margin-top:10px;
    }

    .toolbar{

        display:block;
    }

    .search{

        max-width:none;
    }

    .bottom-area{

        display:block;
    }

    .home-btn{

        width:100%;

        justify-content:center;
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

<div class="cursor-light" id="cursorLight"></div>


<!-- =====================================================
     HEADER
===================================================== -->

<header class="header">

    <div class="header-left">

        <div class="logo">

            <i class="fas fa-shield-heart"></i>

        </div>

        <div class="header-title">

            <h1>
                College Complaint Management System
            </h1>

            <p>
                Student Complaint Tracking Portal
            </p>

        </div>

    </div>


    <div class="header-status">

        <span class="online-dot"></span>

        System Online

    </div>

</header>


<!-- =====================================================
     MAIN
===================================================== -->

<div class="container">


    <!-- PAGE HEADING -->

    <div class="page-heading">

        <div>

            <h2>

                <i class="fas fa-file-circle-check"></i>

                My Complaints

            </h2>

            <p>
                Track your submitted complaints and their current status.
            </p>

        </div>

    </div>


    <?php

    $totalComplaints = mysqli_num_rows($result);

    $pendingCount = 0;
    $progressCount = 0;
    $resolvedCount = 0;

    // Store rows so the result can be used for both
    // statistics and table display.
    $complaints = [];

    if($totalComplaints > 0){

        while($row = mysqli_fetch_assoc($result)){

            $complaints[] = $row;

            $status = strtolower(trim($row['status']));

            if($status == "pending"){
                $pendingCount++;
            }
            elseif(
                $status == "in progress" ||
                $status == "processing"
            ){
                $progressCount++;
            }
            elseif(
                $status == "resolved" ||
                $status == "finished"
            ){
                $resolvedCount++;
            }

        }

    }

    ?>


    <!-- =================================================
         SUMMARY
    ================================================== -->

    <div class="summary">


        <div class="summary-card tilt-card">

            <div class="summary-icon">

                <i class="fas fa-file-lines"></i>

            </div>

            <h4>
                Total Complaints
            </h4>

            <div
                class="summary-number"
                data-target="<?php echo $totalComplaints; ?>"
            >
                0
            </div>

        </div>


        <div class="summary-card tilt-card">

            <div class="summary-icon">

                <i class="fas fa-hourglass-half"></i>

            </div>

            <h4>
                Pending
            </h4>

            <div
                class="summary-number"
                data-target="<?php echo $pendingCount; ?>"
            >
                0
            </div>

        </div>


        <div class="summary-card tilt-card">

            <div class="summary-icon">

                <i class="fas fa-circle-check"></i>

            </div>

            <h4>
                Resolved
            </h4>

            <div
                class="summary-number"
                data-target="<?php echo $resolvedCount; ?>"
            >
                0
            </div>

        </div>

    </div>


    <!-- =================================================
         TABLE PANEL
    ================================================== -->

    <div class="table-panel" id="tablePanel">


        <div class="panel-header">

            <h3>

                <i class="fas fa-layer-group"></i>

                Complaint Records

            </h3>


            <div class="record-badge">

                <i class="fas fa-database"></i>

                <span id="visibleCount">
                    <?php echo $totalComplaints; ?>
                </span>

                Records

            </div>

        </div>


        <!-- SEARCH -->

        <div class="toolbar">

            <div class="search">

                <i class="fas fa-search"></i>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search complaints, register number, subject..."
                    autocomplete="off"
                >

            </div>

        </div>


        <!-- TABLE -->

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

                        <th>Complaint</th>

                        <th>Date</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>


                <?php

                if(count($complaints) > 0){

                    foreach($complaints as $row){

                        $status = trim($row['status']);

                        $statusLower =
                            strtolower($status);

                        $statusClass = "";

                        if($statusLower == "pending"){

                            $statusClass = "pending";

                        }
                        elseif(
                            $statusLower == "in progress" ||
                            $statusLower == "processing"
                        ){

                            $statusClass = "progress";

                        }
                        elseif(
                            $statusLower == "resolved" ||
                            $statusLower == "finished"
                        ){

                            $statusClass = "resolved";

                        }

                ?>

                    <tr>


                        <td>

                            <span class="id-badge">

                                <?php
                                echo htmlspecialchars(
                                    $row['id']
                                );
                                ?>

                            </span>

                        </td>


                        <td class="register">

                            <?php
                            echo htmlspecialchars(
                                $row['register_no']
                            );
                            ?>

                        </td>


                        <td class="student-name">

                            <?php
                            echo htmlspecialchars(
                                $row['student_name']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['course']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['department']
                            );
                            ?>

                        </td>


                        <td class="category">

                            <?php
                            echo htmlspecialchars(
                                $row['complaint_category']
                            );
                            ?>

                        </td>


                        <td class="subject">

                            <?php
                            echo htmlspecialchars(
                                $row['complaint_subject']
                            );
                            ?>

                        </td>


                        <td class="details">

                            <?php
                            echo htmlspecialchars(
                                $row['complaint_details']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['complaint_date']
                            );
                            ?>

                        </td>


                        <td>

                            <?php

                            if($statusClass != ""){

                            ?>

                                <span
                                    class="status <?php echo $statusClass; ?>"
                                >

                                    <span class="status-dot"></span>

                                    <?php
                                    echo htmlspecialchars(
                                        $status
                                    );
                                    ?>

                                </span>

                            <?php

                            }
                            else{

                                echo htmlspecialchars(
                                    $status
                                );

                            }

                            ?>

                        </td>


                    </tr>


                <?php

                    }

                }
                else{

                ?>

                    <tr class="empty-row">

                        <td
                            colspan="10"
                            class="empty"
                        >

                            <i class="fas fa-folder-open"></i>

                            No Complaints Found

                        </td>

                    </tr>

                <?php

                }

                ?>


                </tbody>

            </table>

        </div>


        <!-- BOTTOM -->

        <div class="bottom-area">

            <a
                href="student_dashboard.php"
                class="home-btn"
            >

                <i class="fas fa-arrow-left"></i>

                Back to Dashboard

            </a>

        </div>


    </div>


    <!-- FOOTER -->

    <div class="footer">

        <i class="fas fa-shield-halved"></i>

        © 2026 Online Complaint Management System

        <br>

        Secure Student Complaint Portal

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

for(let i = 0; i < 55; i++){

    const particle =
        document.createElement("span");

    particle.className =
        "particle";

    particle.style.left =
        Math.random() * 100 + "%";

    particle.style.animationDuration =
        (7 + Math.random() * 13) + "s";

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
   3D SUMMARY CARD TILT
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
                `
                perspective(900px)
                rotateX(${rotateX}deg)
                rotateY(${rotateY}deg)
                translateY(-6px)
                translateZ(10px)
                `;

        }
    );


    card.addEventListener(
        "mouseleave",
        function(){

            card.style.transform =
                `
                perspective(900px)
                rotateX(0deg)
                rotateY(0deg)
                translateY(0)
                translateZ(0)
                `;

        }
    );

});


/* =========================================================
   TABLE PANEL 3D TILT
========================================================= */

const tablePanel =
    document.getElementById(
        "tablePanel"
    );

tablePanel.addEventListener(
    "mousemove",
    function(e){

        if(window.innerWidth < 1000)
            return;

        const rect =
            tablePanel.getBoundingClientRect();

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

        tablePanel.style.transform =
            `
            perspective(1600px)
            rotateX(${rotateX}deg)
            rotateY(${rotateY}deg)
            `;

    }
);


tablePanel.addEventListener(
    "mouseleave",
    function(){

        tablePanel.style.transform =
            `
            perspective(1600px)
            rotateX(0deg)
            rotateY(0deg)
            `;

    }
);


/* =========================================================
   ANIMATED COUNTERS
========================================================= */

function animateCounter(
    element,
    target,
    duration = 1200
){

    let start = 0;

    const startTime =
        performance.now();

    function update(currentTime){

        const progress =
            Math.min(
                (
                    currentTime -
                    startTime
                ) / duration,
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
                target * eased
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

    requestAnimationFrame(
        update
    );

}


document
.querySelectorAll(
    ".summary-number"
)
.forEach(function(counter){

    const target =
        parseInt(
            counter.dataset.target,
            10
        ) || 0;

    animateCounter(
        counter,
        target,
        1400
    );

});


/* =========================================================
   SEARCH
========================================================= */

const searchInput =
    document.getElementById(
        "searchInput"
    );

const table =
    document.getElementById(
        "complaintTable"
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
                "tbody tr:not(.empty-row)"
            );

        let visible = 0;


        rows.forEach(function(row){

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

        });


        visibleCount.textContent =
            visible;

    }
);


/* =========================================================
   TABLE ROW STAGGER
========================================================= */

document
.querySelectorAll(
    "#complaintTable tbody tr"
)
.forEach(function(row,index){

    row.style.animationDelay =
        (index * 0.045) + "s";

});


/* =========================================================
   MOUSE FOLLOW LIGHT
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
   STATUS HOVER 3D
========================================================= */

document
.querySelectorAll(
    ".status"
)
.forEach(function(status){

    status.addEventListener(
        "mouseenter",
        function(){

            this.style.transform =
                "translateY(-3px) scale(1.05)";

        }
    );


    status.addEventListener(
        "mouseleave",
        function(){

            this.style.transform =
                "translateY(0) scale(1)";

        }
    );

});


/* =========================================================
   KEYBOARD SEARCH SHORTCUT
   CTRL + K
========================================================= */

document.addEventListener(
    "keydown",
    function(e){

        if(
            (e.ctrlKey || e.metaKey) &&
            e.key.toLowerCase() === "k"
        ){

            e.preventDefault();

            searchInput.focus();

        }


        if(e.key === "Escape"){

            searchInput.value = "";

            searchInput.dispatchEvent(
                new Event("input")
            );

            searchInput.blur();

        }

    }
);


/* =========================================================
   PAGE TITLE VISIBILITY
========================================================= */

document.addEventListener(
    "visibilitychange",
    function(){

        if(document.hidden){

            document.title =
                "My Complaints";

        }
        else{

            document.title =
                "My Complaints | Royal Portal";

        }

    }
);


/* =========================================================
   SMOOTH BUTTON PRESS
========================================================= */

document
.querySelectorAll(
    ".home-btn"
)
.forEach(function(button){

    button.addEventListener(
        "mousedown",
        function(){

            this.style.transform =
                "scale(.96)";

        }
    );


    button.addEventListener(
        "mouseup",
        function(){

            this.style.transform =
                "";

        }
    );

});

</script>

</body>
</html>