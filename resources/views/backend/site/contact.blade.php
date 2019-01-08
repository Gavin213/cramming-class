@extends('backend.layouts.app')

@section('title', $title = '联系方式' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">{{$title}}</a>
@endsection
@section('content')
    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>

        <form class="layui-form layui-form-pane" method="POST" action="{{route('administrator.site.contact')}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="POST">

            <div class="layui-form-item">
                <label class="layui-form-label">联系人</label>
                <div class="layui-input-block">
                    <input type="text" name="contacts" lay-verify="" autocomplete="off" placeholder="联系人" class="layui-input" value="{{ get_value($site, 'contacts') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">电话</label>
                <div class="layui-input-block">
                    <input type="text" name="phone" lay-verify="" autocomplete="off" placeholder="电话" class="layui-input" value="{{ get_value($site, 'phone') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">传真</label>
                <div class="layui-input-block">
                    <input type="text" name="fax" lay-verify="" autocomplete="off" placeholder="传真" class="layui-input" value="{{ get_value($site, 'fax') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">Email</label>
                <div class="layui-input-block">
                    <input type="text" name="email" lay-verify="" autocomplete="off" placeholder="Email" class="layui-input" value="{{ get_value($site, 'email') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">QQ</label>
                <div class="layui-input-block">
                    <input type="text" name="qq" lay-verify="" autocomplete="off" placeholder="QQ" class="layui-input" value="{{ get_value($site, 'qq') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">微信</label>
                <div class="layui-input-block">
                    <input type="text" name="weixin" lay-verify="" autocomplete="off" placeholder="微信" class="layui-input" value="{{ get_value($site, 'weixin') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">微博</label>
                <div class="layui-input-block">
                    <input type="text" name="weibo" lay-verify="" autocomplete="off" placeholder="微博" class="layui-input" value="{{ get_value($site, 'weibo') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">旺旺</label>
                <div class="layui-input-block">
                    <input type="text" name="wangwang" lay-verify="" autocomplete="off" placeholder="旺旺" class="layui-input" value="{{ get_value($site, 'wangwang') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">网址</label>
                <div class="layui-input-block">
                    <input type="text" name="site" lay-verify="" autocomplete="off" placeholder="网址" class="layui-input" value="{{ get_value($site, 'site') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">地址</label>
                <div class="layui-input-block">
                    <input type="text" name="address" lay-verify="" autocomplete="off" placeholder="地址" class="layui-input" value="{{ get_value($site, 'address') }}" >
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="upload_thumb">二维码</button>
                    <input type="hidden" name="qrcode" id="form_thumb" value="{{ old('image',get_value($site, 'qrcode')) }}" />
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" src="{{ get_value($site, 'qrcode') ? Storage::url(get_value($site, 'qrcode')) : ''}}" id="image_image" style="max-width: 520px;" _height="280">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                {{--</div>--}}
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        layui.use(['upload','form'], function(){
            var form = layui.form;
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#upload_thumb' // 绑定元素
                ,url: '{{ route('upload.image') }}?folder=contact' // 上传接口
                ,field: 'upload_file'
                ,done: function(res){
                    if(res.success == true){
                        $("#form_thumb").val(res.file_uri);
                        $("#image_image").attr("src",res.file_path);
                    }
                    //上传完毕回调
                    console.log(res);
                }
                ,error: function(){
                    //请求异常回调
                    layer.alert('上传失败，请重试!', 2);
                }
            });

            form.render();
        });

    </script>
@endsection