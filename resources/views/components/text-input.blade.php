@props(['disabled' => false, 'icon' => null])

<div class="relative">
    @if($icon)
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                @if($icon === 'email')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                @elseif($icon === 'password')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                @elseif($icon === 'user')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                @endif
            </svg>
        </div>
    @endif
    
    <input @disabled($disabled) 
           {{ $attributes->merge([
               'class' => 'input-focus block w-full ' . 
                         ($icon ? 'pl-10 ' : 'pl-3 ') . 
                         'pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                          transition-all duration-200 shadow-sm hover:shadow-md
                          disabled:bg-gray-50 disabled:text-gray-500'
           ]) }}>
</div>