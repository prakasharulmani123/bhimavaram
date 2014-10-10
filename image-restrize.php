<?php
header('Content-type: image/png');
$im = imagecreatefrompng('flower.png');
imagefilter($im, IMG_FILTER_GRAYSCALE);
imagefilter($im, IMG_FILTER_CONTRAST, 255);
imagefilter($im, IMG_FILTER_NEGATE);
imagefilter($im, IMG_FILTER_NEGATE);
imagefilter($im, IMG_FILTER_COLORIZE, 255, 255, 255);
imagealphablending( $im, false );
imagesavealpha( $im, true );
//imagepng($im, 'flower1.png');
imagepng($im);
imagedestroy($im);