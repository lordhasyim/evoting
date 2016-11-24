<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>">
    <style>
        /*    .wrapper {
        margin-top: 40px;
        margin-bottom: 80px;
        } */

        /* Override B3 .panel adding a subtly transparent background */
        body {

            color:#FFFFFF;
        }
        .panel {
            background-color: rgba(255, 255, 255, 0.9);
        }
        .margin-base-vertical {
            margin: 40px 0;
        }
        body::before{
            background: url(bg.jpg) no-repeat center center fixed;
            content: '';
            z-index: -1;
            width: 100%;
            height: 100%;
            position:absolute;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            -webkit-filter: blur(5px);
            -moz-filter: blur(5px);
            -o-filter: blur(5px);
            -ms-filter: blur(5px);
            filter: blur(5px);
        }
    </style>
</head>
<body>
<div class="margin-base-vertical">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-2 text-center">
                <img src="<?php echo base_url('assets/vote-candidate/logo_ftp.jpg') ; ?>" class="img-cirle" height="100px" width="100px" alt="">
            </div>
            <div class="col-md-8">
                <h1 class="text-center">Pemilihan Calon Ketua DPM</h1>
                <h3 class="text-center">Fakultas Teknologi Pertanian Universitas Brawijaya </h3>
            </div>
            <div class="col-md-2 text-center">
                <img src="logo.jpg" class="img-cirle" height="100px" width="100px" alt="">
            </div>
        </div>
    </div>
    <div class="margin-base-vertical">
        <div class="container">
            <h1 class="text-center">Selamat Datang Pemilih</h1>
            <h2 class="text-center">Kholiquer Rizki</h2>
            <h2 class="text-center">098766712647123819</h2>
            <h3 class="text-center">
                Tekan <b>Enter</b>
                <img src="enter.png" width="40px" height="40px" alt="">
                Untuk Masuk membuka kotak suara</h3>
            <p class="text-center">

                <!--   <input type="text" name="search" id="searchinput" onkeydown="if (event.keyCode == 13) handleButtonClick()" autofocus="true"> -->
                <a href="pilih_calon_bem.html" class="btn btn-primary btn-lg" > Buka Kotak Suara</a>
            </p>
        </div>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.10.2.js"); ?>"></script>
<!-- Bootstrap JavaScript -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.js"); ?>"></script>
<script type="text/javascript">
    function handleButtonClick() {
        window.location="pilih_calon_bem.html";
    }
</script>
</body>
</html>
