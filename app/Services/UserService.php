<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService
{

    /**
     * @param  array  $formData
     * @return User
     */
    public function store(array $formData): User
    {
        $data = Arr::except($formData, ['password']);

        $data['password'] = Hash::make($formData['password']);

        $user = User::create($data);

        event(new Registered($user));

        return $user;
    }

    /**
     * @param  User  $user
     * @param  array  $formData
     * @return User
     */
    public function update(User $user, array $formData): User
    {
        $data = Arr::except($formData, ['password', 'is_admin']);

        // Update password only if itn't null
        if (Arr::exists($formData, 'password')) {
            $data['password'] = Hash::make($formData['password']);
        }

        $user->update($data);

        // Only Admin can set another user as Admin
        if (auth()->user()->can('assignAdminRole', $user)) {
            if (Arr::exists($formData, 'is_admin')) {
                $formData['is_admin']
                    ? $user->assignRole('admin')
                    : $user->removeRole('admin');
            }
        }

        return $user;
    }
}
