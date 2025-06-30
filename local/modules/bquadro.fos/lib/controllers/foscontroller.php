<?php

namespace Bquadro\Fos\Controllers;

use Bitrix\Main\Application;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;
use Bquadro\Fos\Prefilters\BotPrefilter;
use Bquadro\Fos\Prefilters\CookiesPrefilter;
use Bquadro\Fos\Prefilters\RecapchaPrefilter;
use Bquadro\Fos\Prefilters\UrlPrefilter;
use Bquadro\Fos\Dto\FabricaDto;
use Bquadro\Fos\Models;
use COption;
use Bitrix\Main\Result;
use App\Helper;

/**
 * Class FosController
 * Класс контроллера для обработки запросов FOS
 */
class FosController extends Controller
{
    private Result $result;

    /**
     * Настройка доступных действий контроллера
     * @return array
     */
    public function configureActions(): array
    {
        $prefilters = $this->setPrefilters();
        return [
            'application' => [
                'prefilters' => [],
            ],
            'submit' => [
                'prefilters' => $prefilters,
            ],
        ];
    }

    private function setPrefilters(): array
    {
        $prefilters = [
            new ActionFilter\HttpMethod(
                [
                    ActionFilter\HttpMethod::METHOD_POST,
                ]
            ),
            new ActionFilter\Csrf(true),
        ];

//        if (!empty(COption::GetOptionString('bquadro.fos', 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_ENABLE'))) {
//            $prefilters[] = new UrlPrefilter();
//            $prefilters[] = new CookiesPrefilter();
//            $prefilters[] = new BotPrefilter();
//        }
//        if (!empty(COption::GetOptionString('bquadro.fos', 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPTCHA_ENABLE'))) {
//            $prefilters[] = new RecapchaPrefilter();
//        }

        return $prefilters;
    }

    public function applicationAction()
    {
        $requestData = $this->getFosData();

        return new \Bitrix\Main\Engine\Response\Component('bquadro:fos_component', 'application',
            array(
                'IBLOCK_CODE' => 'form_application',
                'TYPE' => 'form',
                'TITLE' => $requestData['title'] ?? 'Оставить заявку',
                'TEXT' => $requestData['text'] ?? 'Оставьте свои контакты, мы свяжемся с вами, уточним детали и сделаем полный расчет стоимости с учетом всех ваших пожеланий.',
                'GOAL' => (Helper\Site::isProd() ? '' : ''),
            )
        );
    }

    /**
     * Обработка действия submit
     * @return array
     * @throws SystemException
     * @throws LoaderException
     */
    public function submitAction()
    {
        $formCode = $this->getFosCode();
        $dto = FabricaDto::getFosDto($formCode);

        $this->result = (new Models\Action\FosModel($dto))->addEl();

        return $this->getResult();
    }

    /**
     * @throws SystemException
     */
    private function getFosCode(): string
    {
        $requestData = $this->getFosData();

        return $requestData['TYPE'] ?: 'form';
    }

    /**
     * Получение данных FOS из запроса
     * @return array
     */
    private function getFosData(): array
    {
        $request = Application::getInstance()->getContext()->getRequest();

        return $request->getPostList()->toArray();
    }

    protected function getResult(): array
    {
        if ($errors = $this->result->getErrors()) {
            $this->addErrors($errors);
        }

        return $this->result->getData();
    }
}