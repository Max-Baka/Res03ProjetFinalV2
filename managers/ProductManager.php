<?php
class ProductManager extends AbstractManager {

    public function getAllProducts() : array  
    { 
      $query = $this->db->prepare('SELECT products.id, products.name ,products.slug ,products.description,products.price, products.media, categories.name as categorie_id
    FROM products JOIN categories
    ON products.categorie_id = categories.id
    ORDER BY products.id desc');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_ASSOC);  
        $list = [];
      
        foreach($products as $product)
    {
        $prod = new Product($product["name"], $product["slug"], $product["description"], $product["price"], $product["media"], $product["categorie_id"]);
        $prod->setId($product["id"]);
        $list[] = $prod;
    }
        return $list;  
    }  
    
    public function getProductBySlug(string $productSlug) : Product  
    {  
        $query = $this->db->prepare('SELECT * FROM products WHERE slug=:slug');

        $parameters = [
            'slug' => $productSlug
        ];
        $query->execute($parameters);
        $productParams = $query->fetch(PDO::FETCH_ASSOC);
        $product = new Product($productParams["name"], $productParams["slug"], $productParams["description"], $productParams["price"], $productParams["media"], $productParams["categorie_id"]);
        $product->setId($productParams["id"]);
        return $product;  
    }
    public function getProductByID(int $productId) : Product  
    {  
        $query = $this->db->prepare('SELECT * FROM products WHERE id=:id');

        $parameters = [
            'id' => $productId
        ];
        $query->execute($parameters);
        $productParams = $query->fetch(PDO::FETCH_ASSOC);
        $product = new Product($productParams["name"], $productParams["slug"], $productParams["description"], $productParams["price"], $productParams["media"], $productParams["categorie_id"]);
        $product->setId($productParams["id"]);
        return $product;  
    }
    
    public function createProduct(Product $product) : Product
    {
        $query = $this->db->prepare('INSERT INTO products VALUES (null, :name, :slug, :description, :price,
        :media, :categorie_id)');
        $parameters = [
        'name' => $product->getName(),
        'slug' => $product->getSlug(),
        'description' => $product->getDescription(),
        'price' => $product->getPrice(),
        'media' =>$product->getMedia(),
         'categorie_id' =>$product->getCategorieId()
        ];
        $query->execute($parameters);
        $product->setId($this->db->lastInsertId());
        return $product;

    }
    public function editProduct(Product $product) : Product
    {
        $query = $this->db->prepare('UPDATE products SET name= :name, slug= :slug, description= :description,
        price= :price, media= :media, categorie_id= :categorie_id WHERE id= :id');
        $parameters = [
        'id' => $product->getId(),
        'name' => $product->getName(),
        'slug' => $product->getSlug(),
        'description' => $product->getDescription(),
        'price' => $product->getPrice(),
        'media' =>$product->getMedia(),
        'categorie_id' => $product->getCategorieId()
        ];
        $query->execute($parameters);
        
        return $product;
    }
    public function deleteProduct(string $productSlug) : void
    {
        $product = $this->getProductBySlug($productSlug);
        
    
        $query = $this->db->prepare('DELETE  FROM products WHERE slug = :slug');
        $parameters = [
            'slug' => $productSlug
            ];
        $query->execute($parameters);    
    }
    
    
    public function getProductsByCategoryId(int $id) : array  
    {  
        $query = $this->db->prepare('SELECT * FROM products WHERE categorie_id = :id ');

        $parameters = [
            'id' => $id,
        ];

        $query->execute($parameters);
        $list = [];
        $products = $query->fetchAll(PDO::FETCH_ASSOC);  
        foreach($products as $product)
        {
        $prod = new Product($product["name"], $product["slug"], $product["description"], $product["price"], $product["media"], $product["categorie_id"]);
        $prod->setId($product["id"]);
        $list[] = $prod;
        }
        return $list;  

    }
}