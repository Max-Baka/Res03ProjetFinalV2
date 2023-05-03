<?php  
 
class CategoryManager extends AbstractManager {  
   
    public function getAllCategories() : array  
    {  
        $list = [];  
      
       $query = $this->db->prepare('SELECT * FROM categories'); // Pour accéder à la base de données utilisez $this->db  
       $query->execute();
       $categories = $query->fetchAll(PDO::FETCH_ASSOC);
       $categ = [];
       
       foreach($categories as $categorie)
       {
            $categ = new Category($categorie["name"], $categorie["slug"], $categorie["description"]);
            $categ->setId($categorie["id"]);
            $list[] = $categ;
       }
        return $list;  
    }  
        public function createCategory(Category $category) : Category
    {
        $query = $this->db->prepare('INSERT INTO categories VALUES (null, :name, :slug, :description)');
        $parameters = [
        'name' => $category->getName(),
        'slug' => $category->getSlug(),
        'description' => $category->getDescription()
        ];
        $query->execute($parameters);
        $category->setId($this->db->lastInsertId());
        return $category;
      
    }
    public function editCategory(Category $category) : Category
    {
        $query = $this->db->prepare('UPDATE categories SET name= :name, slug= :slug, description= :description WHERE id= :id');
        $parameters = [
        'name' => $category->getName(),
        'slug' => $category->getSlug(),
        'description' => $category->getDescription(),
        'id' => $category->getId()
        ];
        $query->execute($parameters);
        
        return $category;
    }
    public function deleteCategory(string $categorySlug) : void
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $query = $this->db->prepare('DELETE FROM products_categories WHERE category_id = :id');
        $parameters = [
            'id' => $category->getId()
            ];
        $query->execute($parameters);    
        
        $query = $this->db->prepare('DELETE FROM categories WHERE slug = :slug');
        $parameters = [
            'slug' => $categorySlug
            ];
        $query->execute($parameters);    
    }  
    public function getCategoryBySlug(string $slug) : Category  
    {  
        $query = $this->db->prepare('SELECT * FROM categories WHERE categories.slug=:slug '); 
                                        // Pour accéder à la base de données utilisez $this->db  
        $parameter = ["slug" =>$slug];
        $query->execute($parameter);
        $categories = $query->fetch(PDO::FETCH_ASSOC);
        $categ = new Category($categories["name"], $categories["slug"], $categories["description"]);
        $categ->setId($categories["id"]);
        return $categ;
    }
    
    public function getCategoriesByProductSlug(string $slug) : array
    {
        $query = $this->db->prepare('SELECT categories.* FROM products_categories JOIN products ON products_categories.products_id = products.id JOIN 
                                        categories ON products_categories.category_id = categories.id WHERE products.slug =:slug '); 
                                        // Pour accéder à la base de données utilisez $this->db  
        $parameter = ["slug" =>$slug];
        $query->execute($parameter);
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        foreach($categories as $categorie)
       {
            $categ = new Category($categorie["name"], $categorie["slug"], $categorie["description"]);
            $categ->setId($categorie["id"]);
            $list[] = $categ;
       }
        return $list;
    }
 
}