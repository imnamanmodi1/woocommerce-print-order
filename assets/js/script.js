'use strict';

// create "wcpo" button and add print event
function wcpoButton() {
    if (!wcpoButtonName) {
        var wcpoButtonName = 'Print order';
    }

    jQuery('.wc-order-data-row.wc-order-bulk-actions .add-items').append('<button id="wcpo-button" type="button" class="button">' + wcpoButtonName + '</button>');

    jQuery('#wcpo-button').on('click', function(e) {
        e.preventDefault();

        var printFrame = document.getElementById('wcpo-iframe');

        if (printFrame) {
            printFrame.contentWindow.focus();
            printFrame.contentWindow.print();
        } else {
            console.log('wcpo iframe not found.');
        }
    });
}

jQuery(document).ready(function() {
    wcpoButton();
});