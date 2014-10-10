<?php
if(!isset($_REQUEST['src']))
	return;
	
$source = dirname(__FILE__)."/uploader/files/thumbnail/".$_REQUEST['src'];
	
header('Content-type: image/png');
$im = imagecreatefrompng($source);

imagefilter($im, IMG_FILTER_COLORIZE, 255, 255, 255);
imagealphablending( $im, false );
imagesavealpha( $im, true );
//imagepng($im, 'flower1.png');
imagepng($im);
imagedestroy($im);