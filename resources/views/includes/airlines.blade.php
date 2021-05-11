@php
    $out = []
@endphp
@foreach(\App\Http\Controllers\StaticDataController::getAirports() as $airport)
    @if(!array_key_exists($airport->country, $out))
        @php
            $out[$airport->country] = [];
        @endphp
    @endif

    @php
        $out[$airport->country][] = $airport;
    @endphp
@endforeach

@foreach($out as $country => $arr)
    <optgroup label="{{ $country }}">
        @foreach($out[$country] as $airport)
            <option @if($default == $airport->iata_code) selected @endif value="{{ $airport->iata_code }}">{{ $airport->city . ' - ' . $airport->iata_code . ' - ' . $airport->name }}</option>
        @endforeach
    </optgroup>
@endforeach
