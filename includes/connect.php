<?php
    try {
        $conn = new PDO('mysql:host=localhost;dbname=B3W7O1', "root", "mysql");
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
?>