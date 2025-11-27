<form id="quotes-requirement-form">
    {{csrf_field()}}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('comment.name') }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" name="phone" id="phone" class="form-control" placeholder="{{ __('comment.phone') }}">
            </div>
        </div>
    </div>

    <div class="mb-1">
        <textarea name="requirement" id="requirement" class="form-control" rows="3" cols="1" placeholder="{{ __('home.requirement_placeholder') }}"></textarea>
    </div>

    <div class="text-right">
        <button type="submit" class="btn bg-success"><i class="icon-plus22 mr-1"></i> {{ __('home.requirement_botton') }}</button>
    </div>
</form>