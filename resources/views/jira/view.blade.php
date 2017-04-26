@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
             <div class="col-md-12">
                 <form action="{!! url('jira/view') !!}"  method="POST" class="col-md-8" id="jira_form">
                     {{csrf_field() }}
                     <div class="form-group">
                         <label>Enter Jira Ticket Id </label>
                         <input type="text" name="ticket_id" class="form-control" >
                     </div>
                     <div class="form-group">
                         <input type="submit"  class="form-control btn-primary" >
                     </div>
                 </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.getJSON( "https://arsenaltech.atlassian.net/rest/api/2/issue/EC-9369/worklog", function( data ) {
            console.log(data);
        });
    </script>
@endsection