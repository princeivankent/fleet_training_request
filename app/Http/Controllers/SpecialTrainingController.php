<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use Image;
use App\SpecialTraining;
use App\SpecialTrainingImage;
use App\Http\Requests;

class SpecialTrainingController extends Controller
{
    public function index()
    {
        return SpecialTraining::with('special_training_images')->get();
    }

    public function show($special_training_id)
    {
        return SpecialTraining::with('special_training_images')->findOrFail($special_training_id);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'program_title' => 'required|string'
        ]);

        $query = new SpecialTraining;
        $query->program_title = $request->program_title;
        $query->save();
        
        return response()->json($query);
    }

    public function update(Request $request, $special_training_id)
    {
        $query = SpecialTraining::findOrFail($special_training_id);
        $query->program_title = $request->program_title;
        $query->save();
        
        return response()->json($query);
    }

    public function delete($special_training_id)
    {
        $query = SpecialTraining::findOrFail($special_training_id);
        $images = SpecialTrainingImage::where('special_training_id', $special_training_id)->get();
        $query->delete();

        if ($query) {
            foreach ($images as $value) {
                Storage::disk('photo_gallery')->delete($value->image);
            }
        }

        return response()->json($query);
    }

    public function get_images($special_training_id)
    {
        return SpecialTrainingImage::where('special_training_id', $special_training_id)->get();
    }

    public function store_image(Request $request)
    {
        $query = new SpecialTrainingImage;
        $query->special_training_id = $request->special_training_id;
        
        if ($request->get('image')) {
            $image = $request->get('image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/photo_gallery/').$name);
            $query->image = $name;
        }
        
        $query->save();

        return response()->json($query);
    }

    public function delete_image($special_training_image_id)
    {
        $query = SpecialTrainingImage::findOrFail($special_training_image_id);
        $query->delete();

        if ($query) {
            Storage::disk('photo_gallery')->delete($query->image);
        }

        return response()->json($query);
    }
}