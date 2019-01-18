<?php

namespace App;

class Session {
    const SESSION_STARTED = true;
    const SESSION_NOT_STARTED = false;

    private $sessionState = self::SESSION_NOT_STARTED;

    private static $instance;

    private function __construct() {}

    static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        self::$instance->startSession();
        return self::$instance;
    }

    function startSession() {
        if ($this->sessionState == self::SESSION_NOT_STARTED) {
            $this->sessionState = session_start();
        }
        return $this->sessionState;
    }

    function __set($name , $value) {
        $_SESSION[$name] = $value;
    }

    function __get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    function __isset($name) {
        return isset($_SESSION[$name]);
    }

    function __unset($name) {
        unset($_SESSION[$name]);
    }

    function destroy() {
        if ($this->sessionState == self::SESSION_STARTED) {
            $this->sessionState = !session_destroy();
            setcookie("member_login", '', time() - 3600, '/');
            setcookie("access_token", '', time() - 3600, '/');
            unset($_SESSION);
            return !$this->sessionState;
        }
        return false;
    }

    function hasLoggedInUser() {
        $this->attemptAutoLogin();
        return isset($this->userId);
    }

    function logIn($user, $useCookie) {
        setcookie("member_login", '', time() - 3600, '/');
        setcookie("access_token", '', time() - 3600, '/');
        $this->userId = $user->getId();
        if ($useCookie) {
            $cookie_expiration_time = time() + (30 * 24 * 60 * 60);
            setcookie("member_login", $user->getId(), $cookie_expiration_time, '/');
            setcookie("access_token", $user->getToken(), $cookie_expiration_time, '/');
        }
    }

    function getLoggedUser() {
        if ($this->hasLoggedInUser()) {
            return \App\Model\User::getById($this->userId);
        }
        return null;
    }

    private function attemptAutoLogin() {
         $user = \App\Model\User::getById($_COOKIE['member_login']);
         if ($user && $user->getToken() === $_COOKIE['access_token']) {
            $this->logIn($user, true);
         }
    }
}
