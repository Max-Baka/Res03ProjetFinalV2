export default class User {
    username;
    email;
    password;
    confirmPassword;

    constructor(username = "", email = "", password = "", confirmPassword = "") {
        
        this.username = username;
        this.email = email;
        this.password = password;
        this.confirmPassword = confirmPassword;
    }

    get username () {
      return this.username;
    }

    set username (username) {
        this.username = username;
    }

    get email () {
        return this.email;
    }

    set email (email) {
        this.email = email;
    }

    get password () {
        return this.password;
    }

    set password (password) {
        this.password = password;
    }

    get confirmPassword () {
        return this.confirmPassword;
    }

    set confirmPassword (confirmPassword) {
        this.confirmPassword = confirmPassword;
    }

    validate() {
        if(this.checkEqualPassword() === true &&
        this.checkUsername() === true &&
        this.checkEmail() === true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    checkEqualPassword() {
        if(this.password === this.confirmPassword)
       {
           return true; // vérifier que this.password est égal à this.confirmPassword
       }
        // optionnel si il y a des regles de password (longueur, minusculs / majuscules etc etc) vérifier ici
        else{
            return false;  // si c'est bon return true sinon return false
        }
    }
    checkUsername() {
        if(this.username.length <=255) // vérifier que this.username fait moins de 256 caractères
        {
            return true
        }                    // si c'est bon return true sinon return false
        else{
            return false
        }
       
    }

    checkEmail() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailRegex.test(this.email))
    {                                    // Vérification du format d'email en utilisant une expression régulière
        return true;
    } 
    else
    {
        return false;
    }

    }
}

