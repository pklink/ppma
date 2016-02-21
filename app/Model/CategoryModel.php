<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;


/**
 * @property int             $id
 * @property string          $name
 * @property int             $parent_id
 * @property CategoryModel   $parent
 * @property CategoryModel[] $children
 * @property \DateTime       $createdAt
 * @property \DateTime       $updatedAt
 */
class CategoryModel extends Model {

    protected $table = 'categories';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo(CategoryModel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(CategoryModel::class, 'id', 'parent_id');
    }

}