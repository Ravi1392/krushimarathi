<div class="navbar navbar-expand-lg navbar-light">
	<div class="text-center d-lg-none w-100">
		<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
			<i class="icon-unfold mr-2"></i>
			Footer
		</button>
	</div>

	<div class="navbar-collapse collapse" id="navbar-footer">
		<span class="navbar-text">
			&copy; {{Date('Y')}} <a href="{{ url('/') }}">{{ __('footer.copyright') }}</a>
		</span>

		<ul class="navbar-nav ml-lg-auto">
			<li class="nav-item">
				<a href="{{ url('/aboutus') }}" class="navbar-nav-link font-weight-semibold" target="_blank">
					<i class="icon-file-text2 mr-1"></i> {{ __('footer.about_us') }}
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ url('/privacy-policy') }}" class="navbar-nav-link font-weight-semibold" target="_blank">
					<i class="icon-file-text2 mr-1"></i> {{ __('footer.privacy_policy') }}
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ url('/termsandconditions') }}" class="navbar-nav-link font-weight-semibold" target="_blank">
					<i class="icon-file-text2 mr-1"></i> {{ __('footer.terms_conditions') }}
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ url('/disclaimer') }}" class="navbar-nav-link font-weight-semibold" target="_blank">
					<i class="icon-file-text2 mr-1"></i> {{ __('footer.disclaimer') }}
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ url('/write-for-us') }}" class="navbar-nav-link font-weight-semibold" target="_blank">
					<i class="icon-file-text2 mr-1"></i> {{ __('footer.write_for_us') }}
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ url('/advertisement') }}" class="navbar-nav-link font-weight-semibold" target="_blank">
					<i class="icon-file-text2 mr-1"></i> {{ __('footer.advertisement') }}
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ url('/contact-us') }}" class="navbar-nav-link font-weight-semibold" target="_blank">
					<i class="icon-file-text2"></i> {{ __('footer.contact_us') }}
				</a>
			</li>
		</ul>
	</div>
</div>