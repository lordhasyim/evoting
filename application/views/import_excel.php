<?php
/**
 * Created by PhpStorm.
 * User: Hasyim
 * Date: 10/11/2016
 * Time: 10.46
 */

?>
<div style="margin-top:20px"></div>
<form action="<?php echo current_url();?>" method="post" enctype="multipart/form-data">
    <input type="file" name="filename">
    <input type="submit" name="submit" value="upload file">
</form>