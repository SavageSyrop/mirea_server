<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/connect_db.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $query = "SELECT * FROM uploaded_files WHERE id = " . $_GET['id'];
    $result = mysqli_query($mysqli, $query) or die("Error in query " . $query);
    list($id, $file, $type, $size, $upload_date) = mysqli_fetch_array($result);
    header("Content-length: $size");
    header("Content-Description: File Transfer");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=" . $file);
    ob_clean();
    echo $content;
    readfile($file);
}
?>