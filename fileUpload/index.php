<!DOCTYPE html>
<html>
<body>

<?php if (isset($_POST['submit'])) {
	echo '<pre>';
	print_r($_FILES['fileToUpload']);
	die();
} ?>
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>