static function calculateImageDimensions($image, $stage_width, $stage_heigth){
	/* $image - url of uploaded image
	* 	$stage_width - int value of stage wrapper width, where to place resized image
	*	$stage_height - int value of stage wrapper height, where to place resized image
	*/
	list($width, $height) = getimagesize($image);
	if($width > $stage_width){
		if($height > $stage_heigth){
			//both dimensions are bigger than stage. check if image is landscape or potrait
			if($width > $height){
				//landscape
				$perm_width = $stage_width;
				$ratio = $stage_width/$width;
				$perm_height = round($height * $ratio);
				//if image is still not fitting stage - then we need to resize it by smaller dimension
				if($perm_height>$stage_heigth){
					$perm_height = $stage_heigth;
					$ratio = $stage_heigth/$height;
					$perm_width = round($width * $ratio);
				}
			}else{
				//portrait
				$perm_height = $stage_heigth;
				$ratio = $stage_heigth/$height;
				$perm_width = round($width * $ratio);
				//if image is still not fitting stage - then we need to resize it by smaller dimension
				if($perm_width>$stage_width){
					$perm_width = $stage_width;
					$ratio = $stage_width/$width;
					$perm_height = round($height * $ratio);
				}
			}
		}else{
			//width is bigger and height is smaller
			$perm_width = $stage_width;
			$ratio = $stage_width/$width;
			$perm_height = round($height * $ratio);
			
		}
		
	}elseif($height > $stage_heigth){
		//width is smaller and height is bigger
		$perm_height = $stage_heigth;
		$ratio = $stage_heigth/$height;
		$perm_width = round($width * $ratio);
	}else{
		//both dimensions are smaller than stage - do not resize
		$perm_width = $width;
		$perm_height = $height;
	}
	
	return array($perm_width, $perm_height);
}