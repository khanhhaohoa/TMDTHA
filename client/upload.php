<?php
error_reporting(0);
echo $_REQUEST['product'];
if(isset($_REQUEST['product'])){
    if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/file/product/'.$_REQUEST['product'])) {
                mkdir($_SERVER['DOCUMENT_ROOT'].'/file/product/'.$_REQUEST['product'], 0777, true);
            }
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/file/product/".$_REQUEST['product']."/";
}else {
    exit;
}
//$target_dir = "../hafile/file/mail/".$fol."/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats

if($imageFileType != "jpg" 
&& $imageFileType != "png" 
&& $imageFileType != "jpeg"
&& $imageFileType != "gif" 
&& $imageFileType != "cdr" 
&& $imageFileType != "zip" 
&& $imageFileType != "rar"
&& $imageFileType != "xls" 
&& $imageFileType != "xlsx" 
&& $imageFileType != "doc" 
&& $imageFileType != "docx" 
&& $imageFileType != "psd"
&& $imageFileType != "pdf") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    try {
        $ipol = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>