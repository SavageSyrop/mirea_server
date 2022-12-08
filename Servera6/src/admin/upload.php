<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Your file is too large";
    } elseif ($_FILES["fileToUpload"]["error"] > 0) {
        echo "During file uploading an error was caught: " . $_FILES["fileToUpload"]["error"];
    } elseif (!in_array($_FILES['fileToUpload']['type'], ['application/pdf'])) {
        echo "This file is not pdf";
    } else if (isset($_FILES["fileToUpload"]['name'])){
        include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
        $file_name = $_FILES['fileToUpload']['name'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        move_uploaded_file($file_tmp, "./download/" . $file_name);

        $query = "insert into uploaded_files(name, type, size, upload_date) values ('";
        $query = $query . $_FILES["fileToUpload"]["name"] . "', '" . $_FILES["fileToUpload"]["type"] . "', '" . $_FILES["fileToUpload"]["size"] . "', STR_TO_DATE(\"" . date("Y-m-d H:i:s") . "\", \"%Y-%m-%d %H:%i:%s\"));";
        $result = mysqli_query($mysqli, $query);
    
    } else {
        echo $_FILES["fileToUpload"];
    }
}
?>