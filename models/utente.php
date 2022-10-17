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

    public function save()
    {          
        $query = "INSERT INTO `utenti` (`nome`, `cognome`, `email`, `password`) VALUES ('$this->nome','$this->cognome','$this->email','$this->password')";
        $mysql = mysqli_connect("127.0.0.1","root","root","test-edusogno",'3306');
        if ($mysql->connect_errno) {
            error_log('Connection error: ' . $mysql->connect_error);
        }
        if(false===mysqli_query($mysql,$query)){
            exit("Errore: impossibile eseguire la query. " . mysqli_error($mysql));
        }
        mysqli_close($mysql);
    }

}