<?php

namespace Bquadro\Fos\Prefilters;

use Bitrix\Main\Application;
use Bitrix\Main\Error;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bquadro\Fos\Prefilters\Recaptcha\GoogleRecaptcha;
use Bquadro\Fos\Prefilters\Recaptcha\ReCaptchaResponse;
use COption;

class RecapchaPrefilter extends \Bitrix\Main\Engine\ActionFilter\Base
{

    private static $_signupUrl     = "https://www.google.com/recaptcha/admin";
    private static $_siteVerifyUrl = "https://www.google.com/recaptcha/api/siteverify?";
    private static $_version       = "php_1.0";
    private        $_secret;

    public function onBeforeAction(Event $event): ?EventResult
    {
        $seckretKey = COption::GetOptionString('bquadro.fos', 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_SECRET');

        if (empty($seckretKey)) {
            $this->addError(new Error('Google Recaptcha Secret Error. В настрйках модуля не указан секрет.'));

            return new EventResult(EventResult::ERROR, null, null, $this);
        }

        $this->_secret = $seckretKey;

        $token = $this->getRecapchaToken();

        if (empty($token)) {
            $this->addError(new Error('Google Recaptcha Token Error. В параметрах запроса нет токена.'));

            return new EventResult(EventResult::ERROR, null, null, $this);
        } else {
            $verify = $this->verifyResponse($_SERVER['REMOTE_ADDR'], $token);
            if ($verify->success == 'false' || $verify->action !== 'send_form' || floatval($verify->score) < 0.5) {
                $this->addError(
                    new Error('Google Recaptcha Error. Похоже в бот. '.$seckretKey.' '.json_encode($verify))
                );

                return new EventResult(EventResult::ERROR, null, null, $this);
            }

            return null;
        }
    }

    private function getRecapchaToken()
    {
        $data = $this->getFosData();

        if (isset($data['recapchaToken'])) {
            return $data['recapchaToken'];
        }

        return null;
    }

    private function getFosData(): array
    {
        $request = Application::getInstance()->getContext()->getRequest();

        return $request->getPostList()->toArray();
    }

    /**
     * Calls the reCAPTCHA siteverify API to verify whether the user passes
     * CAPTCHA test.
     *
     * @param string $remoteIp IP address of end user.
     * @param string $response response string from recaptcha verification.
     *
     * @return ReCaptchaResponse
     */
    public function verifyResponse($remoteIp, $response)
    {
        // Discard empty solution submissions
        if ($response == null || strlen($response) == 0) {
            $recaptchaResponse = new ReCaptchaResponse();
            $recaptchaResponse->success = false;
            $recaptchaResponse->errorCodes = 'missing-input';

            return $recaptchaResponse;
        }

        $data = array(
            'secret'   => $this->_secret,
            'remoteip' => $remoteIp,
            //'v' => self::$_version,
            'response' => $response,
        );
        $getResponse = $this->_submitHttpGet(
            self::$_siteVerifyUrl,
            $data
        );

        $answers = json_decode($getResponse, true);
        $recaptchaResponse = new ReCaptchaResponse();

        if (trim($answers ['success']) == true) {
            $recaptchaResponse->success = 'true';
            $recaptchaResponse->score = $answers["score"];
            $recaptchaResponse->action = $answers["action"];
        } else {
            $recaptchaResponse->success = 'false';
            $recaptchaResponse->errorCodes = $answers ["error-codes"];
        }

        return $recaptchaResponse;
    }

    /**
     * Submits an HTTP GET to a reCAPTCHA server.
     *
     * @param string $path url path to recaptcha server.
     * @param array $data array of parameters to be sent.
     *
     * @return array response
     */
    private function _submitHTTPGet($path, $data)
    {
        $req = $this->_encodeQS($data);

        $url = $path.$req;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);

        //$response = file_get_contents($path . $req);

        return $response;
    }

    /**
     * Encodes the given data into a query string format.
     *
     * @param array $data array of string elements to be encoded.
     *
     * @return string - encoded request.
     */
    private function _encodeQS($data)
    {
        $req = "";
        foreach ($data as $key => $value) {
            $req .= $key.'='.urlencode(stripslashes($value)).'&';
        }

        // Cut the last '&'
        $req = substr($req, 0, strlen($req) - 1);

        return $req;
    }
}