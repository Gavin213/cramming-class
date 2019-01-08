{{--<script type="text/javascript"  src="{{ asset('plugins/wang/release/wangEditor.js') }}"></script>--}}

{{--<script>--}}
    {{--var E = window.wangEditor--}}
    {{--var editor = new E('#editor');--}}
    {{--var content = '{!! $content !!}';--}}
    {{--var $text1 = $('.editor');--}}
    {{--editor.customConfig.onchange = function (html) {--}}
        {{--// 监控变化，同步更新到 textarea--}}
        {{--$text1.val(html)--}}
    {{--}--}}
    {{--editor.customConfig.uploadImgServer = '{{ route('upload.image') }}?folder={{$folder}}&editor=1&object_id={{$object_id ?? 0}}';--}}
    {{--editor.customConfig.uploadImgParams = {--}}
        {{--_token: '{{ csrf_token() }}',--}}
        {{--ename:'wang'--}}
    {{--}--}}
    {{--editor.customConfig.uploadFileName = 'upload_file';--}}
    {{--editor.create();--}}
    {{--editor.txt.html(content);--}}
{{--</script>--}}

<div name="content" id="editor">
    <p></p>
</div>
<script src="{{ asset('plugins/ckeditor/build/ckeditor.js') }}"></script>
<script>
    var data;
//    CKEDITOR.editorConfig = function( config ) {
//        config.enterMode = CKEDITOR.ENTER_BR;
//    };
    ClassicEditor.create(document.querySelector('#content'), {
                toolbar:['heading','|','alignment','bold','italic','link','bulletedList','numberedList','imageUpload','blockQuote','undo','redo'],
                language: 'zh-cn', //设置中文
                ckfinder: {
                    uploadUrl: '{{ route('upload.image') }}?folder={{$folder}}&editor=1&object_id={{$object_id ?? 0}}&_token={{ csrf_token() }}&ename=ckeditor',
                }
            }
    ).then(editor => {
        window.editor = editor;
    data = editor.getData();
    console.log(data);
    } )
    .catch(error => {
        console.log(error);
    } );
</script>