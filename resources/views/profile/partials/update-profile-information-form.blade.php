<section x-data="{ editing: false }">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
    </header>

    <!-- Current Profile Information -->
    <div class="mt-6 space-y-6 border p-4 rounded-lg bg-gray-50" x-show="!editing">
        <div class="flex items-start space-x-4">
            @if($user->profilePicture)
                <img src="{{ Storage::url($user->profilePicture) }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover">
            @else
                <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif
            <div class="flex-1">
                <div>
                    <h3 class="font-medium">{{ __('Name') }}</h3>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="mt-4">
                    <h3 class="font-medium">{{ __('Email') }}</h3>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="mt-4">
                    <h3 class="font-medium">{{ __('Birthday') }}</h3>
                    <p>{{ $user->birthday ? date('F j, Y', strtotime($user->birthday)) : 'Not set' }}</p>
                </div>
                <div class="mt-4">
                    <h3 class="font-medium">{{ __('Bio') }}</h3>
                    <p class="whitespace-pre-line">{{ $user->bio ?? 'No bio added yet' }}</p>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <x-primary-button
                type="button"
                @click="editing = true"
            >
                {{ __('Edit Profile') }}
            </x-primary-button>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div x-show="editing" class="mt-6">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="birthday" :value="__('Birthday')" />
                <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', $user->birthday)" />
                <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="profilePicture" :value="__('Profile Picture')" />
                <x-text-input id="profilePicture" name="profilePicture" type="file" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('profilePicture')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="bio" :value="__('Bio')" />
                <textarea id="bio" name="bio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4">{{ old('bio', $user->bio) }}</textarea>
                <x-input-error :messages="$errors->get('bio')" class="mt-2" />
            </div>

             <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <x-secondary-button type="button" @click="editing = false">
                    {{ __('Cancel') }}
                </x-secondary-button>
                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>