@extends('layouts.menu')

@section('title', 'Carrito de Compras')

@section('contents')

    <h1>Carrito de Compras</h1>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    @if($cart && count($cart) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['product_name'] }}</td>
                        <td>${{ number_format($item['precio'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" max="{{ $item['cantidad'] + App\Models\Product::find($id)->stock }}" class="form-control form-control-sm me-2" required>
                                <button type="submit" class="btn btn-sm btn-success">Actualizar</button>
                            </form>
                        </td>
                        <td>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">Limpiar Carrito</button>
            </form>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Realizar Compra</button>
            </form>
        </div>
    @else
        <p>El carrito está vacío.</p>
    @endif

@endsection
