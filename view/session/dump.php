<?php

$dir = __DIR__ . "/../../config";
require "$dir/config.php";

$url = $app->request->getBaseUrl() . "/session"

?>

<div class="content">

    <a href="<?= $url ?>">Back to session page</a>

    <h3> The $_SESSION array contains the following:</h3>

    <pre> <?= $app->session->dump() ?> </pre>

</div>
