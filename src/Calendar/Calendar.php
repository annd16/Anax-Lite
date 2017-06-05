<?php

namespace anna\Calendar;

class Calendar
{
    // private $name;
    public $today;
    public $weeks = [];
    private $theYear = 0;
    private $theMonthNumber = 0;
    // public $result = [];

    /**
     * Constructor
     * @return void
     */
    public function __construct($nameday)
    {
        $this->today = getdate();
        $this->nameday = $nameday;
    }

    /**
     * Calendar::displayCurrentDate()
     * @return datetime object
     */
    public function displayCurrentDate()
    {
        print_r(date('D, d M Y H:i:s'));
        $date = date('D, d M Y H:i:s');
        return $date;
    }


    /**
     * Calendar::getCurrentMonth()
     *  @return string $month - the current month
     */
    public function getCurrentMonth()
    {
        $month = $this->today['month'];
        return $month;
    }

    /**
     * Calendar::getCurrentMonthNumber()
     * @ @return integer $mnumber - the current month number
     */
    public function getCurrentMonthNumber()
    {
        $mnumber = $this->today['mon'];
        return $mnumber;
    }

    /**
     * Calendar::getCurrentYear()
     * @ @return integer $year - the current year
     */
    public function getCurrentYear()
    {
        $year = $this->today['year'];
        return $year;
    }

    /**
     * Calendar::getMonth()
     *  @return string $month - the requested month
     */
    public function getMonth()
    {
        return $this->theMonth;
    }

    /**
     * Calendar::getTheMonthNumber()
     * @ @return integer $mnumber - the requested month number
     */
    public function getMonthNumber()
    {
        return $this->theMonthNumber;
    }

    /**
     * Calendar::getYear()
     * @ @return integer $year - the requested year
     */
    public function getYear()
    {
        return $this->theYear;
    }

    /**
     * Calendar::setMonth()
      * @param string $theMonth
     */
    public function setMonth($theMonth)
    {
        $this->theMonth = $theMonth;
    }

    /**
     * Calendar::setMonthNumber()
     * @param integer $theMonthNumber
     */
    public function setMonthNumber($theMonthNumber)
    {
        $this->theMonthNumber = $theMonthNumber;
    }

    /**
     * Calendar::setYear()
     * @ @return integer $theYear
     */
    public function setYear($theYear)
    {
        $this->theYear = $theYear;
    }

     /**
     * Calendar::getNoWeeks()
     * @param integer $theMonthNumber - the requested month number
     * @param integer $theYear - the requested year
     * @param integer $number - the last day of the requested month i.e. 28, 29 , 30 or 31.
     * @ @return integer $noWeeks - no of weeks in the calendar view for a particular month/year combination.
     */
    // public function getNoWeeks($theMonthNumber, $theYear, $number)
    public function getNoWeeks($number)
    {
        $begin = new \DateTime($this->theYear . '-' . $this->theMonthNumber . '-01');

        // Fyll ut med "dummy-dagar" om månadens första dag inte är en måndag
        while ($begin->format("D") != "Mon") {
            $begin = $begin->modify('-1 day');
        }
        $end = new \DateTime($this->theYear . '-' . $this->theMonthNumber . '-' . $number);
        // $end = $end->modify('+1 day');      // För att även sista dagen i intervallet ska tas med.

        while ($end->format("D") != "Sun") {
            $end = $end->modify('+1 day');
            // echo($end->date);
            // var_dump($end);
        }
        // $interval = new \DateInterval('P1D');
        // $period = new \DatePeriod($begin, $interval, $end);
        $noDays = $begin->diff($end);
        // var_dump($noDays->days);
        $noWeeks = ($noDays->days+1)/7;
        // echo("<br/>" . $noWeeks);
        $noWeeks = ceil($noWeeks);
        // echo("<br/>" . $noWeeks);
        return $noWeeks;
    }

    /**
    * Calendar::createWeeksInMonth()
    * @param integer $noWeeks
    * @param dateobject $begin - start date
    */
    public function createWeeksInMonth($noWeeks, $begin)
    {
        for ($i = 1; $i <= $noWeeks; $i++) {
            // echo("<br/>\$begin->format('Ymd') inside for-loop= " . $begin->format('Ymd'));
            $this->weeks[$i] = new Week("week" . $i, $begin);
            $begin = $begin->modify('+7 day');      // För att nästa vecka ska få rätt startdatum
        }
    }


    /**
    * Calendar::zeroPad($number)
    * @param integer $number - the number that is going to be checked and padded if < 10.
    * @ @return integer $number - the number that has been checked and (perhaps) padded.
    **/
    // Pad numbers below 10 with a zero
    public function zeroPad($number)
    {
        if ($number < 10) {
            $number = "0" . $number;
        }
        return $number;
    }

    /**
    * Calendar::defineStartDate()
    * @param integer $theYear
    * @param integer $themonthNumber
    * @ @return datetime object
    */
    // public function defineStartDate($theYear, $theMonthNumber)
    public function defineStartDate()
    {
        $begin = new \DateTime($this->theYear . '-' . $this->theMonthNumber . '-01');
        // Fyll ut med "dummy-dagar" om månadens första dag inte är en måndag
        while ($begin->format("D") != "Mon") {
            $begin = $begin->modify('-1 day');
        }
        return $begin;
    }

    /**
    * Calendar::checkIfTodaySetClass()
    * @param datetime object $date
    * @param String $class
    * @param Integer $currentMonthNumber
    * @ @return String $class.
    **/
    public function checkIfTodaySetClass($date, $class, $currentMonthNumber)
    {
        if (($date->format('d') == $this->today['mday']) && ($date->format('m') == $this->zeroPad($currentMonthNumber)) && $class != 'different') {
             $class .= ' today';
        }
         return $class;
    }


    // /**
    // * Calendar::getWeekHTML()
    // * @param datetime object $date
    // * @ @return String $html the HTML code as a string.
    // **/
    // public function getWeekNumberHTML($date, $html)
    // {
    //     $html .= "<span class='weeknumber'>";
    //     $weekNumber = $date->format('W');
    //     // echo($weekNumber);
    //     $html .= $weekNumber . "</span>";
    //     return $html;
    // }

    /**
    * Calendar::getHTML()
    * @param String $the Month
    * @param integer $theMonthNumber
    * @param integer $theYear
    ** @param integer $noWeeks
    * @ @return String $html the HTML code as a string.
    **/
    //
    // public function getHTML($theMonth, $theMonthNumber, $theYear, $noWeeks)
    public function getHTML($theMonth, $noWeeks, $currentMonthNumber)
    {
        $html =  "<div class='month'>";
        // $html .= "<h3 class='month'>" . date('M', $theMonth) . " " . $this->theYear . "</h3>";
        $html .= "<h3 class='month'>" . $theMonth . " " . $this->theYear . "</h3>";
        for ($i = 1; $i <=$noWeeks; $i++) {
            $html .= "<div class='week'>";
            // echo("\$weeks[$i]->week = ");
            // var_dump($weeks[$i]->week);
            foreach ($this->weeks[$i]->week as $date) {
                if ($date->format("D") == "Mon") {
                    $html .= "<span class='weeknumber'>";
                    $weekNumber = $date->format('W');
                    // echo($weekNumber);
                    $html .= $weekNumber . "</span>";
                    // $html = $this->getWeekNumberHTML($date, $html);
                }

                // Sätt klassen till samma som dagens kortnamn
                $class = $date->format('D');

                // Men sätt annan klass på de dagar i månaden som inte tillhör den aktuella månaden
                if ($date->format("m") != $this->theMonthNumber) {
                    // echo "This day does not belong to this month!";
                    $class='different';
                }
                /*******************************/
                // var_dump($this->today);
                // echo "<br/>" . $date->format('d') . " vs " . $this->today['mday'];
                // echo "<br/>" . $date->format('m') . " vs " . $this->zeroPad($currentMonthNumber);

                // if (($date->format('d') == $this->today['mday']) && ($date->format('m') == $this->zeroPad($currentMonthNumber)) && $class != 'different') {
                //     $class .= ' today';
                // }

                $class = $this->checkIfTodaySetClass($date, $class, $currentMonthNumber);

                /******************************/
                if ($class=='different') {
                    $html .= "<p class='day $class'>" . $date->format('d') . "<br/>" . $date->format("D") . "</p>";
                // } else if ($this->result && $this->checkCurl()) {
                } else if ($this->nameday->result && $this->checkCurl()) {
                    $html .= "<span class='day $class'>" . $date->format('d') . "<br/>" . $date->format("D") . "<br/>" . "<p class='day nameday'>" . $this->nameday->getNameday($date->format("d")) . "</p>" . "</span>";
                    // $html .= "<span class='day . $class'>" . $date->format('d') . "<br/>" . $date->format("D") . "<br/>" . "<p class='day nameday'>" . $this->getNameday2($date->format("d")) . "</p>" . "</span>";
                // } else if ($this->result) {
                } else if ($this->nameday->result) {
                    $html .= "<span class='day $class'>" . $date->format('d') . "<br/>" . $date->format("D") . "<br/>" . "<p class='day nameday'>" . $this->nameday->getNameday2($this->theYear, $this->theMonthNumber, $date->format("d")) . "</p>" . "</span>";
                    // $html .= "<span class='day . $class'>" . $date->format('d') . "<br/>" . $date->format("D") . "<br/>" . "<p class='day nameday'>" . $this->getNameday2($date->format("d")) . "</p>" . "</span>";
                } else {
                    $html .= "<span class='day $class'>" . $date->format('d') . "<br/>" . $date->format("D") . "<br/>" . "<p class='day nameday'>" .  "</p>" . "</span>";
                }
            }
            $html .= "</div><br/>";
        }
        $html .= "</div>";
        return $html;
    }


    /**
    * Calendar::getFlashHTML()
    * @param xxxx $linkImage - link to an asset.
    * @ @return String $html the HTML code as a string.
    **/
    // Pad numbers below 10 with a zero
    public function getFlashHTML($linkimage)
    {

        $html =  "<div class='row'>";
        $html .= "<div class='outer-wrap flash'>";
        $html .= "<div class='inner-wrap flash'>";
        $html .= "<p><img src='$linkimage'></p>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }


    /**
    * Calendar::setParams()
    * @param integer $currentYear - the current year.
    * @param integer $currentMonth - the current Month.
    **/
    public function setParams($currentYear, $currentMonthNumber)
    {

        if (isset($_GET["theMonthNumberPrevious"])) {
            $this->theYear = isset($_GET["theYearPrevious"]) ? htmlentities($_GET["theYearPrevious"]) : $currentYear;
            $this->theMonthNumber = isset($_GET["theMonthNumberPrevious"]) ? htmlentities($_GET["theMonthNumberPrevious"]) : $currentMonthNumber;
        } else if (isset($_GET["theMonthNumberNext"])) {
            $this->theYear = isset($_GET["theYearNext"]) ? htmlentities($_GET["theYearNext"]) : $currentYear;
            $this->theMonthNumber = isset($_GET["theMonthNumberNext"]) ? htmlentities($_GET["theMonthNumberNext"]) : $currentMonthNumber;
        } else {
            $this->theMonthNumber = $currentMonthNumber;
            $this->theYear = $currentYear;
        }
    }


    /**
    * Calendar::checkCurl()
    * @param integer $currentYear - the current year.
    * @param integer $currentMonth - the current Month.
    **/
    public function checkCurl()
    {

        if (function_exists("curl_version")) {
            $civ = curl_version();
            $cvn = $civ["version_number"];
            if ($cvn) {
                // echo "curl installed";
                return true;
                // Request namedays from API (fungerar lokalt)
                // $calendar->requestNamedaysFromAPI($calendar->getYear(), $calendar->getMonthNumber());
            }
        } else {
            // echo "curl is not installed";
            return false;
            // Get namedays from file (stud-servern)
            // $calendar->getNamedaysFromFile3();
        }
    }
}
