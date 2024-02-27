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
                            <div class="d-flex align-produkItems-center">
                                <div class="col">
                                    <h4 class="card-title">Master Produk</h4>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-info btn-border btn-round btn-sm" data-toggle="modal"
                                        data-target="#ImportRowModal">
                                        <i class="fa fa-plus"></i>
                                        Import
                                    </button>
                                    <a href="{{ asset('test_produk.xlsx') }}"
                                        class="btn btn-info btn-border btn-round btn-sm">
                                        <i class="fa fa-plus"></i> Template Import
                                    </a>
                                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                        data-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Add Row
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- Modal Import --}}
                            <div class="modal fade" id="ImportRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">Import Data</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Pilih File</label>
                                                            <input id="file" type="file" class="form-control"
                                                                name="file">
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
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">Tambah Produk</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('produk.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('post')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Kategori</label>
                                                            <select name="id_kategori" class="form-control">
                                                                <option selected>--- PILIH ---</option>
                                                                @foreach ($kategori as $produkItem)
                                                                    <option value="{{ $produkItem->id }}">
                                                                        {{ $produkItem->jenis_kategori }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Nama Produk</label>
                                                            <input id="nama_produk" type="text" class="form-control"
                                                                name="nama_produk">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Harga Beli</label>
                                                            <input id="harga_beli" type="text" class="form-control"
                                                                name="harga_beli">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Harga Jual</label>
                                                            <input id="harga_jual" type="text" class="form-control"
                                                                name="harga_jual" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Stok Barang</label>
                                                            <input id="stok" type="text" class="form-control"
                                                                name="stok">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Kondisi Barang</label>
                                                            <input id="foto" type="file" class="form-control"
                                                                name="foto">
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
                                            <th>Kategori</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stok awal</th>
                                            <th>Gambar</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stok awal</th>
                                            <th>Gambar</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($produk as $produkItem)
                                            <tr>
                                                <td>
                                                    @if (empty($produkItem->kategori))
                                                        Data Parent Tidak Ditemukan
                                                    @else
                                                        {{ $produkItem->kategori->jenis_kategori }}
                                                    @endif
                                                </td>

                                                <td>{{ $produkItem->nama_produk }}</td>
                                                <td>Rp.{{ number_format($produkItem->harga_beli) }}</td>
                                                <td>Rp. {{ number_format($produkItem->harga_jual) }}</td>
                                                <td>{{ $produkItem->stok }}</td>
                                                <td>
                                                    <img src="{{ asset('produk/' . $produkItem->foto) }}"
                                                        class="img-fluid" style="width: 100px;" alt="">
                                                </td>
                                                <td>
                                                    @if ($produkItem->stok < 1)
                                                        <h4><span class="badge bg-danger">Stok Habis</span></h4>
                                                    @else
                                                        <h4><span class="badge bg-success">Stok Tersedia</span></h4>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-id="{{ $produkItem->id }}"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $produkItem->id }}"
                                                            class="btn btn-link btn-primary btn-lg editBtn"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form id="deleteForm{{ $produkItem->id }}"
                                                            action="{{ route('produk.destroy', $produkItem->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <!-- Tambahkan ini untuk menentukan metode DELETE -->
                                                            <button type="button" data-id="{{ $produkItem->id }}"
                                                                class="btn btn-link btn-danger deleteBtn"
                                                                data-toggle="tooltip" title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{ $produkItem->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $produkItem->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel{{ $produkItem->id }}">Edit Produk</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('produk.update', $produkItem->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-body">
                                                                <div class="mb-2">
                                                                    <label for="">Kategori Produk</label>
                                                                    <select name="id_kategori" class="form-control">
                                                                        @if (!is_null($produkItem->kategori))
                                                                            <option
                                                                                value="{{ $produkItem->id_kategori }}">
                                                                                {{ $produkItem->kategori->jenis_kategori }}
                                                                            </option>
                                                                        @else
                                                                            <option value="">Data Parent Telah
                                                                                dihapus</option>
                                                                        @endif

                                                                        @foreach ($kategori as $kategoriItem)
                                                                            <option value="{{ $kategoriItem->id }}">
                                                                                {{ $kategoriItem->jenis_kategori }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="">Nama Produk</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama_produk"
                                                                        value="{{ $produkItem->nama_produk }}">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="">Harga Beli</label>
                                                                    <input type="text" class="form-control"
                                                                        name="harga_beli"
                                                                        value="{{ $produkItem->harga_beli }}">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="">Harga Jual</label>
                                                                    <input type="text" class="form-control"
                                                                        name="harga_jual"
                                                                        value="{{ $produkItem->harga_jual }}">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="">Stok Awal</label>
                                                                    <input type="text" class="form-control"
                                                                        name="stok" value="{{ $produkItem->stok }}">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="">Gambar</label><br>
                                                                    <img src="{{ asset('produk/' . $produkItem->foto) }}"
                                                                        class="img-fluid" style="width: 100px;"
                                                                        alt="">
                                                                    <input type="file" class="form-control"
                                                                        name="foto" value="{{ $produkItem->foto }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Update</button>
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
    <script>
        // Ambil elemen input harga beli dan harga jual
        const inputHargaBeli = document.getElementById('harga_beli');
        const inputHargaJual = document.getElementById('harga_jual');

        // Tambahkan event listener pada input harga beli
        inputHargaBeli.addEventListener('input', function() {
            // Ambil nilai harga beli dan konversi menjadi angka
            const hargaBeli = parseFloat(inputHargaBeli.value);

            // Jika nilai harga beli adalah angka
            if (!isNaN(hargaBeli)) {
                // Hitung harga jual (harga beli + 30%)
                const hargaJual = hargaBeli * 1.3;

                // Set nilai input harga jual
                inputHargaJual.value = hargaJual.toFixed(); // Menampilkan 2 angka di belakang koma
            } else {
                // Jika nilai harga beli bukan angka, atur nilai input harga jual menjadi kosong
                inputHargaJual.value = '';
            }
        });
    </script>
@endsection
