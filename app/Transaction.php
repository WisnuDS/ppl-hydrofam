<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $order_note
 * @property string $status
 * @property string $paid_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property ItemsSelected[] $itemsSelecteds
 */
class Transaction extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_note', 'status', 'paid_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemsSelecteds()
    {
        return $this->hasMany('App\ItemsSelected');
    }
}
