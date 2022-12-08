<?php
function create_watermark($image_path, $new_image_path) {
    $im = imagecreatefrompng($image_path);

    $stamp = imagecreatetruecolor(200, 70);
    imagefilledrectangle($stamp, 0, 0, 199, 69, 0x0000FF);
    imagefilledrectangle($stamp, 9, 9, 190, 60, 0xFFFFFF);
    imagestring($stamp, 5, 20, 20, 'Goyda', 0x0000FF);
    imagestring($stamp, 3, 20, 40, '(c) ' . date('d.m.Y H:i:s'), 0x0000FF);

    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);

    imagepng($im, $new_image_path);
    imagedestroy($im);
}
?>