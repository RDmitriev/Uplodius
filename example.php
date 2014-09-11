<?
	/*
		Uplodius
		Multiple image file upload using PHP
		https://github.com/RDmitriev/Uplodius
	*/
	
	include 'lib/uplodius.php';
	
	if(isset($_POST['images_add']))
	{
		$Uplodius = new Uplodius;
		
		$result = $Uplodius->Upload(
			$_FILES['files'],
			(object) array(
				'dir' 			=> '../upload/',
				'name' 			=> $structure['path'],
				'width' 		=> 1000,
				'height' 		=> 0,
				'prevWidth' 	=> 200,
				'prevHeight' 	=> 0
			)
		);
		
		var_dump($result);
	}
?>
<h1>Upload images</h1>
<form method="post" enctype="multipart/form-data" class="form">
	<input type="file" name="files[]" multiple="multiple">
	<input type="submit" name="images_add" value="Загрузить">
</form>