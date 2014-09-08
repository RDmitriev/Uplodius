Uplodius
========

Multiple file upload using PHP

Installation
--------------
Download [archive] and unzip in your library folder

include 'lib/uplodius.php';

```sh
/*
    Include Uplodius
*/

include 'lib/uplodius.php';

/*
    Initialization Uplodius
*/

$Uplodius = new Uplodius;

/*
    Rund Uplodius
    Result return array, if your images upload fine $result return:
    
    ["status"]=> true
    and
    ["new_file_name"]=> 'awesome_file_uploader_540e034e38d33.jpg'
*/

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