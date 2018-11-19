<?php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$idChampionship = $view->getVariable("idChampionship");
$categories = $view->getVariable("categories");
$view->setVariable("title", i18n("Select categories"));
?>

<h3><?= i18n("Select categories")?></h3>
<br>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-6 col-xs-12">
			<form
				action="index.php?controller=championship&amp;action=addCategories&amp;idChampionship=<?=$idChampionship?>"
				method="POST">
			<?php foreach ($categories as $category) :?>
			<div class="custom-control custom-checkbox">
					<input type="checkbox" class="form-check-input"
						id="ckbox-<?= $category->getId(); ?>" name="checklist"
						value="<?= $category->getId(); ?>"> <label
						class="form-check-label" for="ckbox-<?= $category->getId(); ?>"><?= $category->getNivel()." - ".$category->getSexo(); ?></label>
				</div>
			<?php endforeach;?>
			<br>
				<button type="submit" class="btn btn-primary" value=""><?= i18n("Add categories")?></button>
			</form>

		</div>
	</div>
</div>