@extends('backend.layouts.app')

@section('title', $title = '辅导员列表')

@section('breadcrumb')
    <a href="">辅导员管理</a>
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
                            <label class="layui-form-label">邮箱</label>

                            <div class="layui-input-inline">
                                <input type="text" name="email" lay-verify="email" autocomplete="off"
                                       value="{{ $email ?? '' }}" class="layui-input">
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
                    <a href="{{ route("administrator.export.teacher") }}" class="layui-btn" form="form-article-list">导出名单</a>
                </div>
            </div>
        </div>


        <div class="layui-form">
            @if($users->count())
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="150">
                        <col width="150">
                        <col width="150">
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>姓名</th>
                        <th>照片</th>
                        <th>邮箱</th>
                        <th>年级</th>
                        <th>辅导课程</th>
                        <th>课程时间</th>
                        <th>辅导方式</th>
                        <th>个人介绍</th>
                        <th>Q1</th>
                        <th>Q2</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $user->id  }}</td>
                            <td>{{ $user->name  }}</td>
                            <td><img class="layui-upload-img" src="{{ $user->headimg  }}" id="image_image_b"
                                     style="max-width: 520px;" height="60"></td>
                            <td>{{ $user->email  }}</td>
                            <td>{{ $user->grade  }}</td>
                            <td>{!! $user->course !!}</td>
                            <td>{!! $user->time !!}</td>
                            <td>{{ $user->teach_way  }}</td>
                            <td>{{ $user->introduce  }}</td>
                            <td>{{ $user->que_one  }}</td>
                            <td>{{ $user->que_tew  }}</td>
                            <td>
                                @switch($user->is_active)
                                @case(0)
                                <a href="{{ route('administrator.teacher.edit', array('user'=>$user->id,'is_active'=>2)) }}"
                                   class="layui-btn layui-btn-sm layui-btn-normal">通过</a>
                                <a href="{{ route('administrator.teacher.edit', array('user'=>$user->id,'is_active'=>1)) }}"
                                   class="layui-btn layui-btn-sm layui-btn-danger">拒绝</a>
                                @break
                                @case(1)
                                <span>已拒绝</span>
                                @break
                                @case(2)
                                <span>已通过</span>
                                @break
                                @endswitch
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

    <div style="display: none;" id="edit-user">
        <div class="site-text site-block">
            <form action="" class="layui-form" style="margin-right:100px;">
                <input type="hidden" name="id">

                <div class="layui-form-item">
                    <label class="layui-form-label">姓名</label>

                    <div class="layui-input-block">
                        <input type="text" name="title" required lay-verify="required" placeholder="请输入标题"
                               autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>

                    <div class="layui-input-block">
                        <input type="text" name="title" required lay-verify="required" placeholder="请输入标题"
                               autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">年级</label>

                    <div class="layui-input-block">
                        <input type="text" name="title" required lay-verify="required" placeholder="请输入标题"
                               autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        layui.use(['jquery', 'layer'], function () {
            var $ = layui.jquery
                    , layer = layui.layer;
            $('.edit-user').on('click', function () {
                var form = $('#edit-user');
                var tr = $(this).parents('tr');
                form.find('input:eq(0)').val(tr.find('td:eq(0)').text());
                form.find('input:eq(1)').attr('value', tr.find('td:eq(3)').text());
                form.find('input:eq(2)').attr('value', tr.find('td:eq(4)').text());
                form.find('input:eq(3)').attr('value', tr.find('td:eq(5)').text());

                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['600px', '400px'], //宽高
                    content: form.html()
                });

            });

        });
    </script>
    @include('backend.layouts._paginate',[ 'count' => $users->total(), ])
@endsection