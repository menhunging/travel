<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

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
?>

<form action="<?= $APPLICATION->GetCurPage(false); ?>" data-form="submit">
    <?php echo bitrix_sessid_post(); ?>
    <input type="hidden" name="TYPE" value="<?= $arParams['TYPE'] ?>">
    <input type="hidden" name="IBLOCK_CODE" value="<?= $arParams['IBLOCK_CODE'] ?>">
    <input type="hidden" name="GOAL" value="<?= $arParams['GOAL'] ?>">

    <input type="hidden" name="recaptcha_response" id="recaptchaResponseFeedback">
    <input type="hidden" name="recaptcha_action" value="form">

    <div class="caption caption--h3">
        <?php echo $arParams['TITLE']; ?>
    </div>
    <div class="desc">
        <?php echo $arParams['TEXT']; ?>
    </div>

    <div class="input-list">
        <div class="input-item" data-name="NAME">
            <input type="text" name="NAME" placeholder="Имя *">
            <div class="input-item__icon">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.375 2.75C2.375 3.44619 2.65156 4.11387 3.14384 4.60616C3.63613 5.09844 4.30381 5.375 5 5.375C5.69619 5.375 6.36387 5.09844 6.85616 4.60616C7.34844 4.11387 7.625 3.44619 7.625 2.75C7.625 2.05381 7.34844 1.38613 6.85616 0.893845C6.36387 0.401562 5.69619 0.125 5 0.125C4.30381 0.125 3.63613 0.401562 3.14384 0.893845C2.65156 1.38613 2.375 2.05381 2.375 2.75ZM8.75 9.875H0.875C0.775544 9.875 0.680161 9.83549 0.609835 9.76517C0.539509 9.69484 0.5 9.59946 0.5 9.5V8.375C0.5 7.87772 0.697544 7.40081 1.04917 7.04917C1.40081 6.69754 1.87772 6.5 2.375 6.5H7.625C8.12228 6.5 8.59919 6.69754 8.95082 7.04917C9.30246 7.40081 9.5 7.87772 9.5 8.375V9.5C9.5 9.59946 9.46049 9.69484 9.39017 9.76517C9.31984 9.83549 9.22446 9.875 9.125 9.875H8.75Z"
                        fill="#808094"/>
                </svg>
            </div>
        </div>

        <div class="input-item" data-name="PHONE">
            <input type="tel" name="PHONE" class="phone-input" placeholder="Телефон *">
            <div class="input-item__icon">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.9542 8.91423L8.60714 6.78027C8.4962 6.67943 8.35041 6.62565 8.20056 6.63028C8.0507 6.63491 7.90852 6.6976 7.80401 6.80509L6.42235 8.22601C6.08978 8.1625 5.42117 7.95406 4.73294 7.26757C4.04471 6.57876 3.83627 5.90843 3.77449 5.57818L5.19427 4.19595C5.3019 4.09152 5.36467 3.9493 5.3693 3.79941C5.37394 3.64952 5.32007 3.5037 5.21909 3.39282L3.08568 1.04638C2.98467 0.935151 2.84427 0.867684 2.69431 0.858305C2.54435 0.848925 2.39664 0.898373 2.28255 0.996147L1.02964 2.07064C0.929821 2.17082 0.870241 2.30416 0.862204 2.44535C0.853543 2.58969 0.688413 6.0089 3.33973 8.66135C5.6527 10.9737 8.54998 11.1429 9.34792 11.1429C9.46455 11.1429 9.53614 11.1394 9.5552 11.1383C9.69637 11.1304 9.82964 11.0705 9.92934 10.9703L11.0033 9.71678C11.1014 9.60306 11.1512 9.45547 11.1421 9.30552C11.1329 9.15557 11.0655 9.01515 10.9542 8.91423Z"
                        fill="#808094"/>
                </svg>

            </div>
        </div>

        <div class="input-item" data-name="EMAIL">
            <input type="email" name="EMAIL" placeholder="E-mail *">
            <div class="input-item__icon">
                <svg width="10" height="8" viewBox="0 0 10 8" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.5 0H9.5C9.63261 0 9.75979 0.0468252 9.85355 0.130175C9.94732 0.213524 10 0.32657 10 0.444444V7.55556C10 7.67343 9.94732 7.78648 9.85355 7.86983C9.75979 7.95318 9.63261 8 9.5 8H0.5C0.367392 8 0.240215 7.95318 0.146447 7.86983C0.0526784 7.78648 0 7.67343 0 7.55556V0.444444C0 0.32657 0.0526784 0.213524 0.146447 0.130175C0.240215 0.0468252 0.367392 0 0.5 0ZM5.03 3.85911L1.824 1.43911L1.1765 2.11644L5.0365 5.02978L8.827 2.11422L8.173 1.44178L5.03 3.85911Z"
                        fill="#808094"/>
                </svg>
            </div>
        </div>

        <div class="input-item" data-name="COUNTRY">
            <input type="text" name="COUNTRY" placeholder="Страна">
        </div>
        <div class="input-item" data-name="REGION">
            <input type="text" name="REGION" placeholder="Регион">
        </div>

        <?/*?>
        <select name="COUNTRY" class="selectric" placeholder="Страна">
            <option disabled selected="selected">Страна</option>
            <?php foreach ($arResult['COUNTRY'] as $value => $name) { ?>
                <option value="<?php echo $value; ?>">
                    <?php echo $name; ?>
                </option>
            <?php } ?>
        </select>

        <select name="REGION" class="selectric" placeholder="Регион">
            <option disabled selected="selected">Регион</option>
            <?php foreach ($arResult['REGION'] as $value => $name) { ?>
                <option value="<?php echo $value; ?>">
                    <?php echo $name; ?>
                </option>
            <?php } ?>
        </select>
<?*/?>
        <div class="input-item input-item--travel" data-name="DATE">
            <input type="text" name="DATE" placeholder="Период поездки *" id="datepicker">
            <div class="input-item__icon">
                <svg width="10" height="11" viewBox="0 0 10 11" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 5V8.88889C10 9.18357 9.88294 9.46619 9.67456 9.67456C9.46619 9.88294 9.18357 10 8.88889 10H1.11111C0.816426 10 0.533811 9.88294 0.325437 9.67456C0.117063 9.46619 0 9.18357 0 8.88889V5H10ZM7.22222 0C7.36957 0 7.51087 0.0585316 7.61506 0.162718C7.71925 0.266905 7.77778 0.408213 7.77778 0.555556V1.11111H8.88889C9.18357 1.11111 9.46619 1.22817 9.67456 1.43655C9.88294 1.64492 10 1.92754 10 2.22222V3.88889H0V2.22222C0 1.92754 0.117063 1.64492 0.325437 1.43655C0.533811 1.22817 0.816426 1.11111 1.11111 1.11111H2.22222V0.555556C2.22222 0.408213 2.28075 0.266905 2.38494 0.162718C2.48913 0.0585316 2.63044 0 2.77778 0C2.92512 0 3.06643 0.0585316 3.17061 0.162718C3.2748 0.266905 3.33333 0.408213 3.33333 0.555556V1.11111H6.66667V0.555556C6.66667 0.408213 6.7252 0.266905 6.82939 0.162718C6.93357 0.0585316 7.07488 0 7.22222 0Z"
                        fill="#808094"/>
                </svg>
            </div>
        </div>

        <div class="input-item input-item--comments" data-name="MESSAGE">
            <textarea name="MESSAGE" placeholder="Комментарий"></textarea>
            <div class="input-item__icon">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.27685 0.467158C7.57609 0.168042 7.98189 4.39611e-05 8.40499 0.000122098C8.82809 0.000200234 9.23383 0.168348 9.53295 0.467574C9.83208 0.766801 10.0001 1.1726 10 1.59569C9.99992 2.01878 9.83177 2.42451 9.53254 2.72363L8.92174 3.33357L9.1409 3.55189C9.27632 3.6873 9.38375 3.84806 9.45704 4.02498C9.53033 4.20191 9.56806 4.39154 9.56806 4.58305C9.56806 4.77455 9.53033 4.96419 9.45704 5.14111C9.38375 5.31804 9.27632 5.4788 9.1409 5.61421L8.21096 6.54413C8.13284 6.62236 8.02683 6.66635 7.91627 6.66643C7.80571 6.66651 7.69965 6.62267 7.62141 6.54454C7.54318 6.46642 7.49919 6.36042 7.49911 6.24986C7.49903 6.1393 7.54287 6.03324 7.621 5.95501L8.55177 5.02509C8.60984 4.96706 8.65591 4.89814 8.68735 4.8223C8.71878 4.74645 8.73496 4.66515 8.73496 4.58305C8.73496 4.50095 8.71878 4.41965 8.68735 4.3438C8.65591 4.26795 8.60984 4.19904 8.55177 4.141L8.33262 3.92352L3.37045 8.88476C3.21973 9.03545 3.03601 9.14899 2.83382 9.21639L0.548135 9.97883C0.474706 10.0033 0.395925 10.0067 0.320623 9.98891C0.245321 9.97107 0.176474 9.93262 0.121798 9.87786C0.0671219 9.8231 0.0287778 9.75419 0.0110633 9.67886C-0.00665126 9.60354 -0.00303611 9.52476 0.0215035 9.45137L0.78312 7.16657C0.850582 6.96441 0.964119 6.7807 1.11476 6.62995L7.27685 0.467158Z"
                        fill="#808094"/>
                </svg>
            </div>
        </div>

        <div class="input-list__controls">
            <button type="submit" class="btn">Отправить</button>
            <label class="checkbox">
                <input type="hidden" name="UCONSENT" value="Да" checked>
                <span class="desc">
                    Я согласен на обработку персональных данных согласно <a href="/privacy-policy/" target="_blank">Политике конфиденциальности</a>
                </span>
            </label>
        </div>
    </div>
</form>
