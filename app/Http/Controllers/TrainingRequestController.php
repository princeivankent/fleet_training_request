<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\TrainingRequest;
use App\Http\Requests;

class TrainingRequestController extends Controller
{
    public function index()
    {
        return response()->json('haha');
        return response()->json(
            TrainingRequest::with([
                'training_program',
                'unit_model'
            ])->get()
        );
    }

    public function show($training_request_id)
    {
        return response()->json(TrainingRequest::findOrFail($training_request_id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string',
            'office_address' => 'required|string',
            'contact_person' => 'required|string',
            'email' => 'required|string',
            'selling_dealer' => 'required|json',
            'position' => 'required|string',
            'contact_number' => 'required|string',
            'unit_models' => 'required|json',
            'training_participants' => 'required|json',
            'training_date' => 'required|date',
            'training_venue' => 'required|string',
            'training_address' => 'required|string',
            'training_program_id' => 'required|integer|exists:training_programs,training_program_id',
            'unit_model_id' => 'required|integer|exists:unit_models,unit_model_id'
        ]);

        return response()->json($request->all());
    }
}