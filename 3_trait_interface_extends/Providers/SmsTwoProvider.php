<?php

namespace Providers;

use Interfaces\SmsProviderInterface;

/**
 * Class SmsTwoProvider
 * @package Providers
 */
class SmsTwoProvider implements SmsProviderInterface {

    /**
     *
     * Send SMS via SmsOne provider
     * @param $phone
     * @param $code
     */
    public function sendSms($phone, $code) {
        if ($this->sendViaSmsTwo($phone, $code)) {
            echo "Code {$code} sent to {$phone} via SMS Two provider <br />";
            return true;
        }

        return false;
    }

    private function sendViaSmsTwo($phone, $code) {
        return true;
    }

}
