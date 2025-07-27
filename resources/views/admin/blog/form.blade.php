@csrf
@if(isset($post))
    @method('PUT')
@endif

<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control" 
            value="{{ old('title', $post->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="image" class="form-label">Cover image</label>
    <input type="file" name="image" id="image" class="form-control">
    @if(!empty($post?->image))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Обкладинка" style="max-width: 200px;">
        </div>
    @endif
</div>

<div class="mb-3">
    <label for="body" class="form-label">Text</label>
    <textarea name="body" id="body" class="form-control" rows="10">{{ old('body', $post->body ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">Create</button>
<a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Back</a>