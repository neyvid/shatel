<?php

namespace App\Services\Sms;

class SendSms extends SmsContract
{
    private static $sms_client;
    const username = 'smsh5511';
    const password = '17836886';
    const pnlno = '30002659999998';
    const isflash = false;

    public static function sendSms($mobileNumber, string $text)
    {
        self::$sms_client = new \SoapClient('http://webservice.0098sms.com/service.asmx?wsdl',
            array('encoding' => 'UTF-8'));
        $parameters['username'] = self::username;
        $parameters['password'] = self::password;
        $parameters['mobileno'] = $mobileNumber;
        $parameters['pnlno'] = self::pnlno;
        $parameters['text'] = $text;
        $parameters['isflash'] = self::isflash;
        return self::$sms_client->SendSMS($parameters)->SendSMSResult;

    }

}
