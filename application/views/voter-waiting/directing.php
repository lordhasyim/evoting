

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
                                    <h3 align="center" class="text-success">Tersedia</h3>
                                    <p align="center">
                                        <?php echo anchor("choosing-booth/$voter_id/".$item['booth_id'], 'Pilih', "class='btn btn-success'")?>
                                    </p>
                                <?php } else { ?>
                                    <h3 align="center"><?php echo $item['name'];?></h3>
                                    <h4 align="center"><?php echo $item['identity'];?></h4>
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

<script>
    setInterval(function(){ $('.refresh-data').trigger('click'); },10000);
</script>

