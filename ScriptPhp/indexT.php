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

if (isset($_GET['ID'])  != "") {
  $deleteSQL = sprintf("DELETE FROM HelpTo WHERE ID=%s",
                       GetSQLValueString($_GET['ID'], "int"));

 mysql_select_db($database_connCap, $connCap);
 $Result1 = mysql_query($deleteSQL, $connCap) or die(mysql_error());

  $deleteGoTo = "indexT.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
//    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_POST['impegno'])) {
  $colname_Recordset1 = $_POST['impegno'];
}
mysql_select_db($database_connCap, $connCap);
$query_Recordset1 = "SELECT * FROM HelpTo  ORDER BY ID  DESC limit 15 ";
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
<?php include 'mieiJs/menu1.php'; ?>
<?php include 'mieiJs/bgc.php'; ?>
</head>

<body  bgcolor="<?php echo $colorB ?>"><script> document.getElementById("av_toolbar_regdiv").innerHTML = ""; </script>
  
  

<div  style="margin:0 auto; width:90%; background-color:#ccff00; padding:4px;">
 <?php do { ?>
 <div style="text-align:right;">
  
<?php $source = $row_Recordset1['data']; ?>
<?php $date = new DateTime($source);?>
<b><?php echo $date->format('d-M-Y');?></b><br/>
<b><?php echo $row_Recordset1['luogo']; ?></b>

<hr/ width="20%" align="right">
</div>
<div><div><?php  if($row_Recordset1['foto'] == ""){echo ("Questa Nota è priva di immagine...!!!");}else{ echo ("<img src='img/" . $row_Recordset1['foto']. "' width='50%' />"); } ?>
 </div></div><hr/ width="60%" align="left">
<div><?php
     $testo = ("<b><u>Descrizione:</u> </b>" . $row_Recordset1['descrizione']);
      // converto gli 'a capo' con dei < br >
     $testo = nl2br($testo);
     echo ($testo);
 ?>

</div>
<div style="width:50%; float:left;"><a href="indexT.php?ID=<?php echo $row_Recordset1['ID']; ?>" ><p>Elimina</p></a></div>
<div style="width:50%; float:right;text-align:right;"><a href="aggiorna.php?IDI=<?php echo $row_Recordset1['ID']; ?>" ><p>Aggiorna</p></a></div>
<hr/ size=4 color="#3377FF">

<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
