<?php

class customException extends Exception {
  public function errorMessage() {
    //error message
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid E-Mail address';
    return $errorMsg;
  }
}

class Existance
{

  function __construct()
  {
    // code...
  }

  public function logedUser(){
    return ((isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))?TRUE:FALSE);
  }

  public function userUnique($user){

    if($this -> logedUser()){
      return (($_SESSION['user_id'] == $user)?TRUE:FALSE);
    }else{

    }
  }
}


class UploadException extends Exception
{
  public function __construct($code) {
    $message = $this->codeToMessage($code);
    parent::__construct($message, $code);
  }

  private function codeToMessage($code)

  {
    switch ($code) {
      case UPLOAD_ERR_INI_SIZE:
        $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
        break;

      case UPLOAD_ERR_FORM_SIZE:
        $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
        break;

      case UPLOAD_ERR_PARTIAL:
        $message = "The uploaded file was only partially uploaded";
        break;

      case UPLOAD_ERR_NO_FILE:
        $message = "No file was uploaded";
        break;

      case UPLOAD_ERR_NO_TMP_DIR:
        $message = "Missing a temporary folder";
        break;

      case UPLOAD_ERR_CANT_WRITE:
        $message = "Failed to write file to disk";
        break;

      case UPLOAD_ERR_EXTENSION:
        $message = "File upload stopped by extension";
        break;

      default:
        $message = "Unknown upload error";
        break;

    }

    return $message;

  }
}

class PublicFileUpload extends Exception
{
  public function codeToMessage($code, int $file_type = FILE_SIZE["files"])
  {
    $upload_max = (int) (ini_get('upload_max_filesize'));

    switch ($code) {
      case UPLOAD_ERR_INI_SIZE:
        $message = "The uploaded file exceeds the maximum allowed file size of " . $upload_max . "MB";
        break;

      case UPLOAD_ERR_FORM_SIZE:
        $message = "The uploaded file exceeds the maximum allowed file size of " . $file_type . "MB";
        break;

      case UPLOAD_ERR_PARTIAL:
        $message = "The uploaded file was only partially uploaded";
        break;

      case UPLOAD_ERR_NO_FILE:
        $message = "No file was uploaded";
        break;

      case UPLOAD_ERR_NO_TMP_DIR:
        $message = "Missing a temporary folder";
        break;

      case UPLOAD_ERR_CANT_WRITE:
        $message = "Failed to write file to disk";
        break;

      case UPLOAD_ERR_EXTENSION:
        $message = "File upload stopped by extension";
        break;

      default:
        $message = "Unknown upload error";
        break;

    }

    return $message;

  }
}