<?php

// FRONT-END ROUTES
Route::get('/', 'FrontpageController@index')->name('home')->middleware('auth');
Route::get('/slider', 'FrontpageController@slider')->name('slider.index')->middleware('auth');

Route::get('/search', 'FrontpageController@search')->name('search')->middleware('auth');

Route::get('/property', 'PagesController@properties')->name('property')->middleware('auth');
Route::get('/property/{id}', 'PagesController@propertieshow')->name('property.show')->middleware('auth');
Route::post('/property/message', 'PagesController@messageAgent')->name('property.message')->middleware('auth');
Route::post('/property/comment/{id}', 'PagesController@propertyComments')->name('property.comment')->middleware('auth');
Route::post('/property/rating', 'PagesController@propertyRating')->name('property.rating')->middleware('auth');
Route::get('/property/city/{cityslug}', 'PagesController@propertyCities')->name('property.city')->middleware('auth');

Route::get('/agents', 'PagesController@agents')->name('agents')->middleware('auth');
Route::get('/agents/{id}', 'PagesController@agentshow')->name('agents.show')->middleware('auth');

Route::get('/gallery', 'PagesController@gallery')->name('gallery')->middleware('auth');

Route::get('/blog', 'PagesController@blog')->name('blog')->middleware('auth');
Route::get('/blog/{id}', 'PagesController@blogshow')->name('blog.show')->middleware('auth');
Route::post('/blog/comment/{id}', 'PagesController@blogComments')->name('blog.comment')->middleware('auth');

Route::get('/blog/categories/{slug}', 'PagesController@blogCategories')->name('blog.categories')->middleware('auth');
Route::get('/blog/tags/{slug}', 'PagesController@blogTags')->name('blog.tags');
Route::get('/blog/author/{username}', 'PagesController@blogAuthor')->name('blog.author')->middleware('auth');

Route::get('/contact', 'PagesController@contact')->name('contact')->middleware('auth');
Route::post('/contact', 'PagesController@messag.1eContact')->name('contact.message')->middleware('auth');
Route::post('/user/report/{id}', 'Admin\UserManagerController@report')->name('user-manager.report');

Auth::routes();
Route::get('admin/user-manager/block', 'Admin\UserManagerController@block')->name('admin.user-manager.block')->middleware(['auth', 'admin']);
Route::put('admin/user-manager/block/{id}', 'Admin\UserManagerController@updateActive')->name('admin.user-manager.updateActice')->middleware(['auth', 'admin']);
Route::get('property/{id}/message', 'PagesController@messageProperty')->name('property.message-2')->middleware('auth');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin'], 'as' => 'admin.'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tags', 'TagController');
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('features', 'FeatureController');
    Route::resource('properties', 'PropertyController');
    Route::resource('user-manager', 'UserManagerController');
    Route::post('properties/gallery/delete', 'PropertyController@galleryImageDelete')->name('gallery-delete');

    Route::resource('sliders', 'SliderController');
    Route::resource('testimonials', 'TestimonialController');

    Route::get('galleries/album', 'GalleryController@album')->name('album');
    Route::post('galleries/album/store', 'GalleryController@albumStore')->name('album.store');
    Route::get('galleries/{id}/gallery', 'GalleryController@albumGallery')->name('album.gallery');
    Route::post('galleries', 'GalleryController@Gallerystore')->name('galleries.store');
    Route::get('message/export', 'DashboardController@exportMessages')->name('message.export');
    Route::get('settings', 'DashboardController@settings')->name('settings');
    Route::post('settings', 'DashboardController@settingStore')->name('settings.store');

    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('profile', 'DashboardController@profileUpdate')->name('profile.update');

    Route::get('message', 'DashboardController@message')->name('message');
    Route::get('message/read/{id}', 'DashboardController@messageRead')->name('message.read');
    Route::get('message/replay/{id}', 'DashboardController@messageReplay')->name('message.replay');
    Route::post('message/readunread', 'DashboardController@messageReadUnread')->name('message.readunread');
    Route::delete('message/delete/{id}', 'DashboardController@messageDelete')->name('messages.destroy');
    Route::post('message/mail', 'DashboardController@contactMail')->name('message.mail');

    Route::get('changepassword', 'DashboardController@changePassword')->name('changepassword');
    Route::post('changepassword', 'DashboardController@changePasswordUpdate')->name('changepassword.update');
});

Route::group(['prefix' => 'agent', 'namespace' => 'Agent', 'middleware' => ['auth', 'agent'], 'as' => 'agent.'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('profile', 'DashboardController@profileUpdate')->name('profile.update');
    Route::get('changepassword', 'DashboardController@changePassword')->name('changepassword');
    Route::post('changepassword', 'DashboardController@changePasswordUpdate')->name('changepassword.update');
    Route::resource('properties', 'PropertyController');
    Route::post('properties/gallery/delete', 'PropertyController@galleryImageDelete')->name('gallery-delete');

    Route::get('message', 'DashboardController@message')->name('message');
    Route::get('message/read/{id}', 'DashboardController@messageRead')->name('message.read');
    Route::post('message/readunread', 'DashboardController@messageReadUnread')->name('message.readunread');
    Route::delete('message/delete/{id}', 'DashboardController@messageDelete')->name('messages.destroy');
    Route::post('message/mail', 'DashboardController@contactMail')->name('message.mail');
    Route::get('message/export', 'DashboardController@exportMessages')->name('message.export');
});

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => ['auth', 'user'], 'as' => 'user.'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('profile', 'DashboardController@profileUpdate')->name('profile.update');
    Route::get('changepassword', 'DashboardController@changePassword')->name('changepassword');
    Route::post('changepassword', 'DashboardController@changePasswordUpdate')->name('changepassword.update');

    Route::get('message', 'DashboardController@message')->name('message');
    Route::get('message/read/{id}', 'DashboardController@messageRead')->name('message.read');
    Route::get('message/replay/{id}', 'DashboardController@messageReplay')->name('message.replay');
    Route::post('message/replay', 'DashboardController@messageSend')->name('message.send');
    Route::post('message/readunread', 'DashboardController@messageReadUnread')->name('message.readunread');
    Route::delete('message/delete/{id}', 'DashboardController@messageDelete')->name('messages.destroy');
});
