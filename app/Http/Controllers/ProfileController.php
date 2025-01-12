<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage; // For handling file uploads (if needed)

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Get the authenticated user
        $user = $request->user();

        // Update the user's profile fields
        $user->fill($request->validated());

        // Handle email verification if the email is updated
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle profile picture upload (if applicable)
        if ($request->hasFile('profilePicture')) {
            // Delete the old profile picture if it exists
            if ($user->profilePicture && Storage::exists($user->profilePicture)) {
                Storage::delete($user->profilePicture);
            }

            // Store the new profile picture
            $path = $request->file('profilePicture')->store('profile-pictures', 'public');
            $user->profilePicture = $path;
        }

        // Save the updated profile
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete the user's profile picture if it exists
        if ($user->profilePicture && Storage::exists($user->profilePicture)) {
            Storage::delete($user->profilePicture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}