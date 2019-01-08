<script type="text/javascript"  src="{{ asset('plugins/editor/js/module.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/hotkeys.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/uploader.js') }}"></script>
<script type="text/javascript"  src="{{ asset('plugins/editor/js/simditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/editor/simditor-html-master/vendor/bower/js-beautify/js/lib/beautify-html.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/editor/simditor-html-master/lib/simditor-html.js') }}"></script>

<script>
    $(".editor").each(function(){
        new Simditor({
            textarea: $(this),
            toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough','fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment', '|', 'html'],
            upload: {
                url: '{{ route('upload.image') }}?folder={{$folder}}&editor=1&object_id={{$object_id ?? 0}}',
                params: { _token: '{{ csrf_token() }}' },
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            pasteImage: true,
            tabIndent: true,
            allowedTags:['div','br', 'span', 'a', 'img', 'b', 'strong', 'i', 'strike', 'u', 'font', 'p', 'ul', 'ol', 'li', 'blockquote', 'pre', 'code', 'h1', 'h2', 'h3', 'h4', 'hr'],
            allowedStyles:{
                div:['font-size','font-family','color','float','display','flex-direction','flex-wrap','flex-flow','justify-content','align-items','align-content','width','height'],
                table:['table']
            }
        });
    });
</script>