<?php

// navbar är en array som består av två arrayer: config-arrayen (med ett element) och
// items-arrayen som i sin tur består av tre arrayer: me, about och report.
$navbar = [
    "config" => [
        "navbar-class" => "navbar"
    ],
    "items" => [
        "me" => [
            "text" => "Me",
            "route" => "",
        ],
        "about" => [
            "text" => "About",
            "route" => "about",
        ],
        "report" => [
            "text" => "Report",
            "route" => "report",
        ],
        "session" => [
            "text" => "Session",
            "route" => "session",
        ],
    ]
];

// echo "navbar ";
// var_dump($navbar);


?><nav>
<?php foreach ($navbar['items'] as $key => $val) {
    // echo "<br/> key= " . $key . " val= " . $val . " "?>
<a href="<?= $app->url->create($navbar['items'][$key]['route']) ?>"><?= $navbar["items"][$key]["text"] ?> </a>
<?php } ?>
</nav>
