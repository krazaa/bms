<?php

namespace App\modules;

use Illuminate\Database\Eloquent\Model;

class Electronicproduct extends Model
{
    //protected $guarded = ['id'];
    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];

 	public function cats()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcats()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }
        
}
