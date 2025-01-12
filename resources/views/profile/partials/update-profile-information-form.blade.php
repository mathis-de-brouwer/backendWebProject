<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Your current profile information.") }}
        </p>
    </header>

    <!-- Current Profile Information -->
    <div class="mt-6 space-y-6 border p-4 rounded-lg bg-gray-50">
        <div>
            <h3 class="font-medium">{{ __('Name') }}</h3>
            <p>{{ $user->name }}</p>
        </div>

        <div>
            <h3 class="font-medium">{{ __('Email') }}</h3>
            <p>{{ $user->email }}</p>
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm text-red-600">{{ __('Email not verified') }}</p>
            @endif
        </div>

        <div>
            <h3 class="font-medium">{{ __('Birthday') }}</h3>
            <p>{{ $user->birthday ? date('F j, Y', strtotime($user->birthday)) : 'Not set' }}</p>
        </div>

        <div>
            <h3 class="font-medium">{{ __('Profile Picture') }}</h3>
            @if($user->profilePicture)
                <img src="{{ Storage::url($user->profilePicture) }}" alt="Profile Picture" class="w-32 h-32 object-cover rounded-full">
            @else
                <p>No profile picture set</p>
            @endif
        </div>

        <div>
            <h3 class="font-medium">{{ __('Bio') }}</h3>
            <p class="whitespace-pre-line">{{ $user->bio ?? 'No bio added yet' }}</p>
        </div>

        <x-primary-button
            x-data=""
            x-on:click.prevent="$refs.editForm.classList.toggle('hidden')"
        >
            {{ __('Edit Profile') }}
        </x-primary-button>
    </div>

    <!-- Edit Profile Form -->
    <div x-ref="editForm" class="hidden mt-6">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Rest of your existing form fields -->
            <!-- ... -->

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <x-secondary-button x-on:click.prevent="$refs.editForm.classList.add('hidden')">
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