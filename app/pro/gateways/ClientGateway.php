<?php namespace pro\gateways;

use pro\repositories\ClientRepository\ClientRepository;

class ClientGateway {

	private $clientRepo;

	public function __construct(ClientRepository $clientRepo) {
		$this->clientRepo = $clientRepo;
	}

	public function doRegister($input) {
		return $this->clientRepo->doRegister($input);
	}
}