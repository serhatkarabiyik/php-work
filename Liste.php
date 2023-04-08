<?php 
// Donne aussi accès à la variable $_SESSION
//require_once('Webpage.php');
//require_once('function.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style> 
      <?php include('style2.css');?>
    </style>
    <link rel="stylesheet" media="all" type="text/css"  href="style.css">
    <title>Acceuil</title>
</head>
<body>
  <main>
  <section class="d-flex justify">
    <h1>Quicklink</h1>
    <button class="boutton"><a class="lien" href="connexion.php">Connexion</a></button><!--Pour mettre la page de connexion-->
    
  </section>
   
    <table class="bord">
      <thead> 
        <tr>
          <th class="th">Site</th>
          <th class="th">URL</th>
        </tr>
       </thead>
       <tbody>
         <tr>
            <td class="td">google</td>
            <td class="td">https//google.com</td>
         </tr>
         <tr>
            <td class="td">google</td>
            <td class="td">https//google.com</td>
         </tr>
         <tr>
            <td class="td">google</td>
            <td class="td">https//google.com</td>
         </tr>
         <tr>
            <td class="td">google</td>
            <td class="td">https//google.com</td>
         </tr>
         <tr>
            <td class="td">google</td>
            <td class="td">https//google.com</td>
         </tr>
         <tr>
            <td class="td">google</td>
            <td class="td">https//google.com</td>
         </tr>
       </tbody> 
    </table>
  </main>
    
</body>
</html>