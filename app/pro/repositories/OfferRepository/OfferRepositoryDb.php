<?php

namespace pro\repositories\OfferRepository;

use Offer;
class OfferRepositoryDb implements OfferRepositoryInterface {

	public $errors = [];

	public function all($perpg = 25) {
		$offers = Offer::orderBy('created_at','desc')->paginate($perpg);
		return $offers;
	}

	public function byId($id,$with=['user']) {
		return Offer::with($with)->find($id);
	}

	public function create($input) {
		$offer = new Offer;
		
		$offer->fill($input);
		$offer->save();

		return $offer;
	}

	public function update($id,$input){

		$offer = $this->getOffersWhere($id);
		$offer->fill($input);
		$offer->save();

		return $course;
	}

	public function delete($id){
		$offer = $this->byId($id);
		
		if($offer->delete()){
			return true;
		}

		return false;

	} 
	
	public function hire($params){
		$offer = $this->byId($params['offer_id'],['user']);
		
		if($offer->project->user->id!=$params['user_id']){
			return 'You don\'t have permission to hire freelancer on this project';
		}

		if($offer->project->id!=$params['project_id']){
			return 'The offer doesn\'t belong to the project';
		}

		if($offer->status>=2){
			return 'You already hired this offer';
		}

		$offer->status=2;
		$offer->save();
		return true;
	}

	public function finish($params){
		$offer = $this->byId($params['offer_id'],['user','project.user']);
		
		if($offer->project->user->id!=$params['user_id']){
			return 'You don\'t have permission to finish this offer';
		}

		if($offer->project->id!=$params['project_id']){
			return 'The offer doesn\'t belong to the project';
		}

		if($offer->status==1){
			return 'You haven\'t hired this offer yet';
		}

		if($offer->status>=3){
			return 'You already finished this offer';
		}

		$offer->status=3;
		$offer->save();

		return true;
	}

	public function addFeedback($params){
		$offer = $this->byId($params['offer_id'],['user','project.user']);
		
		if($offer->project->user->id!=$params['user_id']){
			return 'You don\'t have permission to add feedback to this this offer';
		}

		if($offer->project->id!=$params['project_id']){
			return 'The offer doesn\'t belong to the project';
		}

		if($offer->status!=3){
			return 'Offer is not finished yet';
		}

		$offer->feedback=$params['feedback'];
		$offer->save();

		return true;
	}

	public function getOffersWhere($where){
		$offers = new Offer;

		foreach ($where as $key => $condition) {
			$offers = $offers->where($condition[0],$condition[1],$condition[2]);
		}

		return $offers->get();
	}

	public function byUserId($id,$perpg = 25){ 
		return Offer::with('user')->where('user_id',$id)->orderBy('created_at','desc')->paginate($perpg); 
	}

}
 