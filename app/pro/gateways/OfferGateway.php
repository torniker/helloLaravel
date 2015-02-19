<?php 

namespace pro\gateways;

use pro\repositories\OfferRepository\OfferRepositoryInterface;
use Auth;
use Offer;
use Notification;
class OfferGateway {

	private $OfferRepo;

	public function __construct(OfferRepositoryInterface $OfferRepo) {
		$this->OfferRepo = $OfferRepo;
	}
 
	public function all($perpg = 25) {
		return $this->OfferRepo->all($perpg);
	}

	public function byId($id) {
		return $this->OfferRepo->byId($id);
	}

	public function create($input) {
		$input['user_id'] = Auth::user()->id;
		$offer = new Offer;
		validate($input,$offer->rules['creating']);
		
		return $this->OfferRepo->create($input);
	}
	
	public function update($id,$input) { 
		return $this->OfferRepo->update($id,$input);
	}

	public function delete($id){
		return $this->OfferRepo->delete($id);
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

	public function getCurrentUserOffers(){
		$user = Auth::user();
		return $this->OfferRepo->ByUserId($user->id);
	}

	public function hire($user_id,$project_id,$offer_id){
		$offer = new Offer;
		$params = ['offer_id'=>$offer_id,'project_id'=>$project_id,'user_id'=>$user_id];

		validate($params,$offer->rules['hiring']);
		

		$res = $this->OfferRepo->hire($params);
		
		if(is_string($res)){
			Notification::error($res);
			return false;
		}

		if($res===true){
			return true;
		}
		
		return false;
	}

	public function finish($user_id,$project_id,$offer_id){
		$offer = new Offer;
		$params = ['offer_id'=>$offer_id,'project_id'=>$project_id,'user_id'=>$user_id];

		validate($params,$offer->rules['finishing']);
		

		$res = $this->OfferRepo->finish($params);
		
		if(is_string($res)){
			Notification::error($res);
			return false;
		}

		if($res===true){
			return true;
		}
		
		return false;
	}

	public function addFeedback($user_id,$project_id,$offer_id,$feedback){
		$offer = new Offer;
		$params = ['offer_id'=>$offer_id,'project_id'=>$project_id,'user_id'=>$user_id,'feedback'=>$feedback];

		validate($params,$offer->rules['adding_feedback']);
		

		$res = $this->OfferRepo->addFeedback($params);
		
		if(is_string($res)){
			Notification::error($res);
			return false;
		}

		if($res===true){
			return true;
		}
		
		return false;
	}
}