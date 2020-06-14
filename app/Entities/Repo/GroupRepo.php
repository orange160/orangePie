<?php namespace App\Entities\Repo;

use App\Entities\Group;
use App\Entities\GroupUser;
use App\Exceptions\NotFoundException;
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

    /**
     * 创建group和user的关联数据
     * @return bool
     */
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

    /**
     * 通过slug查抄group
     * @param $slug
     * @return Group
     * @throws NotFoundException
     */
    public function getBySlug($slug): Group
    {
        $group = Group::where('slug', '=', $slug)->first();
        if ($group === null) {
            throw new NotFoundException(trans('group.group_not_found'));
        }

        return $group;
    }
}