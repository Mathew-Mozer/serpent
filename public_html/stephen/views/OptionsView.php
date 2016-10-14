<?php
    include('/home/casino/public_html/modals/OptionsModal.php');

    $optionsModal = new OptionsModal(1);
    $options = $optionsModal->getPromotionSettings();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings View</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
         dialog = $("#settings").dialog({
                autoOpen: true,
                height: 400,
                width: 350,
                modal: true,
                buttons: {
                    Submit: function () {
                        //submit changes to
                        dialog.dialog('close');
                    }
                }
            });
        } );
    </script>
</head>
<body>
    <div id="settings" title="Settings">
        <?php
            foreach ($options as $setting => $value){
                echo $setting . " = " . $value . "<br>";
            }
        ?>
    </div>
</body>

