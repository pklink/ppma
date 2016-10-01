<?php


namespace ppma\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 */
class User extends Model
{

    protected $table = 'users';

    protected $hidden = ['password'];

}
