<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="generator" content="AlterVista - Editor HTML"/>
  <title></title>
  <?php //include 'mieiJs/menu1.php'; ?>
   <?php //include 'mieiJs/bgc.php'; ?>
</head>
<body bgcolor="<?php echo $colorB ?>"><script> document.getElementById("av_toolbar_regdiv").innerHTML = ""; </script>

<?php echo  strstr("document.all.user_file.value", 'WP_')?>
<div style="margin:0 auto; width:60%;">
<table>

<form method="post" action="upload.php" enctype="multipart/form-data" name="F">
<tr><td></td><td><input name="luogo" value="<?php echo $_REQUEST['luogo']?>"  type="hidden" placeholder="Campo obbligatorio"/></td></tr>
<tr><td></td><td><input name="descrizione" value="<?php echo $_REQUEST['descrizione'] ?>" type="hidden" placeholder="Campo obbligatorio" rows="5" cols="40"/></td></tr>
<tr>
  <td> 
  	<label>Carica il tuo file:</label></td>
  <td>
			<input type="file" name="user_file"  value="" size="32"   onBlur="document.all.foto.value=document.all.user_file.value.substring((document.all.user_file.value.lastIndexOf('\\') +1), document.all.user_file.value.length)" />
		    <input type="hidden" name="action" value="upload" />
  </td>
</tr>

<tr><td>Carica questa immagine:</td><td><input name="foto" type="#"  /></td></tr>

<tr><td></td><td><input name="latitudine" value="<?php echo $_REQUEST['latitudine']?>" type="hidden" placeholder="Campo obbligatorio" /></td></tr>
<tr><td></td><td><input name="longitudine" value="<?php echo $_REQUEST['longitudine']?>" type="hidden" placeholder="Campo obbligatorio"/></td></tr>
<tr><td>Clikka QUI per confermare la scelta; poi il tasto inserisci.....!!!</td><td><input name="e_mail" value="<?php  echo $_REQUEST['e_mail']?>" type="hidden" /></td></tr>
<tr><td></td><td><input name="settore_interesse" value="<?php echo $_REQUEST['settore_interesse']?>" type="hidden" /></td></tr>
<tr><td></td><td><input name="input" type="submit" value="Inserisci"  /></td></tr>


</form>

</table>
</div>

</body>
</html>
