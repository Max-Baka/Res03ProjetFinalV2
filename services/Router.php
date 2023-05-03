<?php  
 /* Yep. */
class Router {  
    private ProductController $pc;
    private CategoryController $cc;
    private AuthController $auth; 
      private UserController $uc;
  
    public function __construct()  
        {  
            $this->pc = new ProductController();
            $this->cc = new CategoryController();
            $this->auth = new AuthController(); 
            $this->uc = new UserController();

        }
    private function splitRouteAndParameters(string $route) : array  
        {  
            $routeAndParams = [];  
            $routeAndParams["route"] = null;  
            $routeAndParams["categorySlug"] = null;  
            $routeAndParams["productSlug"] = null;
            $routeAndParams["contactName"] = null;
            
            
            if(strlen($route) > 0) 
            {  
                $tab = explode("/", $route);  

                if($tab[0] === "categories")  
                {  
                    
                    $routeAndParams["route"] = "categories";  
                    $routeAndParams["categorySlug"] = $tab[1];
                    
                }
                else if($tab[0] === "creer-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                }
                else if($tab[0] === "check-creer-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                }
                else if($tab[0] === "modifier-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["categorySlug"] = $tab[1];
                }
                else if($tab[0] === "check-modifier-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["categorySlug"] = $tab[1];
                }
               
                else if($tab[0] ===  "supprimer-categorie")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["route2"] = $tab[1];
                    
                }
                else if($tab[0] === "produits") 
                {  
                    
                    $routeAndParams["route"] = "products";
                    
                    if (isset($tab[1])){
                        
                    $routeAndParams["productSlug"] = $tab[1];
                   $this->pc->productDetails($tab[1]);
                    }
                    else{
                        $this->pc->productsList();
                    }
                }
                else if($tab[0] === "creer-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                }
                else if($tab[0] === "check-creer-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                }
                else if($tab[0] === "modifier-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["productSlug"] = $tab[1];
                }
                else if($tab[0] === "check-modifier-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["productSlug"] = $tab[1];
                }
                else if($tab[0] ===  "supprimer-produit")
                {
                    $routeAndParams["route"] = $tab[0];
                    $routeAndParams["productSlug"] = $tab[1];
                }
                else if($tab[0] === "creer-un-compte") 
                {  
                    
                    $routeAndParams["route"] = $tab[0];  
                }  
                else if($tab[0] === "check-creer-un-compte")
                {  
                
                    $routeAndParams["route"] = $tab[0];  
                }  
                else if($tab[0] === "connexion")  
                {  
                      
                    $routeAndParams["route"] = $tab[0];  
                }  
                else if($tab[0] === "check-connexion")   
                {  
                     
                    $routeAndParams["route"] = $tab[0];  
                }
                else if($tab[0] === "deconnexion")   
                {  
                      
                    $routeAndParams["route"] = $tab[0];  
                }
                else if($tab[0] === "admin-utilisateurs")   
                {  
                     
                    $routeAndParams["route"] = $tab[0];  
                }
                else if($tab[0] === "delete-utilisateur") 
                {  
                      
                    $routeAndParams["route"] = $tab[0]; 
                     $routeAndParams["route2"] = $tab[1]; 
                    
                }
                else if($tab[0] === "admin-produits")   
                {  
                    
                    $routeAndParams["route"] = $tab[0];  
                }
                else if($tab[0] === "admin-categories") 
                {  
                      
                    $routeAndParams["route"] = $tab[0];  
                }
                
            }
            
            else  
            {  
                $routeAndParams["route"] = "";  
            }  
          
            return $routeAndParams;  
        }
        public function checkRoute(string $route) : void  
    {  
        $routeTab = $this->splitRouteAndParameters($route);
    
        if($routeTab['route'] === "")  
        {  
           
            $this->cc->categoriesList();
        }
        else if($routeTab['route'] === "creer-categorie" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $post = $_POST;
            $this->cc->createCategory($post);
        }
        else if($routeTab['route'] === "check-creer-categorie" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $post = $_POST;
            $this->cc->checkCreateCategory($post);
        }
        else if($routeTab['route'] === "modifier-categorie" && $routeTab['categorySlug'] !== null && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->cc->editCategory($routeTab ['categorySlug']);
        }
        else if($routeTab['route'] === "check-modifier-categorie" && $routeTab['categorySlug'] !== null && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $post = $_POST;
            $this->cc->checkEditCategory($post, $routeTab['categorySlug']);
        }
        
        else if($routeTab['route'] === "supprimer-categorie"&& isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->cc->deleteCategory($routeTab['route2']);
        }
        else if($routeTab['route'] === "produits" && $routeTab['productSlug'] === null) // condition(s) pour envoyer vers la liste des produits  
        {  
            
            $this->pc->productsList();
        }  
        else if($routeTab['route'] === "creer-produit" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $post = $_POST;
            $this->pc->createProduct($post);
        }
        else if($routeTab['route'] === "check-creer-produit" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $post = $_POST;
            $this->pc->checkCreateProduct($post);
        }
        else if($routeTab['route'] === "modifier-produit" && $routeTab['productSlug'] !== null && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->pc->editProduct($routeTab['productSlug']);
        }
        else if($routeTab['route'] === "check-modifier-produit" && $routeTab['productSlug'] !== null && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $post = $_POST;
            $this->pc->checkEditProduct($post, $routeTab['productSlug']);
        }
        else if($routeTab['route'] === "supprimer-produit" && $routeTab['productSlug'] !== null && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->pc->deleteProduct($routeTab['productSlug']);
        }
        else if($routeTab['route'] === "categories" && $routeTab['categorySlug'] !== null) // condition(s) pour envoyer vers la liste des produits d'une catégorie  
        {  
           
            $this->cc->productsInCategory($routeTab['categorySlug']);  
        }  
        else if($routeTab['route'] === "produits" && $routeTab['productSlug'] !== null)  
        {  
           
            $this->pc->productDetails($routeTab['productSlug']);
        }
        else if($routeTab["route"] === "creer-un-compte") // condition pour afficher la page du formulaire d'inscription  
        {  
            $this->auth->register();// appeler la méthode du controlleur pour afficher la page d'inscription  
        }  
        else if($routeTab["route"] === "check-creer-un-compte") // condition pour l'action du formulaire d'inscription  
        {  
            $this->auth->checkRegister($_POST);// appeler la méthode du controlleur pour créer un utilisateur et renvoyer vers l'accueil  
        }  
        else if($routeTab["route"] === "connexion") // condition pour afficher la page du formulaire de connexion  
        {  
            $this->auth->login(); // appeler la méthode du controlleur pour afficher la page d'inscription  
        }  
        else if($routeTab["route"] === "check-connexion") // condition pour l'action du formulaire de connexion  
        {  
            $this->auth->checkLogin($_POST); // appeler la méthode du controlleur pour vérifier la connexion et renvoyer vers l'accueil  
        }
        else if($routeTab["route"] === "deconnexion") // condition pour l'action du formulaire de connexion  
        {  
            $this->auth->logout(); // appeler la méthode du controlleur pour vérifier la connexion et renvoyer vers l'accueil  
        }
        else if($routeTab['route'] === "admin-utilisateurs" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->uc->renderAllUsers($routeTab['productSlug']);
        } 
        else if($routeTab['route'] === "delete-utilisateur" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->uc->deleteUser($routeTab['route2']);
        }  
      /*  else if($routeTab['route'] === "admin-produits" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->pc->deleteUser($routeTab['route2']);
        } */
        else if($routeTab['route'] === "admin-categories" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->cc->categoriesListAdmin();
        }
        else if($routeTab['route'] === "admin-produits" && isset($_SESSION["role"]) && $_SESSION["role"]=== "admin")
        {
            $this->pc->productsListAdmin();
        }
    }
}