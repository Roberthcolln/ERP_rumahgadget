@extends('layouts.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master / Pusat /</span> {{ $title }}
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $title }}</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pusat.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pusat" class="form-label">Nama Pusat</label>
                        <input type="text" class="form-control" id="nama_pusat" name="nama_pusat"
                            placeholder="Masukkan nama pusat disini..." value="{{ old('nama_pusat') }}">
                    </div>

                    <div class="card-footer mt-3">
                        <button type="submit" class="btn btn-dark">Save</button>
                        <a href="{{ route('pusat.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
