<?php

$servname = "192.168.16.1:3306";
$user = "user";
$password = "Password1_";
$database = "itunes_database";
$yearstable = "release_years";
$table = "pink_floyd";
$columns = "kind, collectionName, trackName, collectionPrice, trackPrice, primaryGenreName, trackCount, trackNumber, releaseDate";
$albumcolumn = "collectionId";
$releasecolumn = "releaseDate";

$conn = new mysqli($servname, $user, $password, $database);
$readquery = "SELECT $columns FROM $table ORDER BY trackPrice DESC";
$readdata = $conn->query($readquery);
if ($readdata->num_rows > 0) {
  echo "<table border='0' cellspacing='5' cellpadding='2'><tr><th>Тип</th><th>Альбом</th><th>Песня</th><th>Стоимость альбома</th><th>Стоимость песни</th>
        <th>Жанр</th><th>Количество песен</th><th>Номер песни</th><th>Дата релиза</th></tr>";
  while($row = $readdata->fetch_assoc()) {
            $albumprice = $row['collectionPrice'];
            if ($albumprice == -1.00) {$albumprice = '';}
            $songprice = $row['trackPrice'];
            if ($songprice == -1.00) {$songprice = '';}
            echo "<tr><td>".$row["kind"]."</td><td>".$row["collectionName"]."</td><td>".$row["trackName"]."</td><td>",$albumprice,"</td>
            <td>",$songprice,"</td><td>".$row["primaryGenreName"]."</td><td>".$row["trackCount"]."</td>
            <td>".$row["trackNumber"]."</td><td>".$row["releaseDate"]."</td></tr>";
  }
  echo "</table>";
} else {
    echo "0 results";
}
$conn->close();

?>