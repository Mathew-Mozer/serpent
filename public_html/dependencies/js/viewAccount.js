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
    buttons: {
        Close: function () {
            viewPropertyModal.dialog('close');
        }
    }
});

