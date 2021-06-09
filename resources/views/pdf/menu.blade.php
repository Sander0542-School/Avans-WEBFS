<html>
<head>
    <title>GoudenDraak Menu</title>

    <style>
        .fas {
            margin-left: 2px;
        }
    </style>
</head>
<body>
<h1>GoudenDraak</h1>
<h2>Menu</h2>
@foreach($menu as $category)
    <h3>{{ $category['name'] }}</h3>
    @foreach($category['dishes'] as $dish)
        <div>
            <div>
                <span>{{ $dish['number'] }}{{ $dish['addition'] ?? '' }}. {{ $dish['name'] }}</span>
                <span>&euro; {{ number_format($dish['price'], 2) }}</span>
            </div>
            @if($dish['description'])
                <span style="font-style: italic">({{ $dish['description'] }})</span>
            @endif
        </div>
    @endforeach
@endforeach

<h2>Aanbiedingen</h2>
</body>
</html>
