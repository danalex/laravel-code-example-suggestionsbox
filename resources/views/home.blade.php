@extends('layouts.app')
<style>
    .orders {
        display: block;
        float: left;
        font-family: "Open Sans", Arial;
        min-height: 305px;
    }
    .orders ul {
        width: 100%;
        color: #a6a6ac;
        font-weight: normal;
        margin: 0px;
        display: inline-block;
    }
    .orders ul li {
        width: 330px;
        float: left;
        background-color: #3b3b40;
        border-radius: 4px;
        list-style: none;
        margin: 0px 22px 22px 0px;
        padding: 0px 7px 7px 10px;
    }
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="orders">
                    <h3>{{trans('message.dashboard')}} </h3>
                    <hr>
                    {{--<h2>User Language {{Session('lang')}}</h2>
                    <h2>User Language {{App::getLocale()}}</h2>--}}
                    <h2>{{trans('message.welcome')}}</h2>
                    <ul>
                        <li>
                            <h3 class="left">{{trans('message.totalproject')}}</h3>
                            <div class="clear"></div>
                            <h1 class="left">{{$project_count}}</h1>
                        </li>
                        <li>
                            <h3 class="left">{{trans('message.totalreport')}}</h3>
                            <div class="clear"></div>
                            <h1 class="left">{{$report_count}}</h1>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <label>{{trans('message.language')}}</label>
                    <select name="language" class="form-control" id="language">
                        @foreach($languages as $key=>$l)
                            @if($key==Session('lang'))
                            <option value="{{$key}}" selected>{{$l}}</option>
                            @else
                            <option value="{{$key}}">{{$l}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
                $(document).on('change','#language',function(){
                    $.get(base_url+'changelanguage/'+$('#language').val(),function(data){
                        window.location.reload();
                    });
                });
        });
    </script>
@endsection