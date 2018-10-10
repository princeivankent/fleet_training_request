<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Approver;
use App\Http\Requests;

class ApproverController extends Controller
{
    public function index()
    {
        return response()->json(Approver::with('approval_statuses')->latest()->get());
    }

    public function store(Request $request)
    {
        $query = new Approver;
        $query->approver_name = $request->approver_name;
        $query->position = $request->position;
        $query->save();

        return response()->json($query);
    }

    public function show($approver_id)
    {
        return response()->json(Approver::findOrFail($approver_id)->with('approval_statuses')->first());
    }

    public function update(Request $request, $approver_id)
    {
        $query = Model::findOrFail($approver_id);
        $query->approver_name = $request->approver_name;
        $query->position = $request->position;
        $query->save();
        
        return response()->json($query);
    }

    public function destroy($approver_id)
    {
        $query = Approver::findOrFail($approver_id);
        $query->delete();

        return response()->json($query);
    }
}
