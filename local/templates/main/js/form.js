class BquadroForm {
    constructor(parameters) {
        this.googleRecaptchaUrl = parameters.googleRecaptchaUrl || '';
        this.googleRecaptchaSiteKey = parameters.googleRecaptchaSiteKey || '';
        this.googleRecaptchaResponseElement = parameters.googleRecaptchaResponseElement || '';
        this.googleRecaptchaAction = parameters.googleRecaptchaAction || '';
    }

    init() {
        let o = this;
        this.event();

        if (typeof grecaptcha === 'undefined') {
            var script = document.createElement('script');
            script.src = o.googleRecaptchaUrl;
            (document.head || document.documentElement).appendChild(script);
        }
    }

    event() {
        let o = this;
        o.submitForm = false;

        $(document).on('click', '.js-popup-opener', function (e) {
            e.preventDefault();

            if (!o.startLoader()) {
                return false;
            }

            let action = $(this).attr('data-action');
            let formData = new FormData();
            let dataAttributes = $(this).data();

            $.each(dataAttributes, function (key, value) {
                formData.append(key, value);
            });

            o.sendAction(action, formData, this, o.modalForm);
            return false;
        });

        $(document).on('submit', '[data-form="submit"]', function (e) {
            e.preventDefault();

            if (!o.startLoader()) {
                return false;
            }

            let form = this;

            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.ready(function () {
                    grecaptcha.execute(o.googleRecaptchaSiteKey, {action: o.googleRecaptchaAction}).then(function (token) {
                        var recaptchaResponse;
                        if (recaptchaResponse = document.getElementById(o.googleRecaptchaResponseElement)) {
                            recaptchaResponse.value = token;
                        }

                        let formData = new FormData($(form)[0]);
                        formData.append('SEND_PAGE', window.location.href);

                        o.sendAction('submit', formData, this, o.modalSuccess);
                    });
                });
            }

            return false;
        });
    }

    sendAction(action, formData, el, callback) {
        let o = this;

        $('[data-form="submit"]').find('.error').removeClass('error');

        BX.ajax.runAction('bquadro:fos.foscontroller.' + action, {
            data: formData
        }).then(function (response) {
            callback(action, response, el);
            o.endLoader();
        }, function (response) {
            o.showErrors(action, response,);
            o.endLoader();
        });
    }

    showErrors(action, response,) {
        if (response.errors.length === 0) {
            return;
        }

        let errorText = '';
        response.errors.forEach(function (error, index) {
            if (action == 'submit') {
                if (error.code == 500) {
                    if ('code' in error.customData) {
                        if ($('[data-name="' + error.customData.code + '"]').length) {
                            $('[data-name="' + error.customData.code + '"]').addClass('error');
                        }
                    }
                } else {
                    errorText += error.message + '\n';
                }
            } else {
                errorText += error.message + '\n';
            }
        });

        if (errorText.length > 0) {
            alert(errorText);
        }
    }

    modalForm(action, response, el) {
        $('#modal-form .modal-form').html(response.data.html);
        BquadroForm.initJs();
        MicroModal.show('modal-form');
    }

    modalSuccess(action, response, el) {
        if (('goal' in response.data) && response.data.goal.length) {
            sendEvent(response.data.goal);
        }

        MicroModal.close('modal-form');
        MicroModal.show('modal-success');
    }

    startLoader() {
        if (this.submitForm === true) {
            return false;
        }
        this.submitForm = true;

        if (!this.loadingScreen) {
            this.loadingScreen = $('<div>', {
                class: 'bq-loading-screen',
                append: $('<div>', {
                    id: 'loading_screen',
                    append: $('<img>', {
                        src: '/images/loader.gif',
                    })
                })
            });
            this.loadingScreen.appendTo('body');
        }
        this.loadingScreen.show();

        return true;
    }

    endLoader() {
        this.submitForm = false;
        if (this.loadingScreen && this.loadingScreen.css('display') != 'none') {
            this.loadingScreen.hide();
        }
    }

    static initJs() {
        if ($(".phone-input").length > 0) {
            $(".phone-input").map(function () {
                $(this).inputmask({
                    mask: "+7(999) 999-99-99",
                    placeholder: "*",
                    showMaskOnHover: false,
                    showMaskOnFocus: true,
                    clearIncomplete: true,
                });
            });
        }

        if ($(".selectric").length > 0) {
            $(".selectric").map(function () {
                $(this).selectric({
                    onOpen: function (element) {
                    },
                    onChange: function (element) {
                    },
                    onClose: function (element) {
                    },
                });
            });
        }

        if ($("#datepicker").length > 0) {
            $("#datepicker").daterangepicker(
                {
                    showWeekNumbers: true,
                    autoApply: true,
                    locale: {
                        format: "MM/DD/YYYY",
                        separator: " - ",
                        applyLabel: "Apply",
                        cancelLabel: "Cancel",
                        fromLabel: "From",
                        toLabel: "To",
                        customRangeLabel: "Custom",
                        weekLabel: "W",
                        daysOfWeek: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                        monthNames: [
                            "Январь",
                            "Февраль",
                            "Март",
                            "Апрель",
                            "Май",
                            "Июнь",
                            "Июль",
                            "Август",
                            "Сентябрь",
                            "Октрябрь",
                            "Ноябрь",
                            "Декабрь",
                        ],
                        firstDay: 1,
                    },
                    opens: "center",
                    drops: "auto",
                },
                function (start, end, label) {
                }
            );
        }
    }
}

function sendEvent(value) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({'event': value});
}