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
    private $_user;

    public function authenticate($auto=false)
    {
        $username = mb_strtolower($this->username);
        $user = User::model()->with('company')->find('LOWER(login)=?', array($username));
        if ($user === null){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return !$this->errorCode;
        }
        else if ($user->getHash($this->password) !== $user->password && !$auto)
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




    public static function createAuthenticatedIdentity($model) {
        $identity=new self($model->login,'');
        $identity->_id=$model->id;
        $identity->errorCode=self::ERROR_NONE;
        return $identity;
    }

}