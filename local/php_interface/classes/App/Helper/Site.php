<?php

namespace App\Helper;

use Bitrix;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

class Site
{
    public static function isProd(): bool
    {
        return Option::get('main', 'update_devsrv') !== 'Y';
    }

    public static function currencyFormat($price)
    {
        $price = floatval($price);
        return number_format($price, 0, '.', ' ') . ' р';
    }

    public static function isAdmin()
    {
        global $USER;
        return $USER->isAdmin();
    }

    public static function dump($var, $die = false, $all = false, $export = false)
    {
        global $USER;
        if ($USER->isAdmin() || $all) {
            $bt = debug_backtrace();
            $caller = array_shift($bt);

            print '<pre>';
            print 'File: ' . $caller['file'] . "\n";
            print 'Line: ' . $caller['line'] . "\n";

            if ($export) {
                var_export($var);
            } else {
                print_r($var);
            }

            print '</pre>';
            if ($die) {
                die();
            }
        }
    }

    public static function show404($message = "", $defineConstant = true, $setStatus = true, $showPage = true, $pageFile = "")
    {
        if (Bitrix\Main\Loader::includeModule("iblock")) {
            Bitrix\Iblock\Component\Tools::process404(
                $message,
                $defineConstant,
                $setStatus,
                $showPage,
                $pageFile
            );
        }
    }

    public static function includeArea($path, $params = array())
    {
        if (Loader::includeModule('api.uncachedarea')) {
            \CAPIUncachedArea::includeFile(
                $path,
                $params,
                array(
                    'SHOW_BORDER' => false,
                )
            );
        }
    }

    public static function linkPhone($phone)
    {
        $phoneStr = str_replace(array(' ', '-', '‒', ')', '('), '', strip_tags($phone));
        if ($phoneStr[0] == 8) {
            $phoneStr = substr_replace($phoneStr, '+7', 0, 1);
        }

        return $phoneStr;
    }

    public static function getClassByProperty($property_id, $default = "")
    {
        global $APPLICATION;

        $class = $APPLICATION->GetProperty($property_id);
        if (strlen($class) > 0)
            return $class;

        return $default;
    }

    public static function showTitle()
    {
        global $APPLICATION;

        $strResult = '';

        if ($APPLICATION->GetProperty('hide_h1') != "Y") {
            $class = self::getClassByProperty('class_h1', 'caption caption--h1');
            if ($APPLICATION->GetProperty('unvisible_h1') == 'Y') {
                $class .= ' visually-hidden';
            }
            $strResult .= '<h1 class="' . $class . '">';
            $strResult .= $APPLICATION->GetTitle(false) . '</h1>';
        }

        return $strResult;
    }

    public static function showMainBegin()
    {
        global $APPLICATION;

        if ($APPLICATION->GetProperty("hide_main") == "Y")
            return "";

        $strResult = '<main class="main">';

        return $strResult;
    }

    public static function showMainEnd()
    {
        global $APPLICATION;

        if ($APPLICATION->GetProperty("hide_main") == "Y")
            return "";

        return '</main>';
    }

    public static function textPageBegin()
    {
        global $APPLICATION;

        if ($APPLICATION->GetProperty("text_page") == "N")
            return "";

        $strResult = '<section class="details-section">';
        $strResult .= '<div class="container">';

        return $strResult;
    }

    public static function textPageEnd()
    {
        global $APPLICATION;

        if ($APPLICATION->GetProperty("text_page") == "N")
            return "";

        return '</div></section>';
    }

    public static function textPageTextBegin()
    {
        global $APPLICATION;

        if ($APPLICATION->GetProperty("text_page") == "N")
            return "";

        $strResult = '<div class="text-simple">';

        return $strResult;
    }

    public static function textPageTextEnd()
    {
        global $APPLICATION;

        if ($APPLICATION->GetProperty("text_page") == "N")
            return "";

        return '</div>';
    }
}