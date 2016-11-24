<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Counter Bilik</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>"/><!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body>
<div class="container">
    <style>
        /*@import "bourbon";*/
        body {
            font-weight: bold !important;
            background: #eee !important;
            font-size: 50px;
        }

        .wrapper {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .form-signin {
            max-width: 680px;
            padding: 25px 45px 55px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);

        .form-signin-heading, .checkbox {
            margin-bottom: 30px;
        }

        }
        div {
            font-family: Verdana;
            font-weight: 100;
            -webkit-font-smoothing: antialiased;
        }

        .h1, h1 {
            font-size: 120px;
        }

        .h2, h2 {
            font-size: 80px;
        }

    </style>
    <div class="text-center">
        <div class="wrapper">
            <h2>Antrian Bilik</h2>
            <h1><?php echo $data['name'] ?></h1>
            <h1><?php echo $data['identity'] ?></h1>
            <div>
                <h1>ke Bilik </h1>
                <h1 class="text-danger"> <?php echo $data['title'] ?> </h1>
            </div>
        </div>
    </div>
</div>