<?php namespace App\Entiities\Repo;

use App\Entiities\Group;
use App\Entiities\GroupUser;
use phpDocumentor\Reflection\Types\This;

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
        $this->group = $group;
    }

    /**
     * 数据库中插入一条group信息
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        $this->group->fill([
            'name' => $data['name'],
            'introduction' => $data['introduction']
        ]);
        $this->group->refreshSlug();

        if (!$this->group->save() || !$this->createGroupUser()) {
            return false;
        }

        return true;
    }

    protected function createGroupUser()
    {
        $groupUser = new GroupUser();
        $groupUser->user_id = user()->id;
        $groupUser->group_id = $this->group->id;

        // 插入的关系数据时，将order值加1
        $maxOrder = GroupUser::where('user_id', '=', $groupUser->user_id)->count();
        $groupUser->order = $maxOrder + 1;

        return $groupUser->save();
    }
}