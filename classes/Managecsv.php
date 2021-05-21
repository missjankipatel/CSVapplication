<?php 
class Managecsv
{ 
    public $filename;
    public $fileopen;
     
    function __construct($file) {
        $this->filename = $file;    
    }
    
    public function readcsv(){
        $returndata= array();
        
        if (($this->fileopen = fopen($this->filename, "r")) !== FALSE) {
            while (($data = fgetcsv($this->fileopen,1000, ",")) !== FALSE) {
               $returndata[] = $data;
            }
        }
        return $returndata;
    }
    
    public  function writecsv($data){
         $this->fileopen = fopen($this->filename, 'a'); 
         foreach ( $data as $line ) {
            fputcsv($this->fileopen,$line);
        }
    }
    
    public function updatecsv($rowid,$data){
       
       $i=0;
       $newdata = [];
        
       if (($this->fileopen = fopen($this->filename, "r")) !== FALSE) {
            while (($datarow = fgetcsv($this->fileopen,1000, ",")) !== FALSE) {
               
                if ($i == $rowid) {
                    $newdata[$i][] = $data[0];          
                    $newdata[$i][] = $data[1];   
                    $newdata[$i][] = $data[2];  
                    $newdata[$i][] = $data[3];
                    $newdata[$i][] = $data[4];
                    $i++;
                    continue;
                }  
                $newdata[$i][] = $datarow[0];          
                $newdata[$i][] = $datarow[1];    
                $newdata[$i][] = $datarow[2];      
                $newdata[$i][] = $datarow[3];    
                $newdata[$i][] = $datarow[4]; 
                $i++;   
            }
        }
        
        if(!empty($newdata)){
            $this->fileopen = fopen($this->filename, 'w'); 
             foreach ( $newdata as $line ) {
                fputcsv($this->fileopen,$line);
            }
        }
        
    }
    
    function __destruct() {
        
        if ($this->fileopen)
        {
            fclose($this->fileopen);
        }
        
    }
}

?>
