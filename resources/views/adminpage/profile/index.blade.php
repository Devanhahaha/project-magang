@extends('adminpage.layouts.main')

@section('title', 'Profile')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <div class="user-profile-header-banner">
                        <img src="{{ asset('admin/assets/img/pages/profile-banner.png') }}" alt="Banner image"
                            class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img src="{{ asset('admin/assets/img/avatars/1.png') }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img" />
                        </div>
                        <div class="flex-grow-1 mt-3 mt-lg-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4 class="mb-2 mt-lg-6">{{ $user->name }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                                        <li class="list-inline-item d-flex gap-2 align-items-center">
                                            <i class="ti ti-user ti-lg"></i><span
                                                class="fw-medium">{{ auth()->user()->getRoleNames()->first() }}</span>
                                        </li>
                                        <li class="list-inline-item d-flex gap-2 align-items-center">
                                            <i class="ti ti-calendar ti-lg"></i><span class="fw-medium"> Joined
                                                {{ $user->created_at }}</span>
                                        </li>
                                    </ul>
                                </div>
                                {{-- <a href="javascript:void(0)" class="btn btn-primary mb-1">
                                <i class="ti ti-user-check ti-xs me-2"></i>Connected
                            </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-2 gap-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i
                                    class="ti-sm ti ti-user-check me-1_5"></i>
                                Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-body">
                <small class="card-text text-uppercase text-muted small">About</small>
                <ul class="list-unstyled my-3 py-1">
                    <li class="d-flex align-items-center mb-4">
                        <i class="ti ti-user ti-lg"></i><span class="fw-medium mx-2">Full Name:</span>
                        <span>{{ $user->name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-4">
                        <i class="ti ti-crown ti-lg"></i><span class="fw-medium mx-2">Role:</span>
                        <span>{{ auth()->user()->getRoleNames()->first() }}</span>
                    </li>
                </ul>
                <small class="card-text text-uppercase text-muted small">Contacts</small>
                <ul class="list-unstyled my-3 py-1">
                    <li class="d-flex align-items-center mb-4">
                        <i class="ti ti-phone-call ti-lg"></i><span class="fw-medium mx-2">Contact:</span>
                        <span>{{ $user->contact }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-4">
                        <i class="ti ti-mail ti-lg"></i><span class="fw-medium mx-2">Email:</span>
                        <span>{{ $user->email }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admin/assets/js/pages-profile.js') }}"></script>
@endsection
