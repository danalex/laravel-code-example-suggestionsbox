@extends('layouts.app')
@section('content')
    <div class="container" id="myapp">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <h3 style="float: left;">Add Report </h3>
                    <h3 style="float: right" >Today Date:{{date("Y-m-d")}} </h3>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <form  method="POST" class="col-md-10" id="report_form">
                                {{csrf_field() }}
                                <div class="form-group">
                                    <label>Report Name </label>
                                    <input type="text"    name="report_name" class="form-control" placeholder="Task Update 20th july 2016">
                                    <input type="hidden"  name="report_date" class="form-control" value="{{date('Y-m-d')}}">
                                    <input type="hidden"  name="user_id" class="form-control" value="{{Auth::user()->id}}">
                                </div>
                                <div class="form-group">
                                    <input type="button" value="Add Report Name" class="form-control btn-primary" v-on:click="addReport()">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <form  method="POST" class="col-md-10" id="report_content_form">
                                {{csrf_field() }}
                                <div class="form-group" style="height: 65px;">
                                    <div style="width: 50%; float: left">
                                        <label>Select Report</label>
                                        <select id="report_id" name="report_id" class="form-control" v-model="report_id" v-on:change="init2()">
                                            <option value="0">Please Select Report</option>
                                            <option v-for="r in report" v-bind:value="r.report_id">@{{r.report_name}}</option>
                                        </select>
                                    </div>
                                    <div style="width: 25%; float: left">
                                        <label>Label</label>
                                        <select name="label" class="form-control" v-model="label">
                                            <option value="1">Today</option>
                                            <option value="2">Tomorrow</option>
                                        </select>
                                    </div>
                                    <div style="width: 25%; float: right">
                                        <label>Select Project</label>
                                        <select name="project_id" class="form-control">
                                            @foreach($project as $p)
                                                <option value="{{$p->project_id}}">{{$p->project_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ticket ID</label>
                                    <input type="text" name="ticket_id" placeholder="EC-9256" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Subject </label>
                                    <textarea  name="subject" class="form-control"></textarea>
                                </div>
                                <div class="form-group" style="height: 65px;" v-show="label==1">
                                        <div style="width: 40%; float: left">
                                            <label>Percentage Completed </label>
                                            <select name="percentage" class="form-control" v-model="percentage">
                                                    @for($i=1;$i<=100;$i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        <div style="width: 40%; float: right">
                                            <label>Status </label>
                                            <select name="status" class="form-control" v-model="status">
                                                    <option value="1">In Progress</option>
                                                    <option value="2">Done</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label>@{{text}}</label>
                                    <textarea  name="notes" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="button" value="Add Report Content" class="form-control btn-primary" v-on:click="addReportContent()">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <h3>Report Preview</h3>
                </div><br>
                <b><h4>Today Updates:</h4></b>
                <table class="table table-striped">
                    <thead>
                    <tr style="background-color: #337AB7">
                        <th>Project</th>
                        <th>Ticket/Subject</th>
                        <th>%Completed</th>
                        <th>Status</th>
                        <th>Impediments/Queries/Notes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="r in report_content" v-if="r.label==1">
                            <td>@{{r.project_name}}</td>
                            <td><a v-bind:href="url+r.ticket_id" target="_blank">#@{{r.ticket_id }}</a> @{{r.subject}}</td>
                            <td>@{{r.percentage}}%</td>
                            <td>@{{r.status_value}}</td>
                            <td>@{{r.notes}}</td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <b><h4>Tomorrow Updates:</h4></b>
                <table class="table table-striped">
                    <thead>
                    <tr style="background-color: #337AB7">
                        <th>Project</th>
                        <th>Ticket/Subject</th>
                        <th>Target</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="r in report_content" v-if="r.label==2">
                        <td>@{{r.project_name}}</td>
                        <td><a v-bind:href="url+r.ticket_id" target="_blank">#@{{r.ticket_id }}</a>@{{r.subject}}</td>
                        <td>@{{r.notes}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var d=new Vue({
            el:'#myapp',
            data:{
                url:'https://arsenaltech.atlassian.net/browse/',
                label:'1',
                text:'Impediments/Queries/Notes',
                report:[],
                report_content:[],
                report_id:'0',
                status:'1',
            },
            created: function () {
                this.init();
            },
            methods: {
                init:function(){
                    $.getJSON(base_url+'report/getall', function (data) {
                        this.report=data;
                    }.bind(this));
                },
                init2:function(){
                    $.getJSON(base_url+'report/view/'+$('#report_id').val(), function (data) {
                        this.report_content=data[0].report_content;
                    }.bind(this));
                },
                addReport: function () {
                    var $this=this;
                    $.ajax({
                        url:base_url+'report/add',
                        method:"POST",
                        data:$('#report_form').serialize(),
                        success:function(e){
                            $this.init();
                        }
                    });
                },
                addReportContent:function(){
                    var $this=this;
                    $.ajax({
                       url:base_url+'report/addcontent',
                        method:'POST',
                        data:$('#report_content_form').serialize(),
                        success:function(){
                            $this.init2($this.report_id);
                        }
                    });
                }

            },
            computed:{
                text:function(){
                    if(this.label==1)
                      return 'Impediments/Queries/Notes'
                    else
                      return 'Target'
                },
                percentage:function(){
                    if(this.status==2)
                        return '100';
                    else
                        return '1';
                }
            }
        });
    </script>
@endsection