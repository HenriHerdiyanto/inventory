@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="page-inner">
            <h4 class="page-title">User Profile</h4>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-with-nav">
                        <div class="card-header">
                            <div class="row row-nav-line">
                                <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile"
                                            role="tab" aria-selected="false">Profile</a> </li>
                                </ul>
                            </div>
                        </div>
                        <form action="{{ route('profile.update', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Birth Date</label>
                                            <input type="date" class="form-control" name="tgl_lahir"
                                                value="{{ $user->tgl_lahir }}" placeholder="Birth Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="{{ $user->gender }}" selected>{{ $user->gender }}</option>
                                                <option value="pria">Pria</option>
                                                <option value="wanita">Wanita</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $user->phone }}" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $user->address }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>MY POSITION</label>
                                            <input type="text" class="form-control" name="posisi"
                                                value="{{ $user->posisi }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Upload Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3">
                                    <button type="submit" id="alert_demo_3_3"
                                        class="btn btn-success mr-2 w-100">UPDATE</button>
                                </div>
                        </form>
                        <form action="{{ route('profile.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete') <!-- Mengubah metode HTTP dari post menjadi delete -->
                            <button type="submit" id="alert_demo_8" class="btn btn-danger w-100">DELETE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile card-secondary">
                    <div class="card-header" style="background-image: url('{{ asset('assets/img/blogpost.jpg') }}')">
                        <div class="profile-picture">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('fotouser/' . $user->foto) }}" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <div class="name">{{ $user->name }}</div>
                            <div class="job">{{ $user->posisi }}</div>
                            <div class="desc">A man who hates loneliness</div>
                            <div class="social-media">
                                <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                                    <span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
                                </a>
                                <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                    <span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span>
                                </a>
                                <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
                                    <span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
                                </a>
                                <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                    <span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span>
                                </a>
                            </div>
                            <div class="view-profile">
                                <a href="#" class="btn btn-secondary btn-block">View Full Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row user-stats text-center">
                            <div class="col">
                                <div class="number">125</div>
                                <div class="title">Post</div>
                            </div>
                            <div class="col">
                                <div class="number">25K</div>
                                <div class="title">Followers</div>
                            </div>
                            <div class="col">
                                <div class="number">134</div>
                                <div class="title">Following</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
