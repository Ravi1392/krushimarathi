<div class="match-container"  style="padding: 20px 0;box-shadow: none;">
    <div class="points-table">
        <div class="table-container">
            <table style="margin: 0">
                <thead>
                    <tr>
                        <th>शेतीमाल</th>
                        <th>बाजार समिती</th>
                        <th>जात /प्रत</th>
                        <th>परिमाण</th>
                        <th>आवक</th>
                        <th>कमीत कमी दर (रु.)</th>
                        <th>जास्तीत जास्त दर (रु.)</th>
                        <th>सरासरी दर (रु.)</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($crop_rates)
                        @foreach ($crop_rates as $crop_rate)
                            <tr>
                                <td>{{isset($crop_rate->crop_name) ? $crop_rate->crop_name->mr_crop_name : ""}}</td>
                                <td>{{$crop_rate->market_name}}</td>
                                <td>{{$crop_rate->variety}}</td>
                                <td>{{$crop_rate->unit}}</td>
                                <td>{{$crop_rate->arrival}}</td>
                                <td>{{$crop_rate->minimum_rate}}</td>
                                <td>{{$crop_rate->maximum_rate}}</td>
                                <td>{{$crop_rate->average_rate}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>