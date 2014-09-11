<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_NEED_CONFIRM=3;

    private $_id;

    public function authenticate()
    {
        $username = mb_strtolower($this->username);
        $user = User::model()->with('company')->find('LOWER(login)=?', array($username));
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($this->password !== $user->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else if (!$user->company->is_confirmed) {
            $this->errorCode = self::ERROR_NEED_CONFIRM;
        }else {
            $this->_id = $user->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}