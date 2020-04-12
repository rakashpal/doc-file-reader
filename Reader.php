
<?php
$config=include __DIR__.'/config.php';
if(!isset($_POST['SubmitBtn'])){
    header('Location: '.$config['BASE_URL']);
    exit;
}
include_once 'vendor/autoload.php';

session_start();

if(isset($_POST["SubmitBtn"])){

    $fileName=$_FILES["resume"]["name"];
    $fileSize=$_FILES["resume"]["size"]/1024;
    $fileType=$_FILES["resume"]["type"];
    $fileTmpName=$_FILES["resume"]["tmp_name"];  

    if($fileType=="application/msword"){
        $search=$_POST['search'];
    if(isset($_REQUEST['scan_full'])){
        $search=null;
    }
    
        $random=rand(1111,9999);
        $newFileName=$random.$fileName;
        
        //File upload path
        $uploadPath=__DIR__."/Upload/".$newFileName;
        //function for upload file
        if(move_uploaded_file($fileTmpName,$uploadPath)){
        //   echo "Successful"; 
        //   echo "File Name :".$newFileName; 
        //   echo "File Size :".$fileSize." kb"; 
        //   echo "File Type :".$fileType; 
        //   $source = __DIR__ . "/test.doc";
          $source = $uploadPath;
include_once 'DecParser.php';
$parser =new DecParser();
$a_tables = $parser->get_doc_tables_array($source,$search);

include('preview.php');
die;
        }{
        	echo "Issue with upload directory. Please check Upload dir permission ";
        }
      }
 
}


