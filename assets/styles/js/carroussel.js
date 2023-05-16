// Attente que la page soit entièrement chargée avant d'exécuter le code
window.addEventListener("DOMContentLoaded", function(){

// Définition d'un tableau d'URL d'images
let img = [
"/Res03ProjetFinalV2/assets/styles/images/carrousel-1.png",
"/Res03ProjetFinalV2/assets/styles/images/carrousel-2.png",
"/Res03ProjetFinalV2/assets/styles/images/carrousel-3.png"
];

// Initialisation de l'index à 0
let index = 0;


// Exécution d'une fonction toutes les 2 secondes
setInterval(function(){
      // Récupération de l'élément HTML avec l'ID "carrou"
	let section = document.getElementById("carrou");
	    // Modification du style d'arrière-plan pour afficher l'image 
	    //correspondant à l'index actuel dans le tableau "img"
  section.style.backgroundImage = `url(${img[index]})`;

  
  if(index < 2)
  {
        // Si l'index est inférieur à 2, on l'incrémente de 1
  	index++;
  }
  else
  {
        // Si l'index est égal à 2 (le dernier index dans le tableau), on le réinitialise à 0
  	index = 0;
  }
  
}, 2000);

});


