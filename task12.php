<?php
header('Content-Type: image/png');

$image = imagecreatetruecolor(200, 100);

$background = imagecolorallocate($image, 240, 240, 240); // Light gray background
$text_color = imagecolorallocate($image, 0, 0, 0);       // Black text
$line_color = imagecolorallocate($image, 100, 100, 100); // Gray lines
$dot_color = imagecolorallocate($image, 150, 150, 150);  // Gray dots

imagefill($image, 0, 0, $background);

$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

$captcha_text = '';
for ($i = 0; $i < 4; $i++) {
    $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
}

for ($i = 0; $i < rand(3, 5); $i++) {
    imageline($image,
        rand(0, 200), rand(0, 100),
        rand(0, 200), rand(0, 100),
        $line_color
    );
}

for ($i = 0; $i < rand(3, 10); $i++) {
    imagesetpixel($image, rand(0, 200), rand(0, 100), $dot_color);
}

$font = 5;
for ($i = 0; $i < 4; $i++) {
    $angle = rand(-20, 20);

    $y = rand(30, 70);
    $x = 40 + ($i * 40);

    $temp = imagecreatetruecolor(30, 30);
    $trans = imagecolorallocate($temp, 0, 0, 0);
    imagecolortransparent($temp, $trans);

    imagestring($temp, $font, 5, 5, $captcha_text[$i], $text_color);

    $rotated = imagerotate($temp, $angle, $trans);

    imagecopy($image, $rotated, $x, $y, 0, 0, 30, 30);

    imagedestroy($temp);
    imagedestroy($rotated);
}

imagepng($image);
imagedestroy($image);
?>