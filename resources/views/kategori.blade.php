@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="page-inner">
            <!-- Card -->

            <div class="row">
                <div class="col-lg-10">
                    <h4 class="page-title">Master Kategori</h4>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Add Row
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">Tambah Kategori</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('kategori.store') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Jenis Kategori</label>
                                                    <select name="jenis_kategori" class="form-control">
                                                        <option selected>--- PILIH ---</option>
                                                        <option value="olahraga">Olahraga</option>
                                                        <option value="alat musik">alat musik</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nama Kategori</label>
                                                    <input id="nama_kategori" type="text" class="form-control"
                                                        name="nama_kategori">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                @foreach ($kategori as $item)
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats">
                                        <div class="numbers">
                                            <p class="card-category">{{ $item->jenis_kategori }}</p>
                                            <h4 class="card-title">{{ $item->nama_kategori }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn btn-sm btn-warning w-100 editBtn"
                                            data-id="{{ $item->id }}" data-toggle="modal"
                                            data-target="#editModal{{ $item->id }}">Edit</a>
                                    </div>
                                    <div class="col">
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('kategori.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete') <!-- Menggunakan metode DELETE -->
                                            <button type="submit" data-id="{{ $item->id }}"
                                                class="btn btn-link btn-danger deleteBtn" data-toggle="tooltip"
                                                title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('kategori.update', $item->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label for="">Jenis Kategori</label>
                                            <input type="text" name="jenis_kategori" class="form-control"
                                                value="{{ $item->jenis_kategori }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="">Nama Kategori</label>
                                            <input type="text" name="nama_kategori" class="form-control"
                                                value="{{ $item->nama_kategori }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
