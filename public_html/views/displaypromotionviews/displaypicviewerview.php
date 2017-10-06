<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 5/25/2017
 * Time: 4:18 AM
 */
?>
<label id="lblResponse"></label><br>
Step 1:<input id="fileToUpload" type="file" name="uploadfile"/>
<br>
Step 2:<br>
<button id="uploadfile">Upload</button>


<div id="PictureList">

</div>
<script>
loadPictures($("#promotion-view-modal").data('promo-id'));
</script>