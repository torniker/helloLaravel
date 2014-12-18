<?php

use OAuth2\OAuth2;
use OAuth2\Token_Access;
use OAuth2\Exception as OAuth2_Exception;

class Github{
	public static function gitLogin()
	{
		$provider='github'; //შეგვიძლია ასევე გამოვიყენოთ Google ან Facebook
		$provider = OAuth2::provider($provider, array(
			'id' => 'b243bed6dc5e9e88c7d0',
			'secret' => 'baa29a827c04f045ec156917905957813d9989a8',
			));

		if ( ! isset($_GET['code'])){
			return $provider->authorize();
		}
		else
		{
			try{
				$params = $provider->access($_GET['code']);
				$token = new Token_Access(array(
					'access_token' => $params->access_token
					));
				$user = $provider->get_user_info($token);
				return Redirect::to("editprofile/".$user['nickname']);
			}
			catch (OAuth2_Exception $e)
			{
				show_error('შეცდომა: '.$e);
			}
		}
	}

}
