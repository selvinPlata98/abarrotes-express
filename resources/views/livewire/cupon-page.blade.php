<div class="coupon-list">
    <h2>Cupon valido</h2>
    <ul>
        @foreach ($coupons as $coupon)
            <li class="coupon-item">
                <div class="coupon-code">{{ $coupon['code'] }}</div>
                <div class="coupon-description">{{ $coupon['description'] }}</div>
            </li>
        @endforeach
    </ul>
</div>
