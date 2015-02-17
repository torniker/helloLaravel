<?php 

namespace pro\gateways;

use pro\repositories\GithubRepository\GithubRepositoryInterface;

class GithubGateway {

	private $GithubRepo;

	public function __construct(GithubRepositoryInterface $GithubRepo) {
		$this->GithubRepo = $GithubRepo;
	}

	public function getUser($username){
		return $this->GithubRepo->getUser($username);
	}
}