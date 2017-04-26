@extends('layouts.app')
@section('content')
    <div class="container" id="myapp">
        <div class="row">

            @if (Session::has('message'))
                <div class="alert {{Session::get('message.type')}}"> {{ Session::get('message.msg') }}</div>
            @endif
            <div class="col-md-12">
                <div class="row">
                    <h3>Add Complain</h3>
                </div><br>
                <div class="row">
                    <div class="col-md-8">
                            <div class="row">
                                <form  method="POST" action="{{url('complain/add')}}" class="col-md-10" id="project_form">
                                    {{csrf_field() }}
                                    <div class="form-group">
                                        <label>Complain</label>
                                        <textarea name="complain_text" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Add" class="form-control btn-primary">
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
@endsection