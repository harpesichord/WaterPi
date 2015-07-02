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
                    <h2>Create Zone</h2>
                </div>
                <form method="post" class="addForm" role="form" action="">    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="well col-sm-offset-3 col-sm-6">
                        <div class="form-group col-lg-12 col-sm-12">
                            <div><input type="checkbox" data-off-label="Inactive" data-on-label="Active" name="active"  {{ ((!isset($data['active']) or $data['active']) ? "checked" : '') }} data-reverse></div>
                            <div class=""><input class="form-control form_text_field " id="name" name="name" placeholder="Name" value="{{ $data['name'] or ''}}" type="text" required/></div>
                            <div class=""><input class="form-control form_text_field " id="channel" name="channel" placeholder="Relay Channel" value="{{ $data['channel'] or ''}}" type="text"/></div>
                            <div class=""><textarea class="form-control" id="desc" name="desc" placeholder="Description" value="" rows="6">{{ $data['desc'] or ''}}</textarea></div>
                        </div>
                        <div class="col-sm-4 col-sm-offset-4"><p><input type="submit" id="search" name="submit" class="btn btn-lg btn-primary btn-block" value="Add Zone" /></p></div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-6">
                    @if (isset($errs) and $errs["status"])
                        <div class="alert alert-success" role="alert"><strong>Success! </strong> The zone was sussuccfully added.</div>
                    @elseif (isset($errs) and !$errs["status"])
                        <div class="alert alert-danger" role="alert"><strong>Failed! </strong> Please correct the following errors:
                        @foreach ($errs["errors"] as $err)
                            <br>{{ $err }}
                        @endforeach
                        </div>
                    @endif
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
        $(':checkbox').checkboxpicker();
    </script>
    <!-- <script src="{{ asset('') }}"></script> -->
@stop