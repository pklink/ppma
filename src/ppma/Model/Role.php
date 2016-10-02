<?php


namespace ppma\Model;


/**
 * @property int $id
 * @property string $name
 * @method static Role find(int $id)
 */
class Role extends AbstractModel
{

    protected $table = 'roles';

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function users() {
        return $this->hasMany(User::class);
    }

}
