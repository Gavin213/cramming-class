@extends('backend.layouts.app')

@section('title', $title = '用户列表')

@section('breadcrumb')
    <a href="">系统设置</a>
    <a href="">用户</a>
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
                                    <input type="text" name="email" lay-verify="email" autocomplete="off" value="{{ $email ?? '' }}" class="layui-input">
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
                    <button class="layui-btn" form="form-article-list">导出名单</button>
                </div>
            </div>
        </div>




        <div class="layui-form">
            @if($users->count())
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="150">
                        <col width="150">
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>微信昵称</th>
                        <th>微信头像</th>
                        <th>姓名</th>
                        <th>邮箱</th>
                        <th>年级</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $user->nickname  }}</td>
                            <td><img class="layui-upload-img" src="{{ $user->avatar  }}" id="image_image_b"
                                     style="max-width: 520px;" height="60"></td>
                            <td>{{ $user->name  }}</td>
                            <td>{{ $user->email  }}</td>
                            <td>{{ $user->grade  }}</td>
                            <td>
                                <div class="layui-btn-group">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="layui-btn layui-btn-sm layui-btn-normal">编辑</a>
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
    <script type="text/javascript">
       
    </script>
    @include('backend.layouts._paginate',[ 'count' => $users->total(), ])
@endsection