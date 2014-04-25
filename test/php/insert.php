<?php
header('Content-type: text/plain; charset=utf-8');

include ($_SERVER['DOCUMENT_ROOT'] . "/test/php/vars.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/test/php/func.php");

$textArea = $_POST['text'];
$langId = $_POST['lang'];
$countWords = 0;

$con=mysqli_connect("localhost",$MysqlUser,$MysqlUPass,$MysqlDB);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Mysql query to delete old data from UserNW table
$sqlDelete = "TRUNCATE TABLE $UserNW";
if (!mysqli_query($con,$sqlDelete)) {
  die('Error after Delete: ' . mysqli_error($con));
}

/* change character set to utf8 */
if (!mysqli_set_charset($con, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($con));
}

// Get data from html form textrArea field, remove all special characters
// and make an array ($words), convert all words to lowercase 
$textArea = mysqli_real_escape_string($con, $textArea);
$words = preg_split('/\P{L}+/u', $textArea, 0, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
$words = array_map('strtolower', $words);

// Delete all dublicate words in the array and sort in descending order
$words = array_count_values($words);
arsort($words);

echo "<br>"."Total: " . count($words) . " unique words;" ."<br>";

// Insert words in Mysql table and translate them
foreach($words as $word => $freq){
    // Inser words into Mysql table
    $sqlInsert = mysqli_query($con, "INSERT INTO $UserNW (freq, word) VALUES ('$freq', '$word')");
    
    // Get translation from Yandex Translate API
    $jsonurlTr = $trnsl_api."?key=".$trnsl_key."&lang=".$langId."&format=html&text=".$word;
    $jsonTr = json_decode(remote_get_contents($jsonurlTr), true);
    // Parse Yandex Translate API JSON string
    $dataTr = array();
    $nTr = 0;
    foreach($jsonTr["text"] as $keyTr=>$wordTr){
        $dataTr[$nTr] = $wordTr;
        $nTr++;
    }

    // Get translation from Yandex Dict API
    $jsonurlDict = $dict_api."?key=".$dict_key."&lang=".$langId."&format=html&text=".$word;
    $jsonDict = json_decode(remote_get_contents($jsonurlDict), true);
    // Parse Yandex Dict API JSON string
    $dataDict = array();
    $nDict = 0;
    foreach($jsonDict["def"] as $def){
        foreach($def["tr"] as $text){
            //$dataDict = array($text["text"]);
            $dataDict[$nDict] = $text["text"];
            $nDict++;
            foreach($text["syn"] as $syn){
                //$nDict++;
                $dataDict[$nDict] = $syn["text"];    
                $nDict++;
            }
        }
    }

    // Merge Translate and Dict arrays into third array 
    // and delete all dublicate values in the third array 
    $mergedTrDict = array_unique(array_merge($dataTr, $dataDict));

    //Implode the merged third array into string of values separated by coma   
    $strDict = implode(", ", $mergedTrDict); 
    //$strDict = iconv('ISO-8859-1', 'utf-8', $strDict1); 

    // Sql query to update translation for words
    $sqlUpdate = mysqli_query($con, "UPDATE $UserNW SET text='$strDict' WHERE word='$word' AND freq='$freq'");
    
}

// Mysql query to display the table content 
$sqlSelect = mysqli_query($con,"SELECT * FROM $UserNW");

// Display user dictinary in index.html via jQuery AJAX from dislaydict.js
echo "<br>";
echo "Dictionary: " . $langId . "<br>";
echo "<table border='1'>
<tr>
<th>freq</th>
<th>word</th>
<th>text</th>
</tr>";

while($row = mysqli_fetch_array($sqlSelect)) {
  echo "<tr>";
  echo "<td>" . $row['freq'] . "</td>";
  echo "<td>" . $row['word'] . "</td>";
  echo "<td>" . $row['text'] . "</td>";
  echo "</tr>";
}

echo "</table><br>";

/*$charset = mysqli_character_set_name($con);
printf ("Current Mysql charset - %s\n",$charset);
echo "<br>";
*/
mysqli_close($con);

?>

