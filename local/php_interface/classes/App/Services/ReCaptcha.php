<?php

namespace App\Services;

use Bitrix\Main\Result;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\Web\HttpClient;

class ReCaptcha implements Errorable
{
    const API_URL = 'https://www.google.com/recaptcha/api/siteverify';

    protected Result $result;
    protected string $token;
    protected string $action;

    public function __construct($token = '', $action = 'submit')
    {
        $this->token = $token;
        $this->action = $action;

        $this->result = new Result();
    }

    public function getErrors(): array
    {
        return $this->result->getErrorMessages();
    }

    public function getErrorByCode($code): Error
    {
        return $this->result->getErrorCollection()->getErrorByCode($code);
    }

    public function getResult(): array
    {
        return [
            'success' => $this->result->isSuccess() ? 'success' : 'error',
            'data' => $this->result->getData(),
            'errors' => $this->getErrors(),
        ];
    }

    public function verify()
    {
        try {
            if (empty($this->token)) {
                throw new \Exception('Не пройдена проверка Google reCAPTCHA v3');
            }

            $postData = [
                'secret' => GOOGLE_RECAPTCHA_V3_SECRET_KEY,
                'response' => $this->token,
                'remoteip' => $this->getIp(),
            ];

            $response = $this->sendRequest($postData);

            $gRecaptchaResponseCheck = false;
            if (($response["success"] && $response["score"] >= 0.5 && $response["action"] == $this->action)) {
                $gRecaptchaResponseCheck = true;
            }

            if (!$gRecaptchaResponseCheck) {
                throw new \Exception('Не пройдена проверка Google reCAPTCHA v3');
            }
        } catch (\Exception $e) {
            $this->result->addError(new Error($e->getMessage()));
        }

        return $this->getResult();
    }

    protected function call($postData)
    {
        $httpClient = new HttpClient();
        $httpClient->setTimeout(30);
        $httpClient->setStreamTimeout(60);
        $httpClient->setHeader('Accept', 'application/json; charset=UTF-8');
        $httpClient->setHeader('Content-Type', 'application/json');
        $httpClient->get(self::API_URL . '?' . http_build_query($postData));

        $status = $httpClient->getStatus();
        $response = json_decode($httpClient->getResult(), true);

        return [
            'status' => $status,
            'response' => $response,
        ];
    }

    protected function sendRequest($postData): ?array
    {
        $result = $this->call($postData);

        if ($result['status'] == 200) {
            return $result['response'];
        } else {
            throw new \Exception('Ошибка соединения, попробуйте позже');
        }

        return null;
    }

    protected function getIp()
    {
        $value = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $value = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $value = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $value = $_SERVER['REMOTE_ADDR'];
        }

        return $value;
    }
}