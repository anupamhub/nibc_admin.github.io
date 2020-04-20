<?php
require_once "../config.php";
if (! empty($_POST["country_id"])) {
    
    $countryId = $_POST["country_id"];
    
  
$state = $conn->query("SELECT * FROM states where country_id = '$countryId'"); ?>
<option>Select State</option>
<?php
while($st = $state->fetch_array()) {	?>
<option dataState="<?php echo $st["id"]; ?>" value="<?php echo $st["name"]; ?>"><?php echo $st["name"]; ?></option>
<?php
    }
}
?>