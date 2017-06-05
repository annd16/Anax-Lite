<?php

namespace anna\Navbar;

// *** Att injecta beroende till en klass, alternativ3 *** //
// *** Injecta när man genererar menyn, dvs injecta de beroenden *** //
// *** som finns, i samband med själva anropet till getHTML() *** //
// *******************************************************//

echo($navbar);

// VIEW navbar2/navbar2.php


// *** Att injecta beroende till en klass, alternativ5 *** //
// ***  Generera HTML-koden för navbaren direkt i routens hanterare *** //
// *** och bifoga som en variabel till vyn. *** //
// *******************************************************//
