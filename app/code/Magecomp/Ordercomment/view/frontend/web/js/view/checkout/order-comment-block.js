define(
    [
        'jquery',
        'uiComponent',
        'knockout'
    ],
    function ($, Component, ko) {
        'use strict';

        ko.extenders.maxOrderCommentLength = function (target, maxLength) {
            var timer;
            var result = ko.computed({
                read: target,
                write: function (val) {
                    if (maxLength > 0) {
                        clearTimeout(timer);
                        if (val.length > maxLength) {
                            var limitedVal = val.substring(0, maxLength);
                            if (target() === limitedVal) {
                                target.notifySubscribers();
                            } else {
                                target(limitedVal);
                            }
                            result.css("_error");
                            timer = setTimeout(function () { result.css(""); }, 800);
                        } else {
                            target(val);
                            result.css("");
                        }
                    } else {
                        target(val);
                    }
                }
            }).extend({ notify: 'always' });
            result.css = ko.observable();
            result(target());
            return result;
        };

        return Component.extend({
            defaults: {
                template: 'Magecomp_OrderComment/checkout/order-comment-block'
            },
            initialize: function () {
                this._super();
                if(!this.isEnable()){
                    return;
                }
                var self = this;
                this.comment = ko.observable("").extend({maxOrderCommentLength: this.getMaxLength()});

                this.remainingCharacters = ko.computed(function () {
                    return self.getMaxLength() - self.comment().length;
                });

            },
            hasMaxLength: function () {
                return window.checkoutConfig.max_length > 0;
            },
            getMaxLength: function () {
                return window.checkoutConfig.max_length;
            },
            getInitialCollapseState: function () {
                return window.checkoutConfig.comment_initial_defualt_show;
            },
            isInitialStateOpened: function () {
                return this.getInitialCollapseState() === 1
            },
            getCheckouttitle: function () {
                return window.checkoutConfig.checkout_title;
            },
            isEnable: function () {
                return window.checkoutConfig.is_ordercomment_enable;
            }
        });
    }
);
