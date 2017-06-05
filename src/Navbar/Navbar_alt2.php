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


    // *** Att injecta beroende till en klass, alternativ2 *** //
    // *** Injecta endast de delar som behövs in i Navbar-klassen *** //
    // *** genom att skapa metoder i klassen  *** //
    // *******************************************************//
    // // Metod 1: Injecta nuvarande route (en metod som tar emot nuvarande route).
    /**
     * Sets the current route.
     *
     * @param string $route the current route.
     *
     * @return void
     */
    public function setCurrentRoute($route)
    {
        // $app->navbar->setCurrentRoute($app->request->getRoute());
        $this->route = $route;
        // echo("<br/>this->route i setCurrentRoute() i Navbar-klassen: " . $this->route);
    }
    // Tanken är är att vi, likt hur Url sätts upp, skickar in nuvarande route in i klassen så den kan ta del av den.
    // Så här skulle det kunna se ut i index-filen, routen eller i vyn?.
    // $app->navbar->setCurrentRoute($app->request->getRoute());

    // Metod 2: Injecta url-skaparen
    /**
     * Sets the callable to use for creating routes.
     *
     * @param callable $urlCreate to create framework urls.
     *
     * @return void
     */
    public function setUrlCreator($urlCreate)
    {
        // Tanken är att logiken för att generera HTML-koden för navbaren ligger i denna metod.

        $navbar = $this->config["items"];

        $htmlNavbar = "";
        $htmlNavbar = "<nav>";

        foreach (array_keys($navbar) as $val) {
            $htmlNavbar .= "<a href=" . call_user_func($urlCreate, $navbar[$val]['route']) . ">" . $navbar[$val]['text'] ."</a>";
        }
        $htmlNavbar .= "</nav>";

        return $htmlNavbar;

    }
    // // Nu får Navbar tillgång till metoden som kan skapa nya länkar under kontroll av ramverket.
    // //
    // // Eftersom metoden behöver anropas tillsammans med sin klass, eller instans av klassen,
    // // så lägger man både instansen av klassen och dess metod i en array som tillsammans är en callable i PHP.
    // //
    // // Så här kan det se ut när man anropar metoden från index-filen för att sätta länkskaparen in i Navbar.
    // //
    // // $app->navbar->setUrlCreator([$app->url, "create"]);
    // // Arrayen [$app->url, "create"] är här det som betraktas som en callable.
    // //
    // // När man sedan anropar denna callable, så gör man så här.
    // //
    // // // Alt 1
    // // $htmlNavbar = call_user_func([$app->url, "create"], "my/route");
    // //
    // // // Alt 2
    // // $myCallable = [$app->url, "create"];
    // // $htmlNavbar = call_user_func($myCallable, "my/route");
    // // På detta sättet kan du få Navbar att skapa länkar med ramverkets tjänst, genom att injecta en callable till instansen/metoden som erbjuder tjänsten.
}
