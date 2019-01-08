@extends('backend.layouts.app')

@section('title', $title = 'banner列表')

@section('breadcrumb')
    <a href="">内容管理</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <a href="{{ route('banners.create') }}" class="layui-btn">添加</a>
        <button class="layui-btn layui-btn-danger" form="form-category-list">排序</button>

        <div class="layui-form">
            @if(count($banners))
                <form name="form-article-list" id="form-category-list" class="layui-form layui-form-pane" method="POST" action="{{route('banners.order')}}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="layui-table">
                        <colgroup>
                            <col width="50">
                            <col width="85">
                            <col>
                            <col width="85">
                            <col width="300">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>排序</th>
                            <th>描述</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $index => $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>
                                    <input type="hidden" name="id[]" value="{{$banner->id}}">
                                    <input type="tel" name="order[]" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $banner->order  }}">
                                </td>
                                <td>{{ $banner->description}}</td>
                                <td>@if($banner->status == 1) 启用 @else 停用 @endif</td>
                                <td>
                                    <a href="{{ route('banners.edit', [$banner->id]) }}" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                    <a href="javascript:;" data-url="{{ route('banners.destroy', [$banner->id]) }}" class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                <form id="delete-form" action="" method="POST" style="display:none;">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                </form>
                <div id="paginate-render"></div>
            @else
                <br />
                <blockquote class="layui-elem-quote">暂无数据!</blockquote>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    @include('backend.layouts._paginate',[ 'count' => $banners->total(), ])
@endsection