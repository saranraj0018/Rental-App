@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h1>{{ ucfirst($section) }}</h1>

        <form action="{{ route("$section.store", ['section' => $section]) }}" method="POST">
            @csrf
            <div class="form-group editor-container">
                <!-- Toolbar container -->
                <div id="editor-toolbar"></div>
                <!-- Menu bar container (optional) -->
                <div id="editor-menu-bar"></div>
                <!-- The editable div (CKEditor content) -->
                <div required class="form-control wysiwyg" style="height: 50vh">
                    {!! !empty($item['data_values']) ? json_decode($item['data_values']) : '' !!}
                </div>
                <!-- Hidden input to store the content -->
                <input type="hidden" id="content-input" name="content"
                       value="{{ old('content', !empty($item['data_values']) ? json_decode($item['data_values']) : '') }}">
                <input type="hidden" name="{{ $section }}_id" value="{{ $item['id'] ?? 0 }}">
            </div>
             @if (in_array('others_update', getAdminPermissions()))
            <button type="submit" class="btn btn-primary">Save</button>
            @endif
        </form>
    </div>
@endsection

@section('customJs')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/decoupled-document/ckeditor.js"></script>
    <script>
        const editorConfig = {
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'heading', '|', 'fontSize', 'fontFamily',
                    'fontColor', 'fontBackgroundColor', '|', 'bold', 'italic', 'underline',
                    '|', 'link', 'insertTable', '|', 'alignment', '|', 'outdent', 'indent'
                ],
                shouldNotGroupWhenFull: false
            },
            fontFamily: {
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            heading: {
                options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                ]
            },
            link: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                decorators: {
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
            },
            placeholder: 'Type or paste your content here!'
        };
        document.querySelectorAll('.wysiwyg').forEach((element) => {
            DecoupledEditor.create(element, editorConfig)
                .then(editor => {
                    // Append the toolbar to the editor-toolbar div
                    document.querySelector('#editor-toolbar').appendChild(editor.ui.view.toolbar.element);
                    // Set up the event listener to track changes and update the hidden input
                    editor.model.document.on('change:data', () => {
                        const content = editor.getData();
                        document.querySelector('#content-input').value = content;
                    });
                    return editor;
                })
                .catch(error => console.error(error));
        });
    </script>
@endsection
