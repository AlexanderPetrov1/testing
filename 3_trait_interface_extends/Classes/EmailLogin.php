<?php

namespace Classes;

/**
 * Class EmailLogin
 * @package Classes
 */

class EmailLogin extends UserLoginAbstract{

    private $email;
    private $password;

    private $demoEmail      = 'test@test.com';
    private $demoPassword   = '123456';

    /**
     * EmailLogin constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password) {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Find user with same email and password. Demo mode
     * @return bool|int
     */
    public function findUser() {
        if ($this->email == $this->demoEmail && $this->password == $this->demoPassword) {
            return 1;
        }
        return false;
    }

}
