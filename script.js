setInterval(function () {
  // Envoyer une requête AJAX pour vérifier les mises à jour
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "accueil.php", true);
  xhr.send();
}, 5000);
