/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'ko',
    'jquery',
    'Magento_Ui/js/form/element/abstract',
    'Bhavin_GDPR/js/model/agreements-modal'
], function (ko, $, Component, agreementsModal) {
    'use strict';

    var checkoutConfig = window.checkoutConfig,
        agreementManualMode = 1,
        agreementsConfig = checkoutConfig ? checkoutConfig.checkoutAgreements : {};

    return Component.extend({
        defaults: {
            template: 'ui/form/field',
            elementTmpl: 'Bhavin_GDPR/checkout/checkout-agreements'
        },
        agreementBlockId:"",
        isVisible: agreementsConfig.isEnabled,
        agreements: agreementsConfig.agreements,
        modalTitle: ko.observable(null),
        modalContent: ko.observable(null),
		contentHeight: ko.observable(null),
        modalWindow: null,

        /**
         * @return {exports}
         */
        initialize: function () {
            this._super();
            var require = false;

            $.each(this.agreements,function(){
                if(this.mode == 1)
                {
                    require = true;
                }
            })
            if(!require)
                this.validation='';
        },
        /**
         * Checks if agreement required
         *
         * @param {Object} element
         */
        isAgreementRequired: function (element) {
            return element.mode == agreementManualMode; //eslint-disable-line eqeqeq
        },
        /**
         * Show agreement content in modal
         *
         * @param {Object} element
         */
        showContent: function (element) {
            console.log(element)
            this.modalTitle(element.checkboxText);
            this.modalContent(element.content);
			this.contentHeight(element.contentHeight ? element.contentHeight : 'auto');
            agreementsModal.showModal("#"+this.agreementBlockId);
        },

        /**
         * build a unique id for the term checkbox
         *
         * @param {Object} context - the ko context
         * @param {Number} agreementId
         */
        getCheckboxId: function (context, agreementId) {
            var paymentMethodName = '',
                paymentMethodRenderer = context.$parents[1];

            // corresponding payment method fetched from parent context
            if (paymentMethodRenderer) {
                // item looks like this: {title: "Check / Money order", method: "checkmo"}
                paymentMethodName = paymentMethodRenderer.item ?
                  paymentMethodRenderer.item.method : '';
            }

            return 'agreement_' + paymentMethodName + '_' + agreementId;
        },

        /**
         * Init modal window for rendered element
         *
         * @param {Object} element
         */
        initModal: function (element) {
            agreementsModal.createModal(element);
        }
    });
});
