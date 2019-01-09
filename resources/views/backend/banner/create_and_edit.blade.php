@extends('backend.layouts.app')

@section('title', $title = $banner->id ? '编辑banner' : '新建banner' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">内容管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')


    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>
        <form class="layui-form layui-form-pane" method="POST"
              action="{{ $banner->id ? route('banners.update', $banner->id) : route('banners.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $banner->id ? 'PUT' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">Banner名称</label>

                <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="" autocomplete="off" placeholder="请输入名称"
                           class="layui-input" value="{{ old('name',$banner->name) }}">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">Banner链接</label>

                <div class="layui-input-block">
                    <input type="text" name="url" lay-verify="" autocomplete="off" placeholder="请输入链接"
                           class="layui-input" value="{{ old('link',$banner->url) }}">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">上传Banner</label>

                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="upload_bg">上传Banner</button>
                        <input type="hidden" name="b_url_id" id="b_url_id" lay-verify="img"
                               value="{{ old('image',$banner->img) }}"/>

                        <div class="layui-upload-list">
                            <img class="layui-upload-img" src="{{ $banner->getImage('img') }}" id="image_image_b"
                                 style="max-width: 520px;" _height="280">
                        </div>
                    </div>
                </div>
            </div>

            @if($banner->id)
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">状态</label>

                    <div class="layui-input-block">
                        <input type="radio" name="status" lay-skin="primary" value="0" title="禁用"
                               @if($banner->status == '0') checked="" @endif >
                        <input type="radio" name="status" lay-skin="primary" value="1" title="启用"
                               @if($banner->status == '1') checked="" @endif >
                    </div>
                </div>
            @else
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">状态</label>

                    <div class="layui-input-block">
                        <input type="radio" name="status" lay-skin="primary" value="1" checked="" title="保存">
                        <input type="radio" name="status" lay-skin="primary" value="2" title="发布">
                    </div>
                </div>
            @endif

            <div class="layui-form-item">
                {{--<div class="layui-input-block">--}}
                {{--<input type="hidden" name="parent" value="{{$parent}}">--}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                {{--</div>--}}
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        layui.use(['upload', 'form'], function () {
            var form = layui.form;
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#upload_bg' // 绑定元素
                , url: '{{ route('upload.image') }}?folder=banner&object_id={{$banner->id ?? 0}}' // 上传接口
                , field: 'upload_file'
                , done: function (res) {
                    if (res.success == true) {
                        $("#b_url_id").val(res.file_uri);
                        $("#image_image_b").attr("src", res.file_path);
                    } else {
                        layer.alert('上传失败，请重试!', 2);
                    }
                    //上传完毕回调
                    console.log(res);
                }
                , error: function () {
                    //请求异常回调
                    layer.alert('上传失败，请重试!', 2);
                }
            });
            form.verify({
                img: function (value) {
                    if (value.length < 1) {
                        return '请上传图片';
                    }
                }
            });

            form.render();
        });
    </script>
@endsection