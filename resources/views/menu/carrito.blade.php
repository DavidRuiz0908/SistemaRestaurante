@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Resumen de la Cuenta</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            @if(count($carrito) > 0)
                <table class="table table-hover">
                    <!-- ... tu tabla de artículos queda igual ... -->
                    <thead>
                        <tr>
                            <th>Platillo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($carrito as $id => $item)
                            @php $subtotal = $item['precio'] * $item['cantidad']; @endphp
                            @php $total += $subtotal; @endphp
                            <tr>
                                <td>{{ $item['nombre'] }}</td>
                                <td>${{ $item['precio'] }}</td>
                                <td>{{ $item['cantidad'] }}</td>
                                <td class="fw-bold">${{ $subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fs-5"><strong>Total a Pagar:</strong></td>
                            <td class="fs-5 text-success fw-bold">${{ $total }}</td>
                        </tr>
                    </tfoot>
                </table>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/menu') }}" class="btn btn-outline-secondary">Volver al Menú</a>
                    <form action="{{ url('/carrito/confirmar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">Confirmar Pedido</button>
                    </form>
                </div>
            @else
                <div class="text-center py-5">
                    <h4 class="text-muted">El pedido está vacío</h4>
                    <a href="{{ url('/menu') }}" class="btn btn-primary mt-3">Ir al Menú</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection