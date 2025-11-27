@if(isset($weather_data) && !empty($weather_data))
    @foreach ($weather_data as $data)
        <div class="weather_box">
            <div class="aqi_weatherCityNm">
                <span class="weatherCityNm">{{ $data->district->mr_name }}</span>
                @if(isset($data->aqi_value) && !empty($data->aqi_value))
                    <span class="weatherValue">AQI :&nbsp;<span class="{{ $data->aqi_class }}">{{ $data->aqi_value }}</span> 
                        <span class="aqi_rvw_icn">
                            <img src="{{ asset($data->aqi_image) }}" alt="{{ $data->aqi_class }}">
                        </span>
                    </span>
                @endif
            </div>
            <div class="wheather_imgBx">
                <img src="{{ asset($data->weather_image) }}" alt="{{ $data->aqi_class }}" height="100" width="100">
            </div>
            <div class="wheather_value_bx">
                <div class="weather_degreeVl">{{ $data->temperature }}<sup>o</sup><span class="cel_clas">C</span>
                </div>
                <span>{{ $data->weather_condition }}</span>
            </div>
        </div>
    @endforeach
@endif