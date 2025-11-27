<h6 class="mb-3">{{ __('comment.add_title') }}</h6>
<form id="without-login-comment-form">
    {{csrf_field()}}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('comment.name') }}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" name="phone" id="phone" class="form-control" placeholder="{{ __('comment.phone') }}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('comment.email') }}">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <textarea name="comment" id="comment" class="form-control mb-3" rows="3" cols="1" placeholder="{{ __('comment.placeholder') }}"></textarea>
    </div>

    <div class="text-right">
        <button type="submit" class="btn bg-success"><i class="icon-plus22 mr-1"></i> {{ __('comment.add_button') }}</button>
    </div>
</form>