

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Pilih Bilik</h1>
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
                                <h3 align="center"><?php echo $item['name'];?></h3>
                                <h4 align="center"><?php echo $item['identity'];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- /.row -->
</div>