@props(['route', 'label' => 'Edit'])

<a href="{{ is_string($route) ? url($route) : $route }}" 
   class="inline-flex items-center px-3 py-1.5 text-sm font-medium bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
    {{ $label }}
</a>
