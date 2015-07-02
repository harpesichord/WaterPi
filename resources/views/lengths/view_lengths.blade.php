@extends('app')

@section('styles')
    @parent
    <link href="{{ asset('/css/zones/view_zones.css') }}" rel="stylesheet">
    <style>
        .glyphicon.tableglyph {
            font-size: xx-large;
        }
    </style>
@stop

@section('navbar')
    @parent
@stop

@section('content')
		<div class="container">
			<div class="body" id="body">
				<div class="title text-center" style="margin-bottom:20px;">
                    <h2>View Watering Lengths</h2>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped" id="lengths">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Zone</td>
                                    <td>Length</td>
                                    <td>Description</td>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ((isset($data) ? $data : array()) as $length)
                                    <tr>
                                        <td><a href="{{ url('/lengths/view/' . $length["ID"]) }}">{{ $length["NAME"] }}</a></td>
                                        <td><a href="{{ url('/zones/view/' . $length["Zone"]["ID"]) }}">{{ $length["Zone"]["NAME"] }}</a></td>
                                        <td>{{ $length["LENGTH"] }}</td>
                                        <td>{{ $length["DESCRIPTION"] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
@endsection

@section('scripts')
    @parent
    <script>
        var BASE = '<?php echo Request::root(); ?>/';
        var _globalObj = {!! json_encode(array('_token'=> csrf_token())) !!}
    </script>
    <!-- <script src="{{ asset('') }}"></script> -->
@stop