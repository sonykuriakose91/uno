<div class="modal fade" id="offerlikes" role="dialog">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Likes</h4>
          </div>
        <div class="modal-body">
            <ul class="likes-sec">
                @if(count($traderOfferLikes) > 0)
                @foreach($traderOfferLikes as $key => $offerlike)
                <li>
                    <span class="reaction-btn-emo like-btn-{{ strtolower($offerlike->reaction) }}"> </span>
                    
                    <?php if($offerlike->user_type == "provider") {
                            $likeduser = $offerlike->getprovider;
                        } elseif($offerlike->user_type == "customer") {
                            $likeduser = $offerlike->getuser;
                        }
                    ?>
                    {{ $likeduser->name }}
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>

    </div>
</div>