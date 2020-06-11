<?php namespace App\Auth;

use Carbon\Carbon;

class UserRepo
{
    protected $user;

    /**
     * UserRepo constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user by email
     * @param $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        return $this->user->where('email', '=', $email)->first();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->user->newQuery()->findOrFail($id);
    }

    /**
     * Create a new basic instance of user
     * @param $data
     * @param bool $emailConfirmed
     * @return mixed
     * @throws \Exception
     */
    public function create($data, bool $emailConfirmed = false)
    {
        return $this->user->forceCreate([
           'name' => $data['name'],
           'email' => $data['email'],
           'password' => bcrypt($data['password']),
           'email_verified_at' => $emailConfirmed ? new Carbon() : null
        ]);
    }

    public function registerNew(array $data, bool $emailConfirmed = false): User
    {
        $user = $this->create($data, $emailConfirmed);

        return $user;
    }
}