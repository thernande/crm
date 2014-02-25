<?php
class Upload {

  function __construct() {

  }

  function createDir($dir = null) {

    if(null == $dir || '' == $dir) throw new Exception('Directorio no puede ser null');
      try {
        if(!file_exists($dir)) {
          if(!mkdir($dir)) {
            throw new Exception('Directorio no puede ser null');
          }
        }
      } catch (Exception $e) {
        throw new Exception($e->getMessage());
      }

    return true;
  }


  function uploadFile($oldFile, $newFile, $dir = null) {

    if(null != $dir) $newFile = "{$dir}/{$newFile}";

    if(!move_uploaded_file($oldFile, $newFile)) {
      throw new Exception('Directorio no puede ser null');
    }

    return true;
  }


  function getFileExt($file) {

    $arrFileName = explode('.', $file);
    return $arrFileName[count($arrFileName) - 1];
  }
}

?>