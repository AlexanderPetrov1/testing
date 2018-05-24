<?php

namespace Providers;

use Interfaces\SmsProviderInterface;

/**
 * Class SmsOneProvider
 * @package Providers
 */
class SmsOneProvider implements SmsProviderInterface {

    /**
     *
     * Send SMS via SmsOne provider
     * @param $phone
     * @param $code
     */
    public function sendSms($phone, $code) {
        if ($this->sendViaSmsOne($phone, $code)) {
            echo "Code {$code} sent to {$phone} via SMS One provider <br />";
            return true;
        }

        return false;
    }

    private function sendViaSmsOne($phone, $code) {
        return true;
    }


}
