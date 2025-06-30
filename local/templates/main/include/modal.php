<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="micromodal-slide modal" id="modal-success" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true">
            <div class="modal__inner">
                <button class="modal__close" aria-label="Close modal" data-micromodal-close>
                    <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1100_5448)">
                            <path d="M8.38897 20.7539L20.7422 8.40063" stroke="white" stroke-width="2"
                                  stroke-miterlimit="10" stroke-linecap="square" />
                            <path d="M8.38897 8.40069L20.7422 20.7539" stroke="white" stroke-width="2"
                                  stroke-miterlimit="10" stroke-linecap="square" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1100_5448">
                                <rect width="20" height="20" fill="white"
                                      transform="translate(14.1426 29.1422) rotate(-135)" />
                            </clipPath>
                        </defs>
                    </svg>
                </button>
                <div class="modal__content" autocomplete="off">
                    <div class="modal-success">
                        <div class="circle circle--success"></div>
                        <span class="caption caption--h3">Спасибо, ваша<br /> заявка отправлена</span>
                        <p>
                            Мы свяжемся с вами и ответим на все ваши вопросы
                        </p>
                        <a href="javascript" class="btn" data-micromodal-close>Ок</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="micromodal-slide modal" id="modal-form" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true">
            <div class="modal__inner">
                <button class="modal__close" aria-label="Close modal" data-micromodal-close>
                    <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1100_5448)">
                            <path d="M8.38897 20.7539L20.7422 8.40063" stroke="white" stroke-width="2"
                                  stroke-miterlimit="10" stroke-linecap="square" />
                            <path d="M8.38897 8.40069L20.7422 20.7539" stroke="white" stroke-width="2"
                                  stroke-miterlimit="10" stroke-linecap="square" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1100_5448">
                                <rect width="20" height="20" fill="white"
                                      transform="translate(14.1426 29.1422) rotate(-135)" />
                            </clipPath>
                        </defs>
                    </svg>
                </button>
                <div class="modal__content" autocomplete="off">
                    <div class="modal-form"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('ready', function () {
        var objParams = {
            googleRecaptchaUrl: '<?php echo GOOGLE_RECAPTCHA_URL; ?>',
            googleRecaptchaSiteKey: '<?php echo GOOGLE_RECAPTCHA_V3_SITE_KEY; ?>',
            googleRecaptchaResponseElement: 'recaptchaResponseFeedback',
            googleRecaptchaAction: 'form',
        };

        let obBquadroForm = new BquadroForm(objParams);
        obBquadroForm.init();
    });
</script>