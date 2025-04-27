<!DOCTYPE HTML>
<?php 
include_once('Connections/connHelp.php');


session_start();

if (!isset($_SESSION['username'])) {
    header('Location:http://www.google.com');
    exit;
} 
?>
<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_REQUEST['cercato'])) {
  $colname_Recordset1 = substr($_REQUEST['cercato'],0,10).'%';
}
mysql_select_db($database_connCap, $connCap);
$query_Recordset1 = sprintf("SELECT * FROM HelpTo WHERE `data` LIKE %s", GetSQLValueString($colname_Recordset1, "date"));
$Recordset1 = mysql_query($query_Recordset1, $connCap) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<html lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
 <link rel="icon" href="puntiMappa/puntiMappa.ico" />
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
 
 <style>
 html, body {
 height: 100%;
 padding: 0;
 margin: 0;
 overflow: hidden;
 }
 #map {
 /* configure the size of the map */
 width: 100%;
 height: 100%;
 }
 </style>
 </head>
 <body>
 <div id="map"></div>



<script>





var map = L.map('map').setView({lon: <?php echo $row_Recordset1['longitudine']; ?>, lat: <?php echo $row_Recordset1['latitudine']; ?>}, 15);




// add the OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 19,
attribution: '&copy; <a href=https://openstreetmap.org/copyright>OpenStreetMap contributors</a>'
}).addTo(map);
// show the scale bar on the lower left corner
L.control.scale().addTo(map);

 <?php do { ?>
<?php
     echo ('L.marker({lon:');
     echo $row_Recordset1['longitudine'];
     echo (', lat:')	;
     echo $row_Recordset1['latitudine'];
     echo ('}).bindPopup("');
//     echo ("<img src='img/" . $row_Recordset1['foto']. "' width='100%'/><br/>=====<br/>" . $row_Recordset1['descrizione']."<br/>In data: ".$row_Recordset1['data']);	 
      if($row_Recordset1['foto'] == ""){
      echo ("Questa Nota è priva di immagine...!!!<br/><br/>=====<br/>" . $row_Recordset1['descrizione']."<br/>In data: ".$row_Recordset1['data']);	   
      }else{
      echo ("<img src='img/" . $row_Recordset1['foto']. "' width='100%'/><br/>=====<br/>" . $row_Recordset1['descrizione']."<br/>In data: ".$row_Recordset1['data']);	         
      }

echo ('").addTo(map);'); 
?>
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

</script>

 </body>
</html>
 
<?php
mysql_free_result($Recordset1); 
?>
 