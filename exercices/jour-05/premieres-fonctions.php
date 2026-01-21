<?php

function greet()
{
    echo '<br>Bienvenue sur la boutique !';
}

function greetClient(string $name)
{
    echo "<br>Bienvenue $name";
}

$message = greet();
$message2 = greetClient('Pierre');

$message = greet();
$message2 = greetClient('Marie');

$message = greet();
$message2 = greetClient('Patrick');
