<?php

require_once "../config.php";
if (! empty($_POST["state_id"])) {
    
    $stateId = $_POST["state_id"];
    
$cities = $conn->query("SELECT * FROM cities where state_id = '$stateId'"); ?>
<option>Select City</option>
<?php
while($city = $cities->fetch_array()) {	?>
<option dataCity="<?php echo $city["id"]; ?>" value="<?php echo $city["name"]; ?>"><?php echo $city["name"]; ?></option>
<?php
    }
}
?>