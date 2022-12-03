<div class="single-box card">
    <div class="img-area zoom-img-product">
        <img src="{{ asset('frontend/img/product/' . $item->image) }}" alt="">
    </div>
    <div class="img-text card-body">
        <div class="img-text-top">  
            <h5>{{ $item->nameProduct }}</h5>
            <p class="text-top-price">{{ number_format($item->price, 0 ,".", ".") }} VND</p>
        </div>
        <div class="img-text-bottom">
            <a href="{{ route('shop.product-details', ['nameproduct'=>$item->nameProduct,'gender'=>$tag]) }}" class="btn adjust btn-default btn-float btn-120 gray">Details</a>
            <a class="btn adjust btn-orange-basic btn-float btn-120 btn-nudge-back yellow-bright btn-cart" idProduct={{ $item->idProduct }} data-url="{{ route('add_product_to_cart') }}" href="#">
                Order
            </a>
        </div>
    </div>
</div>  