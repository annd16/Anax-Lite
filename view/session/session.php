<?php

$dir = __DIR__ . "/../../config";
require "$dir/config.php";

$pages = [ "1" => "increment",
           "2" => "decrement",
           "3" => "status",
           "4" => "dump",
           "5" => "destroy",
       ];

// $linkSessionIncrement = $this->url("session/increment");
// $linkSessionDecrement = $this->url("session/decrement");
// $linkSessionStatus = $this->url("session/status");
// $linkSessionDump = $this->url("session/dump");
// $linkSessionDestroy = $this->url("session/destroy");

$sessionNumber = isset($_SESSION['sessionNumber'])
                ? htmlentities($_SESSION['sessionNumber'])
                : 0;
?>


<!-- <a href="<?= $linkSessionIncrement ?>">Increment</a>
<a href="<?= $linkSessionDecrement ?>">Decrement</a>
<a href="<?= $linkSessionStatus ?>">Status</a>
<a href="<?= $linkSessionDump ?>">Dump</a>
<a href="<?= $linkSessionDestroy ?>">Destroy</a> -->

<div class="content">

    <div class="button">
        <?php foreach ($pages as $key => $value) {
        ?><form action="<?= $app->request->getBaseUrl() . "/\session/" . $value ?>" method="get">
            <input  class="<?= 'button' . $key?>" type="submit" value="<?= $value ?>">
        </form>


    <?php } ?>

    </div>


    <h3> The session number is <?= $app->session->get("sessionNumber"); ?> </h3>

</div>

<?php

$data = [
    "Session name" => session_name(),
    "Session id" => session_id(),
    "Session cache expire" => session_cache_expire(),
    "Session status" => session_status(),
    "Session cookie parameters" => session_get_cookie_params()
];

// echo($data["Session name"] . " " . $data["Session id"]);

?>

<!-- VIEW session/session.php -->
