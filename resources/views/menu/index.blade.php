@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Nuestro Menú</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @foreach($categorias as $categoria)
        <h3 class="mt-4 border-bottom pb-2">{{ $categoria->nombre }}</h3>
        <div class="row">
            @foreach($categoria->platillos as $platillo)
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $platillo->nombre }}</h5>
                            <p class="card-text text-success fw-bold fs-5">${{ $platillo->precio }}</p>
                            <form action="{{ url('/carrito/agregar/'.$platillo->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary w-100">Agregar al Pedido</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection