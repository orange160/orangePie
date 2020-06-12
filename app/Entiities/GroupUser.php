<?php namespace App\Entiities;

use App\Model;

class GroupUser extends Model
{
    protected $table = 'group_user';

    protected $fillable = ['user_id', 'group_id', 'order'];
}