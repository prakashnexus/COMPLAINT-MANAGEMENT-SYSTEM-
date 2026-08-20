<?php

session_start();

require_once __DIR__ . "/db.php";

/*
|--------------------------------------------------------------------------
| CONFIGURATION
|--------------------------------------------------------------------------
*/

$RESET_PAGE_URL = "http://localhost/COMPLAINT/reset-password.php";

/*
|--------------------------------------------------------------------------
| VARIABLES
|--------------------------------------------------------------------------
*/

$message = "";
$message_type = "";

$student_verified = false;

$student_id = "";
$register_no = "";
$student_email = "";
$masked_email = "";

$development_reset_link = "";


/*
|--------------------------------------------------------------------------
| HELPER
|--------------------------------------------------------------------------
*/

function maskEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "registered email";
    }

    $parts = explode("@", $email);

    $name = $parts[0];
    $domain = $parts[1];

    $length = strlen($name);

    if ($length <= 2) {
        $maskedName = substr($name, 0, 1) . "*";
    } else {
        $maskedName =
            substr($name, 0, 2) .
            str_repeat("*", max(2, $length - 2));
    }

    return $maskedName . "@" . $domain;
}


/*
|--------------------------------------------------------------------------
| CHECK PASSWORD RESET TABLE
|--------------------------------------------------------------------------
*/

$tableExists = false;

$tableCheck = $conn->query(
    "SHOW TABLES LIKE 'password_resets'"
);

if ($tableCheck && $tableCheck->num_rows > 0) {
    $tableExists = true;
}


/*
|--------------------------------------------------------------------------
| POST REQUEST
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $action = $_POST["action"] ?? "";


    /*
    |--------------------------------------------------------------------------
    | STEP 1 - VERIFY REGISTER NUMBER
    |--------------------------------------------------------------------------
    */

    if ($action === "verify_register") {

        $register_no = trim(
            $_POST["register_no"] ?? ""
        );

        $register_no = strtoupper(
            preg_replace(
                "/\s+/",
                "",
                $register_no
            )
        );


        if ($register_no === "") {

            $message =
                "Please enter your register number.";

            $message_type = "error";

        } elseif (strlen($register_no) > 50) {

            $message =
                "Invalid register number.";

            $message_type = "error";

        } else {

            $stmt = $conn->prepare(
                "SELECT
                    id,
                    register_no,
                    email
                 FROM students
                 WHERE register_no = ?
                 LIMIT 1"
            );


            if (!$stmt) {

                $message =
                    "Database query error: " .
                    $conn->error;

                $message_type = "error";

            } else {

                $stmt->bind_param(
                    "s",
                    $register_no
                );

                $stmt->execute();

                $result = $stmt->get_result();


                if (
                    $result &&
                    $result->num_rows === 1
                ) {

                    $student =
                        $result->fetch_assoc();


                    if (
                        empty($student["email"]) ||
                        !filter_var(
                            $student["email"],
                            FILTER_VALIDATE_EMAIL
                        )
                    ) {

                        $message =
                            "This student does not have a valid registered email address.";

                        $message_type = "error";

                    } else {

                        $_SESSION[
                            "verified_student_id"
                        ] =
                            (int)$student["id"];


                        $_SESSION[
                            "verified_register_no"
                        ] =
                            $student["register_no"];


                        $_SESSION[
                            "verified_student_email"
                        ] =
                            $student["email"];


                        $_SESSION[
                            "masked_email"
                        ] =
                            maskEmail(
                                $student["email"]
                            );


                        $student_verified = true;

                        $student_id =
                            $student["id"];

                        $register_no =
                            $student["register_no"];

                        $student_email =
                            $student["email"];

                        $masked_email =
                            $_SESSION[
                                "masked_email"
                            ];


                        $message =
                            "Register number verified successfully.";

                        $message_type =
                            "success";
                    }

                } else {

                    $message =
                        "Register number not found. Please check your register number and try again.";

                    $message_type =
                        "error";
                }


                $stmt->close();
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | STEP 2 - CREATE RESET TOKEN
    |--------------------------------------------------------------------------
    */

    elseif ($action === "send_reset") {


        if (!$tableExists) {

            $message =
                "The password_resets table does not exist. Please run the SQL provided above.";

            $message_type =
                "error";

        } elseif (
            !isset(
                $_SESSION["verified_student_id"]
            ) ||
            !isset(
                $_SESSION["verified_register_no"]
            ) ||
            !isset(
                $_SESSION["verified_student_email"]
            )
        ) {

            $message =
                "Please verify your register number first.";

            $message_type =
                "error";

        } else {


            $student_id =
                (int)
                $_SESSION[
                    "verified_student_id"
                ];


            $register_no =
                $_SESSION[
                    "verified_register_no"
                ];


            $student_email =
                $_SESSION[
                    "verified_student_email"
                ];


            if (
                !filter_var(
                    $student_email,
                    FILTER_VALIDATE_EMAIL
                )
            ) {

                $message =
                    "The registered email address is invalid.";

                $message_type =
                    "error";

            } else {


                /*
                |--------------------------------------------------------------------------
                | GENERATE SECURE TOKEN
                |--------------------------------------------------------------------------
                */

                try {

                    $token =
                        bin2hex(
                            random_bytes(32)
                        );

                } catch (Throwable $e) {

                    $message =
                        "Unable to generate secure reset token.";

                    $message_type =
                        "error";

                    $token = "";
                }


                if ($token !== "") {


                    /*
                    |--------------------------------------------------------------------------
                    | TOKEN EXPIRY - 30 MINUTES
                    |--------------------------------------------------------------------------
                    */

                    $expires_at =
                        date(
                            "Y-m-d H:i:s",
                            time() + (30 * 60)
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | DELETE OLD TOKENS
                    |--------------------------------------------------------------------------
                    */

                    $delete = $conn->prepare(
                        "DELETE FROM password_resets
                         WHERE user_id = ?"
                    );


                    if (!$delete) {

                        $message =
                            "Unable to prepare reset request: " .
                            $conn->error;

                        $message_type =
                            "error";

                    } else {

                        $delete->bind_param(
                            "i",
                            $student_id
                        );

                        $delete->execute();

                        $delete->close();


                        /*
                        |--------------------------------------------------------------------------
                        | INSERT NEW TOKEN
                        |--------------------------------------------------------------------------
                        */

                        $insert = $conn->prepare(
                            "INSERT INTO password_resets
                            (
                                user_id,
                                token,
                                expires_at
                            )
                            VALUES
                            (
                                ?,
                                ?,
                                ?
                            )"
                        );


                        if (!$insert) {

                            $message =
                                "Unable to create reset request: " .
                                $conn->error;

                            $message_type =
                                "error";

                        } else {

                            $insert->bind_param(
                                "iss",
                                $student_id,
                                $token,
                                $expires_at
                            );


                            if ($insert->execute()) {


                                /*
                                |--------------------------------------------------------------------------
                                | CREATE RESET LINK
                                |--------------------------------------------------------------------------
                                */

                                $reset_link =
                                    $RESET_PAGE_URL .
                                    "?token=" .
                                    urlencode($token);


                                /*
                                |--------------------------------------------------------------------------
                                | SAVE DEVELOPMENT LINK
                                |--------------------------------------------------------------------------
                                */

                                $_SESSION[
                                    "development_reset_link"
                                ] =
                                    $reset_link;


                                /*
                                |--------------------------------------------------------------------------
                                | CLEAR VERIFICATION
                                |--------------------------------------------------------------------------
                                */

                                unset(
                                    $_SESSION[
                                        "verified_student_id"
                                    ]
                                );

                                unset(
                                    $_SESSION[
                                        "verified_register_no"
                                    ]
                                );

                                unset(
                                    $_SESSION[
                                        "verified_student_email"
                                    ]
                                );

                                unset(
                                    $_SESSION[
                                        "masked_email"
                                    ]
                                );


                                /*
                                |--------------------------------------------------------------------------
                                | SHOW SUCCESS
                                |--------------------------------------------------------------------------
                                */

                                $message =
                                    "Password reset link created successfully for " .
                                    maskEmail(
                                        $student_email
                                    ) .
                                    ".";

                                $message_type =
                                    "success";

                            } else {

                                $message =
                                    "Unable to save password reset token: " .
                                    $insert->error;

                                $message_type =
                                    "error";
                            }


                            $insert->close();
                        }
                    }
                }
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | START AGAIN
    |--------------------------------------------------------------------------
    */

    elseif ($action === "start_again") {

        unset(
            $_SESSION["verified_student_id"],
            $_SESSION["verified_register_no"],
            $_SESSION["verified_student_email"],
            $_SESSION["masked_email"],
            $_SESSION["development_reset_link"]
        );

        header(
            "Location: forgot-password.php"
        );

        exit;
    }
}


/*
|--------------------------------------------------------------------------
| RESTORE VERIFIED SESSION
|--------------------------------------------------------------------------
*/

if (
    isset(
        $_SESSION["verified_student_id"]
    ) &&
    isset(
        $_SESSION["verified_register_no"]
    ) &&
    isset(
        $_SESSION["verified_student_email"]
    )
) {

    $student_verified = true;

    $student_id =
        $_SESSION[
            "verified_student_id"
        ];

    $register_no =
        $_SESSION[
            "verified_register_no"
        ];

    $student_email =
        $_SESSION[
            "verified_student_email"
        ];

    $masked_email =
        $_SESSION[
            "masked_email"
        ] ??
        maskEmail(
            $student_email
        );
}


/*
|--------------------------------------------------------------------------
| DEVELOPMENT LINK
|--------------------------------------------------------------------------
*/

if (
    isset(
        $_SESSION["development_reset_link"]
    )
) {

    $development_reset_link =
        $_SESSION[
            "development_reset_link"
        ];

    /*
     * Do not unset immediately.
     * This allows the link to remain visible
     * after the POST request.
     */
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

<title>Forgot Password | Student Portal</title>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {

    min-height: 100vh;

    display: flex;

    justify-content: center;

    align-items: center;

    padding: 25px;

    font-family:
        "Segoe UI",
        Arial,
        sans-serif;

    color: white;

    background:
        radial-gradient(
            circle at 10% 10%,
            rgba(124,58,237,.38),
            transparent 35%
        ),
        radial-gradient(
            circle at 90% 90%,
            rgba(6,182,212,.30),
            transparent 35%
        ),
        linear-gradient(
            135deg,
            #020617,
            #0f172a,
            #111827
        );

    overflow-x: hidden;
}

.orb {

    position: fixed;

    border-radius: 50%;

    pointer-events: none;

    z-index: 0;

    filter: blur(2px);
}

.orb1 {

    width: 400px;
    height: 400px;

    top: -180px;
    left: -130px;

    background:
        radial-gradient(
            circle,
            rgba(139,92,246,.35),
            transparent 70%
        );

    animation:
        orb1Move 8s ease-in-out infinite;
}

.orb2 {

    width: 450px;
    height: 450px;

    right: -180px;
    bottom: -200px;

    background:
        radial-gradient(
            circle,
            rgba(20,184,166,.28),
            transparent 70%
        );

    animation:
        orb2Move 10s ease-in-out infinite;
}

@keyframes orb1Move {

    0%,100% {
        transform: translate(0,0);
    }

    50% {
        transform: translate(70px,50px);
    }
}

@keyframes orb2Move {

    0%,100% {
        transform: translate(0,0);
    }

    50% {
        transform: translate(-70px,-50px);
    }
}

.container {

    width: 100%;

    max-width: 510px;

    position: relative;

    z-index: 10;
}

.card {

    padding: 42px 38px;

    border-radius: 30px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.14),
            rgba(255,255,255,.04)
        );

    border:
        1px solid
        rgba(255,255,255,.18);

    box-shadow:
        0 40px 100px
        rgba(0,0,0,.55),
        inset 0 1px 0
        rgba(255,255,255,.15);

    backdrop-filter:
        blur(25px);

    -webkit-backdrop-filter:
        blur(25px);

    transform-style:
        preserve-3d;

    animation:
        cardIn .8s ease;
}

@keyframes cardIn {

    from {
        opacity: 0;
        transform:
            translateY(60px)
            rotateX(12deg)
            scale(.95);
    }

    to {
        opacity: 1;
        transform:
            translateY(0)
            rotateX(0)
            scale(1);
    }
}

.icon {

    width: 90px;
    height: 90px;

    margin:
        0 auto 22px;

    display: flex;

    justify-content: center;

    align-items: center;

    border-radius: 27px;

    font-size: 42px;

    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #06b6d4
        );

    box-shadow:
        0 20px 50px
        rgba(124,58,237,.35);

    animation:
        iconFloat 3s ease-in-out infinite;
}

@keyframes iconFloat {

    0%,100% {
        transform:
            translateY(0)
            rotateY(0);
    }

    50% {
        transform:
            translateY(-8px)
            rotateY(12deg);
    }
}

h1 {

    text-align: center;

    font-size: 30px;

    margin-bottom: 10px;
}

.subtitle {

    text-align: center;

    color: #cbd5e1;

    font-size: 14px;

    line-height: 1.7;

    margin-bottom: 30px;
}

.steps {

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 30px;
}

.step {

    width: 40px;
    height: 40px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    font-weight: 700;

    color: #94a3b8;

    background:
        rgba(255,255,255,.07);

    border:
        1px solid
        rgba(255,255,255,.15);
}

.step.active {

    color: white;

    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #06b6d4
        );

    box-shadow:
        0 10px 30px
        rgba(124,58,237,.35);
}

.line {

    width: 65px;
    height: 2px;

    background:
        rgba(255,255,255,.14);
}

.line.active {

    background:
        linear-gradient(
            90deg,
            #7c3aed,
            #06b6d4
        );
}

.message {

    padding: 15px 16px;

    border-radius: 14px;

    margin-bottom: 22px;

    font-size: 14px;

    line-height: 1.6;
}

.message.success {

    color: #86efac;

    background:
        rgba(34,197,94,.10);

    border:
        1px solid
        rgba(34,197,94,.30);
}

.message.error {

    color: #fca5a5;

    background:
        rgba(239,68,68,.10);

    border:
        1px solid
        rgba(239,68,68,.30);
}

label {

    display: block;

    margin-bottom: 9px;

    color: #e2e8f0;

    font-size: 14px;

    font-weight: 600;
}

.input-box {

    margin-bottom: 20px;
}

.input-box input {

    width: 100%;

    height: 58px;

    padding:
        0 18px;

    border-radius: 16px;

    border:
        1px solid
        rgba(255,255,255,.15);

    outline: none;

    background:
        rgba(15,23,42,.75);

    color: white;

    font-size: 16px;
}

.input-box input:focus {

    border-color:
        #8b5cf6;

    box-shadow:
        0 0 0 4px
        rgba(139,92,246,.12);
}

.main-button {

    width: 100%;

    height: 58px;

    border: none;

    border-radius: 16px;

    cursor: pointer;

    color: white;

    font-size: 15px;

    font-weight: 700;

    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #06b6d4
        );

    box-shadow:
        0 15px 35px
        rgba(124,58,237,.30);

    transition: .25s;
}

.main-button:hover {

    transform:
        translateY(-3px);
}

.main-button:disabled {

    opacity: .6;

    cursor: not-allowed;
}

.verified-box {

    padding: 22px;

    margin-bottom: 22px;

    border-radius: 20px;

    background:
        rgba(34,197,94,.07);

    border:
        1px solid
        rgba(34,197,94,.23);
}

.verified-icon {

    width: 58px;
    height: 58px;

    margin:
        0 auto 12px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 28px;

    color: #86efac;

    background:
        rgba(34,197,94,.18);
}

.verified-title {

    text-align: center;

    color: #86efac;

    font-weight: 700;

    font-size: 17px;

    margin-bottom: 10px;
}

.verified-email {

    text-align: center;

    color: #cbd5e1;

    font-size: 13px;

    line-height: 1.7;
}

.verified-email strong {

    color: white;
}

.reset-demo {

    margin-top: 22px;

    padding: 17px;

    border-radius: 16px;

    background:
        rgba(245,158,11,.08);

    border:
        1px solid
        rgba(245,158,11,.28);

    color: #fcd34d;

    font-size: 13px;

    line-height: 1.7;

    word-break: break-word;
}

.reset-demo strong {

    display: block;

    color: #fde68a;

    margin-bottom: 8px;
}

.reset-demo a {

    color: #fff;

    font-weight: 600;

    text-decoration: none;
}

.start-again {

    width: 100%;

    margin-top: 12px;

    padding: 12px;

    border-radius: 12px;

    border:
        1px solid
        rgba(255,255,255,.12);

    background:
        rgba(255,255,255,.05);

    color: #cbd5e1;

    cursor: pointer;
}

.back {

    display: block;

    text-align: center;

    margin-top: 25px;

    color: #c4b5fd;

    text-decoration: none;

    font-size: 14px;
}

.security {

    margin-top: 25px;

    padding-top: 20px;

    border-top:
        1px solid
        rgba(255,255,255,.10);

    text-align: center;

    color: #94a3b8;

    font-size: 12px;

    line-height: 1.7;
}

@media(max-width:520px) {

    body {
        padding: 15px;
    }

    .card {
        padding: 32px 22px;
        border-radius: 24px;
    }

    h1 {
        font-size: 26px;
    }

    .icon {
        width: 75px;
        height: 75px;
        font-size: 34px;
    }

    .line {
        width: 40px;
    }
}

</style>

</head>

<body>

<div class="orb orb1"></div>
<div class="orb orb2"></div>

<div class="container">

<div class="card">

<div class="icon">

<?php

if ($student_verified) {
    echo "📧";
} elseif ($development_reset_link !== "") {
    echo "🔗";
} else {
    echo "🔐";
}

?>

</div>


<h1>

<?php

if ($student_verified) {

    echo "Student Verified";

} elseif ($development_reset_link !== "") {

    echo "Reset Link Created";

} else {

    echo "Forgot Password?";

}

?>

</h1>


<p class="subtitle">

<?php

if ($student_verified) {

    echo
        "Your register number has been verified. " .
        "Create a secure password reset request.";

} elseif ($development_reset_link !== "") {

    echo
        "Your password reset link is ready for localhost testing.";

} else {

    echo
        "Enter your registered student register number " .
        "to reset your password.";

}

?>

</p>


<div class="steps">

<div class="step active">1</div>

<div class="line
<?= $student_verified || $development_reset_link !== ""
    ? "active"
    : "" ?>">
</div>

<div class="step
<?= $student_verified || $development_reset_link !== ""
    ? "active"
    : "" ?>">
2
</div>

<div class="line
<?= $development_reset_link !== ""
    ? "active"
    : "" ?>">
</div>

<div class="step
<?= $development_reset_link !== ""
    ? "active"
    : "" ?>">
3
</div>

</div>


<?php if ($message !== ""): ?>

<div class="message <?= htmlspecialchars($message_type) ?>">

<?= htmlspecialchars($message) ?>

</div>

<?php endif; ?>


<?php if (!$student_verified && $development_reset_link === ""): ?>


<form
    method="POST"
    id="verifyForm"
    autocomplete="off"
>

<input
    type="hidden"
    name="action"
    value="verify_register"
>

<label for="register_no">
    Student Register Number
</label>

<div class="input-box">

<input
    type="text"
    id="register_no"
    name="register_no"
    placeholder="Example: 22CS001"
    maxlength="50"
    required
    autocomplete="off"
    autofocus
>

</div>

<button
    type="submit"
    class="main-button"
    id="verifyButton"
>

🔍 Verify Register Number

</button>

</form>


<?php elseif ($student_verified): ?>


<div class="verified-box">

<div class="verified-icon">
✓
</div>

<div class="verified-title">
Register Number Verified
</div>

<div class="verified-email">

Register Number:

<br>

<strong>
<?= htmlspecialchars($register_no) ?>
</strong>

<br><br>

Reset link will be created for:

<br>

<strong>
<?= htmlspecialchars($masked_email) ?>
</strong>

</div>

</div>


<form
    method="POST"
    id="sendForm"
>

<input
    type="hidden"
    name="action"
    value="send_reset"
>

<button
    type="submit"
    class="main-button"
    id="sendButton"
>

🔐 Create Password Reset Link

</button>

</form>


<form method="POST">

<input
    type="hidden"
    name="action"
    value="start_again"
>

<button
    type="submit"
    class="start-again"
>

↩ Use Another Register Number

</button>

</form>


<?php endif; ?>


<?php if ($development_reset_link !== ""): ?>

<div class="reset-demo">

<strong>
🛠 Localhost Development Reset Link
</strong>

Your XAMPP installation is not required to have SMTP configured.

Open this link to continue:

<br><br>

<a
    href="<?= htmlspecialchars($development_reset_link) ?>"
>

<?= htmlspecialchars($development_reset_link) ?>

</a>

</div>

<?php endif; ?>


<a
    href="login.php"
    class="back"
>
← Back to Login
</a>


<div class="security">

🔒 Register number verification required

<br>

🔐 Secure random reset token

<br>

⏱ Token expires after 30 minutes

</div>

</div>

</div>


<script>

const registerInput =
    document.getElementById("register_no");

const verifyForm =
    document.getElementById("verifyForm");

if (registerInput) {

    registerInput.addEventListener(
        "input",
        function () {

            this.value =
                this.value
                .replace(/\s+/g, "")
                .toUpperCase();

        }
    );
}

if (verifyForm) {

    verifyForm.addEventListener(
        "submit",
        function () {

            const button =
                document.getElementById(
                    "verifyButton"
                );

            button.disabled = true;

            button.innerHTML =
                "⏳ Verifying...";

        }
    );
}

const sendForm =
    document.getElementById("sendForm");

if (sendForm) {

    sendForm.addEventListener(
        "submit",
        function () {

            const button =
                document.getElementById(
                    "sendButton"
                );

            button.disabled = true;

            button.innerHTML =
                "⏳ Creating Secure Link...";

        }
    );
}

</script>

</body>

</html>