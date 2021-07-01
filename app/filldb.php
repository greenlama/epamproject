<?php
// $start_time = microtime(true);
//include 'releaseyears.php';

$servname = "127.0.0.1:3306";
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
//$yearstable = "release_years";
$table = "pink_floyd";
$columns = "kind, collectionName, trackName, collectionPrice, trackPrice, primaryGenreName, trackCount, trackNumber, releaseDate";
//$albumcolumn = "collectionId";
//$releasecolumn = "releaseDate";
$lookupurl = 'https://itunes.apple.com/lookup?id=487143&entity=album&limit=200';
$lookupjson = file_get_contents($lookupurl);
$lookupdata = json_decode($lookupjson);

$conn = new mysqli($servname, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->query("TRUNCATE TABLE $database.$table;");

//$albumsquery = "SELECT DISTINCT $albumcolumn, $releasecolumn FROM $database.$yearstable ORDER BY $releasecolumn DESC;";
//$readdata = $conn->query($albumsquery);
//if ($readdata->num_rows > 0) {
echo "<table border='0' cellspacing='5' cellpadding='2'><tr><th>Reloading DB</th></tr>";
foreach ($lookupdata->results as $albumrow){
    //while($row = $readdata->fetch_assoc()) {
        $albumid = $albumrow->collectionId;
        //$albumid = $row["collectionId"];
        $albumlookupurl = "https://itunes.apple.com/lookup?id=$albumid&entity=song&limit=200";
        $json = file_get_contents($albumlookupurl);
        $data = json_decode($json);
        foreach ($data->results as $row){
            $date = new DateTime($row->releaseDate);
            $dateofrelease = date_format($date, 'Y');
            $nameofcollection = addslashes("$row->collectionName");
            $nameoftrack = addslashes("$row->trackName");
            $values = "'$row->kind', '$nameofcollection', '$nameoftrack', '$row->collectionPrice', $row->trackPrice, '$row->primaryGenreName', $row->trackCount, $row->trackNumber, '$dateofrelease'";
            $sql = "INSERT INTO $table ($columns) VALUES ($values);";
            $conn->query($sql);
        }
    //}
    echo "</table>";
}
// } else {
//     echo "0 results";
//}

$conn->close();

// $end_time = microtime(true);
// $execution_time = ($end_time - $start_time);
// echo "Done! Execution time of script = ".$execution_time." sec";

?>
