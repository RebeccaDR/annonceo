<?php

$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$pdo = new PDO('mysql:host=localhost;dbname=annonceo', 'root', '', $options);

// We require all the model functions for later
require('./model/membres.php');
require('./model/categories.php');
require('./model/annonces.php');
require('./model/security.php');
require('./model/commentaires.php');
require('./model/notes.php');
