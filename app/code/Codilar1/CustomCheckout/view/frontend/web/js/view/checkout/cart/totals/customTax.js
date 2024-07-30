define(
    [
        'Codilar1_CustomCheckout/js/view/checkout/summary/customTax'
    ],
    function (Component) {
        'use strict';

        return Component.extend({
            /**
             * @override
             * use to define amount is display setting
             */
            isDisplayed: function () {
                return true;
            }
        });
    }
);
