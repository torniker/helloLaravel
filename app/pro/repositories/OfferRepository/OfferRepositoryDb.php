<?php

namespace pro\repositories\OfferRepository;

use Offer;
class OfferRepositoryDb implements OfferRepositoryInterface {


	public function all($perpg = 25) {
		$offers = Offer::orderBy('created_at','desc')->paginate($perpg);
		return $offers;
	}

	public function byId($id) {
		return Offer::with('user')->find($id);
	}

	public function create($input) {
		$offer = new Offer;
		
		$offer->fill($input);
		$offer->save();

		return $offer;
	}

	public function update($id,$input){

	}

	public function delete($id){
		$offer = $this->byId($id);
		
		if($offer->delete()){
			return true;
		}

		return false;

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
 