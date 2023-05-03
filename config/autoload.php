<?php  
  
// models  
require "models/Category.php";  
require "models/Product.php"; 
require "models/User.php";

  
// managers  
require "managers/AbstractManager.php";  
require "managers/CategoryManager.php";  
require "managers/ProductManager.php";
require "managers/UserManager.php";

  
// controllers  
require "controllers/AbstractController.php";  
require "controllers/ProductController.php";
require "controllers/CategoryController.php";
require "controllers/AuthController.php";
require "controllers/UserController.php";

  
// services  
require "services/Router.php";

//uploader
require "models/Media.php";
require "models/RamdomStringGenerator.php";
require "models/Uploader.php";
