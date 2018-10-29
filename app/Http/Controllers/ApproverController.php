<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Approver;
use App\Http\Requests;

class ApproverController extends Controller
{
    public function index()
    {
        return response()->json(Approver::with('approval_statuses')->oldest()->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'approver_name' => 'required|string',
            'position' => 'required|string',
        ]);

        $query = new Approver;
        $query->approver_name = $request->approver_name;
        $query->email = $request->email;
        $query->position = $request->position;
        $query->created_by = '(By dafault) Miguel Sanggalang';
        $query->save();
        
        return response()->json($query);
    }

    public function show($approver_id)
    {
        return response()->json(Approver::findOrFail($approver_id));
    }

    public function update(Request $request, $approver_id)
    {
        $this->validate($request, [
            'approver_name' => 'required|string',
            'position' => 'required|string',
        ]);
        
        $query = Approver::findOrFail($approver_id);
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
