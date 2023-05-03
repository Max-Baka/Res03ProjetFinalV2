<?php
 
class Product {
  private ?int $id;
  private string $name;
  private string $slug;
  private string $description;
  private int $price;
  private ?string $media;
  private ?string $categorie_id;

    public function __construct(string $name, string $slug, string $description, int $price, ?string $media, ?string $categorie_id = null)
    {
       $this->id = null;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->price = $price;
        $this->media = $media;
        $this->categorie_id = $categorie_id;

    }
   public function getId() : int 
    {
        return $this->id;
    }

    public function setId(?int $id) : void
    {
        $this->id =$id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name =$name;
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function setSlug(string $slug) : void
    {
        $this->slug =$slug;
    }

  public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description =$description;
    }

    public function getPrice() : int
    {
        return $this->price;
    }

    public function setPrice(?int $price) : void
    {
        $this->price =$price;
    }
    
    public function getMedia() : ?string
    {
        return $this->media;
    }

    public function setMedia(string $media) : void
    {
        $this->media =$media;
    }
     public function getCategorieId() : ?string
    {
        return $this->categorie_id;
    }

    public function setCategorieId(int $categorie_id) : void
    {
        $this->categorie_id =$categorie_id;
    }


}