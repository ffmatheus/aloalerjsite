<?php
Auth::routes();

Route::get('/', ['as' => 'home', 'uses' => 'Home@index']);

Route::get('/offline', ['as' => 'home', 'uses' => 'Home@offline']);

Route::get('comissoes/{name}', [
    'as' => 'committees.show',
    'uses' => 'Committees@show'
]);

Route::get('pages/{name}', ['as' => 'pages.show', 'uses' => 'Pages@show']);

//Route::get('comissoes/{name}', ['as' => 'page', 'uses' => 'Committees@view']);

Route::group(['prefix' => 'chat'], function () {
    Route::get('index', ['as' => 'chat.index', 'uses' => 'Chat@index']);
    Route::get('create', ['as' => 'chat.create', 'uses' => 'Chat@create']);
    Route::get('terminated', [
        'as' => 'chat.terminated',
        'uses' => 'Chat@terminated'
    ]);
});

Route::group(['prefix' => 'tv'], function () {
    Route::get('/', ['as' => 'tv.index', 'uses' => 'Tv@index']);
});

Route::group(['prefix' => 'radio'], function () {
    Route::get('/', ['as' => 'radio.index', 'uses' => 'Radio@index']);
});

Route::group(['prefix' => 'contact'], function () {
    Route::get('/', ['as' => 'contact.index', 'uses' => 'Contact@index']);
    Route::get('pretend', [
        'as' => 'contact.index',
        'uses' => 'Contact@pretend'
    ]);
    Route::post('/', ['as' => 'contact.post', 'uses' => 'Contact@post']);
});

Route::get('/home', 'Home@index')->name('home');

//Route::group(['prefix' => 'callcenter', 'middleware' => ['auth']], function()
Route::group(['prefix' => 'callcenter'], function () {
    Route::get('/', 'People@index')->name('persons.index');

    Route::group(['prefix' => 'persons'], function () {
        Route::get('/', 'People@index')->name('persons.index');
        Route::get('/create', 'People@create')->name('persons.create');
        Route::post('/', 'People@store')->name('persons.store');
        Route::get('/show/{person_id}', 'People@show')->name('persons.show');

        Route
            ::post('/insertContact', 'People@insertContact')
            ->name('persons.insertContact');
    });

    Route::group(['prefix' => 'persons_addresses'], function () {
        Route
            ::get('/', 'PersonAddresses@index')
            ->name('persons_addresses.index');
        Route
            ::get('/create/{person_id}', 'PersonAddresses@create')
            ->name('persons_addresses.create');

        Route
            ::post('/', 'PersonAddresses@store')
            ->name('persons_addresses.store');
        Route
            ::get('/show/{id}', 'PersonAddresses@show')
            ->name('persons_addresses.show');
    });

    Route::group(['prefix' => 'persons_contacts'], function () {
        Route::get('/', 'PersonContacts@index')->name('persons_contacts.index');
        Route
            ::get('/create/{person_id}', 'PersonContacts@create')
            ->name('persons_contacts.create');
        Route
            ::post('/', 'PersonContacts@store')
            ->name('persons_contacts.store');
        Route
            ::get('/show/{id}', 'PersonContacts@show')
            ->name('persons_contacts.show');

        Route
            ::get('/createOutside/{id}', 'PersonContacts@createOutside')
            ->name('persons_contacts.createOutside');
    });

    Route::group(['prefix' => 'origins'], function () {
        Route::get('/', 'Origins@index')->name('origins.index');
        Route::get('/create', 'Origins@create')->name('origins.create');
        Route::post('/', 'Origins@store')->name('origins.store');
        Route::get('/show/{id}', 'Origins@show')->name('origins.show');
    });

    Route::group(['prefix' => 'areas'], function () {
        Route::get('/', 'Areas@index')->name('areas.index');
        Route::get('/create', 'Areas@create')->name('areas.create');
        Route::post('/', 'Areas@store')->name('areas.store');
        Route::get('/show/{id}', 'Areas@show')->name('areas.show');
    });

    Route::group(['prefix' => 'records'], function () {
        Route::get('/', 'Records@index')->name('records.index');
        Route
            ::get('/create/{person_id}', 'Records@create')
            ->name('records.create');
        Route::post('/', 'Records@store')->name('records.store');
        Route::get('/show/{id}', 'Records@show')->name('records.show');
    });

    Route::group(['prefix' => 'contact_types'], function () {
        Route
            ::get('/array/', 'ContactTypes@array')
            ->name('contact_types.array');
    });
});