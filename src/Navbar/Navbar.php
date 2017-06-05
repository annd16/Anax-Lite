<?php

namespace anna\Navbar;

/**
 * Navbar to generate HTML för a navbar from a configuration array.
 */
// class Navbar
// Klassen att den lovar att implementera interfacet Configure.
// Då skall vi verkligen implementera interfacet också, via ett trait.
class Navbar implements
    \Anax\Common\ConfigureInterface,
    \Anax\Common\AppInjectableInterface
{
    //  Via use använder klassen Navbar traitet. Man kan se det som att use-konstruktionen kopierar in koden från traitet in i klassen.
    use
    \Anax\Common\ConfigureTrait,
    \Anax\Common\AppInjectableTrait;

    public $htmlNavbar = "";         // Behövs för alternativ 1 & 2

    // *** Att injecta beroende till en klass, alternativ3 *** //
    // *** Injecta när man genererar menyn, dvs injecta de beroenden *** //
    // *** som finns, i samband med själva anropet till getHTML() *** //
    // *** // Det är en variant som minskar antalet setters (och medlemsvariabler). ***//
    // *******************************************************//
    // /**
    //  * Get HTML for the navbar.
    //  *
    //  * @param string $route the current route.
    //  * @param callable $urlCreate to create framework urls.
    //  *
    //  * @return string as HTML with the navbar.
    //  */
    public function getHTML($route, $urlCreate)
    {
        $this->route = $route;
        // echo("<br/>this->route i getHTML(\$route, \$urlCreate) i Navbar-klassen: " . $this->route);

        $navbar = $this->config["items"];

        $htmlNavbar = "";
        $htmlNavbar = "<nav>";
        // foreach ($navbar as $key => $val) {
        foreach (array_keys($navbar) as $key) {
            $htmlNavbar .= "<a href=" . call_user_func($urlCreate, $navbar[$key]['route']) . ">" . $navbar[$key]['text'] ."</a>";
        }
        $htmlNavbar .= "</nav>";

        return $htmlNavbar;
    }
}
