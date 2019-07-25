<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Traits\LaratrustUserTrait;


/**
 * Class User
 * @package App\Models
 * @version July 22, 2019, 2:28 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string name
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string remember_token
 */
class User extends Model  implements Authenticatable
{
    use LaratrustUserTrait;
    use AuthenticableTrait;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
    ];

    public static function validate($id = 0)
    {
        return [
            'email' => 'required|max:50|min:10|email|unique:users,email' . ($id == 0 ? '' : ',' .$id),
            'name' => 'required|max:50',
            'password' => 'max:20|min:6' . ($id == 0 ? '|required' : ''),
            're_password' => 'same:password',
            'roles' => 'required',
        ];
    }
}
