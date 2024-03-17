@extends('frontend.skinoasis.layouts.master')

@section('title')
    {{ localize('Customer Dashboard') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')

@include('frontend.skinoasis.pages.users.partials.cssUser')

<section class="my-account pb-120">

    @include('frontend.skinoasis.pages.users.partials.profileWidget')

    <div class="container mt-8">
        <div class="row">

            <div class="col-10 offset-1 bg-white p-4">
                <h3 class="border-down">My Orders</h3>

                <div class="recent-orders rounded shadow-box py-5">

                    <div class="container">

                    @forelse ($orders as $order)
                        <article class="entry entry-list mb-5 border-down">
                            <div class="row border-down align-items-center">
                                <div class="col-md-6">
                                {{ getSetting('order_code_prefix') }}{{ $order->orderGroup->order_code }} <span>{{ date('d M Y', strtotime($order->created_at)) }}</span> <br>
                                    <span>{{ $order->orderItems()->count() }} item purchased</span>
                                </div>
                                <div class="col-md-3">
                                    Order Status <br>
                                    <span>{{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}</span>
                                </div>
                                <div class="col-md-3">
                                    Total Price <br>
                                    <h3 class="text-dark">{{ formatPrice($order->orderGroup->grand_total_amount) }}</h3>
                                </div>
                            </div>

                            @php
                                $order_id = $order->id;
                                $detail_order = \App\Models\OrderItem::where('order_id', $order_id)->get();
                            @endphp

                            @forelse ($detail_order as $key => $item)

                            @php $product = $item->product_variation->product; @endphp
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <figure class="entry-media">
                                        <a href="single.html">
                                            <img src="{{ uploadedAsset($product->thumbnail_image) }}"
                                            alt="{{ $product->collectLocalization('name') }}">
                                        </a>
                                    </figure>
                                </div>

                                <div class="col-md-4">
                                    <div class="entry-body p-5">
                                        <h3 class="entry-title mt-2">
                                            <a href="{{ route('products.show', $product->slug) }}">{{ $product->collectLocalization('name') }}</a>
                                        </h3>

                                        <div class="entry-cats">
                                            @foreach (generateVariationOptions($item->product_variation->combinations) as $variation)
                                                <span class="fs-xs">
                                                    {{ $variation['name'] }}:
                                                    @foreach ($variation['values'] as $value)
                                                        {{ $value['name'] }}
                                                    @endforeach
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>

                                        <h4 class="text-dark">{{ formatPrice($item->unit_price) }}</h4>

                                        <h5 class="text-dark">{{ $item->qty }}</h5>

                                        <div class="entry-meta">
                                            <span class="entry-author">
                                                by <a href="#">John Doe</a>
                                            </span>
                                            <span class="meta-separator">|</span>
                                            <a href="#">Nov 22, 2018</a>
                                        </div>

                                        <div class="entry-content">
                                            <p>Sed pretium</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    @if ($loop->last)
                                    <div class="entry-body">
                                        @php
                                            $shippingAddress = $order->orderGroup->shippingAddress;
                                            $billingAddress = $order->orderGroup->billingAddress;
                                        @endphp

                                        <div class="entry-content">
                                            <h3>Payment Method</h3>
                                            <p class="mb-2">{{ ucwords(str_replace('_', ' ', $order->orderGroup->payment_method)) }}</p>
                                        </div>

                                        <div class="entry-content">
                                            <h3>Delivery Address</h3>
                                            <p class="mb-2">{{ optional($shippingAddress)->address }},
                                                {{ optional(optional($shippingAddress)->city)->name }},
                                                {{ optional(optional($shippingAddress)->state)->name }},
                                                {{ optional(optional($shippingAddress)->country)->name }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <div class="entry-body">
                                        @if ($loop->last)
                                        <div class="entry-content">
                                            <h3>Shipping Cost</h3>
                                            <p class="mb-2">{{ formatPrice($order->orderGroup->total_shipping_cost) }}</p>
                                        </div>

                                        @if ($order->orderGroup->total_coupon_discount_amount > 0)
                                        <div class="entry-content">
                                            <h3>{{ localize('Coupon Discount') }}</h3>
                                            <p class="mb-2">{{ formatPrice($order->orderGroup->total_coupon_discount_amount) }}</p>
                                        </div>
                                        @endif

                                        <div class="entry-content">
                                            <h3>Subtotal</h3>
                                            <p class="mb-2">{{ formatPrice($order->orderGroup->sub_total_amount) }}</p>
                                        </div>

                                        <div class="entry-content">
                                            <h3>Total</h3>
                                            <p class="mb-2">{{ formatPrice($order->orderGroup->grand_total_amount) }}</p>
                                        </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                            @empty
                            @endforelse
                        </article>
                    @empty
                    @endforelse
                    </div>

                    <div class="table-responsive">
                        <table class="order-history-table table">
                            <tbody>
                                <tr>
                                    <th>{{ localize('Order Code') }}</th>
                                    <th>{{ localize('Placed on') }}</th>
                                    <th>{{ localize('Items') }}</th>
                                    <th>{{ localize('Total') }}</th>
                                    <th>{{ localize('Status') }}</th>
                                    <th class="text-center">{{ localize('Action') }}</th>
                                </tr>

                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ getSetting('order_code_prefix') }}{{ $order->orderGroup->order_code }}
                                        </td>
                                        <td>{{ date('d M, Y', strtotime($order->created_at)) }}</td>
                                        <td>{{ $order->orderItems()->count() }}</td>
                                        <td class="text-secondary">
                                            {{ formatPrice($order->orderGroup->grand_total_amount) }}</td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('customers.trackOrder') }}?code={{ $order->orderGroup->order_code }}"
                                                class="view-invoice fs-xs me-2" target="_blank" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="{{ localize('Track My Order') }}"><i
                                                    class="fas fa-truck text-dark"></i></a>

                                            <a href="{{ route('checkout.invoice', $order->orderGroup->order_code) }}"
                                                class="view-invoice fs-xs" target="_blank" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="{{ localize('View Details') }}"><i
                                                    class="fas fa-eye"></i></a>


                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-1 px-md-3">
                        {{ $orders->appends(request()->input())->links() }}
                    </div>
                </div>

            </div>

        </div>
    </div>

</section>


@endsection
