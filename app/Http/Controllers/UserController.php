<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('dashboard.account', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($request->hasFile('avatar')) {
            $validatedData['avatar'] = $request->file('avatar')->store('avatars');

            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
        }

        $user->update($validatedData);

        return redirect()->route('account')->with('success', 'Account updated');;
    }
}
