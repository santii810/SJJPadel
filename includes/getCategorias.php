<?php
@session_start();

require_once ("../model/ChampionshipMapper.php");
require_once ("../model/Category.php");

$mensaje = '';

if ($_SESSION["__currentlang__"] == "es") {
    $mensaje = "Selecciona Categoria";
} else {
    $mensaje = "Select Category";
}

$idCampeonato = $_REQUEST['idCampeonato'];

$championshipMapper = new ChampionshipMapper();

$categories = $championshipMapper->getCategorias($idCampeonato);

$html = "";

$html .= "<option value=''>" . $mensaje . "</option>";

foreach ($categories as $category) {
    $html .= "<option value='" . $category->getId() . "'>" . $category->getNivel() . "-" . $category->getSexo() . "</option>";
}

echo $html;
?>