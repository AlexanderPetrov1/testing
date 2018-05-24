<?php

namespace Classes;

/**
 * Class PhoneLogin
 * @package Classes
 */
class PhoneLogin extends UserLoginAbstract {

    private $phone;
    private $smsCode;
    private $userSmsCode;
    private $demoSmsCode = '1111';
    private $demoPhone = '+380956800223';

    /**
     * PhoneLogin constructor.
     * @param $phone
     */
    public function __construct($phone) {
        parent::__construct();
        $this->phone = $phone;
    }

    /**
     * Send sms via different providers
     * @param $provider
     */
    public function sendSms($provider) {
        $classname = 'Providers\\' . $provider . 'Provider';
        if (!class_exists($classname)) {
            throw new Exception("Provider {$provider} not found");
        }

        $service = new $classname;
        $this->smsCode = $this->demoSmsCode;

        $service->sendSms($this->phone, $this->smsCode);
    }

    /**
     * Set code from SMS entered by user
     * @param $code
     */
    public function setUserSmsCode($code) {
        $this->userSmsCode = $code;
    }

    /**
     * Find user with same email and password. Demo mode
     * @return bool|int
     */
    public function findUser() {
        if ($this->phone == $this->demoPhone && $this->userSmsCode == $this->demoSmsCode) {
            return 2;
        }
        return false;
    }
}
