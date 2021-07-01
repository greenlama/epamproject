<?php

$servname = "127.0.0.1:3306";
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$table = "pink_floyd";

$conn = new mysqli($servname, $user, $password, $database);
$dropdownquery = "SELECT DISTINCT releaseDate FROM $database.$table ORDER BY releaseDate DESC;";
$readdata = $conn->query($dropdownquery);

echo "<form>"; 
echo "<select name='years' class='years'>";
echo "<option value='blank' disabled selected>", '---', "</option>";
echo "<option value='All'>", 'All', "</option>";
while($dropdownrow = $readdata->fetch_assoc()) {
    echo "<option value='" . $dropdownrow['releaseDate'] . "'>" . $dropdownrow['releaseDate'] . "</option>";
}
echo "</select>";
echo "</form>";

$conn->close();

?>
