Uplodius
========

Multiple file upload using PHP

Installation
--------------
Download and unzip [archive]

```sh
$Uplodius = new Uplodius;
		
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