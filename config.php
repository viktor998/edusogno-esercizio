<?php
class ConnectDB
{
    // parametri per la connessione al database
    private $nomehost = "localhost";
    private $nomeuser = "root";
    private $password = "root";
    private $db = "test-edusogno";
    // controllo sulle connessioni attive
    private $attiva = false;
    // funzione per la connessione a MySQL
    public function connetti()
    {
        if (!$this->attiva) {
            $mysql = mysqli_connect($this->nomehost, $this->nomeuser, $this->password,$this->db); 
            return $mysql;           
        } else {
            return true;
        }
    }
}
