import User from "./user.js";

window.addEventListener("DOMContentLoaded", function(){
   let form = document.getElementById("user-form");

   form.addEventListener("submit", function(event){

       let user = new User();

       user.username = document.getElementById("username").value;
       user.email = document.getElementById("email").value;
       user.password = document.getElementById("password").value;
       user.confirmPassword = document.getElementById("confirm-password").value;

       if (!user.validate()) 
       {
            event.preventDefault();
            alert('Erreur :(');
      } 
      else 
      {
         alert('Tout est OK :)');
      }
   });

});