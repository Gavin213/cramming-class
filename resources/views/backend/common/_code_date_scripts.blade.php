<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate.render({
            elem: '#created_at'
            ,value: '{{ $date }}'
            ,isInitValue: true,
            type: 'datetime'
        });
    })
</script>