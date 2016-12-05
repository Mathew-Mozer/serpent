/**
 * This file creates the new property
 */

/**
 * Create the property modal
 * @type {any}
 */
var createPropertyModal = $('#createProperty').dialog({
    autoOpen: false,
    height: 610,
    width: 350,
    modal: true,
    buttons: {
        Submit: function () {
            createProperty();
            createPropertyModal.dialog('close');
        }
    }
});

/**
 * Generate initial fields for property properties
 */
var createProperty = function () {
    var propertyName = $('#propertyName').val();
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
            propertyName: propertyName, parentCompany: parentCompany, assetBundleUrl: assetBundleUrl,
            assetBundleWindows: assetBundleWindows, assetName: assetName, defaultSkin: defaultSkin,
            defaultLogo: defaultLogo, supportGroup: supportGroup, businessOpen: businessOpen,
            businessClose: businessClose
        },
        cache: false,
        success: function (json) {
            var result = JSON.parse(json);
            if (result.error === 'none') {
                alert("Property Created!");
            } else {
                alert("Error creating property");
            }
        },
        error: function () {
            alert("An error occurred!")
        }
    })
};
