<?php
class TrainingController extends BaseController {

	protected $layout = 'layouts.admin';

	public function index()
	{
		$trainings = Training::get();
		return View::make('admin.trainings.index')->with('trainings', $trainings);
	}

	public function create() {
		return View::make('admin.trainings.create');
	}

	public function store() {
		$input = Input::all();
		$training = new Training;
		$training->fill($input);
		$training->save();
		return Redirect::to('admin/trainings')
			->with('message_type','success')
			->with('message', 'Training added successfully');
	}

	public function edit($id) {
		$training = Training::find($id);
		return View::make('admin.trainings.edit')->with('training', $training);
	}

	public function update($id) {
		$training = Training::find($id);
		if(is_null($training)) {
			return Redirect::to('admin/trainings');
		}

		$input = Input::all();
		$training->fill($input);
		$training->save();
		return Redirect::to('admin/trainings')
			->with('message_type','success')
			->with('message', 'Training updated successfully');
	}

	public function destroy($id) {
		$training = Training::find($id);
		if(is_null($training)) {
			return Redirect::to('admin/trainings');
		}

		$training->delete();
		DB::table('training_user')->where('training_id', '=', $id)->delete();
		return Redirect::to('admin/trainings')
			->with('message_type','success')
			->with('message', 'User deleted successfully');
	}

}
