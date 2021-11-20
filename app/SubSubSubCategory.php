<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSubSubCategory extends Model
{
  public function subsubcategory(){
  	return $this->belongsTo(SubSubCategory::class, 'sub_sub_category_id');
  }

  public function products(){
  	return $this->hasMany(Product::class, 'subsubsubcategory_id');
  }

  public function classified_products(){
  	return $this->hasMany(CustomerProduct::class, 'subsubsubcategory_id');
  }
}
