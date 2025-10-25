<?php 

class Pet {
    private $conn;
    private $usuario_id;
    public $nome;
    public $sexo;
    public $porte;
    public $raca;
    public $foto;

    public function _construct($conn , $nome, $sexo ,$porte, $raca ,$usuario_id, $foto= null){
     $this->conn=$conn;
     $this->nome-$nome;
     $this->sexo=$sexo;
     $this->porte=$porte;
     $this->raca=$raca;
     $this->foto=$foto;
     $this->usuario_id=$usuario_id;
     
    }
    public function salvar(){
        $sql ="INSERT INTO pet(nome,sexo,porte,raca,foto) VALUES (?,?,?,?,?,?)";
        $stmt = $this-> conn->prepare($sql);
        if($stmt ->executer([$this->nome, $this->sexo, $this->porte, $this->raca,$this->usuario_id, $this->foto])){
            $this->usuario_id = $this->lastInsertID();
            return $this->usuario_id;
     }  else{

       throw new Exception ("Erro ao salva o Pet.");

     }        

        
    }


    }
}

?>
