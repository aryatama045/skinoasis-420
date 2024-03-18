@extends('backend.layouts.master')

@section('title')
{{ localize('Add New Employee Staff') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
<section class="tt-section pt-4">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card tt-page-header">
                    <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                        <div class="tt-page-title">
                            <h2 class="h5 mb-lg-0">{{ localize('Add New Person') }}</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">

            <!--left sidebar-->
            <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                <form action="{{ route('admin.staffs.store') }}" method="POST" class="pb-650">
                    @csrf
                    <!--basic information start-->
                    <div class="card mb-4" id="section-1">
                        <div class="card-body">
                            <h5 class="mb-4">{{ localize('Basic Information') }}</h5>

                            <div class="mb-4">
                                <label for="name" class="form-label">Nama Lengkap<span class="text-danger ms-1">*</span></label>
                                <input class="form-control" type="text" id="name" placeholder="Masukan Nama Lengkap" name="name" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>


                            <div class="mb-4">
                                <label for="email" class="form-label">Email<span class="text-danger ms-1">*</span></label>
                                <input class="form-control" type="email" id="email" placeholder="Email" name="email" value="{{old('email')}}">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>


                            <div class="mb-4">
                                <label class="form-label">Role<span class="text-danger ms-1">*</span></label>
                                <select class="select2 form-control" data-toggle="select2" name="role_id">
                                    <option value="0">-- Pilih Role --</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Zona (Hanya untuk Mitra/Klinik/Dokter)</label>
                                <select class="select2 form-control" data-toggle="select2" name="zona">
                                    <option value="0">-- Pilih Zona --</option>
                                    @foreach ($cities as $kota)
                                    <option value="{{ $kota->id }}">
                                        {{ $kota->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label">Nomor Handphone</label>
                                <input class="form-control" type="number" id="phone" placeholder="contoh : 08123456789" name="phone" value="{{old('phone')}}">
                            </div>

                            <div class="mb-4">
                                <label for="name" class="form-label">Alamat Lengkap<span class="text-danger ms-1">*</span></label>
                                <textarea class="form-control" type="text" id="alamat" placeholder="Masukan Alamat Lengkap" name="alamat"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">{{ localize('Password') }}<span class="text-danger ms-1">*</span></label>
                                <input class="form-control" type="password" id="password" placeholder="{{ localize('Type password') }}" name="password">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-4">Informasi Lainnya</h5>

                            <div class="mb-4">
                                <label class="form-label">Foto</label>
                                <div class="tt-image-drop rounded">
                                    <span class="fw-semibold">Pilih Foto</span>
                                    <!-- choose media -->
                                    <div class="tt-product-thumb show-selected-files mt-3">
                                        <div class="avatar avatar-xl cursor-pointer choose-media"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                            onclick="showMediaManager(this)" data-selection="single">
                                            <input type="hidden" name="image">
                                            <div class="no-avatar rounded-circle">
                                                <span><i data-feather="plus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- choose media -->
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="name" class="form-label">Curriculum Vitae, Certificate, Education & Experience</label>
                                <textarea class="" id="myTextarea" name="infolain"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--basic information end-->

                    <!-- submit button -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-4">
                                <button class="btn btn-primary" type="submit">
                                    <i data-feather="save" class="me-1"></i> {{ localize('Save Staff') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- submit button end -->

                </form>
            </div>

            <!--right sidebar-->
            <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                <div class="card tt-sticky-sidebar d-none d-xl-block">
                    <div class="card-body">
                        <h5 class="mb-4">{{ localize('Staff Information') }}</h5>
                        <div class="tt-vertical-step">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#section-1" class="active">{{ localize('Basic Information') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection