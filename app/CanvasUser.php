<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $summary
 * @property string $avatar
 * @property boolean $dark_mode
 * @property boolean $digest
 * @property string $locale
 * @property boolean $role
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class CanvasUser extends Model
{
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
    protected $fillable = ['name', 'email', 'username', 'password', 'summary', 'avatar', 'dark_mode', 'digest', 'locale', 'role', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

}
