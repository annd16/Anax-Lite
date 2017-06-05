<?php


?>

<!doctype html>
<meta charset="utf-8">
<title> <?= $title ?> </title>

<!-- Get all available variables -->
<!-- <pre> <?= print_r(var_dump(get_defined_vars()), false); ?> </pre> -->

<p> <?= $message ?> </p>
<p>These variables are defined.</p>
<ul>
<?php foreach (get_defined_vars() as $key => $val) : ?>
    <li><?= $key ?></li>
<?php endforeach; ?>
</ul>
