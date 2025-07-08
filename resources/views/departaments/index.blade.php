@extends('layouts.app')

@section('title', 'Mantenimiento - Departamento')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Listado de Departamentos</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Departamentos</h5>
                        </div>

                        <div class="card-body">

                            <a class="btn btn-primary mb-3" href="{{ route('departaments.create') }}">Nuevo Registro</a>



                            <table id="departamentsTable"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>

                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($departaments as $departament)
                                        <tr>
                                            <td>{{ $departament->id }}</td>
                                            <td>{{ $departament->name }}</td>
                                            <td>
                                                <a href="{{ route('departaments.edit', $departament->id) }}"
                                                    class="btn btn-sm btn-warning">Editar</a>

                                                <button class="btn btn-sm btn-danger btn-delete"
                                                    data-id="{{ $departament->id }}">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')

    <script>
        $(document).ready(function() {
            $('#departamentsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });

            $('.btn-delete').click(function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/departaments/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('¡Eliminado!', response.message,
                                            'success')
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function() {
                                Swal.fire('Error', 'No se pudo eliminar el departamento.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
