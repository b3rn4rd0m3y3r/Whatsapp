<?php
$uploaddir = './images/';
$uploadfile = $uploaddir . basename($_FILES['ImageFile']['name']);
echo $_FILES['ImageFile']['name'];
move_uploaded_file($_FILES['ImageFile']['tmp_name'], $uploadfile);
?>