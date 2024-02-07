<?php
session_start();
require_once 'config/koneksi.php';
require_once 'function.php';

$isAlert = false;
$isOldInput = false;
if(isset($_SESSION['alert'])) {
    $isAlert = !$_SESSION['alert-shown'];
    extract($_SESSION['alert']);
}

if(isset($_SESSION['oldinput'])) {
    $isOldInput = true;
    extract($_SESSION['oldinput']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silahkan login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
    body {
        font-family: "Poppins", sans-serif;
    }

    .text-sm {
        font-size: 14px;
    }

    .text-xs {
        font-size: 12px;
    }

    .bg-body-gray {
        background-color: var(--bs-gray-100);
    }

    .login-container {
        width: 360px;
        max-width: 100%;
    }

    .withoutAlert {
        margin-top: 4rem;
    }

    .alert-regular-size {
        max-width: 800px;
    }

    .alert-regular-size>.alert-space {
        margin-top: 1rem;
    }

    .withAlert {
        margin-top: 2rem;
    }

    .bi {
        width: 1em;
        height: 1em;
        vertical-align: -0.125em;
        fill: currentColor;
    }
    </style>
</head>

<body class="bg-light">
    <?php
        if($isAlert) {
            include("svg-icon.php");
            echo '<div class="container alert-regular-size">';
            showAlert($alertType,$alertMessage);
            echo '</div>';
        }
    ?>
    <div class="row justify-content-center">
        <div class="login-container <?= $isAlert ? 'withAlert' : 'withoutAlert' ?>">
            <div class="col-md-12">
                <h4 class="text-center mb-3">Silahkan login!</h4>
                <form class="bg-white border shadow-sm p-3" action="cekLogin.php" method="POST">
                    <div class="row">
                        <div class="mb-2 col-md-12">
                            <label class="form-label text-sm" for="">nim</label>
                            <input class="input form-control form-control-sm" type="text"
                                value="<?= $isOldInput ? $nim : null ?>" name="nim" placeholder="220XXXXX" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label text-sm" for="">password</label>
                            <div class="input-group">
                                <input type="password" id="inputPass" class="form-control form-control-sm"
                                    name="password" placeholder="xxxxx" required>
                                <span onclick="switchPass()" class="input-group-text"><i id="eyecon"
                                        class="bi bi-eye-fill"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"><a class="text-xs" href="">Lupa password</a></div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    const debuger = () => {
        console.log("it works");
    }
    const switchPass = () => {
        const input = document.getElementById("inputPass");
        const eyecon = document.getElementById("eyecon");
        const classShow = "bi bi-eye-slash-fill";
        const classHide = "bi bi-eye-fill";

        if (input.type === "password") {
            input.type = "text";
            eyecon.setAttribute("class", classShow);
        } else if (input.type === "text") {
            input.type = "password";
            eyecon.setAttribute("class", classHide);
        }
    }
    </script>
    <!-- index.php?nim=123&nama=tono -->
</body>

</html>