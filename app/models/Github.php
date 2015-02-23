<?php

use OAuth2\OAuth2;
use OAuth2\Token_Access;
use OAuth2\Exception as OAuth2_Exception;

class Github{
	public static function gitAuth()
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
				$curUser = Auth::user();
				$curUser = User::find($curUser->id);

				$uid = $user['uid'];

				try{
					$uidUser = User::where('gitId', '=', $uid)->firstOrFail();
				}catch (Exception $e) {
    				$curUser->gitId = $user['uid'];
					$curUser->save();
					return Redirect::to(URL::to('editprofile/'.$user['nickname']))
					->with('msg',"წარმატებით მიაბი GitHub");
				}

				return Redirect::to(URL::to('editprofile'))
				->with('msg',"ეს GitHub უკვე მიბმულია");

				
			}
			catch (OAuth2_Exception $e)
			{
				show_error('შეცდომა: '.$e);
			}
		}
	}

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
				$uid = $user['uid'];
				try{
					$uidUser = User::where('gitId', '=', $uid)->firstOrFail();
				}catch (Exception $e){
					Session::flash('msg', 'ამ გიტჰაბზე არ არის მიბმული მომხმარებელი');
					return Redirect::to(URL::to(''));
				}
				$dbid = $uidUser->id;
				$curUser = User::find($dbid);
				Auth::login($curUser);
				return Redirect::to(URL::to('dashboard'));
			}
			catch (OAuth2_Exception $e)
			{
				show_error('შეცდომა: '.$e);
			}
		}
	}

}
