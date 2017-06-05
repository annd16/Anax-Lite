<!-- <p>This is the navbar3-view</p> -->

<?php

// navbar är en array som består av två arrayer: config-arrayen (med ett element) och
// items-arrayen som i sin tur består av tre arrayer: me, about och report.
$navbar = [
    "config" => [
        "navbar-class" => "navbar"
    ],
    "items" => [
        "increment" => [
            "text" => "Increment",
            "route" => "session/increment",
        ],
        "decrement" => [
            "text" => "Decrement",
            "route" => "session/decrement",
        ],
        "status" => [
            "text" => "Status",
            "route" => "session/status",
        ],
        "dump" => [
            "text" => "Dump",
            "route" => "session/dump",
        ],
        "destroy" => [
            "text" => "Destroy",
            "route" => "session/destroy",
        ],
    ]
];

// echo "navbar ";
// var_dump($navbar);

?><nav class="navbar_session">

<?php foreach ($navbar['items'] as $key => $val) {
    // echo "<br/> key= " . $key . " val= " . $val . " "?>
<a href="<?= $app->url->create($navbar['items'][$key]['route']) ?>"><?= $navbar["items"][$key]["text"] ?> </a>
<?php } ?>
</nav>
