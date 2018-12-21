/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'Bhavin_GDPR/js/view/default-checkout-agreements',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/checkout-data'
], function ($, AgreementsView, quote, checkoutData) {
    'use strict';

    var checkoutConfig = window.checkoutConfig,
        agreementManualMode = 1,
        agreementsConfig = checkoutConfig ? checkoutConfig.checkoutAgreements : {};

    return AgreementsView.extend({
    	isVisible: agreementsConfig.isEnabledShipping,
        agreements: agreementsConfig.agreements.checkout_shipping_form,
        agreementBlockId:"checkout-agreements-modal-shipping",
    });
});
