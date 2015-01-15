<?php
header('Content-Type: application/javascript'); 
$callback=filter_input(INPUT_GET, 'callback');
echo $callback."({ status : \"OK\" })";
