@extends('adminpage.layouts.main')

@section('title', 'Portfolio')

@section('css')

@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
                <i class="ti ti-plus"></i> Add New Portofolio
            </button>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="add-new-record" aria-labelledby="offcanvasLabel">
            <div class="offcanvas-body flex-grow-1">
                <form action="{{ route('portofolio.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="category">Category</label>
                        <input type="text" id="category" name="category" class="form-control"
                            placeholder="Enter category" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter title"
                            required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control"
                            placeholder="Enter description" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal">tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" required />
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mb-12 g-6">
            @foreach ($portofolios as $key => $portofolio)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm position-relative overflow-hidden border-0 rounded-4">
                        <img class="card-img-top object-fit-cover" style="height: 220px; object-fit: cover;"
                            src="{{ asset($portofolio->image) }}" alt="Portfolio Image" />
                        <div class="position-absolute top-0 end-0 p-2">
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas"
                                            data-bs-target="#add-new-record-update-{{ $portofolio->id }}">
                                            <i class="ti ti-pencil me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <button class="dropdown-item text-danger"
                                            onclick="confirmDelete({{ $portofolio->id }})">
                                            <i class="ti ti-trash me-2"></i>Delete
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <span class="badge bg-primary mb-2">{{ $portofolio->category }}</span>
                            <h5 class="fw-semibold mb-2">{{ $portofolio->title }}</h5>
                            <p class="text-muted small" style="max-height: 60px; overflow: hidden;">
                                {{ $portofolio->description }}
                            </p>
                            <div class="mt-2">
                                <small class="text-secondary">📅 {{ $portofolio->tanggal }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="add-new-record-update-{{ $portofolio->id }}"
                        aria-labelledby="offcanvasLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasLabel">Update Portofolio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <form action="{{ route('portofolio.update', $portofolio->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="category" class="form-control"
                                        value="{{ $portofolio->category }}" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $portofolio->title }}" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control"
                                        value="{{ $portofolio->description }}" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ $portofolio->tanggal }}" required />
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <form action="" id="delete-form" method="POST" style="display: none">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
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
                    form.action = `/admin/portofolio/${id}`;
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
@endsection
