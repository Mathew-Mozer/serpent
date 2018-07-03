<?php
/**
 * Author: Chris Barbour
 *
 *
 */

?>
<div id="use-template-prompt">
    <button type='button' id='scratch-promotion-btn'>Create New</button>
    <p style="newpromo-title">Template Gallery</p>
    <br>
    <div id="template-tabs">
        <ul>
            <li><a href="#tabs-2">My Templates</a></li>
            <li><a href="#tabs-1">Global Templates</a></li>
        </ul>
        <div id="tabs-2">
            <p><div id="select-template">
                <label for="template-options">Select Template </label>
                <div id="promo-templates" style="width: 50%">

                </div>
                <br>
            </div>
            </p>
        </div>
        <div id="tabs-1">
            <p>Currently There are no Templates to use.</p>
        </div>
    </div>
</div>

<div id="save-template-prompt">

</div>

<div id="template-data" hidden>
    <input type="text" id="template-name" name="template-name">
    <label for="template-name">Template Name</label>
    <br>
    <br>
    <br>
</div>
<script>
    $( function() {
        $( "#template-tabs" ).tabs();
    } );
</script>
