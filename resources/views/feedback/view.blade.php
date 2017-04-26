@extends('layouts.app')
@section('content')
    <div class="container" id="myapp">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <h3>All Suggestions</h3>
                </div><br>
                <table class="table table-striped" style=" width : auto; table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>Suggestion Id</th>
                        <th>Suggestion</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td >{{ $d->feedback_id }} </td>
                            <td >{{ $d->feedback_text }} </td>
                            <td >{{ $d->created_at }} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
         </div>
    </div>
@endsection