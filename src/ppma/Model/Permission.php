<?php


namespace ppma\Model;


/**
 * @property int $id
 * @property string $name
 */
class Permission extends AbstractModel
{

    public $incrementing = false;

    protected $table = 'permissions';

    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    } 
    
}
