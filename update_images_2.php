<?php
use App\Models\Product;

$updates = [
    9 => 'https://assets.voila.id/voila/images/product/adidas/3product-B75806-Xms-2023-06-23T1645210700.jpeg',
    10 => 'https://images.prodirectsport.com/ProductImages/Main/277065_Main_0834372.jpg',
    11 => 'https://images.prodirectsport.com/ProductImages/Main/281901_Main_1377729.jpg',
    12 => 'https://sneakernews.com/wp-content/uploads/2023/12/nike-lebron-21-melo-melo-fv2345-800-4.jpg',
    13 => 'https://sneakernews.com/wp-content/uploads/2022/11/air-jordan-37-black-infrared-DD6958-091-7.jpg',
    14 => 'https://images.prodirectsport.com/ProductImages/Main/1008682_Main_1688686.jpg',
    15 => 'https://images.prodirectsport.com/ProductImages/Main/1001150_Main_1537254.jpg',
    16 => 'https://assets.voila.id/voila/images/product/nike/3product-DC0774-101-Xms-2023-05-23T1645210700.jpeg',
    17 => 'https://images.prodirectsport.com/ProductImages/Main/1010191_Main_1740195.jpg',
    18 => 'https://assets.voila.id/voila/images/product/adidas/3product-B75807-Xms-2023-06-23T1645210700.jpeg',
    19 => 'https://images.prodirectsport.com/ProductImages/Main/260381_Main_0647895.jpg',
    20 => 'https://assets.voila.id/voila/images/product/new-balance/3product-BB550WWW-Xms-2023-05-23T1645210700.jpeg',
    21 => 'https://assets.voila.id/voila/images/product/new-balance/3product-MS327FE-Xms-2023-05-23T1645210700.jpeg',
    22 => 'https://assets.voila.id/voila/images/product/puma/3product-374915-01-Xms-2023-05-23T1645210700.jpeg',
    23 => 'https://assets.voila.id/voila/images/product/vans/3product-VN000D3HY28-Xms-2023-05-23T1645210700.jpeg',
    24 => 'https://assets.voila.id/voila/images/product/converse/3product-M9160-Xms-2023-05-23T1645210700.jpeg',
    25 => 'https://images.prodirectsport.com/ProductImages/Main/281895_Main_1377663.jpg',
    26 => 'https://images.prodirectsport.com/ProductImages/Main/249337_Main_0593851.jpg',
    27 => 'https://images.prodirectsport.com/ProductImages/Main/1000889_Main_1537258.jpg',
];

foreach($updates as $id => $image) {
    Product::where('id', $id)->update(['image' => $image]);
    echo "Updated product ID $id with image $image\n";
}
