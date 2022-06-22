<div class="modal fade" id="view_favourites" role="dialog">
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
                        <th>Name</th>
                        <th>Favourited Date</th>
                    </thead>
                    <tbody>
                        @if(count($favourites) > 0)
                        @foreach($favourites as $key => $favourite)
                        <tr>
                            <td>
                                <?php echo ($favourite->user_type == "customer") ? $favourite->getcustomer->name :"<a href='./details/$favourite->user_id'>". $favourite->getfromtrader->name."</a>"; ?>
                                {{ ($favourite->user_type == "provider")?" (Trader)":" (Customer)" }}</td>
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