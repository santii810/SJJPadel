<?php
//file: view/posts/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$currentuser = $view->getVariable("currentusername");

$view->setVariable("title", "Posts");

?>
<img class="img-circle" src="images/silueta.jpg"></img>

