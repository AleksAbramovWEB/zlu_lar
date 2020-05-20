<form action="{{route('connexion.profiles')}}" method="get" class="offset-lg-1 col-lg-10">
    @method('get')
    <h3 class="text-center">{{__('home/home.search')}}:</h3>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="gender">{{__('home/home.find_gender')}}:</label>
                <select name="gender"
                        class="custom-select"
                        id="gender">
                    <option></option>
                    <option value="man" @if(old('gender') == 'man') selected @endif>
                        {{__('home/home.man')}}
                    </option>
                    <option value="woman" @if(old('gender') == 'woman') selected @endif>
                        {{__('home/home.woman')}}
                    </option>
                    <option value="trans" @if(old('gender') == 'trans') selected @endif>
                        {{__('home/home.trans')}}
                    </option>
                </select>
            </div>
        </div>
        <div class="col">
            <label for="gender">{{__('home/home.age')}}:</label>
            <select name="position"
                    class="custom-select"
                    id="position">
                <option></option>
                <option value="domination" @if(old('position') == 'domination') selected @endif>
                    {{__('auth/register.domination')}}
                </option>
                <option value="submission" @if(old('position') == 'submission') selected @endif>
                    {{__('auth/register.submission')}}
                </option>
                <option value="switch" @if(old('position') == 'switch') selected @endif>
                    {{__('auth/register.switch')}}
                </option>
            </select>
        </div>
        <div class="col-3">
            <label for="gender" class="text-center w-100">@lang('home/home.age'):</label>
            <div class="form-group row col-12 justify-content-around w-100 p-0 m-0">
                <label for="age_from" class="col-form-label mr-1">@lang('home/home.from')</label>
                <select name="age_from"
                        class="custom-select col"
                        id="age_from">
                    <option></option>
                    @for($i = 19; $i < 80; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <label for="age_to" class="col-form-label ml-2 mr-1">@lang('home/home.to')</label>
                <select name="age_to"
                        class="custom-select col"
                        id="age_to">
                    <option></option>
                    @for($i = 79; $i > 18; $i--)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="country" class="col-form-label text-md-right">{{ __('auth/register.country') }}:</label>
            <select name="country"
                    class="form-control"
                    id="country">
                <option></option>
                @foreach($countries as $country)
                    @php /** @var App\Models\Geo\GeoCountries $country */ @endphp
                    <option value="{{$country->id}}"
                            @if(old("country") == $country->id) selected @endif>
                        {{$country->title}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="region" class="col-form-label text-md-right">{{ __('auth/register.region') }}:</label>
            <select name="region"
                    class="form-control"
                    id="region">
                <option></option>
                @isset($regions)
                    @foreach($regions as $region)
                        @php /** @var App\Models\Geo\GeoRegions $region */ @endphp
                        <option value="{{$region->id}}"
                                @if(old("region") == $region->id) selected @endif>
                            {{$region->title}}
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col">
            <label for="city" class="col-form-label text-md-right">{{ __('auth/register.city') }}</label>
            <select name="city"
                    class="form-control"
                    id="city">
                <option></option>
                @isset($cities)
                    @foreach($cities as $city)
                        @php /** @var App\Models\Geo\GeoCities $city */ @endphp
                        <option value="{{$city->id}}"
                                @if(old("city") == $city->id) selected @endif>
                            {{$city->title}}
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>
    <div class="justify-content-around row pl-5 pr-5 mt-4">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="user_online" name="user_online">
            <label class="custom-control-label" for="user_online">{{__('home/home.online_now')}}</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="with_photos" name="with_photos">
            <label class="custom-control-label" for="with_photos">{{__('home/home.with_photos')}}</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="vip" name="vip">
            <label class="custom-control-label" for="vip">VIP</label>
        </div>
    </div>
    <button type="submit" class="mt-4 mb-4 font-weight-bold btn btn-light btn-block">{{ __('home/home.find') }}</button>



    <script type="text/javascript">
        let csrftoken = $("meta[name='csrf-token']").attr('content');

        $('select[name=country]').change(function(){
            let country = Number($('select[name=country]').val());
            if (country > 0) {
                $.ajax({
                    url: 'geo/regions/'+country,
                    type: 'POST',
                    data: ({}),
                    beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token', csrftoken);
                    },
                })
                    .done(function(data) {
                        $('select[name=region]').empty();
                        $('select[name=city]').empty();
                        $('select[name=region]').append(("<option value = ''></option>"));
                        for(let id in data){
                            $('select[name=region]').append(("<option value = '"+ id +"'>"+data[id] +"</option>"));}
                    });
            }else {
                $('select[name=region]').empty();
                $('select[name=city]').empty();
            }
        });
        $('select[name=region]').change(function(){
            let region = Number($('select[name=region]').val());
            if (region > 0) {
                $.ajax({
                    url: 'geo/cities/'+region,
                    type: 'POST',
                    data: ({}),
                    beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token', csrftoken);
                    },
                })
                    .done(function(data) {
                        $('select[name=city]').empty();
                        $('select[name=city]').append(("<option value = ''></option>"));
                        for(let id in data){
                            $('select[name=city]').append(("<option value = '"+ id +"'>"+data[id] +"</option>"));}
                    });
            }else {
                $('select[name=city]').empty();
            }
        });
    </script>
</form>
