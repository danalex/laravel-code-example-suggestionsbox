@extends('layouts.app')
@section('content')
    <div class="container" id="myapp">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <h3 style="float: left;">View Report</h3>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <form  method="POST" class="col-md-10" id="report_form">
                                {{csrf_field() }}
                                <div class="form-group">
                                        <input type="hidden"  name="user_id" class="form-control" value="{{Auth::user()->id}}" id="user_id">
                                       <div style="width: 40%; float: left">
                                            <label>Select Your Report Name</label>
                                            <select  id="report_id" name="report_id" class="form-control" v-on:change="init2()">
                                                <option value="0">Please Select Report</option>
                                                <option v-for="r in report" v-bind:value="r.report_id">@{{r.report_name}}</option>
                                            </select>
                                        </div>
                                        <label>OR</label>
                                        <div style="width: 40%; float: right">
                                            <label>Select Date</label>
                                            <input type="date" v-on:change="init3()" class="form-control" id="report_date">
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <br>
                <div class="form-group">
                    <input type="text" class="form-control" v-model="report_link">
                </div>
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
                        <td>@{{r.subject}}</td>
                        <td>@{{r.percentage}}</td>
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
                        <td>@{{r.subject}}</td>
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
                report:[],
                report_content:[],
                report_link:''
            },
            created: function () {
                this.init();
            },
            methods: {
                init:function(){
                    $.getJSON(base_url+'report/getall/', function (data) {
                        this.report=data;
                    }.bind(this));
                },
                init2:function(){
                    $.getJSON(base_url+'report/view/'+$('#report_id').val(), function (data) {
                        console.log(data);
                        if( data.length > '0') {
                            this.report_content = data[0].report_content;
                            this.report_link = base_url +'report/id/'+$('#report_id').val()+'/'+$('#user_id').val();
                        } else{
                            this.report_content = [];
                            this.report_link='No Report Found on This ID';
                        }
                    }.bind(this));
                },
                init3:function(val){
                    $.getJSON(base_url+'report/viewbydate/'+$('#report_date').val(), function (data) {

                        if( data.length > '0') {
                            this.report_content = data[0].report_content;
                            this.report_link = base_url +'report/date/'+$('#report_date').val()+'/'+$('#user_id').val();
                        }
                        else{
                            this.report_content = [];
                            this.report_link='No Report Found on This Date';
                        }
                    }.bind(this));
                }
            }
        });
    </script>
@endsection