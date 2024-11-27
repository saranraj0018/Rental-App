@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h1>{{ ucfirst($section) }}</h1>

        <form action="{{ route("$section.store", ['section' => $section]) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea required name="content" id="content" class="form-control wysiwyg">
                    {!! !empty($item['data_values']) ? json_decode($item['data_values']) : '' !!}
                </textarea>
                <input type="hidden" name="{{ $section }}_id" value="{{ $item['id'] ?? 0 }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

@section('customJs')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('.wysiwyg').forEach((editor) => {
            ClassicEditor.create(editor).catch(error => console.error(error));
        });
    </script>
@endsection
