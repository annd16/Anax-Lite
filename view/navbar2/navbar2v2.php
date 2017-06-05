<?php

namespace anna\Navbar;

// $dir = __DIR__ . "/../../config";
// require "$dir/config.php";

// Behöver inte inkludera Navbarklassen i vyn eftersom vi redan injectat $app in i Navbarklassen(?)
// require __DIR__ . "/../../src/Navbar/Navbar.php";

// *** Att injecta beroende till en klass, alternativ1 *** //
// *** Injecta hela $app in i Navbar-klassen *** //
// *** komma åt html-koden genom en metod i klassen  *** //
// *******************************************************//
echo("This is the navbar2-view<br/>");
// echo($app->navbar->getHTML());


// *** Att injecta beroende till en klass, alternativ2 *** //
// *** Injecta endast de delar som behövs in i Navbar-klassen *** //
// *** genom att skapa metoder i klassen  *** //
// *******************************************************//

// Nedanstående loop verkar inte fungera (ger ingen utskrift):
// foreach ($app->request as $key=>$val) {
//     echo("bla" . $key . " " . $val);
// }

// //Detta fungerar:
// echo("<br/>app->request->getRoute() in navbar2-vyn:  " . $app->request->getRoute());
// $app->navbar->setCurrentRoute($app->request->getRoute());
//
// $urlCreate = [$app->url, "create"];
// // $htmlNavbar = call_user_func($urlCreate, "about");
//
// $htmlNavbar = $app->navbar->setUrlCreator($urlCreate);
//
// echo ("<br/>" . $htmlNavbar);


// *** Att injecta beroende till en klass, alternativ3 *** //
// *** Injecta när man genererar menyn, dvs injecta de beroenden *** //
// *** som finns, i samband med själva anropet till createHTML() *** //
// *******************************************************//

// $route = $app->request->getRoute();
// $urlCreate = [$app->url, "create"];
// echo ("<br/>" . $app->navbar->route);
// echo($app->navbar->getHTML($route, $urlCreate));

// *** Att injecta beroende till en klass, alternativ5 *** //
// ***  Generera HTML-koden för navbaren direkt i routens hanterare *** //
// *** och bifoga som en variabel till vyn. *** //
// *******************************************************//


echo($navbar);

// $urlMe  = $app->url->create("");
// $urlAbout = $app->url->create("about");
// $urlReport = $app->url->create("report");
//
// ?>

<!-- VIEW navbar2/navbar2.php -->
