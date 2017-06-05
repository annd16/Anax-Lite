<?php

namespace anna\Calendar;

class Week
{
    // private $name;
    public $name;
    public $week;

    /**
     * Constructor
    * @param string $name - the name of the week
    * @param DateTime object $begin - the start date of the week
    * @return void
    */
    public function __construct($name, $begin)
    {
        $this->name = $name;
        $interval = new \DateInterval('P1D');
        // $end = $begin;  Fungerar INTE, $begin får samma värde som $end dvs i detta fallet slutdatumet!
        $end = clone $begin;
        $end = $end->modify('+7 days');
        // echo("<br/>begin = " . $begin->format('Ymd'));
        // echo("<br/>end = " . $end->format('Ymd'));
        $this->week = new \DatePeriod($begin, $interval, $end);
        // echo("<br/>\$this->week inside constructor = ");
        // var_dump($this->week);
    }


    // /**
    //  * Constructor
    // //  * @param string $name (optional) The name of the session
    //  * @return void
    //  */
    // // public function __construct($name)
    // // {
    // //     $this->name = $name;
    // // }
    //
    // /**
    //  * Calendar::displayCurrentDate()
    //  * @return xxxxx
    //  */
    // // public function createAWeekInterval($begin)
    // // {
    // //     $interval = new \DateInterval('P1D');
    // //     echo("begin = " . $begin->format('Ymd'));
    // //     $end = $begin->modify('+7 days');
    // //     echo("end = " . $end->format('Ymd'));
    // //     $this->week = new \DatePeriod($begin, $interval, $end);
    // //     return $this->week;
    // // }
    //
    //
    // /**
    //  * Calendar::displayCurrentDate()
    //  * @return xxxxx
    //  */
    // public function displayCurrentDate()
    // {
    //     print_r(date('D, d M Y H:i:s'));
    //
    //     return date('D, d M Y H:i:s');
    // }
    //
    //
    // /**
    //  * Calendar::getCurrentMonth()
    //  * @return xxxxx
    //  */
    // public function getCurrentMonth()
    // {
    //     $month = $this->today['month'];
    //     echo "<br/>current month = " . $month . "<br/>";
    //     // $currentMonth = $datetime.getdate();
    //
    //     return $month;
    // }
    //
    // /**
    //  * Calendar::getCurrentMonth()
    //  * @return xxxxx
    //  */
    // public function getCurrentMonthNumber()
    // {
    //     $mnumber = $this->today['mon'];
    //     echo "<br/>current month = " . $mnumber . "<br/>";
    //     // $currentMonth = $datetime.getdate();
    //
    //     return $mnumber;
    // }
    //
    // /**
    //  * Calendar::getCurrentYear()
    //  * @return xxxxx
    //  */
    // public function getCurrentYear()
    // {
    //     $year = $this->today['year'];
    //     echo "<br/>current year = " . $year . "<br/>";
    //     // $currentMonth = $datetime.getdate();
    //
    //     return $year;
    // }
}
