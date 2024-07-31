<?php
require_once("../config.php");

// Define the state ID you want to retrieve (in this case, 103)
$stateId = 103;

// Prepare and execute the SQL query to retrieve the state with the specified state ID
$query = mysqli_query($con, "SELECT * FROM state WHERE StCode = '$stateId'");

// Check if there is a state with the specified ID
if (mysqli_num_rows($query) > 0) {
    ?>
    <option value="">Select Area</option>
    <?php
    // Loop through the query results (there should be only one result) and populate the dropdown options
    while ($row = mysqli_fetch_array($query)) {
        ?>
        <option value="<?php echo $row["StCode"]; ?>"><?php echo $row["StateName"]; ?></option>
        <?php
    }
} else {
    // No state found with the specified state ID
    ?>
    <option value="">No state found with ID 103</option>
    <?php
}
?>
