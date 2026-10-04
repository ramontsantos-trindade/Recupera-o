<?php

$conexao = mysqli_connect(

"localhost",

"root",

"root",

"PatinhasDB"



);

if(!$conexao){

    die("Falha na conexão: " . mysqli_connect_error());

}

mysqli_set_charset($conexao, "utf8");

?>