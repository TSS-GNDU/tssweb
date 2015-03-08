<?php
	session_start();
	header('Content-type: image/jpeg');
	
	$text = $_SESSION['secure'];
	$fontsize = 30;
	
	$image_width = 120;
	$image_height = 40;
	
	$image = imagecreate($image_width , $image_height);
	imagecolorallocate($image , 255,255,255);
	$fontcolor = imagecolorallocate($image ,0,0,0);
	
	for($i=0; $i<40; $i++){
		$x1=rand(10,110);
		$y1=rand(1,60);
		$x2=rand(10,120);
		$y2=rand(1,60);
		imageline($image , $x1 ,$y1 , $x2 , $y2 , $fontcolor);
	}
	
	
	/*imagettftext($image , $fontsize , angle ,x,y ,$fontcolor , 'font.ttf' , $text);*/
	imagettftext($image , $fontsize , 0 ,15,30 ,$fontcolor , 'font.ttf' , $text);
	imagejpeg($image);
?>