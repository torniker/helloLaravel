<?php
class LinkController extends BaseController {

	public function __construct() {
		$this->beforeFilter(function(){
			if (!Auth::check()){
				return Redirect::to('');
			}elseif(Auth::user()->type!=4){
				return Redirect::to('');
			}
		});
	}

	public function index(){
		return View::make('admin.generate');
	}
	public function generate(){
        $code = sha1(time());
        $code=trim($code);
   		$obj = new Code;
   		$obj->code=$code;
   		$obj->valid=1;
   		$obj->save();
        return URL::to('newstudent').'/?token='.$code;
	}

}
