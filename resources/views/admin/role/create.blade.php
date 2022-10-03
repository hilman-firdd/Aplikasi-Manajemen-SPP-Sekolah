@extends('layouts.master')

@section('site-name','Sistem Informasi SPP')
@section('page-name','Role Create')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        @yield('page-name')
    </h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">@yield('page-name')</h5>
            </div>
            <div class="table-responsive">
                <form action="{{ route('role.store') }}" method="post">
                    @csrf
                    <div class="row p-2">
                        <div class="d-flex flex-row justify-content-center">
                            <div class="col-sm-3 me-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 me-2">
                                <div class="form-group">
                                    <label for="display_name">Display Name</label>
                                    <input type="text" name="display_name" value="{{ old('display_name') }}" required
                                        class="form-control @error('display_name') is-invalid @enderror">
                                    @error('display_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3 me-2">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" value="{{ old('description') }}" required
                                        class="form-control @error('description') is-invalid @enderror">
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="mt-2 btn btn-xl btn-success px-5"><i
                                class="fas fa-save"></i>&nbsp;Simpan</button>
                    </div>

            </div>
            <div class="card-footer">
                <div class="card-header">
                    <h6 class="card-title text-center">Form Menu - Permission</h6>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            @foreach ($menus as $menu)
                            <div class="col-md-4" id="accordion" class="accordion">
                                <a class="d-block w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $menu->id}}" href="#collapse{{ $menu->id}}">
                                    <div class="card-header">
                                        <h6 class="card-title w-100 text-center">
                                            {{ $menu->menu_nama }}
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapse{{ $menu->id}}" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordion">
                                    <div class="card-body">
                                        @foreach($menu->permissions as $permission)
                                        <div class="form-check d-inline">
                                            <input type="checkbox" id="" name="permissions_id[]" value="{{
                                                $permission->id }}">
                                            <label class="form-check-label" for="">{{ $permission->display_name
                                                }}</label>
                                        </div>
                                        @endforeach
                                        @error('permissions_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection