<?php
// file: view/users/register.php
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$category = $view->getVariable("category");
$view->setVariable("title", i18n("Add category"));
?>
<h3><?= i18n("Add category")?></h3>
<form action="index.php?controller=category&amp;action=add"
	method="POST">

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-6 col-xs-12">
				<div class="form-group">
    <?= isset($errors["category"])?i18n($errors["category"]):"" ?> <br />
					<label for="level"> <?= i18n("Level") ?> </label> <input
						type="text" class="form-control" id="level" name="level"
						aria-describedby="loginHelp"
						placeholder="<?= i18n("Enter level") ?>"
						value="<?= $category->getNivel() ?>">
    <?= isset($errors["nivel"])?i18n($errors["nivel"]):"" ?><br>
				</div>

				<div class="form-group">
					<label for="sex" size="1"> <?= i18n("Sex") ?> </label> <select
						class="form-control" id="sex" name="sex">
						<option selected="selected" value="mixto"><?php echo i18n("mixed") ?></option>
						<option value="masculino"><?php echo i18n("male") ?></option>
						<option value="femenino"><?php echo i18n("female") ?></option>
					</select>
				</div>

				<button type="submit" class="btn btn-primary"
					value="<?= i18n("Add category")?>"><?= i18n("Add category")?></button>
			</div>
		</div>
	</div>
</form>
