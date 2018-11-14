<?php
//file: view/reservation/add.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$reservations = $view->getVariable("reservations");
$view->setVariable("title", "Reservar pista");
$hours = array ("10:00", "11:30", "13:00", "14:30", "16:00", "17:30", "19:00", "20:30");
$buttonColour = array("btn-success","btn-success","btn-success", "btn-success", "btn-warning", "btn-secondary");



function getNumReservations($date, $hour, $reservations){
  $toret = 0;
  foreach ($reservations as $reservation) {
    if($reservation["fecha"] == date("Y-m-d", $date) && substr($reservation["hora"],0,5) == $hour)
      return $reservation["numReservas"];
  }
  return $toret;
}

?>

<h2><?= i18n("Select schedule"); ?> </h2>
<p>
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-sm-12 " >

      </div>
      <div class="col-md-2 col sm-3 " >
        <button type="button" class="btn btn-success btn-xs" disabled>
          Libre 
        </button>
      </div>
      <div class="col-md-3 col-sm-5" >
        <button type="button" class="btn btn-warning btn-xs" disabled>
          Ultima pista 
        </button>
      </div>
      <div class="col-md-2 col-sm-3" >
        <button type="button" class="btn btn-secondary btn-xs" disabled>
          Ocupado 
        </button>
      </div>
    </div>

  </div>

  <br><br>


  <form action="index.php?controller=reservation&amp;action=add" method="POST">
    <div class="container">
      <?php    $date = time();
      for ($i = 0; $i < 7; $i++) { ?>
        <div class="row">
          <div class="col-xl-12">
            <?php echo "<br><h3>". date('d-m-Y', $date). "</h3>";
            ?>
          </div>
        </div>
        <div class="row">
          <?php foreach ($hours as $hour) { 
            $numReservas = getNumReservations($date, $hour, $reservations);
            ?>
            <div class="col-sm-3 col-6" >
              <div class="container">
                <div class="row">
                  <div class="col-xl-10">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-10">

                    <button type="submit"
                    name="scheduleButton"
                    value="<?php echo date('d-m-Y', $date)."#".$hour?>"
                    class="btn <?php echo $buttonColour[$numReservas] ?> btn-xs"
                    <?php if($numReservas>=5) echo "disabled" ?>> 
                    <?php echo $hour?> 
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php }?>
      </div> 
      <?php $date = strtotime('tomorrow', $date); }?>
    </div>
  </form>


