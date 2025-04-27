<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
include_once('Connections/correggiErrore.php');
include_once('Connections/connHelp.php'); 

session_start();
$_SESSION['username'] = 'rs200';

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
$conca = "CONCAT(luogo, descrizione, settore_interesse, data, luogo, descrizione, descrizione )"; 
mysql_select_db($database_connCap, $connCap);
$query_Recordset1 = sprintf("SELECT * FROM HelpTo WHERE ". $conca." LIKE %s ORDER BY ID  DESC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
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
<h4 align="center"> Di seguito, in ordine cronologico, gli esiti della tua ricerca: <?php echo "[". $_POST['cercato']."]" ?></h4>
<hr/ size=4 color="#3377FF">
 
  

<div  style="margin:0 auto; width:90%; background-color:#F5F5DC; padding:4px;">
  <table width="100%" border="1">
    <tr>
      <th width="25%" scope="col">Data</th>
      <th  width="75%" scope="col">Luogo</th>
    </tr>
<?php do { ?>
    <tr>
      <td>
<div style="float:left;width:100%;">
      	<a href="index00FF.php?cercato=<?php echo $row_Recordset1['data']; ?>"><?php echo $row_Recordset1['data']; ?></a>
</div>
      </td>
      <td>
      	<div style="float:left;width:25%;vertical-align:middle;">
        	<a href="puntiMappaVediFiltro.php?cercato=<?php echo $row_Recordset1['luogo']; ?>">Tutti i PPunti di: <br/><?php echo $row_Recordset1['luogo']; ?></a>
        </div>
        <div style="float:left;width:25%;">
          <?php 
          $u = '?';
          $uu = '=';
          $dat= $row_Recordset1['data'];
          //$xx = str_replace(" ", '%2520',$dat);
          ?>
          <a href="<?php echo 'http://realizzare.altervista.org/2020HelpTo/puntiMappaVediFiltroData.php' , $u , 'cercato' , $uu,  $dat ;?>">Vedi Punto<img src="Connections/mark.png" width="12%"/></a>

<a href="puntiMappaVediFiltroTTPPG.php?cercato=<?php echo $row_Recordset1['data']; ?>">TTPPG-<?php echo substr($row_Recordset1['data'], 0, 10) ?></a>
        </div>




        <div style="float:right;width:50%;text-align:right;">
            <?php 
            $u = '%3F';
            $uu = '%3D'; 
            $dat= $row_Recordset1['data'];
            $xx = str_replace(" ", '%2520',$dat);
            ?>
            <a href="mailto: mandolesigaetano@gmail.com?subject=Segnalazione&body=<?php 
            echo 'http://realizzare.altervista.org/2020HelpTo/index00FF.php' , $u , 'cercato' , $uu,  $xx ;
            ?>">Invia descrizione<img src="Connections/mailto.jpg" width="7%"/></a>&nbsp;&nbsp;


            <?php 
            $u = '%3F';
            $uu = '%3D';
            $dat= $row_Recordset1['luogo'];
            $dat = str_replace(" ", '%2520',$dat);
            ?>

            <a href="mailto: mandolesigaetano@gmail.com?subject=Segnalazione&body=<?php 
            echo 'http://realizzare.altervista.org/2020HelpTo/puntiMappaVediFiltro.php' , $u , 'cercato' , $uu,  $dat ;
            ?>">Invia Punto<img src="Connections/multiMarks.png" width="7%"/></a>
        </div>

</td>
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
