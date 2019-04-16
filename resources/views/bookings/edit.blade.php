@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>
    
    {!! Form::model($booking, ['method' => 'PUT', 'route' => ['booking.update', $booking->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Pickup Date and Time', 'pickup_date_and_time*', ['class' => 'control-label']) !!}
                    <input type="datetime-local" name="pickup_date_and_time" class="form-control" required="true" value="{{ $booking->pickup_date_and_time }}">
                    <p class="help-block"></p>
                    @if($errors->has('pickup_date_and_time'))
                        <p class="help-block">
                            {{ $errors->first('pickup_date_and_time') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Pickup Address', 'pickup_address*', ['class' => 'control-label']) !!}
                    <input type="text" name="pickup_address" class="form-control" required="true" value="{{ $booking->pickup_address }}">
                    
                    <p class="help-block"></p>
                    @if($errors->has('pickup_address'))
                        <p class="help-block">
                            {{ $errors->first('pickup_address') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Dropoff Address', 'drop_address*', ['class' => 'control-label']) !!}
                    <input type="text" name="dropoff_address" class="form-control" required="true" value="{{ $booking->dropoff_address }}">
                    <p class="help-block"></p>
                    @if($errors->has('drop_address'))
                        <p class="help-block">
                            {{ $errors->first('drop_address') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="row">
                    {!! Form::label('Package Details', ' package_details', ['class' => 'control-label']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('Weight', 'weight*', ['class' => 'control-label']) !!}
                            <input type="number" name="weight" class="form-control" required="true" value="{{ $booking->weight }}">

                    <p class="help-block"></p>
                    @if($errors->has('weight'))
                        <p class="help-block">
                            {{ $errors->first('weight') }}
                        </p>
                    @endif
                    </div>
                    <div class="col-md-3">
                    {!! Form::label('Height', 'height*', ['class' => 'control-label']) !!}
                    <input type="number" name="height" class="form-control" required="true" value="{{ $booking->height }}">
                    <p class="help-block"></p>
                    @if($errors->has('height'))
                        <p class="help-block">
                            {{ $errors->first('height') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-3">
                    {!! Form::label('length', 'Length*', ['class' => 'control-label']) !!}
                    <input type="number" name="length" class="form-control" required="true" value="{{ $booking->length }}">
                    <p class="help-block"></p>
                    @if($errors->has('length'))
                        <p class="help-block">
                            {{ $errors->first('length') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-3">
                    {!! Form::label('Width', 'Width*', ['class' => 'control-label']) !!}
                   <input type="number" name="width" class="form-control" required="true" value="{{ $booking->width }}">
                    <p class="help-block"></p>
                    @if($errors->has('width'))
                        <p class="help-block">
                            {{ $errors->first('width') }}
                        </p>
                    @endif
                </div>
                
                    </div>
                    <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Extra Field', 'extra_Field', ['class' => 'control-label']) !!}
                    <input type="text" name="extra_option" class="form-control"  value="{{ $booking->extra_field }}">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Status', 'Status*', ['class' => 'control-label']) !!}
                    <input type="text" name="status" class="form-control" required="true" value="{{ $booking->status }}">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Price', 'price*', ['class' => 'control-label']) !!}
                    <input type="text" name="price" class="form-control" required="true" value="{{ $booking->price }}">
                    
                </div>
            </div>
                    </div>
            </div>
    </div>
</div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

