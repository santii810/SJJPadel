<?php
/**
* Vista showall (category)
*
* Vista que muestra una tabla con todas las categorias
* 
*
*/
require_once (__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$errors = $view->getVariable("errors");
$categories = $view->getVariable("categories");
$view->setVariable("title", i18n("Categories"));
$cabecera = array(
    "Level",
    "Sex"
);
?>

<h3><?= i18n("Categories"); ?></h3>

<a href="index.php?controller=category&amp;action=add"> <img
	src="images/addCategory.png" class="img-fluid" alt="Responsive image">
</a>

<table class="table">
	<thead class="thead-dark">
		<tr>
      <?php foreach($cabecera as $valor) { ?>
        <th scope="col">
          <?php echo i18n($valor); ?>
        </th>
      <?php } ?>
      <th scope="col" colspan="2">
        <?= i18n("Options"); ?>
      </th>
		</tr>
	</thead>
	<tbody>
      <?php foreach( $categories as $category ) { ?>
        <tr>
			<td>
              <?php echo $category->getNivel() ; ?>
            </td>
			<td>
              <?php echo $category->getSexo() ; ?>
            </td>
			<td><a
				href="index.php?controller=category&amp;action=edit&amp;id=<?php echo $category->getId() ?>">
					<img src="images/editShowall.png" class="img-fluid"
					alt="Responsive image">
			</a> <a
				href="index.php?controller=category&amp;action=delete&amp;id=<?php echo $category->getId() ?>">
					<img src="images/deleteShowall.png" class="img-fluid"
					alt="Responsive image">
			</a></td>
		
		
		<tr>  
      <?php } ?>
  
	
	</tbody>
</table>

