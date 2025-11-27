<div id="comments">
    @if(session('success') || session('error'))
        @include('frontend.components.success_error_msg',['msg_value' => session('msg_value'), 'msg' => session('msg')]) 
    @endif

    <div id="respond" class="comment-respond">
        <form action="{{ route('comments.store',$blog->id) }}" method="POST" id="commentform" class="comment-form">
            @csrf
            <p class="comment-form-comment">
                <input name="name" type="text" placeholder="Name *" class="input_name_box" required>
           
                <input id="email" name="email" type="email" placeholder="Email *" class="input_email_box" required>
            </p>
            <p class="comment-form-comment" style="margin-bottom: 0px;">
                <textarea id="comment" name="comment" cols="8" rows="2" placeholder="Comment *" required></textarea>
            </p>
            
            <p class="form-submit" style="margin-bottom: 0px;">
                <input name="submit" type="submit" id="submit" class="submit" value="Post Comment">
            </p>
        </form>
        <hr style="margin-bottom: 5px;margin-top: 14px;">
        <div class="comments-section">
            @if($comments->count())
                <h3 style="margin-bottom: 10px;"> Comments - ({{ $comments->count() }})</h3>
                @foreach($comments as $comment)
                    <div class="single-comment" style="display: flex; margin-bottom: 20px;">
                        <!-- Commenter Image -->
                        <div class="commenter-image" style="margin-right: 15px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="60" fill="currentColor">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                <circle cx="12" cy="8" r="3" fill="currentColor"/>
                                <path d="M12 12c-3.33 0-6 1.67-6 4v2h12v-2c0-2.33-2.67-4-6-4z" fill="currentColor"/>
                            </svg>
                        </div>
                        
                        <!-- Comment Content -->
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author">{{ $comment->name }} &nbsp;&nbsp;</span>
                
                                <span class="comment-time">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock" style="vertical-align: middle; margin-right: 4px;">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="comment-body" style="margin-bottom: 0px;">{!! $comment->comment !!}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p style="margin-bottom: 0px;">No comments yet</p>
            @endif
        </div>
        
    </div>
</div>