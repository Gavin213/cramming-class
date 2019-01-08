<script type="text/javascript"  src="{{ asset('plugins/wang/release/wangEditor.js') }}"></script>

<script>
    var E = window.wangEditor
    var editor = new E('#editor');
    var content = '{!! $content !!}';
    var $text1 = $('.editor');
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $text1.val(html)
    }
    editor.customConfig.uploadImgServer = '{{ route('upload.image') }}?folder={{$folder}}&editor=1&object_id={{$object_id ?? 0}}';
    editor.customConfig.uploadImgParams = {
        _token: '{{ csrf_token() }}',
        ename:'wang'
    }
    editor.customConfig.uploadFileName = 'upload_file';
    editor.create();
    editor.txt.html(content);
</script>