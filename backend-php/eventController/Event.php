<?php
    
    class Event
    {
        private $id;
        private $nome_evento;
        private $data_evento;
        private $email;

        public function __construct($id, $nome_evento, $data_evento, $email)
        {
            $this->id = $id;
            $this->nome_evento = $nome_evento;
            $this->data_evento = $data_evento;
            $this->email = $email;
        }
    }