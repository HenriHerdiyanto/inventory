@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="page-inner">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Master Penjualan</h4>
                                </div>
                                <a href="{{ route('export') }}" class="btn btn-info btn-border btn-round ml-auto">
                                    <span class="btn-label">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Export
                                </a>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal Tambah-->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">Tambah Penjualan</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('penjualan.store') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Name Produk</label>
                                                            <select name="id_produk" class="form-control">
                                                                <option selected>--- PILIH ---</option>
                                                                @foreach ($produk as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->nama_produk }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Unit Terjual</label>
                                                            <input id="unit_terjual" type="text" class="form-control"
                                                                name="unit_terjual">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="submit" id="addRowButton"
                                                    class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Unit Terjual</th>
                                            <th>Stok awal</th>
                                            <th>Stok Sisa</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Unit Terjual</th>
                                            <th>Stok awal</th>
                                            <th>Stok Sisa</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($penjualan as $item)
                                            <tr>
                                                <td>{{ $item->produk->nama_produk }}</td>
                                                <td>{{ $item->unit_terjual }}</td>
                                                <td>{{ $item->produk->stok }}</td>
                                                <td>{{ $item->produk->stok - $item->unit_terjual }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-id="{{ $item->id }}"
                                                            data-toggle="modal" data-target="#editModal{{ $item->id }}"
                                                            class="btn btn-link btn-primary btn-lg editBtn"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form id="deleteForm{{ $item->id }}"
                                                            action="{{ route('penjualan.destroy', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <!-- Tambahkan ini untuk menentukan metode DELETE -->
                                                            <button type="button" data-id="{{ $item->id }}"
                                                                class="btn btn-link btn-danger deleteBtn"
                                                                data-toggle="tooltip" title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                                                                Edit Penjualan</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('penjualan.update', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-body">
                                                                <div class="mb-2">
                                                                    <label for="">Nama Produk</label>
                                                                    <select name="id_produk" class="form-control">
                                                                        <option value="{{ $item->id_produk }}" selected>
                                                                            {{ $item->produk->nama_produk }}</option>
                                                                        @foreach ($produk as $item_produk)
                                                                            <option value="{{ $item_produk->id }}">
                                                                                {{ $item_produk->nama_produk }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="">Unit Terjual</label>
                                                                    <input type="text" class="form-control"
                                                                        name="unit_terjual"
                                                                        value="{{ $item->unit_terjual }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">UPDATE</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
