<?php

namespace anna\Calendar;

class Nameday
{
    public $result = [];

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        // echo "A Nameday object has been created";
    }

    /**
    * Calendar::requestNamedaysFromAPI()
    * @param integer $theYear
    * @param integer $themonthNumber
    **/
    public function requestNamedaysFromAPI($theYear, $theMonthNumber)
    {

        $this->resetResultArray();

        # Base URL for the API
        $apiUrl  = 'http://api.dryg.net/dagar/v2.1/';
        # List all days in the requested month/year combination
        // $theYear = '2017';
        // $theMonthNumber = '05';
        $apiUrl .= $theYear . "/" . $theMonthNumber;

        # Retreieve the result from the API using cURL library methods (fungerar bara lokalt)
        //************************************************************************

        // Initializes a new session and return a cURL handle for use
        // with the curl_setopt(), curl_exec(), and curl_close() functions
        $curlHandle = \curl_init();

        // curl_setopt() Sets an option for a cURL transfer on the given cURL session handle.

        // The URL to fetch. This can also be set when initializing a session with curl_init().
        curl_setopt($curlHandle, CURLOPT_URL, $apiUrl);

        // TRUE to return the transfer as a string of the return value of curl_exec()
        // instead of outputting it out directly.
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

        // Execute the given cURL session.
        // (This function should be called after initializing a cURL session and all the options for the session are set.)
        $string = curl_exec($curlHandle);

        // Closes a cURL session and frees all resources. The cURL handle, curlHandle, is also deleted.
        curl_close($curlHandle);

        // *********************************************************

        # Read the JSON output into an associative array
        $this->result  = json_decode($string, true);

        // # Find out how many days that are listed
        // $numdays = count($this->result['dagar']);
        // echo "<br/>Days in month: " . $numdays;

    }

    // Filerna måste ligga i htdocs-mappen!

    /**
    * Calendar::getNamedaysFromFile()
    * @param integer $theYear
    * @param integer $theMonthNumber
    **/
    public function getNamedaysFromFile($theYear, $theMonthNumber)
    {

        $this->resetResultArray();

        // $this->setMonthNumber($this->zeroPad($this->getMonthNumber()));
        // echo($theMonthNumber);


        if (file_exists('namn' . $theYear . $theMonthNumber . '.json')) {
            $myfile = fopen('namn' . $theYear . $theMonthNumber . '.json', "r");
            // echo fread($myfile, filesize('namn' . $theYear . $theMonthNumber . '.json'));
            $content = file_get_contents(('namn' . $theYear . $theMonthNumber . '.json'));

            # Read the JSON output into an associative array
            $this->result  = json_decode($content, true);

            // # Find out how many days that are listed
            // $numdays = count($this->result['dagar']);
            // echo "<br/>Days in month: " . $numdays;
            fclose($myfile);
        } else {
            echo "Unable to open file!";
        }
    }


    /**
    * Calendar::getNamedaysFromFile2()
    * @param integer $theYear
    * @param integer $themonthNumber
    **/
    public function getNamedaysFromFile2($theYear)
    {

        $this->resetResultArray();

        // $this->setMonthNumber($this->zeroPad($this->getMonthNumber()));
        // echo($this->getMonthNumber($theMonthNumber));


        if (file_exists('namn' . $theYear . '.json')) {
            $myfile = fopen('namn' . $theYear . '.json', "r");
            // echo fread($myfile, filesize('namn' . $theYear .'.json'));
            $content = file_get_contents(('namn' . $theYear .'.json'));
            # Read the JSON output into an associative array
            $this->result  = json_decode($content, true);

            // # Read the JSON output into an associative array
            // $this->result  = json_decode($string, true);

            // # Find out how many days that are listed
            // $numdays = count($this->result['dagar']);
            // echo "<br/>Days in year: " . $numdays;
            fclose($myfile);
        } else {
            echo "Unable to open file namn{$theYear}.json!";
            // echo(__DIR__ . 'namn' . $theYear . '.json');
        }
    }


    /**
    * Calendar::getNamedaysFromFile3()
    * @param integer $theYear
    * @param integer $themonthNumber
    **/
    public function getNamedaysFromFile3($theYear, $theMonthNumber)
    {
        $this->resetResultArray();
        $dateFormat = 'Y-m-d';
        // $myString = "";

        $stringDate = $theYear . "-" . $this->zeroPad($theMonthNumber) . "-" . '01';

        // $this->setMonthNumber($this->zeroPad($this->getMonthNumber()));
        // echo($theMonthNumber);

        $date = new \DateTime();
        $date = $date->createFromFormat($dateFormat, $stringDate);
        // echo($date->format('Y-m-d'));
        // echo("<br/>\$date->format('L') = " . $date->format("L") . "<br/>");


        if ($date->format("L")) {
            $fileName = 'namn2016.json';
            if (file_exists($fileName)) {
                $myfile = fopen($fileName, "r");
                // echo fread($myfile, filesize('namn2016.json'));
                $content = file_get_contents($fileName);
                # Read the JSON output into an associative array
                $this->result  = json_decode($content, true);

                // # Find out how many days that are listed
                $numdays = count($this->result['dagar']);
                // echo "<br/>Days in year: " . $numdays;
                fclose($myfile);
            } else {
                echo "Unable to open file {$fileName}!";
            }
        } else {
            $fileName = 'namn2017.json';
            if (file_exists($fileName)) {
                $myfile = fopen($fileName, "r");
                // echo fread($myfile, filesize('namn2016.json'));
                $content = file_get_contents($fileName);
                # Read the JSON output into an associative array
                $this->result  = json_decode($content, true);

                // # Find out how many days that are listed
                $numdays = count($this->result['dagar']);
                // echo "<br/>Days in year: " . $numdays;
                fclose($myfile);
            } else {
                echo "Unable to open file {$fileName}!";
            }
        }
    }



    /**
    * Calendar::getNameday()
    * @param integer $day - the day in month
    * @ @return string $myString - the names of the day as a string.
    **/
    public function getNameday($day)
    {
          $myString = "";
          $i = $day-1;

        # Print out the date and the day
        //   $date = $this->result['dagar'][$i]['datum'];
        //   $day = $this->result['dagar'][$i]['veckodag'];
        // echo($i);
        if ($this->result) {
            foreach ($this->result['dagar'][$i]['namnsdag'] as $val) {
                // echo("<br/> " . $key . " " . $val);
                $myString .= $val . "<br/>";
            }
        } else {
                $myString = "";
        }
            return $myString;

    }


    /**
    * Calendar::getNameday2()
    * @param integer $day - the day in month
    * @ @return string $myString - the names of the day as a string.
    **/
    public function getNameday2($theYear, $theMonthNumber, $day)
    {
        // Hela denna metod anropas ju för varje dag i den aktuella månaden
        $dateFormat = 'Y-m-d';
        $myString = "";

        $stringDate = $theYear . "-" . $this->zeroPad($theMonthNumber) . "-" . $day;
        // echo ("<br/>\$day = " . $day);

        // echo ("<br/>\$stringDate = " . $stringDate);

        // Get the day number of the year
        $dayIndex = date("z", strtotime($stringDate));
        // echo ("<br/>\$dayIndex = " . $dayIndex);

        if ($this->result) {
            $date = new \DateTime();
            $date = $date->createFromFormat($dateFormat, $stringDate);
            // echo($date->format('Y-m-d'));
            // echo($date->format("L"));

            foreach ($this->result['dagar'][$dayIndex]['namnsdag'] as $val) {
                if ($date->format("m") == $theMonthNumber) {
                        // echo($date->format("m"));
                        // echo($val);
                        $myString .= $val . "<br/>";
                }
            }
        } else {
            $myString = "";
        }
            return $myString;
    }


    /**
    * Calendar::resetResultArray()
    **/
    // Reset the result array
    public function resetResultArray()
    {
        $this->result = [];
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
}
