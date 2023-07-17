<form class="w-50 mb-5" action="" method="post">

<?php echo (isset($deleteSwitch) && $deleteSwitch) 
        ? "<div class=\"alert alert-danger\"><p>Delete Animal with ID: <strong>$animalId</strong></p>" 
        : (isset($animalId) 
            ? "<div class=\"alert alert-warning\"><p>Editing Animal with ID: <strong>$animalId</strong></p></div>" 
            : ""); ?>

    <div class="mb-3">
        <label class="form-label" for="name">Name:</label>
        <?php echo (isset($deleteSwitch) && $deleteSwitch) 
                ? $animalName 
                : buildNameInput($animalName); 
        ?>
    </div>

    <div class="mb-3">
        <label class="form-label" for="animal-type">Animal Type:</label>
        <?php echo (isset($deleteSwitch) && $deleteSwitch) 
                ? $animalType 
                : buildAnimalTypeSelect($animalType); 
        ?>
    </div>

    <div class="mb-3">
        <label class="form-label" for="adoption-fee">Adoption Fee<?php echo (isset($deleteSwitch) && $deleteSwitch) ? "" : " ($)"; ?>:</label>
        <?php echo (isset($deleteSwitch) && $deleteSwitch) 
                ? "$".$adoptionFee 
                : buildAdoptionFeeInput($adoptionFee); 
        ?>
    </div>

    <div class="mb-3">
        <label class="form-label" for="sex">Sex:</label>
        <?php echo (isset($deleteSwitch) && $deleteSwitch) 
                ? $sex 
                : buildSexSelect($sex); 
        ?>
    </div>

    <div class="mb-3">
        <label class="form-label" for="desexed">Desexed?</label>
        <?php echo (isset($deleteSwitch) && $deleteSwitch) 
                ? $desexed 
                : buildDesexedSelect($desexed); 
        ?>
    </div>

    <?php echo (isset($deleteSwitch) && $deleteSwitch) ? "</div>" : ""; ?>

    <div class="d-flex justify-content-end">
        <input class="btn <?php echo (isset($deleteSwitch) && $deleteSwitch) ? "btn-outline-danger" : (isset($animalId) ? "btn-outline-warning": "btn-outline-primary"); ?>" type="submit" name="submit" value="Cancel">
        <input class="ms-2 btn <?php echo (isset($deleteSwitch) && $deleteSwitch) ? "btn-danger" : (isset($animalId) ? "btn-warning": "btn-primary"); ?>" type="submit" name="submit" value="<?php echo (isset($deleteSwitch) && $deleteSwitch) ? "Delete" : (isset($animalId) ? "Update": "Add"); ?>">
    </div>
</form>


<?php

    function buildNameInput($animalName = null) {

        if (isset($animalName)) {
            return "<input class=\"form-control\" type=\"text\" name=\"animal-name\" value=\"$animalName\">";
        }
        else {
            return "<input class=\"form-control\" type=\"text\" name=\"animal-name\" value=\"\">";
        }

    }

    function buildAnimalTypeSelect($animalType = null) {

        if (isset($animalType)) {
            $select =  "<select class=\"form-select\" name=\"animal-type\">";

            if ($animalType == "Dog") {
                $select = $select."<option value=\"Dog\" selected>Dog</option>";
            }
            else {
                $select = $select."<option value=\"Dog\">Dog</option>";
            } 
            
            if ($animalType == "Cat") {
                $select = $select."<option value=\"Cat\" selected>Cat</option>";
            }
            else {
                $select = $select."<option value=\"Cat\" >Cat</option>";
            }
            
            if ($animalType == "Bird") {
                $select = $select."<option value=\"Bird\" selected>Bird</option>";
            }
            else {
                $select = $select."<option value=\"Bird\" >Bird</option>";
            }
             
            $select = $select."</select>";

            return $select;
        }
        else {
            return "<select class=\"form-select\" name=\"animal-type\">
                        <option value=\"\" default hidden>select type</option>
                        <option value=\"Dog\">Dog</option>
                        <option value=\"Cat\">Cat</option>
                        <option value=\"Bird\">Bird</option>
                    </select>";
        }
    }

    function buildAdoptionFeeInput($adoptionFee = null) {

        if (isset($adoptionFee)) {
            return "<input class=\"form-control\" type=\"text\" name=\"adoption-fee\" value=\"$adoptionFee\">";
        }
        else {
            return "<input class=\"form-control\" type=\"text\" name=\"adoption-fee\" value=\"\">";
        }
    }

    function buildSexSelect($sex = null) {
        if (isset($sex)) {
            $select =  "<select class=\"form-select\" name=\"sex\">";

            if ($sex == "Male") {
                $select = $select."<option value=\"Male\" selected>Male</option>";
            }
            else {
                $select = $select."<option value=\"Male\">Male</option>";
            } 
            
            if ($sex == "Female") {
                $select = $select."<option value=\"Female\" selected>Female</option>";
            }
            else {
                $select = $select."<option value=\"Female\">Female</option>";
            } 
             
            $select = $select."</select>";

            return $select;
        }
        else {
            return "<select class=\"form-select\" name=\"sex\">
                        <option value=\"\" default hidden>select sex</option>
                        <option value=\"Male\">Male</option>
                        <option value=\"Female\">Female</option>
                    </select>";
        }
    }

    function buildDesexedSelect($desexed = null) {
        if (isset($desexed)) {
            $select =  "<select class=\"form-select\" name=\"desexed\">";

            if ($desexed == 1) {
                $select = $select."<option value=\"1\" selected>Yes</option>";
            }
            else {
                $select = $select."<option value=\"1\">Yes</option>";
            } 
            
            if ($desexed == 0) {
                $select = $select."<option value=\"0\" selected>No</option>";
            }
            else {
                $select = $select."<option value=\"0\" >No</option>";
            } 
             
            $select = $select."</select>";

            return $select;
        }
        else {
            return "<select class=\"form-select\" name=\"desexed\">
                        <option value=\"\" default hidden>select status</option>
                        <option value=\"1\">Yes</option>
                        <option value=\"0\">No</option>
                    </select>";
        }
    }

?>