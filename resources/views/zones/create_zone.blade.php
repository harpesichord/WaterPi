@extends('app')

@section('styles')
    @parent
    <link href="{{ asset('/css/zones/create_zone.css') }}" rel="stylesheet">
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
                    <h2>Search Clients</h2>
                </div>
                <form method="post" class="addForm" role="form" action="">    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="well col-sm-offset-3 col-sm-6">
                        <div class="form-group col-lg-12 col-sm-12">
                            <div class=""><input class="form-control form_text_field " id="name" name="name" placeholder="Name" value="" type="text" required/></div>
                            <div class=""><input class="form-control form_text_field " id="channel" name="channel" placeholder="Relay Channel" value="" type="text"/></div>
                            <div class=""><textarea class="form-control" id="desc" name="desc" placeholder="Description" value="" rows="6"></textarea></div>
                        </div>
                        <div class="col-sm-4 col-sm-offset-4"><p><input type="submit" id="search" name="submit" class="btn btn-lg btn-primary btn-block" value="Add Zone" /></p></div>
                    </div>
                
                </form>
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