<div class="opcion">
<?php
    $barWidth = $porcentaje * 5; // magic number
    $estilo = "barra";

    if($survey->getOptionSelected() == $lenguaje['opcion']){ // comentario F
        $estilo = "seleccionado";
    }

    echo $lenguaje['opcion'];
?>
    <div class="<?php echo $estilo; ?>" style="width: <?php echo $barWidth . 'px;' ?>"><?php echo $porcentaje . '%'?></div>

</div>

<?php
// comentario F: esto es para dar un estilo diferente a la barra correspondiente a la opción elegida.