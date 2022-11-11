<?php
class Evento{
  protected $attendees;
  protected $nome_evento;
  protected $data_evento;

  function __construct($attendees, $nome_evento, $data_evento){
    $this->attendees = $_attendees;
    $this->nome_evento = $_nome_evento;
    $this->data_evento = $_data_evento;
  }
  
  
  public function getNome_evento(){
    return $this->nome_evento;
    echo "Evento: ".$evento(getNome_evento())."<br>";
  }
  public function getData_evento(){
    return $this->data_evento;
  }
  public function getAttendees(){
    return $this->attendees;
  }

}
?>