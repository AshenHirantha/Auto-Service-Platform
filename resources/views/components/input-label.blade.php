@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-gray-700 mb-2']) }}>
    {{ $value ?? $slot }}
</label>

<!-- Enhanced primary-button.blade.php -->
<!-- <button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'group relative w-full flex justify-center py-3 px-4 border border-transparent 
                text-sm font-semibold rounded-xl text-white 
                bg-gradient-to-r from-blue-600 to-purple-600 
                hover:from-blue-700 hover:to-purple-700 
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 
                transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg
                disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none'
]) }}>
    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
        <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200 transition-colors duration-200" 
             fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
        </svg>
    </span>
    {{ $slot }}
</button> -->