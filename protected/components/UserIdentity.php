<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

		public function authenticate()
		{

		$user=User::model()->findByAttributes(array('username'=>$this->username));
		if($user!==null) 
		{
			if($user->password===$this->password)
			{	

					if($user->role_id == 2)

					$this->setState('kategori_id',$user->getUserAttributeValueByKey('kategori_id'));
				$this->errorCode=self::ERROR_NONE;		
				
			} else {
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}					
		} else {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} 									
		return !$this->errorCode;
	}
}