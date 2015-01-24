<?php
use pro\gateways\JobsGateway;

class CommentController extends BaseController {

	private $gateway;

	public function __construct(JobsGateway $gateway) {
		$this->gateway = $gateway;
	}

	public function add(){
		$input = Input::all();
		$comment = new Comment;
		$comment->fill($input);
		$comment->save();
		return Redirect::back();
	}

	public function delete($id){
		$author=Input::get('authorid');
		$jobauthor=Input::get('jobauthor');
		$curuser=Auth::user();

		if ($curuser->type==4 || $curuser->id==$author || $curuser->id==$jobauthor) {
			$comment = Comment::find($id);
			$comment->delete();
			return Redirect::back();
		}
	}
	
	public function delete_validate($id){
		$user=Auth::user();
		if ($user->type==4) {
			return true;
		}
	}
}
