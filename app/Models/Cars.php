<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $table ='cars';
    protected $guarded = [];
    protected $appends = [
        'image_link'
    ];

    public function userCars()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function carPictures()
    {
        return $this->hasMany('App\Models\CarDetails');
    }

    public function getImageLinkAttribute()
    {

        if (!empty($this->image)) {

            // explode by /
            $explode_path = explode('/', $this->image);
            // removed first value in array wich is the public of the path
            unset($explode_path[0]);
            // return back to his format
            $implode_path = implode('/', $explode_path);
            $photo = url('storage/' . $implode_path);
        } else {
            // $photo = $this->is_bundle == 1 ? "/img/bundle.png" : "/img/no-product-image.png";
            $photo = "";
        }

        return $photo;
    }
}
