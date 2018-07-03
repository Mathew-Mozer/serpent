<?php
/**
 * This is the update kick for cash form
 */
?>

<div id="add-promotion" data-promo-id="<?php echo($_POST['promoid']) ?>">
    <div id="listdisplaydiv" style="height: 400px; width: 400px; overflow: auto">
        <table class="table">
            <thead>
            <tr>
                <td>Name</td>
                <td>Secondary Data</td>
                <td></td>
            </tr>
            </thead>
            <tbody id="playerlist">

            </tbody>
        </table>
    </div>
    <div>
        <table>
            <tr><td><input type="text" id="dldAddName" placeholder="Name"></td><td><input type="text" id="dldAddData1" placeholder="Other Data"></td><td><button type="button"class="btn btn-sm btn-primary" id="addToListDisplay">Add</button> </td></tr>
        </table>
    </div>
</div>
<script type="text/html" id="playerTemplate">
    <tr>
        <td data-content-text="Name"></td>
        <td data-content-text="Other"></td>
        <td style="display: block;margin: auto;">
            <button data-template-bind='[{"attribute": "data-id", "value": "id"}]' id=""
                    type="button" class="close deleteListItem">&times;
            </button>
        </td>
    </tr>
</script>
<script src="dependencies/js/promotion/formhelperfunctions.js"></script>
<script>
    getModalData($("#promotion-view-modal").data('promo-id'), 11);
    var enableFP = function () {
        getListData()
    }
</script>
