@extends('adminpage.layouts.main')

@section('title', 'About Me')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/app-academy-details.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/plyr/plyr.css') }}" />
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-6">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-6 gap-2">
                            <div class="me-1">
                                <h5 class="mb-0">About Me Content</h5>
                                <p class="mb-0">Ramah <span class="fw-medium text-heading"> Technology </span>
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-label-danger">About Me</span>
                                <i class="ti ti-share ti-lg mx-4"></i>
                                <i class="ti ti-bookmarks ti-lg"></i>
                            </div>
                        </div>
                        <div class="card academy-content shadow-none border">
                            <div class="p-2">
                                <div class="cursor-pointer">
                                    <img src="{{ asset($abouts->image) }}" alt="image" class="img-fluid rounded shadow"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#add-new-record-update-{{ $abouts->id }}">
                                </div>
                                <div class="offcanvas offcanvas-end" tabindex="-1"
                                    id="add-new-record-update-{{ $abouts->id }}" aria-labelledby="offcanvasLabel">
                                    <div class="offcanvas-header border-bottom">
                                        <h5 class="offcanvas-title" id="offcanvasLabel">Update About Content</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body flex-grow-1">
                                        <form action="{{ route('about.update', $abouts->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{ $abouts->id }}">
                                            <!-- Banner -->
                                            <div class="mb-3">
                                                <label class="form-label" for="image">Image</label>
                                                <input type="file" id="image" name="image" class="form-control"
                                                    required />
                                            </div>
                                            <!-- Title -->
                                            <div class="mb-3">
                                                <label class="form-label" for="description">Description</label>
                                                <input type="text" id="description" value="{{ $abouts->description }}"
                                                    name="description" class="form-control" placeholder="Enter title"
                                                    required />
                                            </div>
                                            <!-- Subtitle -->
                                            <div class="mb-3">
                                                <label class="form-label" for="vision">Vision</label>
                                                <input type="text" id="vision" value="{{ $abouts->vision }}"
                                                    name="vision" class="form-control" placeholder="Enter subtitle"
                                                    required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="mission">Mision</label>
                                                <input type="text" id="mission" value="{{ $abouts->mission }}"
                                                    name="mission" class="form-control" placeholder="Enter subtitle"
                                                    required />
                                            </div>
                                            <!-- Submit / Cancel -->
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="offcanvas">
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4 text-center">
                                <h5>About your company</h5>
                                <hr class="my-6" />
                                <h5>Description</h5>
                                <p class="mb-6">
                                    {{ $abouts->description }}
                                </p>
                                <hr class="my-6" />
                                <h5>Vision</h5>
                                <p class="mb-6">
                                    {{ $abouts->vision }}
                                </p>
                                <hr class="my-6" />
                                <h5>Mision</h5>
                                <p class="mb-6">
                                    {{ $abouts->mission }}
                                </p>
                            </div>
                        </div>
                    </div>
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
                    form.action = `/admin/about/${id}`;
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
    @if ($errors->any() && old('id'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const offcanvasId = 'add-new-record-update-{{ old('id') }}';
                const offcanvasEl = document.getElementById(offcanvasId);

                if (offcanvasEl) {
                    const offcanvas = new bootstrap.Offcanvas(offcanvasEl);
                    offcanvas.show();
                }

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
    <script src="{{ asset('admin/assets/js/app-academy-course-details.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/plyr/plyr.js') }}"></script>
@endsection
