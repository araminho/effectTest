<?php
use Src\Resize;
use Src\GrayScale;
use Src\Blur;

spl_autoload_register(function ($className) {
    include_once str_replace('\\', '/', $className) . '.php';
});

if (!is_dir('img')) {
    mkdir('img');
}
$paths = [
    "https://www.tert.am/cache_image/news_images/975/2924924_1/d7241fcaff9f17b28921de0db4a89a0b-542x366.jpg",
    "https://auto.ferrari.com/en_EN/wp-content/uploads/sites/5/2018/02/ferrari-812-superfast-design-draft-2.jpg",
    "https://www.paulmillerauto.com/inventoryphotos/4519/1fm5k8d84kgb45434/ip/1.jpg"
];



// ---------------------------- Image#1: resize to 100x100 pixels, add blur
$resizeParams = [
    'width' => 100,
    'height' => 100,
];
$resize1 = Resize::apply($paths[0], $resizeParams, 'resize1');
$resizeAndBlur1 = Blur::apply($resize1, 'resizeAndBlur1');
unlink($resize1);

// ------------------------------ Image#2: resize to 100x300 pixels
$resizeParams = [
    'width' => 100,
    'height' => 300,
];
$resize2 = Resize::apply($paths[1], $resizeParams, 'resize2');

// -------------------------- Image#3: resize to 150 pixels, add blur, convert to grayscale
$resizeParams = [
    'width' => 150,
    'height' => 150,
];
$resize3 = Resize::apply($paths[2], $resizeParams, 'resize3');
$resizeAndBlur3 = Blur::apply($resize3, 'resizeAndBlur3');

$resizeAndBlurAndGrayscale = GrayScale::apply($resizeAndBlur3, 'resizeAndBlurAndGrayscale3');
unlink($resize3);
unlink($resizeAndBlur3);

?>
<img src="<?php echo $resizeAndBlurAndGrayscale; ?>"/>
