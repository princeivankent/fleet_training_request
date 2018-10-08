<?php


// ============== ADMINISTRATOR ================ //
Route::get('/admin/training_requests/get', 'TrainingRequestController@index');
Route::post('/admin/training_requests/store', 'TrainingRequestController@store');

// Dealers
Route::get('/admin/dealers/get', 'DealerController@index');
Route::get('/admin/dealers/get/{dealer_id}', 'DealerController@show');
Route::post('/admin/dealers/store', 'DealerController@store');
Route::put('/admin/dealers/update/{dealer_id}', 'DealerController@update');
Route::delete('/admin/dealers/delete/{dealer_id}', 'DealerController@delete');

// Unit Models
Route::get('/admin/unit_models/get', 'UnitModelController@index');
Route::get('/admin/unit_models/get/{unit_model_id}', 'UnitModelController@show');
Route::post('/admin/unit_models/store', 'UnitModelController@store');
Route::put('/admin/unit_models/update/{unit_model_id}', 'UnitModelController@update');
Route::delete('/admin/unit_models/delete/{unit_model_id}', 'UnitModelController@delete');

// Training Programs
Route::get('/admin/training_programs/get', 'TrainingProgramController@index');
Route::get('/admin/training_programs/show/{training_program_id}', 'TrainingProgramController@show');
Route::post('/admin/training_programs/store', 'TrainingProgramController@store');
Route::put('/admin/training_programs/update/{training_program_id}', 'TrainingProgramController@update');
Route::delete('/admin/training_programs/delete/{training_program_id}', 'TrainingProgramController@delete');

// ============== GUEST ================ //




// ============== Views ================ //
Route::get('/', function() { return view('guest.home'); });
Route::get('admin', function() { return redirect()->route('dashboard'); });
Route::get('admin/dashboard', function() { return view('admin.dashboard'); })->name('dashboard');
Route::get('admin/dealers', function() { return view('admin.dealers'); })->name('dealers');
Route::get('admin/unit_models', function() { return view('admin.unit_models'); })->name('unit_models');
Route::get('admin/training_programs', function() { return view('admin.training_programs'); })->name('training_programs');