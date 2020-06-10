<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    //
    /**
     * Get profile form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        $user = user();

        return view('auth.profile', ['user' => $user]);
    }

    /**
     * Update profile
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postProfile(Request $request)
    {
        $current_user = user();
        $userData = $request->all();

        $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($current_user->id),
            ],
            'user_password' => 'required|string'
        ]);

        // 检查密码是否正确
        if (!Hash::check($userData['user_password'], $current_user->password)) {
            $this->showErrorNotification('密码错误');
            return redirect('/profile')->withInput(['name' => $userData['name'], 'email' => $userData['email']]);
        }
        $current_user->name = $userData['name'];
        $current_user->email = $userData['email'];
        $current_user->save();
        $this->showSuccessNotification('更新成功');

        return redirect('/profile');
    }

    /**
     * 修改密码
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changePassword(Request $request)
    {
        $request->validate([
           'password' => 'required|confirmed',
           'password_confirmation' => 'required|same:password',
           'new_password' => 'required|string|min:8'
        ]);

        $userData = $request->all();
        $current_user = user();

        // 验证原始密码
        if (!Hash::check($userData['password'], $current_user->password)) {
            $this->showErrorNotification('密码错误');
            return redirect('/profile');
        }

        $current_user->password = bcrypt($userData['new_password']);
        $current_user->save();
        $this->showSuccessNotification('密码修改成功');

        return redirect('/profile');
    }
}
