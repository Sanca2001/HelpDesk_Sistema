@extends('layouts.app')

@section('title', 'Registro - FAQS')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Nuevo Registro - FAQS</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <a href="{{ route('faqs.index') }}" class="btn btn-primary">Ver Listado</a>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('faqs.store') }}" method="POST">
                                @csrf

                                <!-- titulo -->
                                <div class="mt-2">
                                    <label for="title" class="form-label">Titulo</label>
                                    <input type="text" name="title" class="form-control" id="title">

                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Descripcion Textarea -->
                                <div class="mt-2">
                                    <label for="description" class="form-label">Descripcion</label>
                                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>

                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- botn de enviar --}}
                                <button type="submit"
                                    class=" mt-2 btn btn-outline-success waves-effect waves-light">Crear</button>


                            </form>



                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
@endpush



