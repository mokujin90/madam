<?php
class WebUser extends CWebUser
{
    private $_model = null;

    public function getOwner() {
        if($user = $this->getModel()){
            return $user->is_owner;
        }
    }

    public function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id);
        }
        return $this->_model;
    }

    public function getCompanyId()
    {
        if($user = $this->getModel()){
            return $user->company_id;
        }
    }
}