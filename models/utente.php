<?php
class Utente {
    public $nome;
    public $cognome;
    public $email;
    public $password;
    
    public function __construct(String $nome,String $cognome,String $email,String $password)
    {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->password = $password;
    }

    

}