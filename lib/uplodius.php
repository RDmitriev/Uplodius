<?
	/*
		Uplodius
		Multiple image file upload using PHP
		https://github.com/RDmitriev/Uplodius
	*/
	
	class Uplodius
	{
		protected $error_desc = array (
			0 => 'UPLOAD_ERR_OK',
			'UPLOAD_ERR_INI_SIZE',
			'UPLOAD_ERR_FORM_SIZE',
			'UPLOAD_ERR_PARTIAL',
			'UPLOAD_ERR_NO_FILE',
			'',
			'UPLOAD_ERR_NO_TMP_DIR',
			'UPLOAD_ERR_CANT_WRITE',
			'UPLOAD_ERR_EXTENSION',
		);
		
		protected $files = '';
		
		public function Upload($files, $param)
		{
			if (!empty($files))
			{
				$files = $this->diverse($files);
				$files = $this->check($files);
				$files = $this->Image($files, $param);
				
				return $files;
			}
			else
			{
				return false;
			}
		}
		
		private function diverse($array)
		{
			$result = array();
			
			foreach($array as $key1 => $value1)
			foreach($value1 as $key2 => $value2)
			$result[$key2][$key1] = $value2;
			
			return $result;
		}
		
		private function check($files)
		{
			$allow_extension = array(
				'jpeg' => 'image/jpeg',
				'jpg' => 'image/jpeg',
				'png' => 'image/png',
				'gif' => 'image/gif'
			);
			
			foreach($files as $key => $val)
			{
				$pathinfo = pathinfo($val['name']);
				$pathinfo['extension'] = strtolower($pathinfo['extension']);
				
				$files[$key]['extension'] = $pathinfo['extension'];
				
				$files[$key]['check'] = $val['error'] == 0 && $val['size'] > 0 && $allow_extension[$pathinfo['extension']] == $val['type'] && getimagesize($val['tmp_name']) ? true : false;
			}
			
			return $files;
		}
		
		private function Image($files, $param)
		{
			foreach($files as $key => $val)
			{
				if($val['check'] == true)
				{
					$new_file_name = uniqid($param->name . '_') . '.' . $val['extension'];
					
					$img_output = $param->dir . $new_file_name;
					
					if($this->uploadImage($val, $img_output, $param->width, $param->height))
					{
						$files[$key]['status'] = true;
						$files[$key]['new_file_name'] = $new_file_name;
						
						/*
							Create preview
						*/
						
						$prev_img_output = $param->dir . 'prev_' . $new_file_name;
						
						copy($img_output, $prev_img_output);
						
						$file_path_prev_array = array(
							'type' => $val['type'],
							'tmp_name' => $prev_img_output
						);
						
						$files[$key]['preview'] = $this->uploadImage($file_path_prev_array, $prev_img_output, $param->prevWidth, $param->prevHeight) ? true : false;
					}
					else
					{
						$files[$key]['status'] = false;
					}
				}
			}
			
			return $files;
		}
		
		private function uploadImage($img_input, $img_output, $new_width, $new_height)
		{
			list($width, $height) = getimagesize($img_input['tmp_name']);
			
			if($new_width > 0 && $new_height > 0)
			{
				
			}
			elseif($new_width > 0 && $width >= $new_width)
			{
				$new_height = ceil($height / ($width / $new_width));
			}
			elseif($new_height > 0 && $height >= $new_height)
			{
				$new_width = ceil($width / ($height / $new_height));
			}
			else
			{
				$new_width = $width;
				$new_height = $height;
			}
			
			$dst = imagecreatetruecolor($new_width, $new_height);
			
			if($img_input['type'] == 'image/jpeg')
			{
				$src = imagecreatefromjpeg($img_input['tmp_name']);
			}
			elseif($img_input['type'] == 'image/png')
			{
				$src = imagecreatefrompng($img_input['tmp_name']);
				
				imagealphablending($dst, false);
				imagesavealpha($dst, true);
			}
			elseif($img_input['type'] == 'image/gif')
			{
				$src = imagecreatefromgif($img_input['tmp_name']);
			}
			
			imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			if($img_input['type'] == 'image/jpeg')
			{
					imagejpeg($dst, $img_input['tmp_name'], 90);
			}
			elseif($img_input['type'] == 'image/png')
			{
				imagepng($dst, $img_input['tmp_name']);
			}
			elseif($img_input['type'] == 'image/gif')
			{
				imagegif($dst, $img_input['tmp_name'], 90);
			}
				
			imagedestroy($src);
			
			if (move_uploaded_file($img_input['tmp_name'], $img_output))
			{
				return true;
			}
			else
			{
				return false;
			}
			
			return $files;
		}
	}
?>