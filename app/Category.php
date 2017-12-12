<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public static function getForDropdown()
   {
       $categories = Category::orderBy('name')->get();
       #$categoriesForDropdown = [0 => 'Choose one...'];
       foreach ($categories as $category) {
          $categoriesForDropdown[$category->id] = $category->name;
        }
        return $categoriesForDropdown;
    }
    public function jobs()
    {
        return $this->hasMany('App\Job');
    }
    public function __toString()
    {
        return $this->name;
    }
}
