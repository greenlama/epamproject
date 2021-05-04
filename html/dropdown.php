<?php

$servname = "localhost";
$user = "user";
$password = "Password1_";
$database = "itunes_database";
$table = "pink_floyd";

$conn = new mysqli($servname, $user, $password, $database);
$dropdownquery = "SELECT DISTINCT releaseDate FROM $database.$table ORDER BY releaseDate DESC;";
$readdata = $conn->query($dropdownquery);

echo "<form>"; 
echo "<select name='years' class='years'>";
echo "<option value='blank' disabled selected>", '---', "</option>";
echo "<option value='All'>", All, "</option>";
while($dropdownrow = $readdata->fetch_assoc()) {
    echo "<option value='" . $dropdownrow['releaseDate'] . "'>" . $dropdownrow['releaseDate'] . "</option>";
}
echo "</select>";
echo "</form>";

$conn->close();

?>