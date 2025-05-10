<?php

session_start();

$db=require_once '../config/database.php';
require_once  '../models/Piece.php';


$pieces = Piece::getAllPieces($pdo);

require_once '../views/html/piece.php';

?>