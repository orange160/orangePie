<?php
namespace App\Entities;


use App\Ownable;

/**
 * Class Entity
 * The base class for group-like items such as ....
 * This is not a database model in itself but extended.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @package App\Entiities
 */
class Entity extends Ownable
{

    /**
     * Generate and set a new URL slug for this model.
     */
    public function refreshSlug(): string
    {
        $generator = new SlugGenerator($this);
        $this->slug = $generator->generate();
        return $this->slug;
    }
}