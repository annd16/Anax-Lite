<?php
/**
 * Routes.
 */

// Testvy
$app->router->add("test1", function () use ($app) {
    $app->view->add("view/test1", [
        "title" => "Test1",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


$app->router->add("test2", function () use ($app) {
    $app->view->add("view/test2", [
        "title" => "Test2",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


$app->router->add("test3", function () use ($app) {
    $app->view->add("view/test3", [
        "title" => "Test3",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("test4", function () use ($app) {
    $app->view->add("view/test4", [
        "title" => "Test4",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("test5", function () use ($app) {
    // Create default data set to send to the layout
    $data = [
        "title" => "Test5",
        "message" => "Hello World",
        "answer" => 42
        ];

    // Add the layout view to its own region
    $app->view->add("view/layout", $data, "layout");

     // Add views to a specific region
    $app->view->add("view/block", ["region" => "flash1"], "flash", 0);
    $app->view->add("view/block", ["region" => "flash2"], "flash", 1);
    $app->view->add("view/block", ["region" => "main1"], "main", 1);
    $app->view->add("view/block", ["region" => "main2"], "main", 0);
    $app->view->add("view/block", ["region" => "footer1"], "footer", 0);
    $app->view->add("view/block", ["region" => "footer2"], "footer", 1);

    // $app->response->setBody([$app->view, "render"])
    //               ->send();
    $body = $app->view->renderBuffered("layout");
    $app->response->setBody($body)
                   ->send();
});

$app->router->add("test6", function () use ($app) {
    $app->view->add("view/test6", [
        "title" => "Test6",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
