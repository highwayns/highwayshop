<?php

namespace Webkul\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Velocity\Contracts\CategoryTranslation as CategoryTranslationContract;

class CategoryTranslation extends Model implements CategoryTranslationContract
{
    
    protected $table = 'velocity_Category_translations';

    public $timestamps = false;

    protected $fillable = [
        'tooltip',
        'status',
        'products',
    ];

    public function Category()
    {
        return $this->belongsTo(CategoryProxy::modelClass());
    }
}