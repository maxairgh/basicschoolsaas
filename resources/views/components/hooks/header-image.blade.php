@php
    $user = auth()->user();
@endphp

<div class="flex items-center space-x-3">
    <img 
        src="{{ asset('storage/'.$user->photo) }}" 
        alt="{{ $user->username }}" 
        class="w-10 h-10 rounded-full object-cover border border-gray-300 dark:border-gray-600"
    >
    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $user->name }}
    </span>
</div>