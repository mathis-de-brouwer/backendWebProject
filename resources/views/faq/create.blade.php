<!-- resources/views/faq/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('faq.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="question" :value="__('Question')" />
                            <x-text-input id="question" name="question" type="text" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="answer" :value="__('Answer')" />
                            <textarea id="answer" name="answer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4" required></textarea>
                            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>{{ __('Create FAQ') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>