window.addEventListener("DOMContentLoaded", function(){

let img = [
"/Res03ProjetFinalV2/assets/styles/images/carrousel-1.png",
"/Res03ProjetFinalV2/assets/styles/images/carrousel-2.png",
"/Res03ProjetFinalV2/assets/styles/images/carrousel-3.png"
];

let index = 0;

setInterval(function(){
	let section = document.getElementById("carrou");
  section.style.backgroundImage = `url(${img[index]})`;

  
  if(index < 2)
  {
  	index++;
  }
  else
  {
  	index = 0;
  }
  
}, 2000);

});


