<div class="single-box card">
    <div class="img-area zoom-img-product">
        <img src="{{ asset('frontend/img/product/' . $item->image . '.jpg') }}" alt="">
    </div>
    <div class="img-text card-body">
        <div class="img-text-top">
            <h5>{{ $item->nameProduct }}</h5>
            <p class="text-top-price">@php
                echo number_format($item->price);
            @endphp</p>
        </div>
        <div class="img-text-bottom">
            <a href="{{ route('shop.product-details') }}" class="btn adjust btn-default btn-float btn-120 gray">Chi
                Tiết</a>
            <a href=""
                class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright">Đặt
                Hàng</a>
        </div>
    </div>
</div>