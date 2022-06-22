<table class="table table-bordered table-hover">
	<thead>
		<th>Sl.No</th>
		<th>Location</th>
        <th>Latitude</th>
        <th>Longitude</th>
		<th>Status</th>
		<th>#</th>
	</thead>
	<tbody>
		@if($service_locations)
		@foreach ($service_locations as $k => $service_loc)
		<tr>
			<td> {{ ++$k }} </td>
			<td>{{ $service_loc->location }}</td>
            <td>{{ $service_loc->latitude }}</td>
            <td>{{ $service_loc->longitude }}</td>
			<td>{{ ($service_loc->status == 1) ? "Approved" : (($service_loc->status == -1)?"Rejected":"Pending") }}</td>
			<td>
                @if($service_loc->status == 0 || $service_loc->status == -1)
                  <a class="btn btn-xs btn-primary change_service_loc_status" data-type="enable" data-id="{{ $service_loc->id }}">Enable</a>
                @elseif($service_loc->status == 1)
                  <a class="btn btn-xs btn-danger change_service_loc_status" data-type="disable" data-id="{{ $service_loc->id }}">Disable</a>
                @endif
			</td>
		</tr>
		@endforeach
		@endif
	</tbody>
</table>