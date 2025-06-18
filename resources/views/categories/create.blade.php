@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Add Category</h2>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Category name" class="w-full border px-4 py-2 mb-4 rounded" required>
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>
@endsection