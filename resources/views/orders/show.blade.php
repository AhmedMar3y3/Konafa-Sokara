@extends('layout')

@section('main')
<div class="container text-end">
    <h1>تفاصيل الطلب #{{ $order->id }}</h1>
    
    <div class="row">
        <div>
            <h3>معلومات الطلب</h3>
            <p style="color: black">المجموع: {{ $order->total_price }}</p>
            <p style="color: black">عنوان التسليم: {{ $order->map_desc }}</p>
            
            <h4>المحتويات:</h4>
            <ul>
                @foreach($order->items as $item)
                <li style="color: black; list-style-type: none; margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                    <div><strong>المنتج:</strong> {{ $item->product->name }}</div>
                    <div><strong>الكمية:</strong> {{ $item->quantity }}</div>
                    
                    @if($item->additions->isNotEmpty())
                    <div style="margin-top: 10px;">
                        <strong>الإضافات:</strong>
                        <ul style="margin-right: 20px;">
                            @foreach($item->additions as $addition)
                            <li>
                                {{ $addition->name }} 
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        
        <div>
            <h3>موقع التسليم</h3>
            <div id="orderMap" style="height: 400px; width: 100%;"></div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    // Initialize map
    var map = L.map('orderMap').setView([{{ $order->lat }}, {{ $order->lng }}], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Add marker
    L.marker([{{ $order->lat }}, {{ $order->lng }}])
     .addTo(map)
     .bindPopup('{{ $order->map_desc }}')
     .openPopup();
</script>
@endsection