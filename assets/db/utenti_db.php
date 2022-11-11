<?php
class Utente{
  protected $nome;
  protected $cognome;
  protected $email;
  protected $password;
  protected $user_type;

  function __construct($_nome, $_cognome, $_email, $_password, $_user_type)
  {
    $this->nome = $_nome;
    $this->cognome = $_cognome;
    $this->email = $_email;
    $this->password = $_password;
    $this->user_type = $_user_type;
  }
  
  public function getNome(){
    return $this->nome;
    echo "Nome: ".$utente(getNome())."<br>";
  }
  public function getCognome(){
    return $this->cognome;
  }
  public function getEmail(){
    return $this->email;
  }
  public function getPassword(){
    return $this->password;
  }
  public function getType(){
    return $this->user_type;
  }

}
?>