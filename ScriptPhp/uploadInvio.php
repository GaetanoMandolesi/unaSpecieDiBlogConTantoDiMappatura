<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="generator" content="AlterVista - Editor HTML"/>
  <title></title>
   <?php include 'mieiJs/menu1.php'; ?>
   <?php include 'mieiJs/bgc.php'; ?>
</head>
<body bgcolor="<?php echo $colorB ?>"><script> document.getElementById("av_toolbar_regdiv").innerHTML = ""; </script>

<?php echo  strstr("document.all.user_file.value", 'WP_')?>
<div style="margin:0 auto; width:60%;">
<table>

<form method="post" action="upload.php" enctype="multipart/form-data" name="F">
<tr><td>Luogo</td><td><input name="luogo" type="text" placeholder="Campo obbligatorio"/></td></tr>
<tr><td>Descrizione</td><td><input name="descrizione" type="text" placeholder="Campo obbligatorio" rows="5" cols="40"/></td></tr>
<tr>
  <td> 
  	<label>Carica il tuo file:</label></td>
  <td>
			<input type="file" name="user_file"  value="" size="32"   onBlur="document.all.foto.value=document.all.user_file.value.substring((document.all.user_file.value.lastIndexOf('\\') +1), document.all.user_file.value.length)" />
		    <input type="hidden" name="action" value="upload" />
  </td>
</tr>

<tr><td>Carica questa immagine:</td><td><input name="foto" type="#"  /></td></tr>

<tr><td>Latitudine:</td><td><input name="latitudine" type="text" placeholder="Campo obbligatorio" /></td></tr>
<tr><td>Longitudine:</td><td><input name="longitudine" type="text" placeholder="Campo obbligatorio"/></td></tr>
<tr><td>e-mail:</td><td><input name="e_mail" type="text" /></td></tr>
<tr><td>Settore d'interesse; scegli:</td><td>
	<select name="settore_interesse" id="settore">
      <option value="suggerimento">Seleziona:</option>
      <option value="Viabilità">Viabilità</option>
      <option value="Verde_pubblico">Verde pubblico</option>
      <option value="Sicurezza_ambientale">Sicurezza ambientale</option>
      <option value="Igiene_e_decoro">Igiene e decoro</option>
  	</select>
</td></tr>

<tr><td></td><td><input name="input" type="submit" value="Inserisci"  /></td></tr>


</form>

</table>
</div>
<p eight="150">&nbsp;</p>
<div style="margin: 0 auto; text-align:center;width: 60%;">
<div style="text-align:center;width:25%; float:left;"><a href="index.php">Guarda le ultime segnalazioni</a></div>
<div style="text-align:center;width:25%; float:left;"><a href="blogF.php">Effettua una Ricerca mirata</a></div>
<div style="text-align:center;width:25%; float:left;"><a href="indexT.php">Modifica</a></div>
<div style="text-align:center;width:25%; float:right;"><a href="puntiMappaVedi.php">Guarda sulla mappa</a></div>
</div>
</body>
</html>
