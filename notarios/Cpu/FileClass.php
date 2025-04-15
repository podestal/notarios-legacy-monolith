<?php
class  Cpu_File{
     
     private  $_nameFile;
     private  $_file;
     private  $_typeFile = array();
     private  $_size ;
     private  $_widthRequired;
     private  $_heightRequired;
     private  $_width;
     private  $_height;
     private  $_format = array('jpeg','jpg','png','pdf','doc','xls',
                                'rar','zip','odt');
     private  $_pathFile;
     private  $_extension;
     
     public function __construct($file = '',$typeFile = array(),$size = ''){
          $this->_file = $file;
          $this->_typeFile = $typeFile;
          $this->_size = $size;
          $this->_pathFile = '';

     } 
     public function setNameFile($value){
         if(!empty($value))
            $this->_nameFile = $value;
     }
     public function getNameFile(){
        return $this->_nameFile;
     }
     public function setPathFile($value){
         $this->_pathFile = $value;
     }
     public function getPathFile(){
          return $this->_pathFile;
     }
     public function  setFile($value){
        if(!empty($value))
        $this->_file = $value;
     }
     public function  getFile(){
        return $this->_file;

     }
     public function   setSize($value){
         if(!empty($value))
          $this->_size = $value;
     }
     public function getSize(){
        return $this->_size;
     }
     public function setTypeFile($value){
        if(!empty($value))
        $this->_typeFile = $value;
     }
     public function getTypeFile(){
        return $this->_typeFile;
     }
     public function setDimension($w,$h){
       $this->_widthRequired = $w;
       $this->_heightRequired = $h;
     }
     public function  getExtension(){
        return $this->_extension;
     }
     public function  getWidth(){
        list($mW, $mH) = getimagesize($this->_file['tmp_name']);
        return $mW;
     }
     public function  getHeight(){
        list($mW, $mH) = getimagesize($this->_file['tmp_name']);
        return $mH;
     }

     public function isGraphic(){
         $type =  exif_imagetype($this->_file['tmp_name']);
         return ($type == IMAGETYPE_JPEG) && ($type == IMAGETYPE_PNG);
     }
     public function  correctDimension(){
        list($mW, $mH) = getimagesize($this->_file['tmp_name']);
        
        return  (($mW >= $this->_widthRequired) && ($mH >= $this->_heightRequired));
     }
     public function  correctSize(){
        $size = round(intval($this->_file["size"])/1048576, 2);
        return ($size<=$this->getSize());
     }
     public function correctTypeFile(){
        $typeFile =  explode('.', $this->_file['name']);
        $first = array_shift($typeFile);

        $this->_extension = '.'.$typeFile[0];
        
        return in_array($typeFile[0],$this->_typeFile,true);
     }
     public function uploadFile(){
         if($this->correctSize()){
            if($this->correctTypeFile()){
                if(!$this->isGraphic()){


                    //die($this->_file['tmp_name']);
                   // die($this->getPathFile().$this->_nameFile.$this->_extension);

                      if(@move_uploaded_file($this->_file['tmp_name'],$this->getPathFile().$this->_nameFile.$this->_extension))
                        return true;
                    else
                        return true;
                }else{
                    if($this->correctDimesion()){

                       if( @move_uploaded_file($this->_file['tmp_name'],$this->getPathFile().$this->_nameFile.$this->_extension))
                        return  true;
                      else
                        return false;
                    }
                }
            }else{
                die('file undefined typeFile');
            }
         }else{
            die('file undefined size');
         }
     }
    
     /**
     * Image resize
     * @param int $width
     * @param int $height
     */
    function resize($width, $height){
        /* Get original image x y*/
        list($w, $h) = getimagesize($this->_file['tmp_name']);
        /* calculate new image size with ratio */
        $ratio = max($width/$w, $height/$h);
        $h = ceil($height / $ratio);
        $x = ($w - $width / $ratio) / 2;
        $w = ceil($width / $ratio);
       
        /* new file name */
        $path = $this->getPathFile().$this->_nameFile.$this->_extension;

        /* read binary data from image file */
        $imgString = file_get_contents($this->_file['tmp_name']);
        /* create image from string */
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $image,
        0, 0,
        $x, 0,
        $width, $height,
        $w, $h);
        /* Save image */
        switch ($this->_file['type']) {
            case 'image/jpeg':
                imagejpeg($tmp, $path, 100);
                break;
            case 'image/png':
                imagepng($tmp, $path, 0);
                break;
            case 'image/gif':
                imagegif($tmp, $path);
                break;
            default:
                exit;
                break;
        }
        ///return $path;
        /* cleanup memory */
        imagedestroy($image);
        imagedestroy($tmp);
    }

    function downloadFile($fileUrl){
        // get file size    
        if (substr($fileUrl,0,4)=='http') {
            $fileSize = array_change_key_case(get_headers($fileUrl, 1),CASE_LOWER);
            if ( strcasecmp($fileSize[0], 'HTTP/1.1 200 OK') != 0 ) { $fileSize = $fileSize['content-length'][1]; }
            else { $fileSize = $fileSize['content-length']; }
        } else { $fileSize = @filesize($fileUrl); }
     
        // download file
        $ctype="application/octet-stream";
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: $ctype");
     
        header("Content-Disposition: attachment; filename=\"".basename($fileUrl)."\";" );
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".$fileSize);
        readfile("$fileUrl");
        exit();
 
    }

}