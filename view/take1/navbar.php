<?php

$urlMe  = $app->url->create("");
$urlAbout = $app->url->create("about");
$urlReport = $app->url->create("report");

?><navbar>
<a href="<?= $urlMe ?>">Me</a> |
<a href="<?= $urlAbout ?>">About</a>
<a href="<?= $urlReport ?>">Report</a>
</navbar>
