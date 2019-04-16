@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.booking.title')</h3>
    <p>
        <a href="{{ route('booking.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @can('users_manage')
                           <th>user_id</th>
                           @endcan

                        <th>Pickup date and Time</th>
                        <th>Pickup Address</th>
                        <th>Dropoff Address</th>
                        <th>weight</th>
                        <th>length</th>
                        <th>width</th>
                        <th>height</th>                        
                        <th>Extra Option</th> 
                        <th>Status</th>                                         
                        <th>Price</th>         
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($bookings) > 0)
                        @foreach ($bookings as $booking)
                            <tr data-entry-id="{{ $booking->id }}">
                                <td></td>
                                @can('users_manage')
                                    <td>{{ $booking->user_name }}</td>
                                @endcan
                           

                                <td>{{ $booking->pickup_date_and_time }}</td>
                                <td>{{ $booking->pickup_address }}</td>
                                <td>{{ $booking->dropoff_address }}</td>
                                <td>{{ $booking->weight }}</td>
                                <td>{{ $booking->length }}</td>
                                <td>{{ $booking->width }}</td>
                                <td>{{ $booking->height }}</td>
                                <td>{{ $booking->extra_option }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->price }}</td>
                                
                            
                                <td>
                                    <a href="{{ route('booking.edit',[$booking->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    <a href="{{ route('booking.generateExcel',[$booking->id]) }}" class="btn btn-xs btn-info">email</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $booking->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
    </script>
@endsection