<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calon Ketua BEM</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>">
    <style>
        .panel-default {
            border-color: #dddddd !important;
        }
        .rwrapper{
            padding: 5px;
        }
        .rlisting{
            background-color: #fff;overflow: hidden;
        }
        .rlisting img{
            width: 100%;
        }
        .nopad{
            padding:0;
        }
        .rfooter{
            background: #f1f3f5;border-top: 1px #ebebeb solid;width: 100%;padding:10px 15px;
        }

        .rlisting h5,.rlisting p{
            padding:0 15px;
        }

        .wrapper {
            margin-top: 25px;
        }


    </style>

</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-2">
                <img src="logo.jpg" class="img-cirle" height="100" width="100" alt="">

            </div>
            <div class="col-md-6">
                <h1 class="text-center">Pemilihan Calon Ketua BEM</h1>
                <h3 class="text-center">Fakultas Teknologi Pertanian Universitas Brawijaya </h3>

            </div>
            <div class="col-md-2">
                <img src="logo.jpg" class="img-cirle" height="100" width="100" alt="">
            </div>
            <div class="col-md-2 pull-right">

                <h2 class="text-danger">waktu <span id="counter" >1:00</span></h2>
            </div>

        </div>
    </div>
    <script src="Hello World"></script>
    <div class="container bg">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 rwrapper">
                <div class="rlisting">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h1 class="text-center"> <b> 1 </b> </h1></div>
                        <div class="panel-body">
                            <div class="col-md-12 nopad">
                                <img src="leonardo.jpg" class="img-responsive" height="250" width="250">
                            </div>
                            <div class="col-md-12 nopad">
                                <h3 class="text-center">Nama Lengkap</h3>
                                <input type="submit" class="btn btn-block btn-primary" name="btnPilihKetua" value="Pilih">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 rwrapper">
                <div class="rlisting">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h1 class="text-center"><b> 2 </b></h1></div>
                        <div class="panel-body">
                            <div class="col-md-12 nopad">
                                <img src="leonardo.jpg" class="img-responsive" height="250" width="250">
                            </div>
                            <div class="col-md-12 nopad">
                                <h3 class="text-center ">Nama Lengkap</h3>
                                <input type="submit" class="btn btn-block btn-primary" name="btnPilihKetua" value="Pilih">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 rwrapper">
                <div class="rlisting">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h1 class="text-center"> <b> 3 </b> </h1></div>
                        <div class="panel-body">
                            <div class="col-md-12 nopad">
                                <img src="leonardo.jpg" class="img-responsive" height="250" width="250">
                            </div>
                            <div class="col-md-12 nopad">
                                <h3 class="text-center">Nama Lengkap</h3>
                                <input type="submit" class="btn btn-block btn-primary" name="btnPilihKetua" value="Pilih">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 rwrapper">
                <div class="rlisting">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h1 class="text-center"> <b> 4 </b> </h1></div>
                        <div class="panel-body">
                            <div class="col-md-12 nopad">
                                <img src="leonardo.jpg" class="img-responsive" height="250" width="250">
                            </div>
                            <div class="col-md-12 nopad">
                                <h3 class="text-center">Nama Lengkap</h3>
                                <input type="submit" class="btn btn-block btn-primary" name="btnPilihKetua" value="Pilih">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function countDown(){
        var seconds = 60;

        function tick(){
            var counter = document.getElementById("counter");
            seconds--;
            counter.innerHTML= "0:"+ (seconds < 10 ? "0" : "")+String(seconds);
            if (seconds > 0) {
                setTimeout(tick, 1000);
            } else {
                alert("waktu anda habis");
            }
        }
        tick();
    }
    countDown();

</script>
<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.10.2.js"); ?>"></script>
<!-- Bootstrap JavaScript -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.js"); ?>"></script>

</body>
</html>
