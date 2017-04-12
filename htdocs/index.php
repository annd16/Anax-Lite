<?php

// **************************************************************
// Lägger till grundläggande funktioner till ramverket
// **************************************************************


#  Vi använder oss av MODULEN anax/request


// Den första delen bootstrappar ramverket med grunden som behövs för att saker skall fungera.


/**
 * Bootstrap the framework.
 */
// Where are all the files? Booth are needed by Anax.
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
define("ANAX_APP_PATH", ANAX_INSTALL_PATH);

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Add/create all resources to $app
$app = new \anna\App\App();
$app->request = new \Anax\Request\Request();
$app->response = new \Anax\Response\Response();
$app->url = new \Anax\Url\Url();
// Create the router
$app->router  = new \Anax\Route\RouterInjectable();

// Create the container that will hold the views
$app->view = new \Anax\View\ViewContainer();

// Principen bakom view-filer, är att man samlar ihop all data som behövs, sedan skickar man datan till view-filen
// som renderar ett svar, ofta i form av en del av en HTML-sida.

// Inject $app into the view container for use in view files.
$app->view->setApp($app);

// Update view configuration with values from config file.
$app->view->configure("view.php");




// Sedan skapas en instans av request-klassen, den initieras och skrivs ut.

// Init the object of the request class.
// $request = new \Anax\Request\Request();
$app->request->init();


// Init the url-object with default values from the request object.
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());

// // echo "<pre>" . var_dump($app->request) . "</pre>";
// echo "<pre>" . print_r($app->request, 1) . "</pre>";
//
// echo "Done";

// **************************************************************
// Initiering av modulen url som används för att skapa länkar
// **************************************************************

// Create and init an instance of url.
$url = new \Anax\Url\Url();

// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();



// **************************************************************
// Testar att skapa några länkar
// **************************************************************

// // Create some urls.
// $aUrl = $url->create("");
// echo "<p><a href='$aUrl'>The index url, home</a> ($aUrl)";
//
// $aUrl = $url->create("some/route");
// echo "<p><a href='$aUrl'>Url to some/route</a> ($aUrl)";
//
// $aUrl = $url->create("some/where/some/route");
// echo "<p><a href='$aUrl'>Another url to some/where/some/route</a> ($aUrl)";



// Det behövs en router i ramverket så att vi kan ge olika svar på respektive inkommande routes.

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Det sista vi gör är att överlåta till routern att hantera och matcha inkommande route mot de routes som finns.
// Routern tar även hänsyn vilken request method som använts.

// Leave to router to match incoming request to routes
$app->router->handle($app->request->getRoute(), $app->request->getMethod());

// När du vill skapa en länk till en resurs, en asset, i form av bilder, stylesheets, javascript eller andra filer,
// så använder du metoden $url->asset(). Den metoden ignorerar SCRIPT_NAME när länken skapas.
//
// Kom alltså ihåg att skapa länkar som leder in i frontkontroller och ramverk via $this->create() och länkar till
// resurser skapar du med $url->asset().
