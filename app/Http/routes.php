<?php

Route::get('/', function () {
    return Redirect::to('/login');
});
Route::auth();
Route::get('/home', 'HomeController@index');
Route::group(['prefix' => 'project/'], function () {
        Route::get('album', 'FacebookController@albumList');
        Route::get('logout', 'FacebookController@logout');
});
Route::group(['prefix'=>'project/'],function(){
        Route::get('add','ProjectController@add');
        Route::post('add','ProjectController@create');
        Route::get('view','ProjectController@view');
        Route::get('delete/{id}','ProjectController@delete');
        Route::post('update','ProjectController@update');
});
Route::group(['prefix'=>'report/'],function(){
        Route::get('add','ReportController@add');
        Route::post('add','ReportController@create');
        Route::post('addcontent','ReportController@createcontent');
        Route::get('view/{report_id}','ReportController@view');
        Route::get('allview','ReportController@getview');
        Route::get('viewbydate/{date}','ReportController@viewbydate');
        Route::get('getall','ReportController@getall');
        Route::get('delete/{id}','ReportController@delete');
        Route::post('update','ReportController@update');
        Route::get('date/{date}/{id}','ReportController@show');
        Route::get('id/{report_id}/{id}','ReportController@show2');
});
Route::group(['prefix'=>'jira/'],function(){
         Route::get('view','JiraController@view');
         Route::post('view','JiraController@show');
});

Route::get('changelanguage/{ln}','HomeController@changelanguage');
Route::get('complain','complainmgmt@index');
Route::post('complain/add','complainmgmt@add');
Route::get('complain/view','complainmgmt@view');
Route::get('feedback','FeedbackController@index');
Route::post('feedback/add','FeedbackController@add');
Route::get('feedback/view','FeedbackController@view');

