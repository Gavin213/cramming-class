@extends('backend.layouts.app')

@section('title', $title = '课程管理')

@section('breadcrumb')
    <a href="">系统设置</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')
    <div class="layui-main">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{$title}}</legend>
        </fieldset>

        <div class="layui-row">
            <div class="layui-col-md9">
                <form class="layui-form layui-form-pane" method="GET" action="">
                    <input type="hidden" name="type" value="">


                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">日期</label>

                            <div class="layui-input-inline">
                                <input type="text" name="time" lay-verify="required" autocomplete="off"
                                       value="{{ $time ?? '' }}" id="time" class="layui-input">
                            </div>
                            {{--<input type="hidden" name="category" value="{{$category_id}}">--}}
                            <input type="hidden" name="page" value="{{request('page',1)}}">
                            <button type="submit" class="layui-btn layui-btn-normal">搜索</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="layui-col-md3">
                <div style="float: right;">
                    <a href="{{ route("courses.create") }}" class="layui-btn" form="form-article-list">新增课程</a>
                </div>
            </div>
        </div>

        <div class="layui-form">
            @if($courses->count())
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="150">
                        <col width="150">
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>用户名</th>
                        <th>角色</th>
                        <th>邮箱</th>
                        <th>手机</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $index => $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->start.'-'.$course->end  }}</td>
                            <td>{{ $course->address  }}</td>
                            <td>{{ $course->teachers  }}</td>
                            <td>{{ $course->teachers  }}</td>
                            <td>{{ $course->students  }}</td>
                            <td>{{ $course->students  }}</td>
                            <td>{{ $course->status  }}</td>
                            <td>
                                <div class="layui-btn-group">
                                    <a href="{{ route('users.edit', $course->id) }}"
                                       class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
                                    <a href="{{ route('users.edit', $course->id) }}"
                                       class="layui-btn layui-btn-sm layui-btn-normal">查看</a>
                                    <a href="javascript:;" data-url="{{ route('users.destroy', $course->id) }}"
                                       class="layui-btn layui-btn-sm layui-btn-danger form-delete">删除</a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <form id="delete-form" action="" method="POST" style="display:none;">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                </form>
                <div id="paginate-render"></div>
            @else
                <br/>
                <blockquote class="layui-elem-quote">暂无数据!</blockquote>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        layui.use('laydate', function(){
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#time' //指定元素
            });
        });
    </script>
    @include('backend.layouts._paginate',[ 'count' => $courses->total(), ])
@endsection