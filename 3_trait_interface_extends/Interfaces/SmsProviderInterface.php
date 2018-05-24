<?php

namespace Interfaces;

/**
 * Interface SmsProviderInterface
 * @package Interfaces
 */
interface SmsProviderInterface {

    public function sendSms($phone, $code);

}
