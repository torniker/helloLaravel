<?php 

namespace pro\repositories\GithubRepository;

use User;
use Hash;

class GithubRepositoryApi implements GithubRepositoryInterface {
	protected $client;
	public function __construct(){
		$this->client = new \Guzzle\Service\Client('https://api.github.com/');
	}

	public function getUser($username){
		debug(sprintf('users/%s',$username));
		return $this->client->get(sprintf('users/%s',$username))->send()->json();
	}
}
