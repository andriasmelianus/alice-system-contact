<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('phone', 'PhoneController@create');
$router->get('phone', 'PhoneController@read');
$router->put('phone', 'PhoneController@update');
$router->patch('phone', 'PhoneController@update');
$router->delete('phone', 'PhoneController@destroy');

$router->post('address', 'AddressController@create');
$router->get('address', 'AddressController@read');
$router->put('address', 'AddressController@update');
$router->patch('address', 'AddressController@update');
$router->delete('address', 'AddressController@destroy');

$router->post('city', 'CityController@create');
$router->get('city', 'CityController@read');
$router->put('city', 'CityController@update');
$router->patch('city', 'CityController@update');
$router->delete('city', 'CityController@destroy');

$router->post('region', 'RegionController@create');
$router->get('region', 'RegionController@read');
$router->put('region', 'RegionController@update');
$router->patch('region', 'RegionController@update');
$router->delete('region', 'RegionController@destroy');

$router->post('country', 'CountryController@create');
$router->get('country', 'CountryController@read');
$router->put('country', 'CountryController@update');
$router->patch('country', 'CountryController@update');
$router->delete('country', 'CountryController@destroy');
