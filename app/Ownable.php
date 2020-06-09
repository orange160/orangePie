<?php
namespace App;

use App\Auth\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class Ownable extends Model
{
    /**
     * Relation for the user that created this entity
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relation for the user that updated this entity.
     * @return BelongsTo
     */
    public function updateBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Gets the class name.
     * @return string
     */
    public static function getClassName()
    {
        return strtolower(array_slice(explode('\\', static::class), -1, 1)[0]);
    }
}