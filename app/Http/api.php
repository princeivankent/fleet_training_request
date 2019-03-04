<?php

Route::get('guest/dealers/get', 'Api\DealerController@index');
Route::get('guest/unit_models/get', 'Api\UnitModelController@index');
Route::get('guest/schedules/get', 'Api\ScheduleController@index');
Route::get('guest/training_programs/get', 'Api\TrainingProgramController@index');
Route::get('guest/gallery/get_images/{training_program_id}', 'Api\TrainingProgramController@get_images');