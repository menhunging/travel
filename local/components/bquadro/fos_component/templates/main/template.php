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

$this->setFrameMode(true);
CJSCore::Init(['masked_input']);
CJSCore::Init(['phone_number']);
\Bitrix\Main\UI\Extension::load('bquadro.fos');
$formSelector = $templateName.'_'.$arParams['SECTION_CODE'];

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
                                                     data-sid="<?=$formSelector.'_'.'NAME'?>">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="<?=$formSelector.'_'.'NAME'?>"
                                                                   class="form-group__label"><?='ИМЯ'?>
                                                            </label>
                                                            <div class="input">
                                                                <input type="text" aria-describedby="name-format"
                                                                       pattern="[А-Яа-я]+s[А-Яа-я]+"
                                                                       title="Фамилия Имя. Допустима только Кирилица"
                                                                       id="<?=$formSelector.'_'.'NAME'?>"
                                                                       name="<?='NAME'?>"
                                                                       class="form-control input--text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="<?=$formSelector.'_'.'PHONE'?>"
                                                                   class="form-group__label"><?='Телефон'?>
                                                                : <span class="required-star">*</span>
                                                            </label>
                                                            <div class="input">
                                                                <input type="text"
                                                                       id="<?=$formSelector.'_'.'PHONE'?>"
                                                                       name="<?='PHONE'?>"
                                                                       class="form-control input--phone"
                                                                       aria-required="true" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="<?=$formSelector.'_'.'EMAIL'?>"
                                                                   class="form-group__label"><?='Email'?>
                                                                : <span class="required-star">*</span>
                                                            </label>
                                                            <div class="input">
                                                                <input type="email"
                                                                       id="<?=$formSelector.'_'.'EMAIL'?>"
                                                                       name="<?='EMAIL'?>"
                                                                       class="form-control input--phone"
                                                                       aria-required="true" required/>
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
        console.log(el);
        let objFos = new BqFos();
        objFos.init(el);
    })();
</script>