<?php
namespace App\Traits;
trait ProduceImageFromBase64 {
    public function getImageFromBase64($image) {
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace('data:image/jpg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        return base64_decode($image);
    }
}