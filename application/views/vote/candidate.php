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
<div class="wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-2">
                <img src="<?php echo base_url('assets/img/logo_ftp.png') ; ?>" class="img-cirle" height="100" width="100" alt="">

            </div>
            <div class="col-md-6">
                <h1 class="text-center"><?php echo $data->title; ?></h1>
                <h3 class="text-center"><?php echo $data->note; ?></h3>

            </div>
            <div class="col-md-2">
                <img src="<?php echo base_url('assets/img/logo_ftp.png') ; ?>" class="img-cirle" height="100" width="100" alt="">
            </div>
            <div class="col-md-2 pull-right">

                <h2 class="text-danger">waktu <span id="counter" ></span></h2>
            </div>

        </div>
    </div>
    <div class="container bg">
        <div class="row">

            <?php $i = count($items); ?>

            <?php foreach($items as $item):?>
                <?php if ($i%3 ==  0) {?>
                        <div class="col-md-2">
                <?php }else { ?>
                        <div class="col-md-6">
                <?php }?>
                    <div class="rlisting">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h1 class="text-center"> <b> <?php echo $item->serial_number ?> </b> </h1></div>
                            <div class="panel-body">
                                <div class="col-md-12 nopad">
                                    <a href="<?php echo base_url('vote/'.$item->voting_id.'/'.$item->candidate_id) ; ?>" onclick="confirmVote(this);return false;">
                                        <img src="<?php echo base_url('assets/uploads/files/'.$item->picture) ; ?>" class="img-responsive" height="250" width="250">
                                    </a>
                                </div>
                                <div class="col-md-12 nopad">
                                    <h3 class="text-center text-success"><?php echo $item->name ?></h3>
                                    <a href="<?php echo base_url('vote/'.$data->voting_id.'/'.$item->candidate_id) ; ?>" id="enter" class="btn btn-block btn-primary" onclick="confirmVote(this);return false;"> Pilih</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.10.2.js"); ?>"></script>

<script type="text/javascript">

    $(document).ready(function() {

        function confirmVote(a) {
            var r = confirm("Apakah kamu yakin dengan pilihanmu?");
            if (r == true) {
                window.location = a.href;
            }
        }

        function countDown(){
            var seconds = <?php echo $data->timer; ?>;

            function tick(){
                var counter = document.getElementById("counter");
                seconds--;
                counter.innerHTML= "0:"+ (seconds < 10 ? "0" : "")+String(seconds);
                if (seconds > 0) {
                    setTimeout(tick, 1000);
                } else {
                    alert("waktu anda habis");
                    window.location = "<?php echo base_url('vote/'.$data->voting_id) ; ?>";
                }
            }
            tick();
        }

        function check() {
            $.getJSON( "<?php echo base_url("Vote/check"); ?>", function( data ) {
                if(data.status == false)
                    window.location = "<?php echo base_url('vote-waiting') ; ?>";
            });


            setTimeout(check, 2000);
        }
        countDown();
        check();

    });

    $(document).bind("contextmenu",function(e) {
        e.preventDefault();
    });

</script>

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.10.2.js"); ?>"></script>
<!-- Bootstrap JavaScript -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.js"); ?>"></script>

</body>
</html>
