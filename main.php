<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylse.css">
  <title>Document</title>
  <style>
  .palabra:focus{
    background:red;
  } 
  .showpalabra{
    background:red;
  }
  </style>
</head>
<body>
  
<?php

if(isset($_POST['nickName'])){
    $nickName= $_POST['nickName'];
}else{
    $nickName = "Player";
}

if(isset($_POST['columns'])){
  $width = $_POST['columns'];
}else{
  $width = 15;
}

if(isset($_POST['rows'])){
  $height = $_POST['rows'];
}else{
  $height = 15;
}

if(isset($_POST['words'])){
  $numWords = $_POST['words'];
}else{
  $numWords = 7;
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
        $sopaDeLetras .= " <td width = 50>{$tabla[$row][$col]}</td>\n";
      }
      $sopaDeLetras .= "</tr>\n";
    }
    $sopaDeLetras .= "</table>\n";
    return $sopaDeLetras;
}

function printSopaDeLetras(){
  
    global $sopaDeLetras, $word, $datos;
  
    print <<<HERE
    <center>
    <h1>{$datos["name"]}</h1>
    $sopaDeLetras
    <h3>Word List</h3>
    <table border = 0> 
    HERE;
    foreach ($word as $theWord){
      print "<tr><td>$theWord</td></tr>\n";
    }
    print "</table>\n";
  
}

function fillBoard(){
  
    global $word;
    $direccion = array("Horizontal", "Vertical");
    $tablaCompleta = TRUE;
    $contador = 0;
    $siguientePalabra = TRUE;
    while($siguientePalabra){
      $dir = rand(0, 1);
      $palabra = addWord($word[$contador], $direccion[$dir], $contador);
      if ($palabra == FALSE){
        $siguientePalabra = FALSE;
        $tablaCompleta = FALSE;
      } 
      $contador++;
      if ($contador >= count($word)){
        $siguientePalabra = FALSE;
      } 
    } 
    return $tablaCompleta;
  
} 

function addWord($theWord, $dir, $count){
    
  global $tabla, $datos;
  
  
  $theWord = rtrim($theWord);
  
  $tablaCompleta = TRUE;
  
  switch ($dir){
    case "Horizontal":
      $newCol = rand(0, $datos["width"] - 1 - strlen($theWord));
      $newRow = rand(0, $datos["height"]-1);
  
      for ($i = 0; $i < strlen($theWord); $i++){
        
        $boardLetter = $tabla[$newRow][$newCol + $i];
        $wordLetter = substr($theWord, $i, 1);
  
        //con este if controlamos que la letra de la palabra nueva que estamos asignando al tablero se ponga solo en espacios libres o si la letra que ya hay en ese espacio
        //es la misma que la que vamos asignar, es decir, que las palabras se pueden solapar si comparten alguna letra
        if (($boardLetter == $wordLetter) ||
            ($boardLetter == ".")){
          $tabla[$newRow][$newCol + $i] = '<button type="submit" class="palabra">'.$wordLetter.'</button>';
          //$tabla[$newRow][$newCol + $i] = '<button type="submit" class="showpalabra">'.$wordLetter.'</button>';
        } else {
          $tablaCompleta = FALSE;
        } 
      } 
      break;
  
    case "Vertical":
      $newCol = rand(0, $datos["width"] -1);
      $newRow = rand(0, $datos["height"]-1 - strlen($theWord));
      //print "south:\tRow: $newRow\tCol: $newCol<br>\n";
  
      for ($i = 0; $i < strlen($theWord); $i++){
        
        $boardLetter = $tabla[$newRow + $i][$newCol];
        $wordLetter = substr($theWord, $i, 1);

        //con este if controlamos que la letra de la palabra nueva que estamos asignando al tablero se ponga solo en espacios libres o si la letra que ya hay en ese espacio
        //es la misma que la que vamos asignar, es decir, que las palabras se pueden solapar si comparten alguna letra
        if (($boardLetter == $wordLetter) ||
            ($boardLetter == ".")){
          $tabla[$newRow + $i][$newCol] = '<button type="submit" class="palabra">'.$wordLetter.'</button>';
          //$tabla[$newRow + $i][$newCol] = '<button type="submit" class="showpalabra">'.$wordLetter.'</button>';
        } else {
         $tablaCompleta = FALSE;
        } 
        } 
        break;
  
    } 
    return $tablaCompleta;
  } 

  function rellenarTabla(){
    //añadimos letras random en los huecos que nos quedan
    global $tabla, $datos;
    for ($row = 0; $row < $datos["height"]; $row++){
      for ($col = 0; $col < $datos["width"]; $col++){
        if ($tabla[$row][$col] == "."){
          $newLetter = rand(65, 90);
          $tabla[$row][$col] = '<button type="submit" >'.chr($newLetter).'</button>';
        } 
      } 
    } 
  } 


$tablaCompleta = FALSE;

while ($tablaCompleta == FALSE){
    crearArrayTabla();
    
    $tablaCompleta = fillBoard();
} 
  rellenarTabla();
  $sopaDeLetras = crearTabla($tabla);
  printSopaDeLetras();


?>

</body>
</html>

