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
            <div class="col-md-2 text-center">
                <img src="<?php echo base_url('assets/img/logo_ftp.png') ; ?>" class="img-cirle" height="100px" width="100px" alt="">
            </div>
            <div class="col-md-8">
                <h1 class="text-center">Pemilihan Calon Ketua DPM</h1>
                <h3 class="text-center">Fakultas Teknologi Pertanian Universitas Brawijaya </h3>
            </div>
            <div class="col-md-2 text-center">
                <img src="<?php echo base_url('assets/img/logo_ftp.png') ; ?>" class="img-cirle" height="100px" width="100px" alt="">
            </div>
        </div>
    </div>
    <div class="margin-base-vertical">
        <div class="container">
            <h1 class="text-center">Terima kasih</h1>
        </div>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.10.2.js"); ?>"></script>
<!-- Bootstrap JavaScript -->
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function check() {
            $.getJSON( "<?php echo base_url("vote/check"); ?>", function( data ) {
                if(data.status == true)
                    window.location = "<?php echo base_url('vote') ; ?>";
            });

            setTimeout(check, 2000);
        }
        check();
    });
</script>
</body>
</html>
