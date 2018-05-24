<?php

namespace Classes;

/**
 * Class UserLoginAbstract
 * @package Classes
 */
abstract class UserLoginAbstract{

    private $userId;

    /**
     * UserLoginAbstract constructor.
     */
    public function __construct() {
        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    /**
     * Make user logged in
     * @param $userId
     */
    public function userLogin($userId) {
        $this->userId = $userId;
        $_SESSION['user_id'] = $userId;
    }

    /**
     * Make user logged out
     */
    public function userLogout() {
        $this->userId = null;
        unset($_SESSION['user_id']);
    }

    /**
     * Return user id or null
     * @return null
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Abstract function to find users
     * @return mixed
     */
    public abstract function findUser();
}

