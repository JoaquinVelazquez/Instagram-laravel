<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        //dd($follows);

        return view('profiles.index', compact('user', 'follows'));
    }

    public function edit(\App\Models\User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, \App\Models\User $user)
    {
        $this->authorize('update', $user->profile);
    
        $validated = $request->validate([
            'another' => '',
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'url' => 'url',
            'image' => '',
        ]);

    
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }
        

        auth()->user()->profile->update(array_merge(
            $validated,
            $imageArray ?? []
        ));
        
        return redirect("/profile/{$user->id}");
    }

}
