/**
 * Update Promotion by ID
 * @param promotionId
 * @param promotionTypeId
 * @param accountId
 */
var updatePlayer = function (promotionId, promotionTypeId, accountId) {
    var data = getFormData('add-promotion');
    data['action'] = 'update';
    data['update_player']= 'true';
    data['promotionTypeId'] = promotionTypeId;
    data['promotionId'] = promotionId;
    data['accountId'] = accountId;
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: data,
        cache: false,
        Update: function (response) {
            alert(response);
        },
        error: function (xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};


