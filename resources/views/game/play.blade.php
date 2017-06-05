@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Play ! Choose your Level</div>
                <div class="panel-body">
                    <a class="btn btn-warning start_game" href="#" data-level="beginner">Beginner</a>
                    <a class="btn btn-primary start_game" href="#" data-level="intermediate">Intermediate</a>
                    <a class="btn btn-danger start_game" href="#" data-level="advanced">Advanced</a>
                    <a class="btn btn-success" href="#" data-level="custom" data-toggle="modal" data-target="#myModal">Custom</a>
                    <a class="btn btn-info" href="#" data-toggle="modal" data-target="#help">Help</a>
                </div>
                @include('game.custom')
                @include('game.help')
                <div id="minesweeper_grid"></div>
            </div>
        </div>
    </div>

{{-- Load Grid Game --}}
{!! Form::open(['route' => ['game.get_minesweeper'], 'method' => 'POST','id'=>'form-get-minesweeper' ])!!}
        {!! Form::hidden('minesweeper_x', null, ['id' => 'minesweeper-x']) !!}
        {!! Form::hidden('minesweeper_y', null, ['id' => 'minesweeper-y']) !!}
        {!! Form::hidden('minesweeper_mines', null, ['id' => 'minesweeper-mines']) !!}
{!! Form::close() !!}

{{-- Select coordinate in grid --}}
{!! Form::open(['route' => ['game.select_coordinate'], 'method' => 'POST','id'=>'form-select-coordinate' ])!!}
        {!! Form::hidden('x', null, ['id' => 'x']) !!}
        {!! Form::hidden('y', null, ['id' => 'y']) !!}
        {!! Form::hidden('token', null, ['id' => 'token']) !!}
{!! Form::close() !!}

@endsection

@section('scripts')
    <script type="text/javascript">
        var mine_picture = "{{ asset('mina.png') }}";
    </script>
    <script src="{{ asset('js/lib/game.js') }}"></script>    
@endsection
