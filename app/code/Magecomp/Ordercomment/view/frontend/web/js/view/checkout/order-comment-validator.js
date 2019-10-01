define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Magecomp_Ordercomment/js/model/checkout/order-comment-validator'
    ],
    function (Component, additionalValidators, commentValidator) {
        'use strict';

        additionalValidators.registerValidator(commentValidator);

        return Component.extend({});
    }
);