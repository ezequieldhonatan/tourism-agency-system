<?php

Auth::routes();

##  PANEL
Route::group(['prefix' => 'panel', 'namespace' => 'Panel', 'middleware' => ['auth', 'admin']], function () {
    
    Route::resource('', 'PanelController'); ## INDEX

    ## BRAND
    Route::resource('brands', 'BrandController'); ## BRAND
    Route::get('brands/{id}/planes', 'BrandController@planes')->name('brands.planes'); ## BRAND PLANE
    Route::any('brands/search', 'BrandController@search')->name('brands.search'); ## SEARCH BRAND

    ## PLANE
    Route::resource('planes', 'PlaneController'); ## PLANE
    Route::any('planes/search', 'PlaneController@search')->name('planes.search'); ## SEARCH PLANE

    ## STATE
    Route::get('states', 'StateController@index')->name('states.index'); ## STATE
    Route::any('states/search', 'StateController@search')->name('states.search'); ## SEARCH STATE

    ## CITY
    Route::get('states/{initials}/cities', 'CityController@index')->name('state.cities'); ## CITY
    Route::any('states/{initials}/search', 'CityController@search')->name('state.cities.search'); ## SEARCH CITY

    ## FLIGHT
    Route::resource('flights', 'FlightController'); ## FLIGHT
    Route::any('flights/search', 'FlightController@search')->name('flights.search'); ## SEARCH FLIGHT

    ## USER
    Route::resource('users', 'UserController'); ## USER
    Route::any('users/search', 'UserController@search')->name('users.search'); ## SEARCH USER

    ## RESERVE
    Route::resource('reserves', 'ReserveController', [
        // 'only' => [],
        'except' => ['show', 'destroy']
    ]); ## RESERVE
    Route::any('reserves/search', 'ReserveController@search')->name('reserves.search');

    ## AIRPORT
    Route::resource('city/{id}/airports', 'AirportController'); ## AIRPORT

});

##  SITE
Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
    
    Route::get('detalhes-voo/{id}', 'SiteController@detailsFlight')->name('details.flight'); ## DETAILS FLIGHTS
    Route::post('reservar', 'SiteController@reserveFligth')->name('reserve.flight'); ## RESERVE
    Route::get('minhas-compras', 'SiteController@myPurchase')->name('purchase.index'); ## PURCHASE
    Route::get('detalhes-compras/{idReserve}', 'SiteController@purchaseDetails')->name('purchase.details'); ## PURCHASE DETAILS
    Route::get('meu-perfil', 'SiteController@myProfile')->name('my.profile'); ## MY PROFILE
    Route::post('atualizar-perfil', 'SiteController@updateProfile')->name('update.profile'); ## MY PROFILE
    Route::get('sair', 'SiteController@logout')->name('logout.user'); ## LOGOUT USER

});

Route::group(['namespace' => 'Site'], function () {

    Route::get('/', 'SiteController@index')->name('home'); ## HOME
    Route::get('promocoes', 'SiteController@promotions')->name('promotions'); ## PROMOÇÕES
    Route::post('pesquisar', 'SiteController@search')->name('search.flights.site'); ## SEARCH

});