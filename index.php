<?php

require_once 'SenoLazos.php';

$senoLazos = new SenoLazos();
$result = $senoLazos->process( 'SSNON' );
echo $result;
