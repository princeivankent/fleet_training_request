<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return response()->json(TrainingProgram::findOrFail($training_program_id)->delete());
    }
}
