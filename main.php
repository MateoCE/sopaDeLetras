<?php

    if(isset($_POST['nickName'])){
        $nickName= $_POST['nickName'];
    }else{
        $nickName = "Player";
    }

    if(isset($_POST['size'])){
        $size = $_POST['size'];
        switch ($size) {
            case 'small':
                $width = 10;
                $height= 10;
                $numWords=5;
                break;
            case 'medium':
                $width = 15;
                $height= 15;
                $numWords=7;
                break;
            case 'big':
                $width = 20;
                $height= 20;
                $numWords=10;
                break;
            default:
                $width = 15;
                $height= 15;
                $numWords=7;
                break;
        }
    }else{
        $size = "medium";
        $width = 15;
        $height= 15;
        $numWords=7;
    }


    //guardamos todas las palabras del txt en un array
    $file = fopen("listaPalabras", "r");
    $diccionario = [];
    $contador=0;
    while(!feof($file)){
        array_push($diccionario, fgets($file));
        $diccionario[$contador]= trim($diccionario[$contador]);
        $contador++;
    }
    fclose($file);

    //seleccionamos las palabras que usaremos en la sopa de letras segun el tamaño seleccionado
    $word = [];
    $contador=0;
    while ($contador<$numWords) {
        $numAleatorio = rand(0,count($diccionario)-2);
        if (!in_array($diccionario[$numAleatorio], $word)) {
            array_push($word, $diccionario[$numAleatorio]);
            $contador++;
        }
    }

    //juntamos todos los datos necesarion en un array
    $datos = array(
        width => $width,
        height => $height,
        name => $nickName,
        numWords => $numWords
    );

    //creamos un tablero con un . en cada casilla
    function crearArrayTabla(){
        global $tabla, $datos;
        for ($row = 0; $row < $datos["height"]; $row++){
            for ($col = 0; $col < $datos["width"]; $col++){
              $tabla[$row][$col] = ".";
            }
          } 
    }

    //creamos la cuadricula con los datos que contega el array "board" y la guardamos en una variable
    function crearTabla($tabla){
        global $datos;
        $sopaDeLetras = "";
        $sopaDeLetras .= "<table border = 0>\n";
        for ($row = 0; $row < $datos["height"]; $row++){
          $sopaDeLetras .= "<tr>\n";
          for ($col = 0; $col < $datos["width"]; $col++){
            $sopaDeLetras .= " <td width = 15>{$tabla[$row][$col]}</td>\n";
          }
          $sopaDeLetras .= "</tr>\n";
        }
        $sopaDeLetras .= "</table>\n";
        return $sopaDeLetras;
    }

    function printSopaDeLetras(){
      
        global $sopaDeLetras, $word, $datos;
        //print puzzle itself
      
        print <<<HERE
        <center>
        <h1>{$datos["name"]}</h1>
        $sopaDeLetras
        <h3>Word List</h3>
        <table border = 0>
      
      HERE;
      
        //print word list
        foreach ($word as $theWord){
          print "<tr><td>$theWord</td></tr>\n";
        } // end foreach
        print "</table>\n";
        //$puzzleName = $boardData["name"];

      
      } // end printPuzzle

      crearArrayTabla();
      $sopaDeLetras = crearTabla($tabla);
      printSopaDeLetras();


?>