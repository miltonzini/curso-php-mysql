<?php

function sumar() {
    if (validacionInicial()) {
        $datos = validacionInicial();
        $resultado = $datos[0] + $datos[1];
        echo "<div class='resultado'>Suma: " . $resultado . "</div>";
    } 
}
function restar() {
    if (validacionInicial()) {
        $datos = validacionInicial();
        $resultado = $datos[0] - $datos[1];
        echo "<div class='resultado'> Resta: " . $resultado . "</div>";
    } 
}
function multiplicar() {
    if (validacionInicial()) {
        $datos = validacionInicial();
        $resultado = $datos[0] * $datos[1];
        echo "<div class='resultado'>Multiplicación: " . $resultado . "</div>";
    } 
}
function dividir() {
    if (validacionInicial()) {
        $datos = validacionInicial();
        $resultado = $datos[0] / $datos[1];
        echo "<div class='resultado'>División:" . $resultado . "</div>";
    } 
}
function concatenar() {
    if (validacionInicial()) {
        $datos = validacionInicial();
        $resultado = $datos[0] . $datos[1];
        echo "<div class='resultado'>Concatenación: " . $resultado . "</div>";
    } 
}

function validacionInicial() {
    if (isset($_POST['numero01']) && isset($_POST['numero02'])) {
        $n1 = $_POST['numero01'];
        $n2 = $_POST['numero02'];
        if (esNumero($n1, $n2)) {
            $numbers = array($n1, $n2);
            return $numbers;
        } else {
            echo mensajeError($n1, $n2);
        }
    }
}


function esNumero($n1, $n2) {
    if (is_numeric($n1) && is_numeric($n2)) {
        return true;
    } else return false;
}

function mensajeError($n1, $n2){ 

    if ($n1 == "" || $n2 == "") {
        return "<div class='error'>hay algún dato vacío</div>";
    } else {
        return "<div class='error'>ingrese sólo datos numéricos</div>";
    }
}

?>
