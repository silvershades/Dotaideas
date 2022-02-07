<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function spells()
    {
        return $this->hasMany(Spell::class);
    }

    public function item_attributes()
    {
        return $this->hasMany(ItemAttribute::class);
    }

    public function item_recipes()
    {
        return $this->hasMany(ItemRecipe::class);
    }

    public function item_type()
    {
        return $this->belongsTo(ItemType::class);
    }

    public function item_shop()
    {
        return $this->belongsTo(ItemShop::class);
    }

}
