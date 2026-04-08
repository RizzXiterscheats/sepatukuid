<?php
use App\Models\Product;

$updates = [
    3 => 'products/nike-air-jordan-1-retro-high-og.png',
    4 => 'products/adidas-gazelle.png',
    5 => 'products/puma-softride-enzo-5.png',
    6 => 'products/adidas-samba-og-white-grey.png',
    7 => 'products/nb-530-moonbeam-beige.png',
    8 => 'products/nike-air-force-1-07-white.png',
];

foreach($updates as $id => $image) {
    Product::where('id', $id)->update(['image' => $image]);
    echo "Updated product ID $id with image $image\n";
}
