<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\RegisterController;  // Custom RegisterController to handle extra fields

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/thank-you', 'PostRegistration::index', ['as' => 'registration_thank_you']);

// Use your custom RegisterController & override the "/register" to "/sign-up"
$routes->get('sign-up', [RegisterController::class, 'registerView'], ['as' => 'register']);
$routes->post('sign-up', [RegisterController::class, 'registerAction'] , ['as' => 'register.action']);

// routes for character page
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('characters', 'Character::index', ['as' => 'character']);
    $routes->get('characters/(:num)', 'Character::show/$1', ['as' => 'character.show']);
    $routes->get('user/characters', 'UserCharacter::index', ['as' => 'user.characters']);
    $routes->post('characters/(:num)', 'UserCharacter::create/$1', ['as' => 'user.character.create']);
    $routes->delete('characters/(:num)', 'UserCharacter::delete/$1', ['as' => 'user.character.delete']);
});

service('auth')->routes($routes);