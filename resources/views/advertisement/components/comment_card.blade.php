<ul class="media-list">
    @foreach ($comments as $comment)
        <li class="media flex-column flex-md-row">
            <div class="mr-md-3 mb-2 mb-md-0">
                <i class="icon-reading icon-2x text-success-300 border-success-300 border-3 rounded-round p-2 mb-1 mt-1"></i>
            </div>

            <div class="media-body">
                <div class="media-title">
                    <span class="font-weight-semibold">
                        @if ($comment->customer_id && $comment->customer)
                            {{ $comment->customer->full_name }}
                        @else
                            {{ $comment->name }}
                        @endif
                    </span>
                    <span class="text-muted ml-3">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                </div>

                <p>{{$comment->comment}}</p>

                {{-- <ul class="list-inline list-inline-dotted font-size-sm">
                    <li class="list-inline-item"><a href="#">Delete</a></li>
                </ul> --}}
                @if (!$comment->comment_replies->isEmpty())
                    @foreach($comment->comment_replies as $reply)

                        <div class="media flex-column flex-md-row">
                            <div class="mr-md-3 mb-2 mb-md-0">
                                <i class="icon-reading icon-2x text-success-300 border-success-300 border-3 rounded-round p-2 mb-1 mt-1"></i>
                            </div>

                            <div class="media-body">
                                <div class="media-title">
                                    <span class="font-weight-semibold">{{$reply->customer->full_name ?? 'Krushi Marathi'}}</span>
                                    <span class="text-muted ml-3">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</span>
                                </div>

                                <p>{{$reply->comment}}</p>
                            </div>
                        </div>

                    @endforeach                    
                @endif
            </div>
        </li>
    @endforeach
</ul>