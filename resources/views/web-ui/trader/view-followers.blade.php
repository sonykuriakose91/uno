<div class="modal fade" id="view_followers" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Followers</h4>
        </div>
        <div class="modal-body">
            <div class="appointment-sec" style="max-height: 250px;overflow-y: scroll;">
                <table class="table table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Followed Date</th>
                    </thead>
                    <tbody>
                        @if(count($follows) > 0)
                        @foreach($follows as $key => $follow)
                        <tr>
                            <td><?php echo ($follow->user_type == "customer") ? $follow->getcustomer->name :"<a href='./details/$follow->user_id'>". $follow->getfromtrader->name."</a>"; ?>
                            {{ ($follow->user_type == "provider")?" (Trader)":" (Customer)" }}</td>
                            <td>{{ date("d-m-Y h:i A",strtotime($follow->created_at)) }}</td>
                        </tr>
                        @endforeach
                        @else
                        <p>No followers.!!</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>