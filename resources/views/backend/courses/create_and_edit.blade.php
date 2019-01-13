@extends('backend.layouts.app')

@section('styles')
    <style>
        .layui-input {
            width: 80%;
        }
        .layui-form-label {
            width: 130px;
        }
        .layui-input-block {
            margin-left: 160px;
        }
        .week {
            margin-top: 10px;
            display: none;
        }

        @media screen and (min-width: 992px) {
            .layui-col-md-offset1{
                margin-right: 8.33333333%;
                margin-left:0;

            }
        }

    </style>
@endsection

@section('title', $title = $course->id ? '编辑课程' : '新建课程' )

@section('breadcrumb')
    <a href="">站点设置</a>
    <a href="">{{$title}}</a>
@endsection

@section('content')


    <div class="layui-main">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>{{ $title }}</legend>
        </fieldset>
        <form class="layui-form" method="POST"
              action="{{ $course->id ? route('banners.update', $course->id) : route('banners.store') }}?redirect={{ previous_url() }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" class="mini-hidden" value="{{ $course->id ? 'PUT' : 'POST' }}">

            <div class="layui-form-item">
                <label class="layui-form-label">选择课程日期</label>

                <div class="layui-input-block">
                    <input type="text" name="date" lay-verify="required" autocomplete="off" id="date"
                           placeholder="选择日期"
                           class="layui-input" value="{{ old('date',$course->date) }}">
                    <p class="week"></p>
                </div>
            </div>


            <div class="layui-form-item">
                <label class="layui-form-label">选择课程时间</label>

                <div class="layui-input-block">
                    <input type="text" name="time" lay-verify="required" autocomplete="off" id="time"
                           placeholder="选择时间(需要选择开始和结束时间)"
                           class="layui-input" value="{{ old('time',$course->time) }}">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">课程地址</label>

                <div class="layui-input-block">
                    <input type="text" name="address" lay-verify="required" autocomplete="off" placeholder="请输入地址"
                           class="layui-input" value="{{ old('address',$course->address) }}">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">辅导员</label>

                <div class="layui-input-block" style="margin-left: 150px">
                    <div class="layui-row">
                        <div class="layui-col-md2 layui-col-sm4 layui-col-md-offset1">
                            <img src="{{ asset('/mednove/images/client1.png') }}" alt="" width="100%">
                            <div class="cmdlist-text" style="text-align: center;">
                                <p style="margin-bottom: 5px;">test</p>
                                <button class="layui-btn layui-btn-sm">选他</button>
                            </div>
                        </div>
                    </div>
                    <img src="" alt="">
                </div>
            </div>


            <div class="layui-form-item" style="text-align: center;">
                {{--<div class="layui-input-block">--}}
                {{--<input type="hidden" name="parent" value="{{$parent}}">--}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
                <button type="reset" class="layui-btn layui-btn-danger">取消</button>
                {{--</div>--}}
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        layui.use(['form','jquery'], function () {
            var laydate = layui.laydate,$ = layui.jquery;

            //执行一个laydate实例
            laydate.render({
                elem: '#date', //指定元素
                done : function (value, date) {
                    searchTeacher(value);
                }
            });

            //时间范围
            laydate.render({
                elem: '#time'
                , type: 'time'
                , range: true
            });

            var searchTeacher = function (data) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                    url:'{{ route('administrator.search.teachers') }}',
                    type:'get',
                    data: {date:data},
                    success:function(data)
                    {
                        var weekday=["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
                        $('.week').text(weekday[data.week]).show();
                    }

                })
            }
        });
    </script>
@endsection