<?php  
 
class UserManager extends AbstractManager {  
  
    public function getUserByEmail(string $email) : ?User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email=:email'); //
        $parameters = [
            'email' => $email
                        ];
        $query->execute($parameters);
        $log = $query->fetch(PDO::FETCH_ASSOC);
        if($log === false){
            return null;
        }
        else{
            
        //$prod = new Product($product['name'], $product['slug'], $product['description'], $product['price']);
        $user = new User($log['id'], $log['username'], $log['email'], $log['password'], $log['role']);
        // Pour accéder à la base de données utilisez $this->db

        return $user;
        }
    }
  
    public function createUser(User $user) : User
    {
        $query = $this->db->prepare('INSERT INTO users VALUES (:id, :username, :email, :password, :role)');
        $parameters = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole()
            ];
            $query->execute($parameters);
            $query->fetch(PDO::FETCH_ASSOC);
            $id = $this->db->lastInsertId();
            $user->setId($id);
        // Pour accéder à la base de données utilisez $this->db

        return $user;
    }
    public function getAllUsers():array{

          $query = $this->db->prepare('SELECT * FROM users');
    $parameters = [

    ];
$query->execute($parameters);
$users = $query->fetchAll(PDO::FETCH_ASSOC);
// var_dump($users);
 $tab= [];
 
 
        foreach($users as $user){



            $new = new User(null, $user["username"], $user["email"], $user["password"], $user["role"]);
        $new->setId($user["id"]);

        array_push($tab, $new);

        }
        return $tab;
    }
    public function deleteUserById(string $id): void{



         $query= $this->db->prepare("DELETE FROM users WHERE id=:value");
        $parameters = [
        'value' => $id,
        ];
        $query->execute($parameters);


    }
  
}