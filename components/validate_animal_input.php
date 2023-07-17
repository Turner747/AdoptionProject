<?php

    if (!isset($_POST['animal-name']) || empty($_POST['animal-name'])) {
        echo "<div class=\"alert alert-danger\">Error: Name not supplied.</div>";
        $db->close();
        exit;
    }

    if (!isset($_POST['animal-type']) || empty($_POST['animal-type'])) {
        echo "<div class=\"alert alert-danger\">Error: Animal type not supplied.</div>";
        $db->close();
        exit;
    }

    if ($_POST['animal-type'] != "Dog" && $_POST['animal-type'] != "Cat" 
        && $_POST['animal-type'] != "Bird" ) {
        echo "<div class=\"alert alert-danger\">Error: Animal type is invalid.</div>";
        $db->close();
        exit;
    }

    if (!isset($_POST['adoption-fee']) || empty($_POST['adoption-fee'])) {
        echo "<div class=\"alert alert-danger\">Error: Adoption fee not supplied.</div>";
        $db->close();
        exit;
    }

    if (!is_numeric($_POST['adoption-fee'])) {
        echo "<div class=\"alert alert-danger\">Error: Adoption fee is invalid, please enter numeric characters only.</div>";
        $db->close();
        exit;
    }

    if (!isset($_POST['sex']) || empty($_POST['sex'])) {
        echo "<div class=\"alert alert-danger\">Error: Animal sex not supplied.</div>";
        $db->close();
        exit;
    }

    if (!isset($_POST['desexed'])) {
        echo "<div class=\"alert alert-danger\">Error: Desexed status not supplied.</div>";
        $db->close();
        exit;
    }

    if (!is_numeric($_POST['desexed']) || $_POST['desexed'] < 0
        || $_POST['desexed'] > 1) {
        echo "<div class=\"alert alert-danger\">Error: Supplied desexed status is invalid.</div>";
        $db->close();
        exit;
    }

?>