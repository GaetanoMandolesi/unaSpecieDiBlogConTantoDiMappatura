<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
include_once('Connections/correggiErrore.php');
include_once('Connections/connHelp.php'); 
 ?>
<?php
if ($_REQUEST['cercato'] == "")
   
{echo"Attenzione, i campi sono incompleti o non sono compilati correttamente!<div style='margin:15; '></div><a align='left' href='javascript:history.go(-1)'>Go Back</a>";exit();}  

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
if (isset($_POST['cercato'])) {
  	$colname_Recordset1 = $_POST['cercato'];
}
	$line = $colname_Recordset1;
  	$words = explode(" ", $line);   	
	$colname_Recordset1 = implode("%",$words);
$conca = "CONCAT(luogo, descrizione, settore_interesse, luogo, descrizione, descrizione )"; 
mysql_select_db($database_connCap, $connCap);
$query_Recordset1 = sprintf("SELECT * FROM HelpTo WHERE ". $conca." LIKE %s ORDER BY `data` DESC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $connCap) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>



<title>Esito Richiesta</title>
 <style type="text/css">
 .cr{color:#FFF;}
 .cf{width:50%;  }
 </style>

<?php include 'mieiJs/bgc.php'; ?>
</head>

<body  bgcolor="<?php echo $colorB ?>"><script> document.getElementById("av_toolbar_regdiv").innerHTML = ""; </script>
<a align='left' href='javascript:history.go(-1)'>Go Back</a>

<hr/ size=4 color="#858585"> 
<h4 align="center"> Di seguito, in ordine cronologico, gli esiti della tua ricerca: <?php echo "[". $_POST['cercato']."]" ?></h4>
<hr/ size=4 color="#3377FF">
 
  

<div  style="margin:0 auto; width:80%; background-color:#808080; padding:4px;">
  <table width="100%" border="1">
  <tr>
    <th width="30%" scope="col">Data</th>
    <th  width="70%" scope="col">Luogo</th>
  </tr>
<?php do { ?>
    <tr>
      <td><a href="index00FF.php?cercato=<?php echo $row_Recordset1['data']; ?>"><?php echo $row_Recordset1['data']; ?></a></td>
      <td><?php echo $row_Recordset1['luogo']; ?></td>
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
