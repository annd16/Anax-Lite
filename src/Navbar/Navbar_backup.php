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

    // public $htmlNavbar = "";         // Behövs för alternativ 1 & 2

    // *** Att injecta beroende till en klass, alternativ1 *** //
    // *** Injecta hela $app in i Navbar-klassen *** //
    // *** komma åt html-koden genom en metod i klassen  *** //
    // *******************************************************//
    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        // var_dump(array_keys($this->config));

        // Tanken är att logiken för att generera HTML-koden för navbaren ligger i denna metod.
        $navbar = $this->config["items"];
        // pga av config-filen returnerar en array så är innehållet i $this->config oxå en array.


        $html = "<nav>";
        // foreach ($navbar as $key => $val) {
        foreach (array_keys($navbar) as $val) {
            // echo "<br/> key= " . "$key" . " val= " . "$val" . " ";
            // $html += "<a href=" . $this->app->url->create($navbar['items'][$key]['route']) . ">" . $navbar['items'][$key]['text'] ."</a>";
            // $html .= "<a href=" . $this->app->url->create($navbar[$key]['route']) . ">" . $navbar[$key]['text'] ."</a>";
            $html .= "<a href=" . $this->app->url->create($navbar[$val]['route']) . ">" . $navbar[$val]['text'] ."</a>";
            // echo($this->app->url->create($navbar[$key]['route']));
            // echo($navbar[$key]['text']);
        }
        $html .= "</nav>";
        // echo("html =" . $html);
        return $html;
    }

    // *** Att injecta beroende till en klass, alternativ1 *** //
    public function setHTML()
    {
        // Tanken är att logiken för att sätta HTML-koden för navbaren ligger i denna metod.


        $this->htmlNavbar = $this->getHTML();

    }

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
    // public function setCurrentRoute($route)
    // {
    //     // $this->setSiteUrl($route);
    // }
    // Tanken är är att vi, likt hur Url sätts upp, skickar in nuvarande route in i klassen så den kan ta del av den.
    // Så här skulle det kunna se ut i index-filen(?):.
    // $app->navbar->setCurrentRoute($app->request->getRoute());

    // Metod 2: Injecta url-skaparen
    /**
     * Sets the callable to use for creating routes.
     *
     * @param callable $urlCreate to create framework urls.
     *
     * @return void
     */
    // public function setUrlCreator($urlCreate)
    // {
    //     ;
    // }
    // Nu får Navbar tillgång till metoden som kan skapa nya länkar under kontroll av ramverket.
    //
    // Eftersom metoden behöver anropas tillsammans med sin klass, eller instans av klassen,
    // så lägger man både instansen av klassen och dess metod i en array som tillsammans är en callable i PHP.
    //
    // Så här kan det se ut när man anropar metoden från index-filen för att sätta länkskaparen in i Navbar.
    //
    // $app->navbar->setUrlCreator([$app->url, "create"]);
    // Arrayen [$app->url, "create"] är här det som betraktas som en callable.
    //
    // När man sedan anropar denna callable, så gör man så här.
    //
    // // Alt 1
    // $htmlNavbar = call_user_func([$app->url, "create"], "my/route");
    //
    // // Alt 2
    // $myCallable = [$app->url, "create"];
    // $htmlNavbar = call_user_func($myCallable, "my/route");
    // På detta sättet kan du få Navbar att skapa länkar med ramverkets tjänst, genom att injecta en callable till instansen/metoden som erbjuder tjänsten.


    // *** Att injecta beroende till en klass, alternativ3 *** //
    // *** Injecta när man genererar menyn, dvs injecta de beroenden *** //
    // *** som finns, i samband med själva anropet till createHTML() *** //
    // *******************************************************//
    // /**
    //  * Get HTML for the navbar.
    //  *
    //  * @param string $route the current route.
    //  * @param callable $urlCreate to create framework urls.
    //  *
    //  * @return string as HTML with the navbar.
    //  */
    // public function getHTML($route, $urlCreate)
    // {
    //     ;
    // }
    // Det är en variant som minskar antalet setters (och medlemsvariabler).


    // *** Att injecta beroende till en klass, alternativ4 *** //
    // ***          Att sköta allt från vyn                *** //
    // *** En variant är att inte lägga $navbar som en del *** //
    // *** av alla tjänsterna i $app. Istället kan vi       ***
    // *** flytta den delen av koden från frontcontrollern ner till vyn.*** //
    // *******************************************************//

    // *** Att injecta beroende till en klass, alternativ5 *** //
    // ***  Generera HTML-koden för navbaren direkt i routens hanterare *** //
    // *** och bifoga som en variabel till vyn. *** //
    // *******************************************************//
    // Ett annat alternativ är att generera HTML-koden för navbaren direkt i routens hanterare
    // och bifoga som en variabel till vyn.
    //
    // Om man gillar vyer utan kod och logik så är det en bra lösning.
    // En del templatemotorer, som sköter vyerna, gillar inte att man skriver PHP-kod i vyerna.
    // I sådana fall måste anropet till Navbar ske i routen.


    // *** Att injecta beroende till en klass, alternativ5 *** //
    // Skapa länkarna i konfigurationsarrayen?
    //
    // Men, tänk om jag vill länka till en resurs via $app->url->asset() i menyn?
    //
    // Ja, då faller vår idé om en enda metod för att skapa länkarna i menyn.
    //
    // Då hade vi fått tänka om och kanske skapat länkarna direkt i konfigurationsarrayen. Men då behöver konfigurationsarrayen ha tillgång till $app. Det går att lösa.
}
