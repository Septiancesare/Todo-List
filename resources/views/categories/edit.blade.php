@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Edit Category</h2>
    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $category->name }}" class="w-full border px-4 py-2 mb-4 rounded" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection