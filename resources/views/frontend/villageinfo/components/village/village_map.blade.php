<!--<div class="bg-w card_radius">-->
<!--    <div>-->
        <h2 class="archive-heading" style="font-size: 24px;margin-bottom: 10px;"><strong>Google Map of {{$en_name}}</strong></h2>
        <hr>

        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d{{ $zoom }}!2d{{ $longitude }}!3d{{ $latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s{{ $place_id ? urlencode($place_id) : '0x0:0x0' }}!2s{{ urlencode($en_name) }}, {{ urlencode($state) }}, India, {{ urlencode($pin_code) }}!5e1!3m2!1sen!2sin!4v1707234567890!5m2!1sen!2sin" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
            </iframe>

<!--    </div>-->
<!--</div>-->