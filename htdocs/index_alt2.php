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
$app->router = new \Anax\Route\RouterInjectable();

// Create the container that will hold the views
$app->view = new \Anax\View\ViewContainer();

// Principen bakom view-filer, är att man samlar ihop all data som behövs, sedan skickar man datan till view-filen
// som renderar ett svar, ofta i form av en del av en HTML-sida.

// Inject $app into the view container for use in view files.
$app->view->setApp($app);

// Update view configuration with values from config file.
$app->view->configure("view.php");

// Add the navbar to $app
$app->navbar = new \anna\Navbar\Navbar();

// Add the session to $app
$name = "MinForhoppningsvisHeltUnikaAnnaSession";
$app->session = new \anna\Session\Session($name);

// Add the nameday to $app
$app->nameday = new \anna\Calendar\Nameday();

// Add the calendar to $app
// $app->calendar = new \anna\Calendar\Calendar();
$app->calendar = new \anna\Calendar\Calendar($app->nameday);

// *** Att injecta beroende till en klass, alternativ1 *** //
// ***          Låt $app finnas i Navbar-klassen      *** //
// *******************************************************//
// Create the container that will hold the navbar
// $app->navbar = new \anna\Navbar\Navbar();
// // Inject $app into the navbar for use in navbar.
// $app->navbar->setApp($app);         // *** Att injecta beroende till en klass, alternativ1 *** //
//
// // Update navbar configuration with values from the configuration
$app->navbar->configure("navbar.php");      // *** Att injecta beroende till en klass, alla alternativ*** //

// *** Att injecta beroende till en klass, alternativ2 *** //
// *** Injecta endast de delar som behövs in i Navbar-klassen *** //
// *** genom att skapa metoder i klassen  *** //
// *******************************************************//
// Metod 1: Injecta nuvarande route (en metod som tar emot nuvarande route).
// Tanken är är att vi, likt hur Url sätts upp, skickar in nuvarande route in i klassen så den kan ta del av den. Så här.
// $app->navbar->setCurrentRoute($app->request->getRoute());   // *** Att injecta beroende till en klass, alternativ2 *** // Har kommenterat bort denna rad 2/6
// Metod 2: Den andra delen är att navbar skall kunna skapa länkar via $app->url->create().
// Även detta beroende kan vi injecta in i klassen via en metod.
// Det vi skickar in är en funktion, en callable.
// $app->navbar->setUrlCreator([$app->url, "create"]);         // *** Att injecta beroende till en klass, alternativ2 *** // Har kommenterat bort denna rad 2/6
// // Arrayen [$app->url, "create"] är här det som betraktas som en callable.



// Sedan skapas en instans av request-klassen, den initieras och skrivs ut.

// Init the object of the request class.
// $request = new \Anax\Request\Request();
$app->request->init();

// var_dump($app->request);

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


// Använder én av ramverkets metoder för att Lägga till stylesheeten
//(i form av en asset/tillgång)
$app->url->asset("style/style2.css");


// Det behövs en router i ramverket så att vi kan ge olika svar på respektive inkommande routes.

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Det sista vi gör är att överlåta till routern att hantera och matcha inkommande route mot de routes som finns.
// Routern tar även hänsyn vilken request method som använts.

// Leave to router to match incoming request to routes
$app->router->handle($app->request->getRoute(), $app->request->getMethod());
