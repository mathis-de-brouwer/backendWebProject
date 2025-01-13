<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            Welcome
                        </h1>
                        <p class="text-lg text-gray-600">
                            @auth
                                Welcome back, {{ Auth::user()->name }}!
                            @else
                                Please login, register or click on the FAQ link to view the frequently asked questions.
                            @endauth
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
