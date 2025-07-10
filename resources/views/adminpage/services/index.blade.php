@extends('adminpage.layouts.main')

@section('title', 'Services')

@section('css')
    <link href="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Services</h6>
                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
                    <i class="ti ti-plus"></i> Add New Services
                </button>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="add-new-record" aria-labelledby="offcanvasLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasLabel">Add New Services Content</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body flex-grow-1">
                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Banner -->
                        <div class="mb-3">
                            <label class="form-label" for="banner">Banner</label>
                            <input type="file" id="banner" name="banner" class="form-control" required />
                        </div>
                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control"
                                placeholder="Enter title" required />
                        </div>
                        <!-- Subtitle -->
                        <div class="mb-3">
                            <label class="form-label" for="subtitle">Subtitle</label>
                            <input type="text" id="subtitle" name="subtitle" class="form-control"
                                placeholder="Enter subtitle" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control"
                                placeholder="Enter subtitle" required />
                        </div>
                        <!-- Submit / Cancel -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Banner</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $key => $service)
                                <tr class="text-nowrap">
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset($service->banner) }}" height="50" width="auto"
                                            alt="devan" style="object-fit: cover"></td>
                                    <td>{{ $service->title }}</td>
                                    <td>{{ $service->subtitle }}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#descModal{{ $service->id }}"
                                        style="cursor: pointer;">
                                        {{ \Illuminate\Support\Str::limit($service->description, 10) }}
                                    </td>

                                    <!-- Modal Description -->
                                    <div class="modal fade" id="descModal{{ $service->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Full Description</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $service->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="offcanvas"
                                            data-bs-target="#add-new-record-update-{{ $service->id }}">
                                            <i class="ti ti-pencil"></i>
                                        </button>
                                        <div class="offcanvas offcanvas-end" tabindex="-1"
                                            id="add-new-record-update-{{ $service->id }}"
                                            aria-labelledby="offcanvasLabel">
                                            <div class="offcanvas-header border-bottom">
                                                <h5 class="offcanvas-title" id="offcanvasLabel">Update Services Content</h5>
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body flex-grow-1">
                                                <form action="{{ route('services.update', $service->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Banner -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="banner">Banner</label>
                                                        <input type="file" id="banner" name="banner"
                                                            class="form-control" required />
                                                    </div>
                                                    <!-- Title -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="title">Title</label>
                                                        <input type="text" id="title"
                                                            value="{{ $service->title }}" name="title"
                                                            class="form-control" placeholder="Enter title" required />
                                                    </div>
                                                    <!-- Subtitle -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="subtitle">Subtitle</label>
                                                        <input type="text" id="subtitle"
                                                            value="{{ $service->subtitle }}" name="subtitle"
                                                            class="form-control" placeholder="Enter subtitle" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="description">Description</label>
                                                        <input type="text" id="description"
                                                            value="{{ $service->description }}" name="description"
                                                            class="form-control" placeholder="Enter subtitle" required />
                                                    </div>
                                                    <!-- Submit / Cancel -->
                                                    <div class="mt-4">
                                                        <button type="submit"
                                                            class="btn btn-primary me-2">Submit</button>
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="offcanvas">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <button type="button" onclick="confirmDelete({{ $service->id }})"
                                            class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i></button>
                                        <form action="" id="delete-form" method="POST" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatables-demo.js') }}"></script>
@endsection
