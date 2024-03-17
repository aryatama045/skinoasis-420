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

            <div class="col-md-8 offset-md-2 rounded shadow-box bg-white p-4">
                
                <div class="address-book bg-white rounded p-5">

                    <div class="d-flex justify-content-between">
                        <h4 class="mb-5">{{ localize('Address Book') }}</h4>
                        <a href="javascript:void(0);" onclick="addNewAddress()" class="fw-semibold"><i
                                class="fas fa-plus me-1"></i> {{ localize('Add Address') }}</a>
                    </div>
                    <div class="row g-4">
                        @forelse ($addresses as $address)
                            <div class="col-md-6">
                                <div
                                    class="tt-address-content border p-3 rounded address-book-content pe-md-4 position-relative">
                                    <div class="address tt-address-info position-relative">
                                        <!-- address -->
                                        @include('frontend.skinoasis.inc.address', [
                                            'address' => $address,
                                        ])
                                        <!-- address -->

                                        <div class="tt-edit-address position-absolute">
                                            <a href="javascript:void(0);" onclick="editAddress({{ $address->id }})"
                                                class="pe-1">{{ localize('Edit') }}</a>

                                            <a href="javascript:void(0);"
                                                data-url="{{ route('address.delete', $address->id) }}"
                                                onclick="deleteAddress(this)"
                                                class="text-danger">{{ localize('Delete') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            
            </div>

        </div>
    </div>


    <!--add address modal start-->
    @include('frontend.skinoasis.inc.addressForm', ['countries' => $countries])
    <!--add address modal end-->

    </section>
@endsection
