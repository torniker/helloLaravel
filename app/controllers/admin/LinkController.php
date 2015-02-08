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
		$trainings = Input::get('trainings');
		$levels = Input::get('trlevel');
        $code = sha1(time());
        $code=trim($code);
   		$obj = new Code;
   		$obj->code=$code;
   		$obj->valid=1;
   		$obj->save();


		foreach ($trainings as $training) {
			$trlevel = empty($levels[$training])?0:$levels[$training];
			DB::table('code_training')->insert(
				array(
					'code_id' => $obj->id, 
					'training_id' => $training,
					'level' => $trlevel
					)
				);
		}

		return URL::to('newstudent').'/?token='.$code;

	}

}
