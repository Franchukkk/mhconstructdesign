@csrf
@if(isset($post))
    @method('PUT')
@endif

<div class="mb-3">
    <label for="title" class="form-label">Заголовок</label>
    <input type="text" name="title" id="title" class="form-control" 
            value="{{ old('title', $post->title ?? '') }}" required>
</div>

<!-- <div class="mb-3">
    <label for="slug" class="form-label">Slug (URL)</label>
    <input type="text" name="slug" id="slug" class="form-control" 
            value="{{ old('slug', $post->slug ?? '') }}">
</div> -->

<div class="mb-3">
    <label for="image" class="form-label">Обкладинка (файл)</label>
    <input type="file" name="image" id="image" class="form-control">
    @if(!empty($post?->image))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Обкладинка" style="max-width: 200px;">
        </div>
    @endif
</div>

<div class="mb-3">
    <label for="body" class="form-label">Текст</label>
    <textarea name="body" id="body" class="form-control" rows="10">{{ old('body', $post->body ?? '') }}</textarea>
</div>

<!-- <div class="mb-3">
    <label for="meta_title" class="form-label">Meta Title</label>
    <input type="text" name="meta_title" id="meta_title" class="form-control" 
            value="{{ old('meta_title', $post->meta_title ?? '') }}">
</div>

<div class="mb-3">
    <label for="meta_description" class="form-label">Meta Description</label>
    <textarea name="meta_description" id="meta_description" class="form-control">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
</div> -->

<button type="submit" class="btn btn-primary">Зберегти</button>
<a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Назад</a>