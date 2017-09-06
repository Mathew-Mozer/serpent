/**
 * This file creates the new property
 */

/**
 * Create the property modal
 * @type {any}
 */
var viewAccountModal = $('#createProperty').dialog({
    autoOpen: false,
    height: 768,
    width: 1024,
    modal: true,
    title: 'View Account Information',
    open: function(event, ui) {
        // Height setter has no effect after init either
        $(this).dialog("option", "height", 400);
    },
    buttons: {
        Close: function () {
            viewPropertyModal.dialog('close');
        }
    }
});

