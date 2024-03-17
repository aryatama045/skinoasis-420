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

            <div class="col-md-8 col-10 offset-1 offset-md-2 rounded shadow-box bg-white p-4">

                <div class="update-profile bg-white py-5 px-4">
                    <h3 class="mb-4">{{ localize('Update Profile') }}</h3>
                    <form class="profile-form" action="{{ route('customers.updateProfile') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="info">
                        <div class="file-upload text-center rounded-3 mb-5">
                            <input type="file" name="avatar">
                            <img src="{{ staticAsset('frontend/default/assets/img/icons/image.svg') }}" alt="dp"
                                class="img-fluid">
                            <p class="text-dark fw-bold mb-2 mt-3">{{ localize('Drop your files here or browse') }}</p>
                            <p class="mb-0 file-name"></p>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-12">
                                <div class="mb-2 text-dark fw-bold">
                                    <label>{{ localize('Jenis Kelamin') }}</label>
                                </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="P" checked>
                                        <label class="form-check-label" for="inlineRadio1"><span class="text-dark fw-bold">Perempuan</span> </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="L">
                                        <label class="form-check-label" for="inlineRadio2"><span class="text-dark fw-bold">Laki-Laki</span></label>
                                    </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="label-input-field">
                                    <label>{{ localize('Username') }}</label>
                                    <input type="text" name="name" placeholder="{{ localize('Username') }}"
                                        value="{{ $user->name }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="label-input-field">
                                    <label>{{ localize('Nama Depan') }}</label>
                                    <input type="text" name="nama_depan" placeholder="{{ localize('Nama Depan') }}"
                                        value="{{ $user->nama_depan }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="label-input-field">
                                    <label>{{ localize('Nama Belakang') }}</label>
                                    <input type="text" name="nama_belakang" placeholder="{{ localize('Nama Belakang') }}"
                                        value="{{ $user->nama_belakang }}" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="label-input-field">
                                    <label>{{ localize('Biodata') }}</label>
                                    <textarea type="text" name="bioadata" required>{{ $user->biodata }}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="label-input-field">
                                    <label>{{ localize('Tanggal Lahir') }}</label>
                                    <input type="date" name="tanggal_lahir" placeholder="{{ localize('Tanggal Lahir') }}"
                                        value="{{ $user->tanggal_lahir }}">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="label-input-field">
                                    <label>{{ localize('Email') }}</label>
                                    <input type="email" name="email" placeholder="{{ localize('Email') }}"
                                        value="{{ $user->email }}" disabled>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="label-input-field">
                                    <label>{{ localize('Nomor Handphone') }}</label>
                                    <input type="text" name="phone" placeholder="{{ localize('Nomor Handphone') }}"
                                        value="{{ $user->phone }}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="label-input-field">
                                    <label>{{ localize('Negara') }}</label>
                                    <input type="text" name="negara" placeholder="{{ localize('Negara') }}"
                                        value="{{ $user->negara }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="label-input-field">
                                    <label>{{ localize('Kab/Kota') }}</label>
                                    <input type="text" name="kab_kota" placeholder="{{ localize('Kab/Kota') }}"
                                        value="{{ $user->kab_kota }}">
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark mt-6">{{ localize('Update Profile') }}</button>
                    </form>
                </div>

                <div class="change-password bg-white py-5 px-4 mt-4 rounded">
                    <h3 class="mb-4">{{ localize('Change Password') }}</h3>
                    <form class="password-reset-form" action="{{ route('customers.updateProfile') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="password">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="label-input-field">
                                    <label>{{ localize('New Password') }}</label>
                                    <input type="password" name="password" placeholder="******" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="label-input-field">
                                    <label>{{ localize('Re-type Password') }}</label>
                                    <input type="password" name="password_confirmation" placeholder="******" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark mt-6">{{ localize('Change Password') }}</button>
                    </form>
                </div>

            </div>

        </div>
    </div>

</section>


@endsection

