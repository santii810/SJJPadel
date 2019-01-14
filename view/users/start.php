<?php
/**
* start (User)
*
* Vista que muestra una página de bienvenida al usuario 
* 
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Welcome");

?>
<img class="img-fluid" src="images/silueta.jpg"></img>
