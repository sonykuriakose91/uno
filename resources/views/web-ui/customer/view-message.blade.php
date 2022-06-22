<div class="modal fade" id="messagetrader" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
        </div>
        <div class="modal-body">
            <div class="appointment-sec">
                <p>{{ $message->message }}</p>
                <form class="form-horizontal" autocomplete="off" id="message_trader">
                @csrf             
                <input type="hidden" name="from_user_type" value="customer" >
                <input type="hidden" name="from_user_id" value="{{ Auth::guard('web')->user()->user_id }}" >
                <input type="hidden" name="to_user_type" value="{{ $message->from_user_type }}" >
                <input type="hidden" name="to_user_id" value="{{ $message->from_user_id }}">
                <textarea name="message" required placeholder="Message"></textarea>
                <button>Send</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>