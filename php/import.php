<?php

define('LYCHEE', true);

header('content-type: text/plain');
// Include
require('check.php');

if($error=='') {
	if(!$database->query("SELECT `public` FROM `lychee_albums`;")) $database->query("ALTER TABLE  `lychee_albums` ADD  `public` TINYINT( 1 ) NOT NULL DEFAULT  '0'");
	if(!$database->query("SELECT `password` FROM `lychee_albums`;")) $database->query("ALTER TABLE  `lychee_albums` ADD  `password` VARCHAR( 100 ) NULL DEFAULT NULL");


    require_once 'functions.php';

    $albums = getAlbums(null);
    if (isset($albums['album']) && sizeof($albums['album'])) {

    foreach ($albums['album'] as $album) {
        $path = APP_PATH . "/uploads/import/" . $album["title"] . "/*";
        $files = glob($path);
        foreach ($files as $file) {
            /**
             * Imporst the file, and delete from the import folder. Also show some information.
             */
            $file = basename($file);
            $file = $album["title"] . '/' . $file;
            importPhoto($file, $album['id']);

            echo 'Imported :: ' . $file . PHP_EOL;
        }
    }


    }
} else {
}

?>