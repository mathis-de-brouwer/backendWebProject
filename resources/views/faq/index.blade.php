<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('FAQ Management') }}
            </h2>
            @if(auth()->user() && auth()->user()->role === 'admin')
            <x-primary-button onclick="window.location='{{ route('faq.create') }}'">
                {{ __('Add New FAQ') }}
            </x-primary-button>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @foreach($faqs as $category => $categoryFaqs)
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">{{ $category }}</h3>
                            <div class="space-y-4">
                                @foreach($categoryFaqs as $faq)
                                    <div class="border-b pb-4">
                                        <div class="flex justify-between">
                                            <div>
                                                <h4 class="font-medium text-gray-800">{{ $faq->question }}</h4>
                                                <p class="text-gray-600 mt-1">{{ $faq->answer }}</p>
                                            </div>
                                            @if(auth()->user() && auth()->user()->role === 'admin')
                                            <div class="flex space-x-2">
                                                <a href="{{ route('faq.edit', $faq) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                                <form action="{{ route('faq.destroy', $faq) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>