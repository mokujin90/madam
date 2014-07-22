<?php
class WebUser extends CWebUser
{
    private $_model = null;

    function getOwner() {
        if($user = $this->getModel()){
            return $user->is_owner;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'is_owner'));
        }
        return $this->_model;
    }
}