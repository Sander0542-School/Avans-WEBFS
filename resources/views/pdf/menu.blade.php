<html>
<head>
    <title>GoudenDraak Menu</title>

    <style>
        body {
            margin: 0;
            padding: 16px;

            background-color: fefebe;
        }

        @page {
            margin: 0;
        }

        h1, h2 {
            text-align: center;
        }

        .page {
            page-break-before: always;
        }

        .page:first-child {
            page-break-before: never;
        }

        table {
            width: 100%;
        }

        td.fit {
            width: 1px;
            white-space: nowrap;
        }

        .text-strikethrough {
            text-decoration: line-through;
        }
    </style>
</head>
<body>
<h1>GoudenDraak</h1>
<div class="page menu">
    <h2>Menu</h2>
    <table>
        @foreach($menu as $id => $category)
            @if(count($category['dishes']) > 0)
                <tr>
                    <th colspan="3">
                        <h3>{{ $category['name'] }}</h3>
                    </th>
                </tr>
                @foreach($category['dishes'] as $dish)
                    <tr>
                        <td class="fit">{{ $dish['number'] }}{{ $dish['addition'] ?? '' }}.</td>
                        <td>{{ $dish['name'] }}</td>
                        <td class="fit">&euro; {{ number_format($dish['price'], 2) }}</td>
                    </tr>
                    @if($dish['description'])
                        <tr>
                            <td></td>
                            <td colspan="2">
                                <span style="font-style: italic">({{ $dish['description'] }})</span>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
        @endforeach
    </table>
</div>

<div class="page discounts">
    <h2>Aanbiedingen</h2>
    <table>
        @foreach($discounts as $id => $discount)
            @if(count($discount->dishes) > 0)
                <tr>
                    <th colspan="4">
                        <h3>{{ $discount->name }}</h3>
                        <h5>Geldig tot {{ $discount->valid_until->format('d-m-Y H:i') }}</h5>
                    </th>
                </tr>
                @foreach($discount->dishes as $dish)
                    <tr>
                        <td class="fit">{{ $dish->number }}{{ $dish->addition ?? '' }}.</td>
                        <td>{{ $dish->name }}</td>
                        <td class="fit text-strikethrough">&euro; {{ number_format($dish->base_price_inc, 2) }}</td>
                        <td class="fit">&euro; {{ number_format($dish->price_inc, 2) }}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    </table>
</div>
</body>
</html>
