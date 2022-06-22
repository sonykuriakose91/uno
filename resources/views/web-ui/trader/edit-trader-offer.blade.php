<div class="modal fade" id="changetraderoffer" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Trader Post</h4>
        </div>
        <div class="modal-body">
            <div class="appointment-sec">
                <form class="form-horizontal" action="{{ route('traderupdatetraderoffer',$traderOffer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')    
                <label>Product Title</label>
                <input type="text" value="{{ $traderOffer->title }}" required name="product_title" placeholder="Product Title">  
                <label>Description</label>
                <textarea required name="description" placeholder="Description">{{ $traderOffer->description }}</textarea> 
                <label>Full Price</label>
                <input type="text" value="{{ $traderOffer->full_price }}" required name="full_price" placeholder="Full Price">  
                <label>Discount Price</label>
                <input type="text" value="{{ $traderOffer->discount_price }}" required name="discount_price" placeholder="Discount Price">
                <h5>Valid from</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label>Date</label>
                            <input type="date" value="{{ date('Y-m-d',strtotime($traderOffer->valid_from)) }}" required name="valid_from_date" placeholder="Date">
                        </div>
                        <div class="col-md-6">
                            <label>Time</label>
                            <input type="time" value="{{ date('H:i',strtotime($traderOffer->valid_from)) }}" required name="valid_from_time" placeholder="Time">
                        </div>
                    </div>
                </div>
                <h5>Valid to</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label>Date</label>
                            <input type="date" value="{{ date('Y-m-d',strtotime($traderOffer->valid_to)) }}" required name="valid_to_date" placeholder="Date">
                        </div>
                        <div class="col-md-6">
                            <label>Time</label>
                            <input type="time" value="{{ date('H:i',strtotime($traderOffer->valid_to)) }}" required name="valid_to_time" placeholder="Time">
                        </div>
                    </div>
                </div>
                @if(count($traderOffer->traderofferimages) > 0)
                    <div class="form-group row">
                        <label for="name1" class="col-md-3 col-form-label">Trader Offer Images:</label>
                        @foreach($traderOffer->traderofferimages as $ke => $offerimage)
                          <div class="col-md-4">
                            <div class="check-sec">
                                <label class="chk">Remove
                                    <input type="checkbox" name="removeofferImg[]" value="{{ $offerimage->id }}" >
                                    <span class="checkmark"></span>
                                  </label>
                            </div>
                            <img style="width: 100%;" src="{{ asset('uploads/providers/traderoffers/'.$offerimage->offer_image) }}" class="img-fluid mb-2" alt="Offer Image"/>
                          </div>
                        @endforeach
                    </div>
                    @endif
                    <label>Images:</label>
                    <input type="file" class="image-files" name="offer_images[]" multiple>
                <button type="submit" class="btn-s">Update</button>  
                </form>
            </div>
        </div>
    </div>
    </div>
</div>