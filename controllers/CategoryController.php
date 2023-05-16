<?php

class CategoryController extends AbstractController {
    
    private CategoryManager $cm;
    private ProductManager $pm;
    
    public function __construct()
    {
        $this->cm = new CategoryManager();
        $this->pm = new ProductManager();
    }
    
    public function categoriesList() : void  
    {  
       $categories = $this->cm->getAllCategories();  
      
        $this->render("index", [  
            "categories" => $categories  
        ]);  
    }
        /* Pour la route /categories/:slug-categorie */  
    public function productsInCategory(string $categorySlug) : void  
    { 
        $category = $this->cm->getCategoryBySlug($categorySlug);
        $products = $this->pm->getProductsByCategoryId($category->getId());
        $this->render("category", [  
            "products" => $products,
            "category" => $categorySlug
        ]);  
    }
    
    public function createCategory(array $post) : void
    {   
        $this->renderAdmin("create-category", [
            ]);
    }
    
    public function checkCreateCategory(array $post) : void
    {   
        
        $tab = [];
        $category = new Category($this->clean($post["name"]),$this->slugify($post["name"]),$this->clean($post["description"]));
        $newcateg = $this->cm->createCategory($category);
        
         header('Location: creer-categorie');
        exit;
    }
    
    public function editCategory(string $categorySlug) : void
    {
        $editCategory = $this->cm->getCategoryBySlug($categorySlug);
        $this->renderAdmin("edit-category", [
            "categorie" =>$editCategory
            ]);
        
    }
    
    public function checkEditCategory(array $post, string $categorySlug) : void
    {
        
        
        $editCategory =  new Category($this->clean($post["name"]),$this->slugify($post["name"]),$this->clean($post["description"]));
        $editCategory->setId($post["id"]);
        $category = $this->cm->editCategory($editCategory);
          header('Location: /Res03ProjetFinalV2/admin-categories');
    }
    
    public function deleteCategory(string $categorySlug) : void
    {
         $category = $this->cm->deleteCategory($categorySlug);
         header('Location: /Res03ProjetFinalV2/admin-categories');
    }
    public function categoriesListAdmin() : void  
    {  
       $categories = $this->cm->getAllCategories();  
      
        $this->renderAdmin("admin-categories", [  
            "categories" => $categories  
        ]);  
    }
}