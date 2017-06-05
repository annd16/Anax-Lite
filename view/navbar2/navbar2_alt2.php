<?php

namespace anna\Navbar;

// $dir = __DIR__ . "/../../config";
// require "$dir/config.php";

// Behöver inte inkludera Navbarklassen i vyn eftersom vi redan injectat $app in i Navbarklassen(?)
// require __DIR__ . "/../../src/Navbar/Navbar.php";


// *** Att injecta beroende till en klass, alternativ2 *** //
// *** Injecta endast de delar som behövs in i Navbar-klassen *** //
// *** genom att skapa metoder i klassen  *** //
// *******************************************************//

// Nedanstående loop verkar inte fungera (ger ingen utskrift):
// foreach ($app->request as $key=>$val) {
//     echo("bla" . $key . " " . $val);
// }

//Detta fungerar:
// echo("<br/>app->request->getRoute() in navbar2-vyn:  " . $app->request->getRoute());
$app->navbar->setCurrentRoute($app->request->getRoute());

$urlCreate = [$app->url, "create"];
// $htmlNavbar = call_user_func($urlCreate, "about");

$htmlNavbar = $app->navbar->setUrlCreator($urlCreate);

echo ("<br/>" . $htmlNavbar);

// ?>

<!-- VIEW navbar2/navbar2.php -->
