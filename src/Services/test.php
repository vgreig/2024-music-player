<?php

declare(strict_types=1);

$message = '';
$list = ['a', 'b', 'c'];

$message .= "<div>lol</div>";

foreach ($list as $item) {
    $message .= "<div>$item</div>";
}

$message .= "<div>lol</div>";

echo $message;