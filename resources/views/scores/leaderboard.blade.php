@extends('...layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default form-panel">
                <div class="panel-heading">Purpose Media Leaderboard</div>
                    <div class="panel-body">
                        @if (session('score_added'))
                            <div class="alert alert-success">
                                {{ Session::get('score_added') }}
                                {{ Session::put('score_added','') }}
                            </div>
                        @endif

                        @if (session('score_deleted'))
                            <div class="alert alert-success">
                                {{ Session::get('score_deleted') }}
                                {{ Session::put('score_deleted','') }}
                            </div>
                        @endif
                        <table class="leaderboard table table-bordered table-striped table-hover data-table">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Full Name</th>
                                    <th>Score</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $scores as $key =>$score )
                                <tr role="row" class="odd">
                                    <td>{{++$key}}</td>
                                    <td>{{$score->runner->fullname}}</td>
                                    <td>{{$score->score}}</td>
                                    <td>
                                    @if(Auth::user()->is('administrator'))
                                    <a href="/score/delete/{{$score->id }}/" title="Delete" class="btn-xs delete-btn"><i class="fa fa-minus-circle" aria-hidden="true"></i> </a>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default form-panel">
                <div class="panel-heading">Time Input</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/score/store">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                            <label class="col-md-4 ">Time</label>
                            <label class="col-md-4 ">Runner</label>
                            <label class="col-md-4 control-label"></label>
                        </div>

                        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="time" value="" required="required">
                            </div>
                            <div class="col-md-4">
                                 <select class="form-control" name="runner_id" required="required" >
                                    @foreach($contacts as $contact)
                                        <option value="{{$contact->id}}">{{$contact->fullname}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <button type="submit" class="btn btn-primary">
                                Input Time
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection