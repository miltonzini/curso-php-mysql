<?php
$ejemplo = "Esto es un ejemplo";

echo strlen($ejemplo);
echo "<br/><br/>";

echo str_word_count($ejemplo);
echo "<br/><br/>";

echo strrev($ejemplo);  
echo "<br/><br/>";

echo strpos($ejemplo, "es"); 
echo "<br/><br/>";

echo str_replace("es", "fue", $ejemplo); 
echo "<br/><br/>";

echo strtolower($ejemplo); 
echo strtoupper($ejemplo); 
echo "<br/><br/>";

echo strcmp("a", "b");
echo "<br/><br/>";

echo substr($ejemplo, 8, 5); 
echo "<br/><br/>";

echo trim("     texto    con    mucho espacio     ");
echo "<br/>";

?>