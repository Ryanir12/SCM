<?php
session_start();
include "koneksi/koneksi.php";

if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
    header("location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Halaman Login</title>
    <!-- Favicon-->
    <link rel="icon" href="images/Fusionlabs_Logo.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="css/assets/satu.css" rel="stylesheet" type="text/css">
    <link href="css/assets/dua.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/newstyle.css" rel="stylesheet">

    <style>
        .bg-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }

        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Overlay hitam transparan */
            z-index: -1;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 100%;
            height: auto;
            max-width: 200px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }
        }

        body {
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-box {
            width: 360px;
            margin: 80px auto;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.2);
            /* putih transparan */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            padding: 20px;
            backdrop-filter: blur(8px);
            /* efek blur belakang */
            -webkit-backdrop-filter: blur(8px);
            /* untuk Safari */
        }

        .logo-container img {
            width: 150px;
            display: block;
            margin: 0 auto 20px auto;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.5);
            /* input transparan */
            border: none;
            color: #000;
        }

        .form-line {
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }

        .btn {
            background-color: rgba(0, 123, 255, 0.8);
            /* tombol transparan */
            border: none;
        }

        .btn:hover {
            background-color: rgba(0, 123, 255, 1);
        }

        .msg {
            color: white;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Ubah warna teks dan placeholder input jadi putih */
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        /* Placeholder putih */
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body class="login-page">
    <video autoplay muted loop class="bg-video">
        <source src="video/27725-365890983_tiny.mp4" type="video/mp4">
    </video>
    <div class="bg-overlay"></div>
    <div class="login-box">

        <div class="card">
            <div class="logo-container">
                <img src="images/ChatGPT_Image_20_Apr_2025__14.09.51-removebg-preview.png" alt="Waber Logo">
            </div>
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Masukkan Username dan Password </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="submit" name="login" class="btn btn-primary btn-user btn-block" value="LOGIN" />
                        </div>
                    </div>
                </form>

                <?php
                if (isset($_POST['login'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $sql = $koneksi->query("SELECT * FROM tb_user WHERE user_id='$username' AND pass='$password' AND status='Aktif'");
                    $rows = $sql->num_rows;
                    $data = $sql->fetch_assoc();

                    if ($rows >= 1) {
                        $_SESSION['username'] = $data['user_id'];
                        $_SESSION['level'] = $data['level'];

                        switch ($data['level']) {
                            case 'admin':
                                $_SESSION['admin'] = $data['id'];
                                break;
                            case 'kasir':
                                $_SESSION['kasir'] = $data['id'];
                                break;
                            case 'pimpinan':
                                $_SESSION['pimpinan'] = $data['id'];
                                break;
                            case 'supplier':
                                $_SESSION['supplier'] = $data['id'];
                                break;
                            default:
                                break;
                        }

                        header("location:index.php");
                        exit;
                    } else {
                        echo "<script>alert('Login Gagal! Username dan Password Salah atau akun Anda sudah diblokir. Silakan hubungi Admin.');</script>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>