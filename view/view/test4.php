<?php
// include __DIR__ . "/header.php"

$this->renderView("view/header", [
    "title" => $title
]);

// Alternativt kan man skriva så här för att skicka med alla variabler som exponerats för vyn.
$this->renderView("view/header", $data);


?>

<p>This is another test view.</p>

<p><?= $message ?></p>

<?php
// include __DIR__ . "/footer.php"

$this->renderView("view/footer", [
    "copyright" => $copyright,
]);
