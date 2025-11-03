@props(['route'])

<form action="{{ $route }}" method="POST" class="inline-block">
    @csrf
    @method('PUT')
    <input type="hidden" name="is_active" value="1">
    <button type="submit"
        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
        Approve
    </button>
</form>