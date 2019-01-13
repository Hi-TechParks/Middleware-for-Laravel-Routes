<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function(){
	return view('index');
});
Route::get('/adminkosm', 'HomeController@index');*/


// Home route
Route::get('/', 'HomeController@index');

// Additional Page routes
Route::get('/dashboard', 'DashboardController@index');
Route::get('/resource', 'ResourceController@index');
Route::get('/gallery', 'GalleryController@index');
Route::get('/video', 'VideoController@index');
Route::get('/contact','ContactController@index');

// Blog routes
Route::get('/blog','BlogController@index');
Route::get('/blog/{id}','BlogController@showByCategory');
Route::get('/blog/single/{id}','BlogController@show');

// Editorial routes
Route::get('/editorial/single/{id}', 'EditorialController@show')->name('editorial.show');

// Notice routes
Route::get('/notice', 'NoticeController@index')->name('notice.index');
Route::get('/notice/single/{id}', 'NoticeController@show')->name('notice.show');

// Program view
Route::get('/program/single/{id}', 'ProgramController@index')->name('program.index');

// Training routes
Route::get('/training','TrainingController@index')->name('training.index');
Route::get('/training/single/{id}/{pid}','TrainingController@show')->name('training.show');


// Workshop routes
Route::get('/workshop','WorkshopController@index')->name('workshop.index');
Route::get('/workshop/{id}/{pid}','WorkshopController@show')->name('workshop.show');



     // commenting tanvir vais code 23/10/2018

/*Route::get('/workshop/{id}','WorkshopController@show')->name('workshop.show');*/

     // commenting tanvir vais code end 23/10/2018





// Authentication routes
Auth::routes();




// Access Routes for Student Only
Route::middleware(['isStudent'])->group(function ()
{

	// Trainning registration routes
	Route::get('/training/registration','UserProgramRegistrationController@index')->name('training.registration.index');

	// Workshop registration routes
	Route::get('/workshop/registration','UserProgramRegistrationController@indexW')->name('workshp.registration.index');

});






// Access Routes for Trainer Only
Route::middleware(['isTrainer'])->group(function ()
{

	
	// Training category admin routes
	Route::post('admin/training/reg','AdminTrainingController@regTraining')->name('training.reg');
	Route::get('/admin/training/category','AdminTrainingCategoryController@index')->name('training_category.index');
	Route::post('/admin/training/category','AdminTrainingCategoryController@store')->name('training_category.store');
	Route::post('/admin/training/category/{id}','AdminTrainingCategoryController@update')->name('training_category.update');

	// Training program admin routes
	Route::get('/admin/training/reg/{id}/edit/{pid}','AdminTrainingController@regEdit')->name('training.reg.edit');
	Route::get('/admin/training/reg/list','AdminTrainingController@regTraininglist')->name('training.reg.list');
	Route::post('/admin/training/reg','AdminTrainingController@regTraining')->name('training.reg');
	Route::put('/admin/training/reg/{id}','AdminTrainingController@regUpdate')->name('training.update');
	Route::get('/admin/training/{id}/changestatus','AdminTrainingController@changeStatus')->name('training.status');
	Route::resource('/admin/training','AdminTrainingController');


	// Training faq admin routes
	Route::get('/admin/faq/{id}/changestatus','AdminTrainingFAQController@changeStatus')->name('faq.status');
	Route::resource('/admin/faq','AdminTrainingFAQController');

	// Training daytype admin routes
	Route::resource('/admin/daytype','AdminDaytypeController');


	// Training program daytype admin routes
	Route::get('/admin/pr/daytype','AdminProgramDaytypeController@index')->name('daytype.pr.index');
	Route::POST('/admin/pr/daytype','AdminProgramDaytypeController@store')->name('daytype.pr.store');
	Route::PUT('/admin/pr/daytype/{id}','AdminProgramDaytypeController@update')->name('daytype.pr.update');


	//**** codes added by Habib 6/11/2018 ****//
	//training program schedule admin routes
	Route::get('/admin/pr/schedule','AdminProgramScheduleController@index')->name('daytype.pr.index');
	Route::POST('/admin/pr/schedule','AdminProgramScheduleController@store')->name('daytype.pr.store');
	Route::PUT('/admin/pr/schedule/{id}','AdminProgramScheduleController@update')->name('daytype.pr.update');


	// Training outline admin routes 
	Route::get('/admin/pr/outline','AdminTrainingOutlineController@index')->name('outline.index');
	Route::post('/admin/pr/outline','AdminTrainingOutlineController@store')->name('outline.store');
	Route::PUT('/admin/pr/outline/{id}','AdminTrainingOutlineController@update')->name('outline.update');
	Route::get('/admin/pr/outline/{id}','AdminTrainingOutlineController@show')->name('outline.show');


	// Training outline details admin routes
	Route::get('/admin/pr/outline/details/{id}','AdminTrainingOutlineController@createDetails')->name('details.create');
	Route::post('/admin/pr/outline/details/{id}','AdminTrainingOutlineController@storeDetails')->name('details.store');
	Route::get('/admin/pr/outline/details/{id}/edit','AdminTrainingOutlineController@editDetails')->name('details.edit');
	Route::put('/admin/pr/outline/details/{id}','AdminTrainingOutlineController@updateDetails')->name('details.update');


	// Workshop admin routes
	Route::put('/admin/workshop/reg/{id}','AdminWorkshopController@regUpdate')->name('workshop.reg.update');
	Route::get('/admin/workshop/reg/list','AdminWorkshopController@regWorkshoplist')->name('workshop.reg.list');
	Route::post('/admin/workshop/reg','AdminWorkshopController@regWorkshop')->name('workshop.reg');
	Route::resource('/admin/workshop','AdminWorkshopController');


	//Resource category admin routes
	Route::get('/admin/resource/category','AdminResourceCategoryController@index')->name('resource_category.index');
	Route::post('/admin/resource/category','AdminResourceCategoryController@store')->name('resource_category.store');
	Route::post('/admin/resource/category/{id}','AdminResourceCategoryController@update')->name('resource_category.update');
	Route::get('/admin/resource/category/{id}/changestatus','AdminResourceCategoryController@changeStatus')->name('resource.status');


	//Resource admin routes
	Route::get('/admin/resource/list','AdminResourceController@index')->name('resource.index');
	Route::get('/admin/resource/create','AdminResourceController@create')->name('resource.create');
	Route::post('/admin/resource','AdminResourceController@store')->name('resource.store');
	Route::get('/admin/resource/{id}','AdminResourceController@show')->name('resource.show');
	Route::get('/admin/resource/{id}/edit','AdminResourceController@edit')->name('resource.edit');
	Route::post('/admin/resource/{id}','AdminResourceController@update')->name('resource.update');
	Route::get('/admin/resource/{id}/changestatus','AdminResourceController@changeStatus')->name('resource.status');


	// Classroom admin routes
	Route::get('/admin/classroom','AdminClassroomController@index')->name('classroom.index');
	Route::post('/admin/classroom/scheduleclass','AdminClassroomController@scheduleClass')->name('classroom.schedule');
	Route::post('/admin/classroom/removeclass','AdminClassroomController@removeClass')->name('classroom.remove');
	Route::post('/admin/classroom/cancelclass','AdminClassroomController@cancelClass')->name('classroom.cancel');
	Route::post('/admin/classroom/{id}','AdminClassroomController@LaunchClass')->name('classroom.teacher');


	//code added by sazzad 24/10/2018
	// Reg User List admin routes.
	Route::get('/admin/user/list','AdminRegUserListController@index')->name('admin.userlist.index');
	Route::get('/admin/user/list/{id}/changestatus','AdminRegUserListController@changeStatus')->name('admin.userlist.status');


});





// Access Routes for Admin Only
Route::middleware(['isAdmin'])->group(function ()
{
    
	// User List
	Route::get('/admin/profile/list', 'AdminUserController@index')->name('users.index');
	Route::get('/admin/profile/{id}','AdminUserController@show')->name('users.show');
	Route::get('/admin/profile/{id}/edit','AdminUserController@edit')->name('users.edit');
	Route::post('/admin/profile/{id}','AdminUserController@update')->name('users.update');
	Route::get('/admin/profile/{id}/changestatus','AdminUserController@changeStatus')->name('users.status');


	// Author admin routes
	Route::get('/admin/author/list','AdminAuthorController@index')->name('author.index');
	Route::get('/admin/author/create','AdminAuthorController@create')->name('author.create');
	Route::post('/admin/author','AdminAuthorController@store')->name('author.store');
	Route::get('/admin/author/{id}','AdminAuthorController@show')->name('author.show');
	Route::get('/admin/author/{id}/edit','AdminAuthorController@edit')->name('author.edit');
	Route::post('/admin/author/{id}','AdminAuthorController@update')->name('author.update');
	Route::get('/admin/author/{id}/changestatus','AdminAuthorController@changeStatus')->name('author.status');


	// editorial admin routes
	Route::get('/admin/editorial/list','AdminEditorialController@index')->name('editorial.index');
	Route::get('/admin/editorial/create','AdminEditorialController@create')->name('editorial.create');
	Route::post('/admin/editorial','AdminEditorialController@store')->name('editorial.store');
	Route::get('/admin/editorial/{id}','AdminEditorialController@show')->name('editorial.show');
	Route::get('/admin/editorial/{id}/edit','AdminEditorialController@edit')->name('editorial.edit');
	Route::post('/admin/editorial/{id}','AdminEditorialController@update')->name('editorial.update');
	Route::get('/admin/editorial/{id}/changestatus','AdminEditorialController@changeStatus')->name('editorial.status');
	Route::get('/admin/editorial/{id}/makedefault','AdminEditorialController@makeDefault')->name('editorial.default');


	//blog category admin routes
	Route::get('/admin/blog/category','AdminBlogCategoryController@index')->name('blog_category.index');
	Route::post('/admin/blog/category','AdminBlogCategoryController@store')->name('blog_category.store');
	Route::post('/admin/blog/category/{id}','AdminBlogCategoryController@update')->name('blog_category.update');


	//blog admin routes
	//Route::post('admin/blog/list', 'AdminBlogController@bloglist');
	Route::resource('/admin/blog','AdminBlogController');


	// Notice admin routes
	Route::get('/admin/notice/list','AdminNoticeController@index')->name('notice.index');
	Route::get('/admin/notice/create','AdminNoticeController@create')->name('notice.create');
	Route::post('/admin/notice','AdminNoticeController@store')->name('notice.store');
	Route::get('/admin/notice/{id}','AdminNoticeController@show')->name('notice.show');
	Route::get('/admin/notice/{id}/edit','AdminNoticeController@edit')->name('notice.edit');
	Route::post('/admin/notice/{id}','AdminNoticeController@update')->name('notice.update');
	Route::get('/admin/notice/{id}/changestatus','AdminNoticeController@changeStatus')->name('notice.status');


	// Slider admin routes
	Route::get('/admin/slider/list','AdminSliderController@index')->name('slider.index');
	Route::get('/admin/slider/create','AdminSliderController@create')->name('slider.create');
	Route::post('/admin/slider','AdminSliderController@store')->name('slider.store');
	Route::get('/admin/slider/{id}','AdminSliderController@show')->name('slider.show');
	Route::get('/admin/slider/{id}/edit','AdminSliderController@edit')->name('slider.edit');
	Route::post('/admin/slider/{id}','AdminSliderController@update')->name('slider.update');
	Route::get('/admin/slider/{id}/changestatus','AdminSliderController@changeStatus')->name('slider.status');


	// Gallery admin routes
	Route::get('/admin/gallery/list','AdminGalleryController@index')->name('gallery.index');
	Route::get('/admin/gallery/create','AdminGalleryController@create')->name('gallery.create');
	Route::post('/admin/gallery','AdminGalleryController@store')->name('gallery.store');
	Route::get('/admin/gallery/{id}','AdminGalleryController@show')->name('gallery.show');
	Route::get('/admin/gallery/{id}/edit','AdminGalleryController@edit')->name('gallery.edit');
	Route::post('/admin/gallery/{id}','AdminGalleryController@update')->name('gallery.update');
	Route::get('/admin/gallery/{id}/changestatus','AdminGalleryController@changeStatus')->name('gallery.status');


	// Video admin routes
	Route::get('/admin/video/list','AdminVideoController@index')->name('video.index');
	Route::get('/admin/video/create','AdminVideoController@create')->name('video.create');
	Route::post('/admin/video','AdminVideoController@store')->name('video.store');
	Route::get('/admin/video/{id}','AdminVideoController@show')->name('video.show');
	Route::get('/admin/video/{id}/edit','AdminVideoController@edit')->name('video.edit');
	Route::post('/admin/video/{id}','AdminVideoController@update')->name('video.update');
	Route::get('/admin/video/{id}/changestatus','AdminVideoController@changeStatus')->name('video.status');


	// User FAQ admin routes
	Route::get('/admin/user/faq/list','AdminFAQController@index')->name('user_faq.index');
	Route::get('/admin/user/faq/create','AdminFAQController@create')->name('user_faq.create');
	Route::post('/admin/user/faq','AdminFAQController@store')->name('user_faq.store');
	Route::get('/admin/user/faq/{id}','AdminFAQController@show')->name('user_faq.show');
	Route::get('/admin/user/faq/{id}/edit','AdminFAQController@edit')->name('user_faq.edit');
	Route::post('/admin/user/faq/{id}','AdminFAQController@update')->name('user_faq.update');
	Route::get('/admin/user/faq/{id}/changestatus','AdminFAQController@changeStatus')->name('user_faq.status');


});