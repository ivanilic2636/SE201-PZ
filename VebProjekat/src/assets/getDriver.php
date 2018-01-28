<?php

header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-type: application/json");
$test_array =  array(
	array
	(
		'ime' => 'Sebastian',
		'prezime' => 'Vettel',
		'bolid' => 'Ferrari',

	),
	array
	(
    'ime' => 'Lewis',
		'prezime' => 'Hamilton',
		'bolid' => 'Mercedes',
	),
	array
	(
    'ime' => 'Valtteri',
		'prezime' => 'Bottas',
		'bolid' => 'Mercedes',
	),
	array
	(
    'ime' => 'Kimi',
		'prezime' => 'Raikkonen',
		'bolid' => 'Ferrari',
	),
	array
	(
    'ime' => 'Daniel',
		'prezime' => 'Ricciardo',
		'bolid' => 'Red Bull Racing Tag Heuer',
	),
	array
	(
    'ime' => 'Max',
		'prezime' => 'Verstappen',
		'bolid' => 'Red Bul Racing Tag Heuer',
	),
	array
	(
    'ime' => 'Sergio',
		'prezime' => 'Perez',
		'bolid' => 'Force India Mercedes',
	),
	array
	(
    'ime' => 'Esteban',
		'prezime' => 'Ocon',
		'bolid' => 'Force India Mercedes',
	)
);
echo json_encode($test_array);
?>
