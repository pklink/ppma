<?php


namespace ppma\Model;

/**
 * @property int    $id
 * @property string $username
 * @property string $password
 * @property Role   $role
 * @method static User find(int $id)
 */
class User extends AbstractModel
{
    protected $hidden = ['password'];

    protected $table = 'users';

    public function role() {
        return $this->belongsTo(Role::class);
    }

}
