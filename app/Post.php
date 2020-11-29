<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $slug
 * @property string $title
 * @property string $summary
 * @property string $body
 * @property string $published_at
 * @property string $featured_image
 * @property string $featured_image_caption
 * @property string $user_id
 * @property mixed $meta
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'canvas_posts';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['slug', 'title', 'summary', 'body', 'published_at', 'featured_image', 'featured_image_caption', 'user_id', 'meta', 'created_at', 'updated_at', 'deleted_at'];

    public function comment()
    {
        return $this->hasMany("App\Comment");
    }

    public function user()
    {
        return $this->belongsTo("App\CanvasUser");
    }

}
