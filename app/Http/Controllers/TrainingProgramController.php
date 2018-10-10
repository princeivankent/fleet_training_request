<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image as Gallery;
use Image;
use Storage;
use Illuminate\Support\Facades\DB;
use App\TrainingProgram;
use App\Http\Requests;
use League\Flysystem\Exception;

class TrainingProgramController extends Controller
{
	public function index()
	{
		return response()->json(TrainingProgram::with(['program_features','images'])->get());
	}

	public function show($training_program_id)
	{
		return response()->json(TrainingProgram::where('training_program_id', $training_program_id)->with(['program_features','images'])->first());
	}

	public function store(Request $request)
	{
		try {
			DB::beginTransaction();

			$query = new TrainingProgram;
			$query->program_title = $request->program_title;
			$query->description = $request->description;
			$query->save();
			
			if ($query) {
				$training_program_id = $query->training_program_id;
				$features = $request->features;

				foreach ($features as $key => $value) {
					$features[$key]['training_program_id'] = $training_program_id;
				}

				$query = DB::table('program_features')->insert($features);
			}

			DB::commit();
			return response()->json($query);
		} catch (Exception $e) {
			DB:rollBack();

			return false;
		}
	}

	public function update(Request $request, $training_program_id)
	{
		try {
			DB::beginTransaction();

			$program_feature_ids = $request->program_feature_ids;
			if ($program_feature_ids > 0) {
				foreach ($program_feature_ids as $key => $value) {
					DB::table('program_features')->where('program_feature_id', $value)->delete();
				}
			}

			$query = TrainingProgram::findOrFail($training_program_id);
			$query->program_title = $request->program_title;
			$query->description = $request->description;
			$query->save();
			
			if ($query) {
				$training_program_id = $query->training_program_id;
				$features = $request->program_features;
				
				foreach ($features as $key => $value) {
					$find = DB::table('program_features')->where('feature', $value['feature'])->exists();
					if (!$find) {
						$query = DB::table('program_features')
							->insert([
								'feature'             => $value['feature'],
								'training_program_id' => $training_program_id
							]);
					}
				}
			}

			DB::commit();
			return response()->json($query);
		} catch (Exception $e) {
			DB:rollBack();

			return false;
		}
	}

	public function delete($training_program_id)
	{
		$query = TrainingProgram::findOrFail($training_program_id);

		$trans = $query;
		if ($trans) {
			$trans = DB::table('images')
				->select('image')	
				->where('training_program_id', $training_program_id)
				->get();

			foreach ($trans as $key => $value) {
				Storage::disk('photo_gallery')->delete($value->image);
			}
		}
		$query->delete();

		return response()->json($query);
	}

	public function upload_image(Request $request)
	{
		$training_program_id = $request->training_program_id;

		$query = new Gallery;
		$query->training_program_id = $training_program_id;

		if ($request->get('image')) {
			$image = $request->get('image');
			$name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
			Image::make($request->get('image'))->save(public_path('images/photo_gallery/').$name);
		}

		$query->image = $name;
		$query->save();

		return response()->json($query);
	}

	public function get_images($training_program_id)
	{
		return response()->json(TrainingProgram::where('training_program_id', $training_program_id)->with('images')->first());
	}
}