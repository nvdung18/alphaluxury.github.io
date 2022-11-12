@php
    $nowIdOrder = '';
@endphp
@foreach ($listOrder as $key => $item)
    @if ($statusCheck == 'All')
        @if ($nowIdOrder != $item->idOrder)
            @php
                $nowIdOrder = $item->idOrder;
            @endphp
            <div class="order">
                <div class="order-header">
                    <div class="order-header-items">
                        <div>
                            <div class="uppercase font-bold">Order ID:
                                <strong>{{ $item->idOrder }}</strong>
                            </div>
                        </div>
                        <div>
                            @php
                                // get status of this order
                                $statusOrder = json_decode($item->status);
                                foreach ($statusOrder as $key => $value) {
                                    $lenghtOfStatus = $key;
                                }
                                $nowStatusOrder = end($statusOrder->$lenghtOfStatus);
                                
                                // to get list product of order to for detail order button
                                $listDetailProduct = [];
                                
                            @endphp
                            <div class="uppercase font-bold">{{ $nowStatusOrder }}</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="order-products order-middle">
                    @foreach ($listOrder as $key2 => $item2)
                        @if ($nowIdOrder == $item2->idOrder)
                            @php
                                // to get list product of order to for detail order button
                                array_push($listDetailProduct, $item2);
                            @endphp
                            <div class="order-product-item">
                                <div><img src="{{ asset('frontend/img/product/' . $item2->image) }}" alt="Product Image">
                                </div>
                                <div>
                                    <div><a href="#">{{ $item2->nameProduct }}</a>
                                    </div>
                                    <div>Quantity: {{ $item2->quantity }}</div>
                                    <div>Price: {{ number_format($item2->quantity * $item2->price) }}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="order-bottom card">
                    <div class="card-body order-bottom-body">
                        <div class="order-bottom_total">
                            Total:
                            <strong>{{ number_format($item->deliveryCharges + $item->productMoney - (float) (($item->productMoney * $item->discountPercent) / 100)) }}Đ</strong>
                        </div>
                        <div class="order-bottom_btn-order">
                            <a href="#" class="mr-3 btn btn-warning btn-buy_again btn-order-more">Buy
                                again</a>
                            <a href="{{ route('user.detail-order', ['listDetailProduct' => $listDetailProduct]) }}"
                                class="btn btn-light btn-details btn-order-more">Order
                                Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        @php
            // get status of this order
            $statusOrder = json_decode($item->status);
            foreach ($statusOrder as $key => $value) {
                $lenghtOfStatus = $key;
            }
            $nowStatusOrder = end($statusOrder->$lenghtOfStatus);
            
            // to get list product of order to for detail order button
            $listDetailProduct = [];
        @endphp
        @if ($statusCheck == $nowStatusOrder)
            @if ($nowIdOrder != $item->idOrder)
                @php
                    $nowIdOrder = $item->idOrder;
                @endphp
                <div class="order">
                    <div class="order-header">
                        <div class="order-header-items">
                            <div>
                                <div class="uppercase font-bold">Order ID:
                                    <strong>{{ $item->idOrder }}</strong>
                                </div>
                            </div>
                            <div>

                                <div class="uppercase font-bold">{{ $nowStatusOrder }}</div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="order-products order-middle">
                        @foreach ($listOrder as $key2 => $item2)
                            @if ($nowIdOrder == $item2->idOrder)
                                @php
                                    // to get list product of order to for detail order button
                                    array_push($listDetailProduct, $item2);
                                @endphp
                                <div class="order-product-item">
                                    <div><img src="{{ asset('frontend/img/product/' . $item2->image) }}"
                                            alt="Product Image">
                                    </div>
                                    <div>
                                        <div><a href="#">{{ $item2->nameProduct }}</a>
                                        </div>
                                        <div>Quantity: {{ $item2->quantity }}</div>
                                        <div>Price: {{ number_format($item2->quantity * $item2->price) }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="order-bottom card">
                        <div class="card-body order-bottom-body">
                            <div class="order-bottom_total">
                                Total:
                                <strong>{{ number_format($item->deliveryCharges + $item->productMoney - (float) (($item->productMoney * $item->discountPercent) / 100)) }}Đ</strong>
                            </div>
                            <div class="order-bottom_btn-order">
                                <a href="#" class="mr-3 btn btn-warning btn-buy_again btn-order-more">Buy
                                    again</a>
                                <a href="{{ route('user.detail-order', ['listDetailProduct' => $listDetailProduct]) }}"
                                    class="btn btn-light btn-details btn-order-more">Order
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endif
@endforeach
