@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row heading">
        <div class="col-xs-12">
            @role('administrator')
                <a href="/contacts/create/" class="btn btn-success pull-right"> Create a new runner</a>
            @endrole
            <h1><i class="fa fa-user" aria-hidden="true"></i> <span>Runners</span> </h1>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">


                <div class="panel-body">
                    <div class="row">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover data-table" >
                                <thead>
                                <tr>
                                    <th>Name </th>
                                    <th>Email </th>
                                    <th>Telephone </th>
                                    <th width="120">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach( $contacts as $contact )
                                        <tr>
                                            <td>{{$contact->fullname}}</td>
                                            <td>{{$contact->email}}</td>
                                            <td>{{$contact->telephone}} </td>

                                            @if(Auth::user()->is('administrator'))
                                             <td>
                                                <div class="table-btn">

                                                    <a href="/contacts/{{$contact->id}}/edit/" title="Edit" class="btn-xs"> <i class="fa fa-edit" aria-hidden="true"></i></a>
                                                    @if(Auth::user()->is('administrator'))
                                                    <a href="/contacts/delete/{{$contact->id }}/" title="Delete" class="btn-xs delete-btn"><i class="fa fa-minus-circle" aria-hidden="true"></i> </a>
                                                    @endif
                                                </div>
                                            </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ( !$contacts->count() )
                        <div class="no-data-message">
                            Sorry, there are currently no labs. &nbsp;
                            <a href="/labs/create/" class="btn btn-success btn-xs">
                                Create a new lab <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
