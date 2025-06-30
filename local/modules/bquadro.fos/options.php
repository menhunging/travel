<?php

use Bitrix\Main\Localization\Loc;

global $APPLICATION;
Loc::loadMessages(__FILE__);
$isAIModuleEnabled = \Bitrix\Main\Loader::includeModule('bquadro.aigate');
$module = 'bquadro.fos';
$optionsData = [
    'BQ_MODULE_FOS_SETTINGS'             => [
        'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPTCHA_ENABLE' =>
            [
                'name'          => 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPTCHA_ENABLE',
                'desc'          => Loc::getMessage('BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPTCHA_ENABLE'),
                'type'          => 'checkbox',
                'default_value' => 'checkbox',
            ],
        'BQ_MODULE_FOS_BOT_PROTECT_SETTING_ENABLE'           =>
            [
                'name'          => 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_ENABLE',
                'desc'          => Loc::getMessage('BQ_MODULE_FOS_BOT_PROTECT_SETTING_ENABLE'),
                'type'          => 'checkbox',
                'default_value' => 'checkbox',
            ],
        'BQ_MODULE_FOS_BOT_PROTECT_SETTING_AI_ENABLE'        =>
            [
                'name'          => 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_AI_ENABLE',
                'desc'          => Loc::getMessage('BQ_MODULE_FOS_BOT_PROTECT_SETTING_AI_ENABLE'),
                'type'          => 'checkbox',
                'default_value' => 'checkbox',
            ],
    ],
    'BQ_MODULE_FOS_BOT_PROTECT_SETTINGS' => [

        'BQ_MODULE_FOS_BOT_PROTECT_SETTING_BOT_TIME_LOCK'   =>
            [
                'name'          => 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_BOT_TIME_LOCK',
                'desc'          => Loc::getMessage('BQ_MODULE_FOS_BOT_PROTECT_SETTING_BOT_TIME_LOCK'),
                'type'          => 'text',
                'default_value' => 120,
            ],
        'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_KEY'    =>
            [
                'name' => 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_KEY',
                'desc' => Loc::getMessage('BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_KEY'),
                'type' => 'text',

            ],
        'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_SECRET' =>
            [
                'name' => 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_SECRET',
                'desc' => Loc::getMessage('BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_SECRET'),
                'type' => 'text',

            ],
    ],

];

if ($REQUEST_METHOD === "POST" && check_bitrix_sessid()) {
    foreach ($optionsData as $index => $optionsDatum) {
        array_map(function ($data) use ($module) {
            if (isset($_POST[$data['name']]) && $data['type'] !== 'checkbox') {
                COption::SetOptionString($module, $data['name'], $_POST[$data['name']], $data['desc']);
            } elseif ($data['type'] === 'checkbox') {
                $isEnable = isset($_POST[$data['name']]) ? 'checked' : '';

                COption::SetOptionString($module, $data['name'], $isEnable, $data['desc']);
            }
        }, $optionsDatum);
    }
}

$isAIEnabled = !empty(COption::GetOptionString($module, 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_AI_ENABLE'));

$disabled = empty(COption::GetOptionString($module, 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_ENABLE')) ? "disabled" : "";

$aTabs = [
    [
        "DIV"   => "bq_module_fos_settings",
        "TAB"   => Loc::getMessage('BQ_MODULE_FOS_TAB_SETTINGS_TITLE'),
        "ICON"  => "ib_settings",
        "TITLE" => Loc::getMessage('BQ_MODULE_FOS_TAB_SETTINGS_FORM_TITLE'),
    ],
    [
        "DIV"   => "bq_module_fos_bot_protect_settings",
        "TAB"   => Loc::getMessage('BQ_MODULE_FOS_TAB_BOTPROTECT_TITLE'),
        "ICON"  => "ib_settings",
        "TITLE" => Loc::getMessage('BQ_MODULE_FOS_TAB_BOTPROTECT_FORM_TITLE'),
    ],
];
$htmlAiEnabled = '';
$tabControl = new CAdminTabControl("tabControlFos", $aTabs);

$tabControl->Begin();
?>
<form method="post" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>">
    <?php
    foreach ($optionsData as $index => $options): ?>
        <?php
        $tabControl->BeginNextTab(); ?>
        <div class="module-options-tab-main">
            <ul>
                <?php
                foreach ($options as $item) :?>
                    <?php
                    $addDisabled = '';
                    $curOptionVal = COption::GetOptionString($module, $item['name']);
                    $checked = $item['type'] === 'checkbox' ? $curOptionVal : '';
                    ?>
                    <?php
                    if ($index === 'BQ_MODULE_FOS_BOT_PROTECT_SETTINGS' && $item['type'] !== 'checkbox') {
                        $addDisabled = $disabled;
                    }
                    ?>
                    <?php
                    if ($item['name'] === 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_AI_ENABLE1'): ?>
                        <?php
                        $htmlAiEnabled = '<li>
                                        <lable for="'.$item['name'].'">'
                            .$item['desc']
                            .'</lable>
                                        <input name="'
                            .$item['name'].'" 
                                        type="'
                            .$item['type']
                            .'"value="'
                            .$curOptionVal.'" '
                            .$checked.' '
                            .$addDisabled.'></li>';
                        ?>
                    <?php
                    else: ?>
                        <li>
                            <lable for="<?=$item['name']?>"><?=$item['desc']?></lable>
                            <input name="<?=$item['name']?>" type="<?=$item['type']?>"
                                   value="<?=$curOptionVal?>" <?=$checked?> <?=$addDisabled?>>
                        </li>
                    <?php
                    endif; ?>
                <?php
                endforeach; ?>
            </ul>
        </div>
        <?php
        if ($index === 'BQ_MODULE_FOS_BOT_PROTECT_SETTINGS'): ?>
            <div>
                <h2>Блок интилектуальной защиты</h2>
                <?php
                if ($isAIModuleEnabled): ?>
                    <ul>
                        <?=$htmlAiEnabled?>
                    </ul>
                    <?php
                    if ($isAIEnabled) {
                        $gptName = COption::GetOptionString('bquadro.aigate', 'BQ_MODULE_AIGATE_GPT_CLASS');
                    }
                    ?>
                    <?php
                    //  $gptDto = \Bquadro\AiGate\Dto\FabricaDto::getDto($gptName);
                    echo $gptName;
                    ?>
                <?php
                else: ?>
                    <p>для подключения Интилектуальной защиты необходимо установить модуль bquadro.aigate</p>
                <?php
                endif; ?>
            </div>
        <?php
        endif; ?>
        <?php
        $tabControl->EndTab(); ?>
    <?php
    endforeach; ?>
    <?php
    $tabControl->Buttons(); ?>
    <input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>"
           title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
    <?php
    if (strlen($_REQUEST["back_url_settings"]) > 0): ?>
        <input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>"
               title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location = '<?php
        echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"])) ?>'">
        <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
    <?php
    endif ?>
    <?=bitrix_sessid_post();?>
    <?php
    $tabControl->End(); ?>
</form>