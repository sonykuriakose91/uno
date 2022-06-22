<div class="modal fade" id="postlikes" role="dialog">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Likes</h4>
          </div>
        <div class="modal-body">
            <ul class="likes-sec">
                @if(count($traderPostLikes) > 0)
                @foreach($traderPostLikes as $key => $postlike)
                <li>
                    <span class="reaction-btn-emo like-btn-{{ strtolower($postlike->reaction) }}"> </span>
                    
                    <?php if($postlike->user_type == "provider") {
                            $likeduser = $postlike->getprovider;
                        } elseif($postlike->user_type == "customer") {
                            $likeduser = $postlike->getuser;
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