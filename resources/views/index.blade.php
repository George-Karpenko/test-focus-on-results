<x-layouts.base :title="$cityName">
    <ul class="nav nav-pills flex-column mb-auto">
        @foreach ($regions as $region)
            <li class="nav-item">
                @if (count($region->cities))
                    <span class="nav-link link-dark">{{ $region->name }}</span>
                    <ul class="nav nav-pills flex-column mb-auto ms-4">
                        @foreach ($region->cities as $city)
                            <li class="nav-item">
                                @if ($region->citySlug($city->slug) === $citySlug)
                                    <a href="{{ route('index', ['city' => $region->citySlug($city->slug)]) }}" class="nav-link link-dark fw-bold">{{ $city->name }}</a>
                                @else
                                    <a href="{{ route('index', ['city' => $region->citySlug($city->slug)]) }}" class="nav-link link-dark">{{ $city->name }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    @if ($region->slug === $citySlug)
                        <a href="{{ route('index', ['city' => $region->slug]) }}" class="nav-link link-dark fw-bold">{{ $region->name }}</a>
                    @else
                        <a href="{{ route('index', ['city' => $region->slug]) }}" class="nav-link link-dark">{{ $region->name }}</a>
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
</x-layouts.base>