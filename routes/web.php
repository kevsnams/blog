<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Articles\Article;

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

$router->get('/', fn () => view('home'));

$router->get('/articles/{slug}',
    fn ($slug) => view('articles',[
        'article' => new Article($slug)
    ])
);
