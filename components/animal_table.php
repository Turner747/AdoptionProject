
<?php
    require('components/db_connection.php');

    $query = "SELECT DISTINCT animal_type FROM animal ORDER BY animal_type";
    $result = $db->query($query);
    $numResults = $result->num_rows;

    $validlogin = $_SESSION["isLoggedIn"];
?>
<div class="mb-4 w-50 d-inline-block float-end pt-3">
    <form class="my-auto" action="" method="GET">
        <div class="input-group">
            <label class="input-group-text">Filter by Animal Type: </label>
            <select class="form-select" name="animal-type">
                <option value="all" default>All</option>
                <?php
                    for($i = 0; $i < $numResults; $i++){
                        $row = $result->fetch_assoc();
                        $animalCategory = $row['animal_type'];
                        if (isset($_GET['animal-type']) && !empty(['animal-type'])) {
                            if ($_GET['animal-type'] == $row['animal_type']) {
                                $selected = "selected";
                            }
                            else {
                                $selected = "";
                            }
                        }
                        echo "<option value=\"$animalCategory\" $selected>$animalCategory</option>";
                    }
                    $result->free();
                ?>
            <input class="btn btn-outline-primary" type="submit" value="Search">
        </div>
    </form> 
</div>
 

<?php

    if (isset($_GET['animal-type']) && !empty(['animal-type'])) {
        if ($_GET['animal-type'] == "all") {
            $query = "SELECT * FROM animal ORDER BY name";
        }
        else {
            $animalType = $_GET['animal-type'];
            $query = "SELECT * FROM animal WHERE animal_type = '$animalType' ORDER BY name";
        }
    }
    else {
        $query = "SELECT * FROM animal ORDER BY name";
    }

    function createButtonColumn($hiddenName, $hiddenValue, $buttonText, $actionPage){

        if ($buttonText == "Edit") {
            $buttonClass = "btn btn-warning";
        }
        else if ( $buttonText == "Delete") {
            $buttonClass = "btn btn-danger";
        }
        else {
            $buttonClass = "btn btn-primary";
        }

        echo "<td>";
        echo "<form action=\"$actionPage\" method=\"GET\" >";
        echo "<input type=\"hidden\" name=\"$hiddenName\" value=\"$hiddenValue\" />";
        echo "<button class=\"$buttonClass\" type=\"submit\">$buttonText</button>";
        echo "</form>";
        echo "</td>";
    }

    function createTableContents($query) {
        require('components/db_connection.php');

        $result = $db->query($query);
        $numResults = $result->num_rows;

        for ($i = 0; $i < $numResults; $i++) {
            $row = $result->fetch_assoc();
            $animalId = $row['animalid'];
            $name = $row['name'];
            $animalType = $row['animal_type'];
            $adoptionFee = $row['adoption_fee'];
            $sex = $row['sex'];
            if ($row['desexed'] == 1){
                $desexed = "Yes";
            }
            else {
                $desexed = "No";
            }

            $validlogin = $_SESSION["isLoggedIn"];

            echo "<tr>";
            echo "<td class=\"align-middle\">$name</td>";
            echo "<td class=\"align-middle\">$animalType</td>";
            echo "<td class=\"align-middle\">$".number_format($adoptionFee,2)."</td>";
            echo "<td class=\"align-middle\">$sex</td>";
            echo "<td class=\"align-middle\">$desexed</td>";
            if (isset($validlogin)){
                if ($validlogin) {
                    createButtonColumn("animalid", $animalId, "Edit", "edit.php");
                    createButtonColumn("animalid", $animalId, "Delete", "delete.php");
                }
            }
            echo "</tr>";
        }
    }
?>

<table class="table table-striped mb-5">
    <thead>
        <tr class="table-dark">
            <th scope="col">Name</th>
            <th scope="col">Animal Type</th>
            <th scope="col">Adoption Fee</th>
            <th scope="col">Sex</th>
            <th scope="col">Desexed?</th>
            <?php echo (isset($validlogin) && $validlogin) ? "<th scope=\"col\"></th><th scope=\"col\"></th>": ""; ?>
        </tr>
    </thead>
    <tbody>
        <?php createTableContents($query); ?>
    </tbody>
</table>