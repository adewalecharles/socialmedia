<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Courses
    Route::post('courses/media', 'CourseApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CourseApiController');

    // Lessons
    Route::post('lessons/media', 'LessonApiController@storeMedia')->name('lessons.storeMedia');
    Route::apiResource('lessons', 'LessonApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');

    // Questions Options
    Route::apiResource('questions-options', 'QuestionsOptionsApiController');

    // Tests
    Route::apiResource('tests', 'TestsApiController');
});
