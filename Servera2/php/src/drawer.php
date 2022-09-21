<?php
header("Content-type: image/png");

$num = $_GET['num'];
if (!empty($num)) {
    $form = $num & 0b11;
    $num = $num >> 2;
	$color_r = $num & 0b11111111;
	$num = $num >> 7;
	$color_g = $num & 0b11111111;
	$num = $num >> 7;
	$color_b = $num & 0b11111111;
	$num = $num >> 7;
	$img_width = $num & 0b1111111111;
	$num = $num >> 8;
	$img_height = $num & 0b1111111111;
	$num = $num >> 8;

	if ($img_height<256){
		$img_height=256;
	}
	
	if ($img_width<256){
		$img_width=256;
	}

	$img = imagecreatetruecolor($img_width, $img_height);
	$bg = imagecolorallocate($img, 255 - $color_r, 255 - $color_g, 255 - $color_b);
	imagefill($img, 0, 0, $bg);
	$color = imagecolorallocate($img, $color_r, $color_g, $color_b);

	if ($form == 0) {
		imagefilledarc($img, $img_width*0.5, $img_height*0.5, $img_width*0.8, $img_height*0.8,  0, 360, $color, IMG_ARC_PIE);
	} else if ($form == 1) {
		imagefilledpolygon($img, [$img_width*3/10, $img_height*2/10, $img_width*2/10, $img_height*5/10, $img_width*4/10, $img_height*5/10], 3, $color);
	} else {
        imagefilledrectangle($img, 0, 0, $img_width*0.8, $img_height*0.8, $color);
	}

	imagepng($img);
	imagedestroy($img);
}
?>

