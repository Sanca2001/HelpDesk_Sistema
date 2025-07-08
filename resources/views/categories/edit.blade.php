@extends('layouts.app')

@section('title', 'Editar - Categoria')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Editar Registro - Categorias</h4>

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
                            <a href="{{ route('categories.index') }}" class="btn btn-primary">Ver Listado</a>
                        </div>

                        <div class="card-body">


                            <form action="{{ route('categories.update', $category->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <!-- Nombre Input -->
                                <div class="mt-2">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text"  value=" {{ $category->name }} " name="name" class="form-control" id="name">

                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Descripcion Textarea -->
                                <div class="mt-2">
                                    <label for="description" class="form-label">Descripcion</label>
                                    <textarea name="description"  class="form-control" id="description" rows="3">{{ $category->description }}</textarea>

                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- botn de enviar --}}
                                <button type="submit"
                                    class=" mt-2 btn btn-outline-success waves-effect waves-light">Actualizar</button>


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







