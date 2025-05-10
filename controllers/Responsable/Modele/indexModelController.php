<?php

require_once '../../../models/Modele.php';



$db = require_once '../../../config/database.php';

$modeles = Modele::index($db);

require_once '../../../views/html/dashboardresponsable/modele/indexmodele.php';
?>