<?php 

namespace pro\gateways;

use pro\repositories\CommentRepository\CommentRepositoryInterface;
use Input;
use Comment;
use Hash;
use Validator;

class CommentGateway {

	public function __construct(CommentRepositoryInterface $CommentRepository) {

		$this->CommentRepository = $CommentRepository;

	}

	public function create($params){
		$comment = new Comment;
		
		validate($params,$comment->rules['creating']);
		
		return $this->CommentRepository->create($params); 

	}

	public function getOffersWhere($oldWhere=[]){
		$where = [];

		foreach ($oldWhere as $key => $cond) {
			if(is_array($cond)){
				
				$elNum = count($cond);

				if($elNum==3){
					$where[] = [$cond[0],$cond[1],$cond[2]];
				}

				if($elNum==2){
					$where[] = [$cond[0],'=',$cond[1]];
				}
			}
		}
		
		return $this->OfferRepo->getOffersWhere($where);
	}

}