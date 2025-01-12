<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="space-y-6">
                        @forelse ($messages as $message)
                            <div class="border-b pb-4">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-semibold">{{ $message->subject }}</h3>
                                    <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mt-2">{{ $message->message }}</p>
                                <div class="mt-2 text-sm text-gray-600">
                                    From: {{ $message->name }} ({{ $message->email }})
                                </div>
                                <div class="mt-1 text-sm text-gray-600">
                                    To Admin: {{ $message->admin_email }}
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No messages found.</p>
                        @endforelse

                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>