<?php

namespace anna\Calendar;

$nameday = new Nameday();
$calendar = new Calendar($nameday);


$currentMonth = $calendar->getCurrentMonth();
$currentMonthNumber = $calendar->getCurrentMonthNumber();
$currentYear = $calendar->getCurrentYear();

$calendar->setParams($currentYear, $currentMonthNumber);

// $theMonth = mktime(0, 0, 0, $calendar->getMonthNumber(), date("d"), date("Y"));
$theMonth = date('F', mktime(0, 0, 0, $calendar->getMonthNumber(), 10)); // March
// echo("\$theMonth = " . $theMonth . "<br/>");


$number = cal_days_in_month(CAL_GREGORIAN, $calendar->getMonthNumber(), $calendar->getYear()); // 31


if ($calendar->checkCurl()) {
    $nameday->requestNamedaysFromAPI($calendar->getYear(), $calendar->getMonthNumber());
    // $calendar->requestNamedaysFromAPI($calendar->getYear(), $calendar->getMonthNumber());
    // $calendar->getNamedaysFromFile2($calendar->getYear());
} else {
    $nameday->getNamedaysFromFile3($calendar->getYear(), $calendar->getMonthNumber());
}

// // Request namedays from API v2 (fungerar inte ännu)
// $calendar->requestNamedaysFromAPI2($calendar->getYear(), $calendar->getMonthNumber());

// $begin = $calendar->defineStartDate($calendar->getYear(), $calendar->getMonthNumber());
$begin = $calendar->defineStartDate();


// $noWeeks = $calendar->getNoWeeks($calendar->getMonthNumber(), $calendar->getYear(), $number);
$noWeeks = $calendar->getNoWeeks($number);



$calendar->createWeeksInMonth($noWeeks, $begin);

$linkimage = $this->asset("img/frog-2240764_640_edit1.jpg");

echo($calendar->getFlashHTML($linkimage));

?>

<main id="calendar">


<!-- Har tagit bort kod här -->


    <?php

    // echo($calendar->getHTML($theMonth, $calendar->getMonthNumber(), $calendar->getYear(), $noWeeks));
    echo($calendar->getHTML($theMonth, $noWeeks, $currentMonthNumber));

    $linkViewPrevious = $app->url->create("calendar");
    $linkViewNext = $app->url->create("calendar");


    ?>

    <div class="row">
        <div class="outer-wrap next_previous">
            <div class="inner-wrap next_previous">

    <a href="<?= $linkViewPrevious ?>?theYearPrevious=<?= $theYearPrevious = $calendar->getMonthNumber() > 1
                                   ? $calendar->getYear()
                                   : $calendar->getYear() - 1;  ?>&theMonthNumberPrevious=<?= $theMonthNumberPrevious = $calendar->getMonthNumber() > 1
                                                                                                          ? $calendar->getMonthNumber() - 1
                                                                                                          : 12; ?>#calendar">previous</a>


    <a href="<?= $linkViewNext ?>?theYearNext=<?= $theYearNext = $calendar->getMonthNumber() < 12
                                   ? $calendar->getYear()
                                   : $calendar->getYear() + 1; ?>&theMonthNumberNext=<?= $theMonthNumberNext = $calendar->getMonthNumber() < 12
                                                                                                 ? $calendar->getMonthNumber() + 1
                                                                                                : 1; ?>#calendar">next</a>


            </div>
        </div>
    </div>

</main>
