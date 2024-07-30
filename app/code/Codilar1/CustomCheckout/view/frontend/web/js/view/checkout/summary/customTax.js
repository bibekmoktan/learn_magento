define(
    [
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils',
        'Magento_Checkout/js/model/totals',
        'ko'
    ],
    function (Component, quote, priceUtils, totals, ko) {
        "use strict";
        return Component.extend({
            defaults: {
                isFullTaxSummaryDisplayed: window.checkoutConfig.isFullTaxSummaryDisplayed || false,
                template: 'Codilar1_CustomCheckout/checkout/summary/customTax'
            },
            totals: quote.getTotals(),
            isTaxDisplayedInGrandTotal: window.checkoutConfig.includeTaxInGrandTotal || false,
            customTaxAmount: ko.observable(0),
            customTaxRate: ko.observable(window.checkoutConfig.customTaxRate), // Use the value from the config
            initialize: function () {
                this._super();
            },
            isDisplayed: function() {
                return this.isFullMode();
            },
            getValue: function() {
                var price = 0;
                if (this.totals() && totals.getSegment('custom_tax')) {
                    price = totals.getSegment('custom_tax').value;
                }
                return this.getFormattedPrice(price);
            },
            getBaseValue: function() {
                var price = 0;
                if (this.totals()) {
                    price = this.totals().base_custom_tax;
                }
                return priceUtils.formatPrice(price, quote.getBasePriceFormat());
            },
            getTitle: function() {
                return 'Custom Tax (' + this.customTaxRate() + '%)';
            }
        });
    }
);
