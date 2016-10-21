<?php
/**
 * Created by PhpStorm.
 * User: Ivaylo
 * Date: 19.10.2016 г.
 * Time: 16:44
 */


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$actual_file = $_FILES["fileToUpload"]["name"];
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if ($_FILES["fileToUpload"]["size"] > 100000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

$wmkIMG = imagecreatefrompng('watermark.png');
imagealphablending($wmkIMG,true);

imagecopymerge($_FILES["fileToUpload"]["tmp_name"], $wmkIMG, 755, 864, 0, 0, 465, 36, 50);

// Save the image to file and free memory
echo '<img src= "' . $_FILES["fileToUpload"]["tmp_name"] . '" alt="test"/>';

imagedestroy($actual_file);
imagedestroy($wmkIMG);
}

?>





