<?php


namespace ppma\Model;


/**
 * @property int       $id
 * @property string    $name
 * @property string    $username
 * @property string    $password
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property int       $owner_id
 * @property User      $owner
 * @method static Entry find(int $id)
 */
class Entry extends AbstractModel
{

    protected $table = 'entries';

    public function owner() {
        return $this->belongsTo(Permission::class);
    }

}
