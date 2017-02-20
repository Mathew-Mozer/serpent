/**
 * This file creates the new property
 */

/**
 * Create the property modal
 * @type {any}
 */
var viewDocumentsModal = $('#createProperty').dialog({
    autoOpen: false,
    height: 610,
    width: 600,
    modal: true,
    title: 'Supporting Documents',
    buttons: {
        Close: function () {
            viewDocumentsModal.dialog('close');
        }
    }
});
