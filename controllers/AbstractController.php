<?php  

abstract class AbstractController  
{  
    protected function render(string $template, array $values)  
    {  
        $data = $values;  
        $page = $template;  
  
        require "templates/layout.phtml";  
    } 
    protected function renderAdmin(string $template, array $values)  
    {  
        $data = $values;  
        $page = $template;  
  
        require "templates/admin-layout.phtml";  
    }
    protected function clean(string $unsafe) : string
    {
          $safe = htmlspecialchars($unsafe);
          return $safe;
    }
    public function __construct()  
    {  
    $this->pm = new ProductManager();  
    $this->cm = new CategoryManager();  
    }
    protected function slugify($text, string $divider = '-')
    {
      // replace non letter or digits by divider
      $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    
      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    
      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);
    
      // trim
      $text = trim($text, $divider);
    
      // remove duplicate divider
      $text = preg_replace('~-+~', $divider, $text);
    
      // lowercase
      $text = strtolower($text);
    
      if (empty($text)) {
        return 'n-a';
      }
    
      return $text;
    }
}