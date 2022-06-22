<div class="modal fade" id="changetraderpost" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Trader Post</h4>
        </div>
        <div class="modal-body">
            <div class="appointment-sec">
                <form class="form-horizontal" action="{{ route('traderupdatetraderpost',$traderPost->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')                
                <label>Post Title</label>
                <input type="text" value="{{ $traderPost->title }}" required name="post_title" placeholder="Post Title">
                <label>Post Content</label>
                <textarea name="post_content" required placeholder="Want share something?">{!! html_entity_decode($traderPost->post_content) !!}</textarea>
                @if(count($traderPost->traderpostimages) > 0)
                    <div class="form-group row">
                        <label for="name1" class="col-md-3 col-form-label">Trader Post Images:</label>
                        @foreach($traderPost->traderpostimages as $ke => $image)
                          <div class="col-md-4">
                            <div class="check-sec">
                                <label class="chk">Remove
                                    <input type="checkbox" name="removeImg[]" value="{{ $image->id }}" >
                                    <span class="checkmark"></span>
                                  </label>
                            </div>
                            <img style="width: 100%;" src="{{ asset('uploads/providers/traderposts/'.$image->post_image) }}" class="img-fluid mb-2" alt="Post Image"/>
                          </div>
                        @endforeach
                    </div>
                    @endif
                    <label>Images:</label>
                    <input type="file" class="image-files" title="Upload" name="post_images[]" multiple>
                <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>