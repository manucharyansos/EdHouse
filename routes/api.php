<?php

use App\Models\BackgroundImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

Route::get('/background-image', function (Request $request) {
$backgroundImage = BackgroundImage::latest()->first();
return response()->json([
'backgroundImage' => $backgroundImage ? asset($backgroundImage->image_url) : asset('/img/default-bg.jpg'),
]);
});
