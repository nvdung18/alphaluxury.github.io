{{-- Instagram Begin --}}
<div class="instagram">
    <div class="container-fluid">
        <div class="row">
            @for ($i = 0; $i < 6; $i++)
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="{{ asset('frontend/img/instagram/insta-2.jpg') }}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
{{-- Instagram End --}}