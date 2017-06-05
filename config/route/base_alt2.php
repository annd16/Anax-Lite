<?php
/**
 * Routes.
 */

// Kod för att tilldela navbarens htmlkod till Navbarklassens variabel $htmlNavbar;
// $app->navbar->setHTML();        // Alternativ 1

$app->navbar->setCurrentRoute($app->request->getRoute());   // *** Att injecta beroende till en klass, alternativ2 *** //
$app->navbar->setUrlCreator([$app->url, "create"]);         // *** Att injecta beroende till en klass, alternativ2 *** //

// Kod för att tilldela navbarens htmlkod till Navbarklassens variabel $htmlNavbar;
// $app->navbar->htmlNavbar = $app->navbar->getHTML($app->request->getRoute(), [$app->url, "create"]);        // Alternativ 3

// $app->router->add efter att vi flyttat kod från me-routen till en vy istället.
$app->router->add("", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Me"]);
    // $app->view->add("take1/navbar");
    // $app->view->add("navbar2/navbar2", ["navbar" => $app->navbar->htmlNavbar]);
    $app->view->add("navbar2/navbar2");
    $app->view->add("take1/flash");
    $app->view->add("take1/me");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


// $app->router->add efter att vi flyttat kod från about-routen till en vy istället.
$app->router->add("about", function () use ($app) {
    $app->view->add("take1/header", ["title" => "About"]);
    // $app->view->add("take1/navbar");
    // $app->view->add("navbar2/navbar2", ["navbar" => $app->navbar->htmlNavbar]);
    $app->view->add("navbar2/navbar2");
    $app->view->add("take1/flash");
    $app->view->add("take1/about");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// $app->router->add efter att vi flyttat kod från report-routen till en vy istället.
$app->router->add("report", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Report"]);
    // $app->view->add("take1/navbar");
    // $app->view->add("navbar2/navbar2", ["navbar" => $app->navbar->htmlNavbar]);
    $app->view->add("navbar2/navbar2");
    $app->view->add("take1/flash");
    $app->view->add("take1/report");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


// $app->router->add 
$app->router->add("session", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Session"]);
    // $app->view->add("take1/navbar");
    // $app->view->add("navbar2/navbar2", ["navbar" => $app->navbar->htmlNavbar]);
    $app->view->add("navbar2/navbar2");
    $app->view->add("session/navbar3");
    $app->view->add("session/session");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


// $app->router->add
$app->router->add("calendar", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Calendar"]);
    // $app->view->add("navbar2/navbar2", ["navbar" => $app->navbar->htmlNavbar]);
    $app->view->add("navbar2/navbar2");
    $app->view->add("calendar/calendar");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Route som skickar ett JSON-objekt som svar.
$app->router->add("status", function () use ($app) {
    $data = [
        "Current user" => get_current_user(),
        "Server" => php_uname(),
        "PHP version" => phpversion(),
        "Included files" => count(get_included_files()),
        "Memory used" => memory_get_peak_usage(true),
        "Execution time" => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
        // "phpinfo" => phpinfo(INFO_GENERAL, INFO_MODULES,INFO_ENVIRONMENT, INFO_VARIABLES),
        // "phpinfo" => phpinfo(49),
    ];

    $app->response->sendJson($data);
});


// Man kan skapa routes som är dynamiska och skickar med en parameter till routens callback.
// Route med parametrar
$app->router->add("search/{string}", function ($string) use ($app) {
    $data = [
        "Searchstring was" => $string
    ];

    $app->response->sendJson($data);
});


// Route med parametrar som kollar om parametern är av viss typ och ger olika svar beroende på typ...

/**
 * Check arguments that matches a specific type.
 */
$callback = function ($value) use ($app) {
    $data = [
        "route"     => $app->request->getRoute(),
        "matched"   => $app->router->getLastRoute(),
        "value"     => $value,
    ];

    $app->response->sendJson($data);
};

$app->router->add("validate/{value:digit}", $callback);
$app->router->add("validate/{value:hex}", $callback);
$app->router->add("validate/{value:alpha}", $callback);
$app->router->add("validate/{value:alphanum}", $callback);
