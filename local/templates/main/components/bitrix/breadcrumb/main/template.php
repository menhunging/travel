<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
    return "";

$strReturn = '';

$strReturn .= '<section class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList"><ul>';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $home = ($index == 0);
    $class = $home ? 'class="breadcrumbs__main"' : '';

    if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
        $strReturn .= '
			<li id="bx_breadcrumb_' . $index . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="' . $arResult[$index]["LINK"] . '" ' . $class . ' title="' . $title . '" itemprop="item">
					' . ($home ? '' : $title) . '
				</a>
				<meta itemprop="position" content="' . ($index + 1) . '" />
			</li>';
    } else {
        $strReturn .= '
			<li>
				<span>' . $title . '</span>
			</li>';
    }
}

$strReturn .= '</ul></section>';

return $strReturn;
