<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;


/**
 * @property string $label
 * @property string $password
 * @property int    $id
 */
class EntryModel extends Model {

    protected $table = 'entries';

}