

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> PIlih Bilik</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <?php foreach($data as $item):?>
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $item['title'];?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php  if($item['voter_id'] === null) { ?>
									<div id="tersedia-<?php echo $item['booth_id'] ?>">
										<h3 align="center" class="text-success">Tersedia</h3>
										<p align="center">
											<?php echo anchor("choosing-booth/$voter_id/".$item['booth_id'], 'Pilih', "class='btn btn-success'")?>
										</p>
									</div>
									<div id="informasi-<?php echo $item['booth_id'] ?>" style="display:none">
										<h3 align="center" id="booth-<?php echo $item['booth_id'] ?>-name-<?php echo $item['name'] ?>"><?php echo $item['name'];?></h3>
										<h4 align="center" id="booth-<?php echo $item['booth_id'] ?>-<?php echo $item['identity'] ?>"><?php echo $item['identity'];?></h4>
									</div>
                                <?php } else { ?>
									
									<div id="tersedia-<?php echo $item['booth_id'] ?>" style="display:none">
										<h3 align="center" class="text-success">Tersedia</h3>
										<p align="center">
											<?php echo anchor("choosing-booth/$voter_id/".$item['booth_id'], 'Pilih', "class='btn btn-success'")?>
										</p>
									</div>
									<div id="informasi-<?php echo $item['booth_id'] ?>">
										<h3 align="center" id="booth-<?php echo $item['booth_id'] ?>-<?php echo $item['name'] ?>"><?php echo $item['name'];?></h3>
										<h4 align="center" id="booth-<?php echo $item['booth_id'] ?>-<?php echo $item['identity'] ?>"><?php echo $item['identity'];?></h4>
									</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- /.row -->
</div>
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.10.2.js"); ?>"></script>

<script>
    <?php foreach($data as $booth):?>
    setInterval(function() {
        $.getJSON( "<?php echo base_url("dashboard/booth/".$booth['booth_id']); ?>", function( data ) {
            if(data == null) {
				$("#tersedia-<?php echo $booth['booth_id'] ?>").show();
				$("#informasi-<?php echo $booth['booth_id'] ?>").hide();
				
                $("#booth-<?php echo $booth['booth_id'] ?>-<?php echo $booth['name'] ?>").html("-");
                $("#booth-<?php echo $booth['booth_id'] ?>-<?php echo $booth['identity'] ?>").html("-");
            } else {
				$("#tersedia-<?php echo $booth['booth_id'] ?>").hide();
				$("#informasi-<?php echo $booth['booth_id'] ?>").show();
				
                $("#booth-name-<?php echo $booth['booth_id'] ?>-<?php echo $booth['name'] ?>").html(data.name);
                $("#booth-name-<?php echo $booth['booth_id'] ?>-<?php echo $booth['identity'] ?>").html(data.identity);
                $("#booth-identity-<?php echo $booth['booth_id'] ?>-<?php echo $booth['identity'] ?>").html(data.identity);
			}
        });

    }, 8000);
    <?php endforeach; ?>

</script>

