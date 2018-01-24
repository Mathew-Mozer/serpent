<?php
/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 12/13/2017
 * Time: 8:25 AM
 */
?>
<style>

</style>
ChimeraTV Settings
<table class="table table-striped">
    <thead>
    <td colspan="2">Upload New APK</td>
    </thead>
    <tr>
        <td><label id="lblResponse">Ready</label><br>
            <select id="folder" name="folder">
                <option value="ChimeraTV">ChimeraTV</option>
                <option value="Home">Home</option>
            </select><br>Version:<input type="text" value="" id="fileversion" name="version"> </td><td>
            <input id="apkUploadFile" type="file" name="uploadfile"/><button id="apkUpload">Save</button>
        </td>
    </tr>

    <thead>
    <td>ChimeraTV</td>
    <td>ChimeraTV Home</td>
    </thead>
    <tr>
        <td>
            <table id="chimeraTVFiles" class="table table-striped">

            </table>
        </td>
        <td>
            <table id="chimeraTVHomeFiles" class="table table-striped">

            </table>
        </td>
    </tr>
</table>

<!-- start item template -->
<script type="text/html" id="fileTemplate">
    <tr>
        <td data-content-text="Filename">&nbsp;</td>
        <td data-content-text="Version">&nbsp;</td>
    </tr>
</script>

<script>
    var chimeraTVFile = firebase.database().ref('Files/ChimeraTV');

    chimeraTVFile.orderByChild("TimeStamp").on('value', function (snapshot) {
        fileArray = [];
        snapshot.forEach(function (userSnapshot) {
            curFile = JSON.parse(JSON.stringify(userSnapshot));
            addToFileList(curFile.Filename, curFile.Version, "None");
        });
        $("#chimeraTVFiles").loadTemplate($('#fileTemplate'), fileArray, {append: false});
    });
    function addToFileList(filename, version, changes) {
        fileArray.push({
            Filename: filename,
            Version: version,
            Changes: changes
        });
        ;
    }








</script>
<!-- end Template -->