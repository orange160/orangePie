<?php namespace App\Entiities;

/**
 * Class GroupRepo
 * @package App\Entiities
 */
class GroupRepo
{
    protected $group;

    /**
     * GroupRepo constructor.
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        my_log('1111111111');
        my_log($group);
        $this->group = $group;
    }

    public function create($data)
    {
        my_log($data);
        $this->group->refreshSlug();
        $this->group->fill([
            'name' => $data['name'],
            'introduction' => $data['introduction']
        ]);
        return $this->group->save();
    }
}