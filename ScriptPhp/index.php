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
if (isset($_POST['impegno'])) {
  $colname_Recordset1 = $_POST['impegno'];
}
mysql_select_db($database_connCap, $connCap);
$query_Recordset1 = sprintf("SELECT * FROM HelpTo   ORDER BY ID  DESC  LIMIT 7 ", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $connCap) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Esito Richiesta</title>
 <style type="text/css">
 .cr{color:#FFF;}
 .cf{width:50%;  }
 </style>

<?//php include 'mieiJs/bgc.php'; ?>
</head>

<body  bgcolor="<?php echo $colorB ?>"><script> document.getElementById("av_toolbar_regdiv").innerHTML = ""; </script>
  
<hr/ size=4 color="#3377FF"> 
<h4 align="center"> Di seguito, in ordine cronologico, dalla più recente, le ultime sette "segnalazioni". </h4>
<hr/ size=4 color="#3377FF">

<div  style="margin:0 auto; width:90%; background-color:#DDDDDD; padding:4px;">
 <?php do { ?>
 <div style="text-align:right;">
  
<?php $source = $row_Recordset1['data']; ?>
<?php $date = new DateTime($source);?>
<b><?php echo $date->format('d-M-Y');?></b><br/>
<b><?php echo $row_Recordset1['luogo']; ?></b>

<hr/ width="20%" align="right">
</div>
<div><?php  if($row_Recordset1['foto'] == ""){echo ("Questa Nota è priva di immagine...!!!");}else{ echo ("<img src='img/" . $row_Recordset1['foto']. "' width='50%' />"); } ?>
 </div><hr/ width="60%" align="left">
<div><?php
     $testo = $row_Recordset1['descrizione'];
      // converto gli 'a capo' con dei < br >
     $testo = nl2br($testo);
     echo ($testo);
     echo ('<hr/ width="60%" align="left">');
     echo ('Coordinate: ' . $row_Recordset1['latitudine'] . "," . $row_Recordset1['longitudine'] .  " &nbsp;<a href='https://www.google.it/maps/dir//".$row_Recordset1['latitudine'].",".$row_Recordset1['longitudine']."'><img src='Connections/googleMark0.png' width='5%'/></a>" . "&nbsp;<a href='https://www.openstreetmap.org/#map=18/".$row_Recordset1['latitudine']."/".$row_Recordset1['longitudine']."'><img src='Connections/mark.jpg' width='5%'/></a>");
     
     echo ('<hr/ width="60%" align="left">');
     echo ('Rilevato da: ' . $row_Recordset1['e_mail'] . "<br/>Settore da attivare: " . $row_Recordset1['settore_interesse']);
 ?>
<br/>

<?php 
$u = '%3F';
$uu = '%3D';
$dat= $row_Recordset1['data'];
$xx = str_replace(" ", '%2520',$dat);
?>
<a href="mailto: mandolesigaetano@gmail.com?subject=Segnalazione&body=<?php 
echo 'http://realizzare.altervista.org/2020HelpTo/index00FF.php' , $u , 'cercato' , $uu,  $xx ;
?>">mailto</a>


</div><hr/ size=4 color="#3377FF">
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
