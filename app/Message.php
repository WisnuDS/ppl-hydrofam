<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $message
 * @property User $user

 */
class Message extends Model
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
    protected $fillable = ['sender_id', 'receiver_id', 'created_at', 'updated_at', 'message'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }
}
