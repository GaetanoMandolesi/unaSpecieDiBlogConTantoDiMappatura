<!DOCTYPE html>
<html>
<head>
<?php
include_once('Connections/connHelp.php'); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="generator" content="AlterVista - Editor HTML"/>
  <title></title>
<?php include 'mieiJs/menu1.php'; ?>
<?php include 'mieiJs/bgc.php'; ?>
</head>
<body bgcolor="<?php echo $colorB ?>"><script> document.getElementById("av_toolbar_regdiv").innerHTML = ""; </script>
<?php 
$ve = $_REQUEST['user_file'] ;
$vei =  substr($ve,0) ;
?>
<?php
$data0 = date('d-m-Y g:i.s A');
//$data0 = date('d-m-Y.H:i:s');	
  #  $data = "<br/>In data: " . date('d-m-Y g:i.s A');
  #	 $Pb = " - $data\").addTo(map);";
  // $data prelevato da db
// $data = "2012-05-31 15:36:21";

  
  

       if ( $_REQUEST['luogo'] =="" ||$_REQUEST['descrizione'] ==""  || $_REQUEST['latitudine']=="")
   
{echo"Attenzione, i campi sono incompleti o non sono compilati correttamente!<div style='margin:15; '><a align='left' href='javascript:history.go(-1)'>Go Back</a></div>";exit();} 


    
    	$connhelp	or die ("Impossibile connettersi al server $host");
    	mysql_select_db($DB, $connhelp)
			or die ("Impossibile connettersi al database $DB");

	
     $query = "INSERT INTO HelpTo ( data, luogo , descrizione ,  longitudine, latitudine, e_mail, settore_interesse, foto) VALUES ('".$data0."','".addslashes($_REQUEST['luogo'])."','".addslashes($_REQUEST['descrizione'])."','".$_REQUEST['longitudine']."','".$_REQUEST['latitudine']."','".$_REQUEST['e_mail']."','".$_REQUEST['settore_interesse']."','". $_REQUEST['foto'] ."')";
    
    if (!mysql_query($query, $connhelp))
    {
    print("Attenzione, impossibile inserire il record");
    }
    else
    {
    print("Il record &egrave; stato inserito correttamente <div style='margin:15; '><a align='left' href='index.php'>Vedi</a></div>");
    }
?>


<?php
define("UPLOAD_DIR", "./img/");

if(isset($_POST['action']) and $_POST['action'] == 'upload')
{
    if(isset($_FILES['user_file']))
    {
        $file = $_FILES['user_file'];
        if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name']))
        {
            move_uploaded_file($file['tmp_name'], UPLOAD_DIR.$file['name']);
        }
    }
}
?>

<?php mysql_close($connhelp); ?>
</body>
</html>