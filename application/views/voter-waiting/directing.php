
<?php

    foreach($data as $item) {

        echo "booth_id".$item['booth_id'].'<br>';
        echo "title".$item['title'].'<br>';
        echo "voter_id".$item['voter_id'].'<br>';
        echo "identity".$item['identity'].'<br>';
        echo "name".$item['name'].'<br>';
        ?>

        <?php if($item['voter_id'] === null); ?>
            <?php echo anchor('choosing-booth/'.$voter_id.'/'.$item['booth_id'], 'pilih', "class='btn btn-link'")?>
<?php
    } ?>