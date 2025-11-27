<h6 class="mb-3">{{ __('comment.add_title') }}</h6>
<form id="with-login-comment-form">
    {{csrf_field()}}
    <div class="mb-3">
        <textarea name="comment" id="comment" class="form-control mb-3" rows="3" cols="1" placeholder="{{ __('comment.placeholder') }}"></textarea>
    </div>

    <div class="text-right">
        <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1"></i> {{ __('comment.add_button') }}</button>
    </div>
</form>