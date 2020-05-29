<?php
    if(isset($_POST['nickName'])){
        $nickName= $_POST['nickName'];
    }else{
        $nickName = "Player";
    }

    if(isset($_POST['size'])){
        $size = $_POST['size'];
    }else{
        $size = "medium";
    }

    echo $nickName;
    echo $size;

    //Leer archivo txt y guardar palabras en array.
    $file = fopen("listaPalabras", "r");
    $diccionario = [];
    $contador=0;
    while(!feof($file)){
        array_push($diccionario, fgets($file));
        $diccionario[$contador]= trim($diccionario[$contador]);
        $contador++;
    }
    fclose($file);

    //Seleccionamos 6 palabras aleatorias.
    $palabrasRandom = [];
    $contador=0;
    while ($contador<6) {
        $numAleatorio = rand(0,count($diccionario)-2);
        if (!in_array($diccionario[$numAleatorio], $palabrasRandom)) {
            array_push($palabrasRandom, $diccionario[$numAleatorio]);
            $contador++;
        }
    }

    print_r($palabrasRandom);
?>