<?php
/**
* Script php getGrupos
*
* Script que devuelve un seleccionable con los grupos del campeonato
* 
*
*/
require_once ("../model/ChampionshipMapper.php");
require_once ("../model/Group.php");

$idCampeonato = $_REQUEST['idCampeonato'];
$idCategoria = $_REQUEST['idCategoria'];

$championshipMapper = new ChampionshipMapper();

$groups = $championshipMapper->getGrupos($idCampeonato, $idCategoria);

$html = "";

foreach ($groups as $group) {
    $html .= "<option value='" . $group->getIdGroup() . "'>" . $group->getGroupName() . "</option>";
}

echo $html;
?>