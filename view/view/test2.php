<?php

$linkcar = $this->asset("img/car.png");

$linkViewTest1 = $this->url("test1");
$linkViewTest2 = $this->url("test2");
$linkGoogle = $this->url("https://google.se");      // ÄVen externa länkar ska tydligen skapas med $this->url!


?>

<!doctype html>
<meta charset="utf-8">
<title> <?= $title ?> </title>

<!-- Get all available variables -->
<!-- <pre> <?= print_r(var_dump(get_defined_vars()), false); ?> </pre> -->

<p> <?= $message ?> </p>

<p>Here is a link to a static asset <a href="<?= $linkcar ?>">car.png</a>.</p>

<p>Here is the same car within a paragraph as an image <img src="<?= $linkcar ?>">, the image source is linked as an asset.</p>

<p>Here are two links to the test routes:
<a href="<?= $linkViewTest1 ?>">view/test1</a>.</p>
<a href="<?= $linkViewTest2 ?>">view/test2</a>.</p>

<p>Here is a link to another site, like <a href="<?= $linkgoogle ?>">google</a>.</p>
