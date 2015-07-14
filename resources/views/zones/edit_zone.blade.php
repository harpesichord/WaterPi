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
                    <input type="hidden" name="id" value="{{ $data['id'] or '' }}">
                    <div class="well col-sm-offset-2 col-sm-8">
                        <div class="form-group col-lg-12 col-sm-12">
                            <div><input type="checkbox" data-off-label="Inactive" data-on-label="Active" name="active"  {{ ((!isset($data['active']) or $data['active']) ? "checked" : '') }} data-reverse></div>
                            <div class=""><input class="form-control form_text_field " id="name" name="name" placeholder="Name" value="{{ $data['name'] or ''}}" type="text" required/></div>
                            <div class=""><input class="form-control form_text_field " id="channel" name="channel" placeholder="Relay Channel" value="{{ $data['relay'] or ''}}" type="text"/></div>
                            <div class=""><textarea class="form-control" id="desc" name="desc" placeholder="Description" value="" rows="6">{{ $data['desc'] or ''}}</textarea></div>
                            <div><h4>Flow Rate: </h4><span id="flow">{{ $data["flowRate"] or 0.0000 }}</span><span> gallons/minute (gpm)</span></div>
                        </div>
                        <div class="form-group col-lg-12 col-sm-12"><hr></div>
                        <div class="form-group col-lg-12 col-sm-12">
                            <h4>Flow Rates</h4>
                            <p>To calculate the flow rate of your zone fill in the information below for each different type of head you use.</p>
                            <a class="btn btn-info addFlowRate" href="#" id="addFlowRate">Add Flow Rate</a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="flowRates">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td>Nozzel Diameter</td>
                                            <td>Water Pressure</td>
                                            <td>Head Quantity</td>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ((isset($data["rates"]) ? $data["rates"] : array()) as $rate)
                                            @include('zones.flow_rate', ['rate' => $rate])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="col-sm-6">
                                <input type="submit" id="save" name="save" class="btn btn-lg btn-primary btn-block" value="Update Zone" />
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" id="delete" name="delete" class="btn btn-lg btn-danger btn-block" value="Delete Zone" />
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
        $(':checkbox').checkboxpicker();
    </script>
    <script src="{{ asset('/js/zone/zones.js') }}"></script>
@stop