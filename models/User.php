<?php  
 
class User {  
  
    private ?int $id;  
    private string $username;  
    private string $email;  
    private string $password;  
    private string $role;
  
    public function __construct(?int $id, string $username, string $email, string $password, string $role)  
    {  
        $this->id = $id;  
        $this->username = $username;  
        $this->email = $email;  
        $this->password = $password; 
        $this->role = $role;
    }  
  
    /**  
     * @return int|null     */    public function getId(): ?int  
    {  
        return $this->id;  
    }  
  
    /**  
     * @param int|null $id  
     */  
    public function setId(?int $id): void  
    {  
        $this->id = $id;  
    }  
  
    /**  
     * @return string     */    public function getUsername(): string  
    {  
        return $this->username;  
    }  
  
    /**  
     * @param string $username  
     */  
    public function setUsername(string $username): void  
    {  
        $this->username = $username;  
    }  
  
    /**  
     * @return string     */    
     public function getEmail(): string  
    {  
        return $this->email;  
    }  
  
    /**  
     * @param string $email  
     */  
    public function setEmail(string $email): void  
    {  
        $this->email = $email;  
    }  
  
    /**  
     * @return string     */    public function getPassword(): string  
    {  
        return $this->password;  
    }  
  
    /**  
     * @param string $password  
     */  
    public function setPassword(string $password): void  
    {  
        $this->password = $password;  
    }  
    
    public function getRole(): string  
    {  
        return $this->role;  
    }  
    public function setRole(string $role): void  
    {  
        $this->role = $role;  
    }
}