<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- News Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Latest News</h3>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add News
                            </a>
                        @endif
                    </div>
                    <div class="space-y-4">
                        @forelse($news ?? [] as $item)
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ $item->title }}</h4>
                                        <p class="text-gray-600 mt-1">{{ $item->content }}</p>
                                        <span class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if(auth()->user()->role === 'admin')
                                        <div class="flex space-x-2">
                                            <a href="{{ route('news.edit', $item) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                            <form action="{{ route('news.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No news available.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Frequently Asked Questions</h3>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('faq.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add FAQ
                            </a>
                        @endif
                    </div>
                    <div class="space-y-4">
                        @forelse($faqs ?? [] as $faq)
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ $faq->question }}</h4>
                                        <p class="text-gray-600 mt-1">{{ $faq->answer }}</p>
                                        <span class="text-sm text-gray-500">Category: {{ $faq->category }}</span>
                                    </div>
                                    @if(auth()->user()->role === 'admin')
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
                        @empty
                            <p class="text-gray-500">No FAQs available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>