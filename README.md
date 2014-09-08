Uplodius
========

Multiple file upload using PHP

Installation
--------------
<<<<<<< HEAD
Download [archive] and unzip in your library folder

Insert code
=======
Download and unzip [archive]

>>>>>>> parent of 11c93bb... edit
```sh
$Uplodius = new Uplodius;
<<<<<<< HEAD

/*
    Run Uplodius
    Result return array, if your images upload fine $result return:
    
    ["status"]=> true
    and
    ["new_file_name"]=> 'awesome_file_uploader_540e034e38d33.jpg'
*/

=======
		
>>>>>>> parent of 11c93bb... edit
$result = $Uplodius->Upload(
		$_FILES['files'],
			(object) array(
			'dir' 			=> 'upload/',
			'prefix' 		=> 'awesome_upload',
			'width' 		=> 800,
			'height' 		=> 0,
			'prevWidth' 	=> 200,
				'prevHeight' 	=> 0
		)
);
```

[archive]:https://github.com/RDmitriev/Uplodius/archive/master.zip