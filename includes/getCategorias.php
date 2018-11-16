<?php
	require_once("../model/ChampionshipMapper.php");
	require_once("../model/Category.php");

	$idCampeonato = $_REQUEST['idCampeonato'];

	$championshipMapper = new ChampionshipMapper();

	$categories = $championshipMapper->getCategorias($idCampeonato);
	
	$html="";

	$html.= "<option value=''>Selecciona Categoria</option>";

	foreach($categories as $category)
	{
		$html.= "<option value='".$category->getId()."'>".$category->getNivel()."-".$category->getSexo()."</option>";
	}
	
	echo $html;
?>