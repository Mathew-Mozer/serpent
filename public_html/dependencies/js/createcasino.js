//Construct the create casino modal
var createCasinoModal = $('#createCasino').dialog({
    autoOpen: false,
    height: 610,
    width: 350,
    modal: true,
    buttons: {
        Submit: function () {
            createCasino();
            createCasinoModal.dialog('close');
        }
    }
});

//Generate fields for initial casino properties
var createCasino = function () {
    var casinoName = $('#casinoName').val();
    var parentCompany = $('#parentCompany').val();
    var assetBundleUrl = $('#assetBundleUrl').val();
    var assetBundleWindows = $('#assetBundleWindows').val();
    var assetName = $('#assetName').val();
    var defaultSkin = $('#defaultSkin').val();
    var defaultLogo = $('#defaultLogo').val();
    var supportGroup = $('#supportGroup').val();
    var businessOpen = $('#businessHoursOpen').val();
    var businessClose = $('#businessHoursClose').val();

    $.ajax({
        url: 'controllers/toolbarcontroller.php',
        type: 'post',
        data: {
            casinoName: casinoName, parentCompany: parentCompany, assetBundleUrl: assetBundleUrl,
            assetBundleWindows: assetBundleWindows, assetName: assetName, defaultSkin: defaultSkin,
            defaultLogo: defaultLogo, supportGroup: supportGroup, businessOpen: businessOpen,
            businessClose: businessClose
        },
        cache: false,
        success: function (json) {
            var result = JSON.parse(json);
            if (result.error === 'none') {
                alert("Casino Created!");
            } else {
                alert("Error creating casino");
            }
        },
        error: function () {
            alert("An error occurred!")
        }
    })
};