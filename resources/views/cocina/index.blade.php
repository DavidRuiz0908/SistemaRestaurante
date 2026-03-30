@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4 text-danger fw-bold">🔥 Comandas Pendientes 🔥</h1>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        @if($pedidos->count() > 0)
            @foreach($pedidos as $pedido)
                <div class="col-md-4 mb-4">
                    <div class="card border-warning shadow-sm h-100">
                        <div class="card-header bg-warning text-dark fw-bold d-flex justify-content-between">
                            <span>Pedido #{{ $pedido->id }}</span>
                            <span>{{ $pedido->mesa }}</span>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3">
                                @foreach($pedido->items as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $item->platillo->nombre }}
                                        <span class="badge bg-secondary rounded-pill">x{{ $item->cantidad }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <form action="{{ url('/cocina/completar/'.$pedido->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100 fw-bold">Marcar como Listo</button>
                            </form>
                        </div>
                        <div class="card-footer text-muted text-center small">
                            Recibido hace {{ $pedido->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <h3 class="text-muted">No hay pedidos pendientes. ¡La cocina está limpia! ✨</h3>
            </div>
        @endif
    </div>
</div>
@endsection