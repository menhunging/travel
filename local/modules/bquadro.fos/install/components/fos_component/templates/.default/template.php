<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var \CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var array $templateData */

/** @var \CBitrixComponent $component */

use \Bitrix\Main\Localization\Loc;


$this->setFrameMode(true);
CJSCore::Init(['masked_input']);
CJSCore::Init(['phone_number']);
\Bitrix\Main\UI\Extension::load('bquadro.fos');
$formSelector = 'default'.'_'.$arParams['SECTION_CODE']
?>
<section class="form-section">
    <div class="row bqfos">
        <div class="styled-block">
            <div class="maxwidth-theme" style="display: flex; justify-content: center">
                <div class="col-md-6">
                    <div class="form <?=$formSelector?> form--<?=$formSelector?>">
                        <form id="extention-form-<?=$formSelector?>" class="extention-form form <?=$formSelector?>">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="title form__title">
                                            <?=$arParams['TITLE']?>
                                        </div>
                                        <br>
                                        <?=$arParams['TEXT']?>
                                    </div>
                                    <div class="col-md-12 col-sm-12 form__col">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="row form__row"
                                                     data-sid="<?=$arParams['SECTION_CODE'].'_'.'NAME'?>">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="<?=$arParams['SECTION_CODE'].'_'.'NAME'?>"
                                                                   class="form-group__label"><?='ИМЯ'?>
                                                            </label>
                                                            <div class="input">
                                                                <input type="text"
                                                                       id="<?=$arParams['SECTION_CODE'].'_'.'NAME'?>"
                                                                       name="<?='NAME'?>"
                                                                       class="form-control input--text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="<?=$arParams['SECTION_CODE'].'_'.'PHONE'?>"
                                                                   class="form-group__label"><?='Телефон'?>
                                                                : <span class="required-star">*</span>
                                                            </label>
                                                            <div class="input">
                                                                <input type="text"
                                                                       id="<?=$arParams['SECTION_CODE'].'_'.'PHONE'?>"
                                                                       name="<?='PHONE'?>"
                                                                       class="form-control mask_phone input--phone"
                                                                       aria-required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 pull-right">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="licence_block bx_filter">
                                                                <input type="checkbox"
                                                                       id="<?=$formSelector.'_'.'LICENSES'?>"
                                                                       checked="" name="LICENSES" required="" value="Y"
                                                                       aria-required="true">
                                                                <label for="<?=$formSelector.'_'.'LICENSES'?>"
                                                                       class="licence_block__label">
                                                                    Я согласен на <a href="/include/licenses_detail.php"
                                                                                     target="_blank">обработку
                                                                        персональных данных</a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-footer">
                                                        <button type="submit"
                                                                class="btn-lg btn btn-default ext-fos-submit button--submit">
                                                            Отправить
                                                        </button>
                                                        <input type="hidden" name="FORM_NAME"
                                                               value="<?=$arParams['IBLOCK_CODE']?>">
                                                        <input type="hidden" name="SECTION_CODE"
                                                               value="<?=$arParams['SECTION_CODE']?>">
                                                    </div>
                                                    <input type="hidden" name="PAGE_LINK"
                                                           value="<?=$APPLICATION->GetCurPage()?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    (() => {
        let el = document.getElementById("<?='extention-form-'.$formSelector?>");

        let objFos = new BqFos();
        objFos.init(el);

        objFos.setSignedParameters({
            signedParameters: '<?= $this->getComponent()->getSignedParameters() ?>',
            componentName: '<?= $this->getComponent()->getName() ?>'
        })
        <?php if(isset($arParams['RECAPTCHA_KEY'])):?>
        objFos.setRecaptchaKey('<?= $arParams['RECAPTCHA_KEY'] ?>')
        <?php endif;?>
    })();
</script>