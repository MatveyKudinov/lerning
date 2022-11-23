<?php
class Uploader{
    protected $nameForm;



    public function __construct(string $nameForm){
        $this->nameForm = $nameForm;
    }


    public function isUploaded():bool{
        if(isset($_FILES[$this->nameForm])&&(!empty($_FILES[$this->nameForm]))){
            return true;
        }
        else return false;
    }

    public function  upload(){
        if($this->isUploaded()){
            move_uploaded_file($_FILES['picture']['tmp_name'],__DIR__.'/../img/' . $_POST['dir'] . '/' . $_FILES['picture']['name']);
        }

    }
}