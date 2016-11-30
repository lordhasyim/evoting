<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMILA - Fakultas Teknologi Pertanian</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/vote.css"); ?>">
</head>
<body>
<div class="margin-base-vertical">
    <div class="container">

        <div class="col-md-12">
            <div class="col-md-2">
                <img src="<?php echo base_url('assets/img/logo_ftp.png') ; ?>" class="img-cirle" height="100" width="100" alt="">

            </div>
            <div class="col-md-8">
                <h1 class="text-center"><?php echo $data->event_name ?></h1>

            </div>
            <div class="col-md-2">
                <img src="<?php echo base_url('assets/img/logo_ftp.png') ; ?>" class="img-cirle" height="100" width="100" alt="">
            </div>
            <h2 class="text-danger" style="display:none;">waktu <span id="counter" ></span></h2>
<!--            <div class="col-md-2 pull-right">-->
<!---->
<!--                -->
<!--            </div>-->

        </div>
    </div>
    <div class="margin-base-vertical">
        <div class="container">
            <h1 class="text-center">Selamat Datang Pemilih</h1>
            <h2 class="text-center"><?php echo $data->name ?></h2>
            <h2 class="text-center"><?php echo $data->identity ?></h2>
            <h3 class="text-center">
                Tekan <b>Enter</b>
                <img src="<?php echo base_url('assets/img/enter.png') ; ?>" width="40px" height="40px" alt="">
                Untuk Masuk membuka kotak suara</h3>
            <p class="text-center">

                <!--   <input type="text" name="search" id="searchinput" onkeydown="if (event.keyCode == 13) handleButtonClick()" autofocus="true"> -->
                <a href="<?php echo base_url('section-vote/'.$data->voter_id) ; ?>" id="enter" class="btn btn-primary btn-lg" > Buka Kotak Suara</a>
            </p>
        </div>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.10.2.js"); ?>"></script>
<!-- Bootstrap JavaScript -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#enter').focus();

        function check() {
            $.getJSON( "<?php echo base_url("Vote/check"); ?>", function( data ) {
                if(data.status == false)
                    window.location = "<?php echo base_url('vote-waiting') ; ?>";
            });

            setTimeout(check, 2000);
        }

        function countDown(){
            var seconds = <?php echo $data->event_timer; ?>;

            function tick(){
                var counter = document.getElementById("counter");
                seconds--;
                counter.innerHTML= "0:"+ (seconds < 10 ? "0" : "")+String(seconds);
                if (seconds > 0) {
                    setTimeout(tick, 1000);
                } else {
                    window.location = "<?php echo base_url('section-vote/'.$data->voter_id) ; ?>";
                }
            }
            tick();
        }

        check();
        countDown();

    });


    $(document).bind("contextmenu",function(e) {
        e.preventDefault();
    });
</script>
</body>
</html>
