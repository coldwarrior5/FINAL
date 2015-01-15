<?php
include_once('../revan/error.php');
include_once('../revan/json.php');

class Security
{
	
	
	public static function checkToken($id, $token)
	{
		$prefix = "70d415b7e5ba9ed2c8afbb628263f1f4587f778f";
		$suffix = "7fb87f95dfc09a913e683abd263f6f361ef46120";
		$serverToken = sha1($prefix.$id.$suffix);
		
		if($serverToken != $token)
		{
			Json::renderError(AuthenticationError::authorizationError());
		}
	}
	
	public static function wrapSha1($password)
	{
		$prefix = "70d415b7e5ba9ed2c8afbb628263f1f4587f778f";
		$suffix = "7fb87f95dfc09a913e683abd263f6f361ef46120";
		
		return sha1($prefix.$password.$suffix);
	}
	
	public static function applySessionAndWrap($model)
	{
		if($model->id == 0 || $model->id == -1 || $model->id == NULL)
		{
			Json::renderError(DatabaseError::noRecord());
		}
		
		$session = Security::wrapSha1($model->id);
		$modelArray = $model->toArray();
		$modelArray['session'] = $session;
		
		global $callback; echo $callback.'('.json_encode($modelArray).')';
		
		
	}
	
}

?>
