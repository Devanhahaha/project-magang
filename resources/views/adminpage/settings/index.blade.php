@extends('adminpage.layouts.main')

@section('title', 'Settings')

@section('css')

@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i class="ti-sm ti ti-users me-1_5"></i>
                                Account</a>
                        </li>
                    </ul>
                </div>
                <div class="card mb-6">
                    <!-- Account -->
                    <div class="card-body pt-4">
                        <form id="formAccountSettings" action="{{ route('settings.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" autofocus />
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="john.doe@example.com" />
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="contact" class="form-label">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact"
                                    value="{{ old('contact', $user->contact) }}" />
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="logo_apk" class="form-label">Logo</label>
                                    <input type="file" class="form-control" id="logo_apk"
                                        name="logo_apk">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="nama_apk" class="form-label">Nama Aplikasi</label>
                                    <input type="text" class="form-control" id="nama_apk"
                                        name="nama_apk" value="{{ old('nama_apk', $components->nama_apk) }}">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-3">Save changes</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = `/admin/services/${id}`;
                    form.submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
                timer: 2000
            });
        @endif
    </script>
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Buka offcanvas form
                const offcanvas = new bootstrap.Offcanvas(document.getElementById('add-new-record'));
                offcanvas.show();

                // SweetAlert tampilkan pesan
                let errorMessages = `{!! implode('<br>', $errors->all()) !!}`;
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    html: errorMessages,
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    <script src="{{ asset('admin/assets/js/pages-account-settings-account.js') }}"></script>
@endsection
