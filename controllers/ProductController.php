<?php

class ProductController extends AbstractController{
    
    
    private ProductManager $pm;
    private CategoryManager $cm;
    
     public function __construct()  
    {  
        $this->pm = new ProductManager();
        $this->cm = new CategoryManager();
    }
            /* Pour la route /produits */  
    public function productsList() : void  
    {  
        $products = $this->pm->getAllProducts();  
      
        $this->render("products", [  
            "products" => $products  
        ]);  
    }
        
    public function productDetails(string $productSlug) : void  
    {  
        $product = $this->pm->getProductBySlug($productSlug); 
        $categories = $this->cm->getCategoriesByProductSlug($productSlug);

        $this->render("product", [  
            "product" => $product, 
            "categories" => $categories
        ]);  
    }
    
    public function createProduct() : void
    {   
       $categories = $this->cm->getAllCategories();
        $this->renderAdmin("create-product", [$categories
            ]);
    }
    
    public function checkCreateProduct(array $post) : void
    {   
       
        $uploader = new Uploader();
        $media = $uploader->upload($_FILES, "image");
        $post["media"]= $media->getUrl();
        var_dump($post);
        $tab = [];
        $product = new Product($this->clean($post["name"]),$this->slugify($post["name"]),$this->clean($post["description"]), intval($this->clean($post["price"])), $post["media"], $post["categories"]);
        $newprod = $this->pm->createProduct($product);
        
        header('Location: creer-produit');
        exit;
    }
    
    public function editProduct(string $productSlug) : void
    {
        $editProduct = $this->pm->getProductBySlug($productSlug);
        $this->renderAdmin("edit-product", [
            "edit-product" =>$editProduct
            ]);
        
    }
    
    public function checkEditProduct(array $post, string $productSlug) : void
    {
        var_dump($post);
        $editProduct =  new Product($this->clean($post["name"]),$this->slugify($post["name"]),$this->clean($post["description"]), $this->clean($post["price"]), $post["image"]);
        $editProduct = $this->pm->getProductById($post["id"]);
        $editProduct->setName($post["name"]);
        $editProduct->setDescription($post["description"]);
        $editProduct->setPrice($post["price"]);
        $editProduct->setMedia($post["image"]);
        
        $product = $this->pm->editProduct($editProduct);
       
         header('Location: /Res03ProjetFinalV2/admin-produits');
        exit;
    }
    
    public function deleteProduct(string $productSlug) : void
    {
         $product = $this->pm->deleteProduct($productSlug);
       header('Location: /Res03ProjetFinalV2/admin-produits');
    }
    public function productsListAdmin() : void  
    {  
        $products = $this->pm->getAllProducts();
      
        $this->renderAdmin("admin-produits",   
             $products  
        );  
    }
    
}
