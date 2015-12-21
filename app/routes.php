<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

App::error(function (NotFoundHttpException $e) {
    header("HTTP/1.1 404 Not Found");
    exit;
});

Route::get('/', function () {
    return View::make("index");
});

Route::any('/1.0/doc/{category}/{object}/{action}', function ($category, $object, $action) {
    $category = strtolower($category);
    $object = ucfirst(strtolower($object));
    $action = ucfirst(strtolower($action));
    $controller_name = "{$object}{$action}Controller";
    return View::make("{$category}/{$controller_name}");
})->where('category', '.*')->where('object', '.*')->where('action', '.*');

Route::any('/1.0/doc/{category}/{action}', function ($category, $action) {
    $category = strtolower($category);
    $action = ucfirst(strtolower($action));
    $controller_name = "{$action}Controller";
    return View::make("{$category}/{$controller_name}");
})->where('category', '.*')->where('action', '.*');

Route::any('/1.0/{category}/{object}/{action}', function ($category, $object, $action) {
    $category = strtolower($category);
    $object = ucfirst(strtolower($object));
    $action = ucfirst(strtolower($action));
    $controller_name = "{$object}{$action}Controller";
    require_once __DIR__ . "/controllers/{$category}/{$controller_name}.php";
    $controller = new $controller_name();
    $result = $controller->run();
    if (is_array($result) || is_object($result)) {
        Requests::json_success($result);
    } else {
        Requests::json_error($result);
    }
})->where('category', '.*')->where('object', '.*')->where('action', '.*');

Route::any('/1.0/{category}/{action}', function ($category, $action) {
    $category = strtolower($category);
    $action = ucfirst(strtolower($action));
    $controller_name = "{$action}Controller";
    require_once __DIR__ . "/controllers/{$category}/{$controller_name}.php";
    $controller = new $controller_name();
    $result = $controller->run();
    if (is_array($result) || is_object($result)) {
        Requests::json_success($result);
    } else {
        Requests::json_error($result);
    }
})->where('category', '.*')->where('action', '.*');
