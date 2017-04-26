@extends('layouts.app')
@section('content')
    <div class="container" id="myapp">
        <div class="row">
    <div class="col-md-12" id="myapp" style="width: 80%;
    margin: 0 auto;">
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
            el: '#myapp',
            data: {
                report_content:[],
            },
            created: function () {
                this.report_content={!! $report[0]->report_content !!}
            }
        });
    </script>
@endsection