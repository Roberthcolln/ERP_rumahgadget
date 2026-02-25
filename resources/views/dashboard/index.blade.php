@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-none bg-label-primary">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h4 class="card-title text-primary mb-2">
                                        <span id="greeting">Selamat Datang</span>, {{ Auth::user()->name }}! 🚀
                                    </h4>

                                    <p class="mb-4 text-dark">
                                        Anda masuk ke panel <span
                                            class="fw-bold text-primary">{{ $konf->instansi_setting }}</span>.
                                        Pantau performa bisnis dan kelola data Anda dengan mudah hari ini.
                                    </p>


                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                        height="170" alt="Dashboard Welcome Illustration"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png"
                                        style="transform: scaleX(-1);" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
