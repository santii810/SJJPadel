<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");

$category_wt_tournament = $view->getVariable("category_wt_tournament");
$view->setVariable("title", i18n("Confrontation Select") );

?>
