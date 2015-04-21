<?php
    // $thread =  new Thread();
    
    $mysqli = new mysqli('gefest.faunusanalytics.com', 'gefest', 'dbpwdgefest', 'faunus');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }