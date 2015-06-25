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