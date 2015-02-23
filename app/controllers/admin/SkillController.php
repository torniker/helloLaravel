<?php
class SkillController extends BaseController {

	protected $layout = 'layouts.admin';

	public function index()
	{
		$skills = Skill::get();
		return View::make('admin.skills.index')->with('skills', $skills);
	}
	public function show($id) {
		$skill = Skill::with('users')->find($id);
		return View::make('admin.skills.show')->with('skill', $skill);
	}

	public function create() {
		return View::make('admin.skills.create');
	}

	public function store() {
		$input = Input::all();
		$skill = new Skill;
		$skill->fill($input);
		$skill->save();
		return Redirect::to('admin/skill')
			->with('message_type','success')
			->with('message', 'Skill added successfully');
	}

	public function edit($id) {
		$skill = Skill::find($id);
		return View::make('admin.skills.edit')->with('skill', $skill);
	}

	public function update($id) {
		$skill = Skill::find($id);
		if(is_null($skill)) {
			return Redirect::to('admin/skill');
		}

		$input = Input::all();
		$skill->fill($input);
		$skill->save();
		return Redirect::to('admin/skill')
			->with('message_type','success')
			->with('message', 'Skill updated successfully');
	}

	public function destroy($id) {
		$skill = Skill::find($id);
		if(is_null($skill)) {
			return Redirect::to('admin/skill');
		}

		$skill->delete();
		DB::table('skill_user')->where('skill_id', '=', $id)->delete();
		return Redirect::to('admin/skill')
			->with('message_type','success')
			->with('message', 'User deleted successfully');
	}

}
