<?php
/**
 * Internal routes.
 */

// En intern route som används för felhantering när en route inte kan hittas.
// Den interna routen kan inte nås från webbläsaren, den är intern för ramverket.


// $app->router->addInternal("404", function () use ($app) {
//     $currentRoute = $app->request->getRoute();
//
//     $routes = "<ul>";
//     foreach ($app->router->getAll() as $route) {
//         $routes .= "<li>'" . $route->getRule() . "'</li>";
//     }
//     $routes .= "<ul>";
//
//     $intRoutes = "<ul>";
//     foreach ($app->router->getInternal() as $route) {
//         $intRoutes .= "<li>'" . $route->getRule() . "'</li>";
//     }
//     $intRoutes .= "</ul>";
//
//
//     $body = <<<EOD
// <!doctype html>
// <meta charset="utf-8">
// <title>404</title>
// <h1>404 Not Found</h1>
// <p>The route '$currentRoute' could not be found!</p>
// <h2>Routes loaded</h2>
// <p>The following routes are loaded:</p>
// $routes
// <p>The following internal routes are loaded:</p>
// $intRoutes
// EOD;
//
//     // echo $body;
//     $app->response->setbody($body)
//                   ->send(404);
//     // Argumentet som skickas med till send() är statuskoden som klassen response omvandlar till
//     // ett korrekt anrop med header("HTTP/1.1 404 Not Found").
// });




// $app->router->add efter att vi flyttat kod från 404-routen till en vy istället.
$app->router->addInternal("404", function () use ($app) {
    $app->view->add("take1/header", ["title" => "404"]);
    $app->view->add("take1/404");

    $app->response->setBody([$app->view, "render"])
                      ->send(404);
// Argumentet som skickas med till send() är statuskoden som klassen response omvandlar till
// ett korrekt anrop med header("HTTP/1.1 404 Not Found").
});
