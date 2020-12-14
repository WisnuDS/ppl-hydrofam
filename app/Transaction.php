<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $order_note
 * @property int $status
 * @property string $paid_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $image
 * @property string $invoice
 * @property User $user
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
    protected $fillable = ['user_id', 'order_note', 'status', 'paid_at', 'created_at', 'updated_at', 'deleted_at', 'image', 'invoice'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemsSelecteds()
    {
        return $this->hasMany('App\ItemsSelected');
    }
}
