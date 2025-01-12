<div class="form-group">
    <label for="{{ $field }}" class="block text-sm font-medium text-gray-300">{{ ucfirst($field) }}</label>
    <div class="mt-1 flex items-center space-x-2">
        <input type="hidden" name="{{ $field }}" value="0">
        <input type="checkbox" name="{{ $field }}" id="{{ $field }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-600 rounded" value="1" {{ $value ? 'checked' : '' }}>
        <label for="{{ $field }}" class="block text-sm text-gray-300">{{ $name }}</label>
    </div>
</div>
