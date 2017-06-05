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
echo($app->navbar->getHTML());

?>

<!-- VIEW navbar2/navbar2.php -->
