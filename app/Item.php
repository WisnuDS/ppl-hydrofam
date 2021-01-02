<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $item_name
 * @property string $item_description
 * @property integer $price
 * @property integer $unit
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Item extends Model
{
    use HasFactory;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['item_name', 'item_description', 'price', 'unit', 'image', 'created_at', 'updated_at', 'deleted_at'];

}
