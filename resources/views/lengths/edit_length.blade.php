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
                    <h2>Edit Zone</h2>
                </div>
                <form method="post" class="addForm" role="form" action="">    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $data['ID'] or '' }}">
                    
                    <div class="well col-sm-offset-3 col-sm-6">
                        <div class="form-group col-lg-12 col-sm-12">
                            <div class=""><input class="form-control form_text_field " id="name" name="name" placeholder="Name" value="{{ $data['NAME'] or ''}}" type="text" required/></div>
                            <div class="">
                                <select  class="form-control" name="zone">
                                    @foreach ((isset($zones) ? $zones : array()) as $zone)
                                        <option value="{{ $zone["ID"] }}" {{ ($zone["ID"] == $data["ZONE"] ? "selected" : "") }}>{{ $zone["NAME"]  }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=""><input class="form-control form_text_field " id="length" name="length" placeholder="Watering Length in Minutes" value="{{ $data['LENGTH'] or ''}}" type="text"/></div>
                            <div class=""><textarea class="form-control" id="desc" name="desc" placeholder="Description" value="" rows="6">{{ $data['DESCRIPTION'] or ''}}</textarea></div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6">
                                <input type="submit" id="save" name="save" class="btn btn-lg btn-primary btn-block" value="Update Watering Length" />
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" id="delete" name="delete" class="btn btn-lg btn-danger btn-block" value="Delete Watering Length" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-6">
                    @if (isset($errs) and $errs["status"])
                        <div class="alert alert-success" role="alert"><strong>Success! </strong> The zone was sussuccfully updated.</div>
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
    </script>
    <!-- <script src="{{ asset('') }}"></script> -->
@stop