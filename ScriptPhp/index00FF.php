<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
include_once('Connections/correggiErrore.php');
include_once('Connections/connHelp.php'); 
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
if (isset($_GET['cercato'])) {
  $colname_Recordset1 = $_GET['cercato'];
}
mysql_select_db($database_connCap, $connCap);
$query_Recordset1 = sprintf("SELECT * FROM HelpTo WHERE `data` = %s", GetSQLValueString($colname_Recordset1, "date"));
$Recordset1 = mysql_query($query_Recordset1, $connCap) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<title>Esito Richiesta</title>
 <style type="text/css">
 .cr{color:#FFF;}
 .cf{width:50%;  }
 </style>


</head>
<body  bgcolor="#F5F5DC"><script> document.getElementById("av_toolbar_regdiv").innerHTML = ""; </script>
<a align='left' href='javascript:history.go(-1)'>Go Back</a>
<hr/ size=4 color="#858585"> 
<h4 align="center"> Di seguito, gli esiti della tua ricerca: <?php echo "[". $_GET['cercato']."]" ?></h4>
<hr/ size=4 color="#3377FF">
<div  style="margin:0 auto; width:90%; background-color:#E0F0DC; padding:4px;">
  <table width="100%" border="1">
  <tr>
    <th width="30%" scope="col">Data</th>    
    <th  width="70%" scope="col">Luogo</th>
    <th  width="70%" scope="col">Foto</th>
  </tr>
  <?php do { ?>
      
      <tr>
      <td><?php echo $row_Recordset1['data']; ?></td>      
      <td><?php echo $row_Recordset1['luogo']; ?>
<?php  echo ('<br/>Coordinate: ' . $row_Recordset1['latitudine'] . "," . $row_Recordset1['longitudine']);  ?>

</td>
      <td rowspan="2" width="20%">
      <?php
      if($row_Recordset1['foto'] == ""){
      echo ("Questa Nota è priva di immagine...!!!");	   
      }else{
      echo ("<img src='img/" . $row_Recordset1['foto']. "' width='200px' />");	         
      }
      ?>
      </td>
      
    </tr>
    <tr>
        <td colspan="2"><?php
     $testo = $row_Recordset1['descrizione'];
      // converto gli 'a capo' con dei < br >
     $testo = nl2br($testo);
     echo ($testo);
 ?></td>
      </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>

</div>
<hr/>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
