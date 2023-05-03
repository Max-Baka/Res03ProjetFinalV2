<?php  
 
class AuthController extends AbstractController {  
    
    private UserManager $um;
    
    public function __construct()  
    {  
        $this->um = new UserManager();
    }  
    /* Pour la page d'inscription */  
    public function register() : void  
    {  
      $this->render("register", []); // render la page avec le formulaire d'inscription  
    }  
      
    /* Pour vérifier l'inscription */  
    public function checkRegister($post) : void  
    {  
        if(isset($post["form-name"]) && $post["form-name"] === "registerForm" 
        && isset($post["username"])&&!empty($post["username"])
        && isset($post["password"])&&!empty($post["password"])
        && isset($post["email"])&&!empty($post["email"])
        && isset($post["confirm-password"])&&!empty($post["confirm-password"])
        &&($post["password"] === ($post["confirm-password"]))
        ){// vérifier que le formulaire a été soumis
        
        $username = $post['username'];
        $email = $post['email'];   // récupérer les champs du formulaire  
        $password = $post['password'];
        $role = "customer"; 
        $password_hash = password_hash($password, PASSWORD_DEFAULT);    // chiffrer le mot de passe    
        $exist = $this->um->getUserByEmail($post['email']);
        if($exist === null){
            
        $user = new User(null, $username, $email, $password_hash, $role);    // appeler le manager pour créer l'utilisateur en base de données   
        $this->um->createUser($user);
        header('Location: /Res03ProjetFinalV2/connexion');// le renvoyer vers l'accueil 
        }
        else{
        header('Location: /Res03ProjetFinalV2/connexion'); 
        }
    }  
    } 
    /* Pour la page de connexion */  
    public function login() : void  
    {  
      $this->render("login", []);  // render la page avec le formulaire de connexion  
    }  
      
    /* Pour vérifier la connexion */  
    public function checkLogin($post) : void  
    {  
       if(isset($post["formName"])
       
       &&isset($post["email"])&& !empty($post["email"])
       &&isset($post["password"])&& !empty($post["password"])
       ){ // vérifier que le formulaire a été soumis  
            $email = $post['email'];   // récupérer les champs du formulaire  
            $password = $post['password'];
            $user = $this->um->getUserByEmail($email); // si il existe, vérifier son mot de passe    

            if ($user)
            {
                if(password_verify($password, $user->getPassword())){
                    $_SESSION["user"] = $user->getUsername();  // utiliser le manager pour vérifier si un utilisateur avec cet email existe    
                    $_SESSION["role"] = $user->getRole();
                    
                    if($_SESSION["role"] === "admin"){
                        header('Location: /Res03ProjetFinalV2/admin-utilisateurs'); // si il est bon, connecter l'utilisateur  
                    }
                }
                else{
                    header('Location: /Res03ProjetFinalV2/connexion'); // si il n'est pas bon renvoyer sur la page de connexion 
                }    
            }
            else{
                header('Location: /Res03ProjetFinalV2/connexion'); // si il n'existe pas renvoyer vers la page de connexion
            }
            
                    
                      
                   
                
       }
    }
    
    public function logout(){

        session_destroy();


           header('Location:/Res03ProjetFinalV2/');
    }
}