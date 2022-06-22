<div class="modal fade" id="view_custfavourites" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Favourites</h4>
        </div>
        <div class="modal-body">
            <div class="appointment-sec" style="max-height: 250px;overflow-y: scroll;">
                <table class="table table-bordered">
                    <thead>
                        <th>Trader</th>
                        <th>Favourited Date</th>
                    </thead>
                    <tbody>
                        @if(count($favourites) > 0)
                        @foreach($favourites as $key => $favourite)
                        <tr>
                            <td><a href="{{ route('traderdetails', $favourite->gettrader->username) }}">{{ $favourite->gettrader->name }}</a></td>
                            <td>{{ date("d-m-Y h:i A",strtotime($favourite->created_at)) }}</td>
                        </tr>
                        @endforeach
                        @else
                        <p>No users favourited you.!!</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>