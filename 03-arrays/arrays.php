<?php
$frutas = array("manzanas", "peras", "uvas");
print_r($frutas);
echo "<br >";


echo "el array 'frutas' tiene " . count($frutas) . " elementos";

echo "<br />";
echo "<br />";
echo "<br />";

for ($i = 0; $i < count($frutas); $i++) { 
    echo $frutas[$i] . "<br />";
}

echo "<br />";
echo "   ____________   ";
echo "<br />";

$edades = array(
    "Marcos" => 34, 
    "Juan" => 27, 
    "Esteban" => 32,
);

print_r($edades);

echo "<br />";
echo "<br />";
echo "<br />";
//echo "La edad de " . "Marcos es: "  . $edades[0];

$nombre = "Juan";

echo $nombre . " tiene " . $edades[$nombre] . " años." . "<br />";

foreach ($edades as $key => $value) {
    echo $key . " tiene el valor de " . $value . "<br />";
}

?>