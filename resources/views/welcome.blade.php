@extends('layouts.menu')

@section('title', 'Stock List')

@section('contents')

    @if(Session::has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <!-- SVG Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
            </svg>
            <div>
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

    <div class="list">
        @foreach ($products as $product)
            <div class="product">
                <img src="{{ asset('storage/' . $product->url) }}" alt="{{ $product->name }}" loading="lazy">
                <ul>
                    <li><strong>Product:</strong> {{ $product->product_name }}</li>
                    <li><strong>Category:</strong> {{ $product->category }}</li>
                </ul>
                <a href="#"
                   class="btn btn-outline-info btn-sm"
                   data-bs-toggle="modal"
                   data-bs-target="#dynamicModal"
                   data-product='@json($product)'>
                   <i class="bi bi-file-earmark-richtext"></i> Details
                </a>
                <!-- Formulario para agregar al carrito -->
                <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $product->id }}">
                    <div class="input-group input-group-sm">
                        <input type="number" name="cantidad" value="1" min="1" max="{{ $product->stock }}" class="form-control" required>
                        <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>

    <!-- Modal Dinámico Único -->
    <div class="modal fade" id="dynamicModal" tabindex="-1" aria-labelledby="dynamicModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dynamicModalLabel">Product Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                    <!-- Columna Izquierda: Información del Producto -->
                    <div class="w-50 me-3">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Name</label>
                            <p id="modalProductName"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Serial Number</label>
                            <p id="modalSerial"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <p id="modalCategory" class="text-capitalize"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Price per Unit</label>
                            <p id="modalPrice"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Units in Stock</label>
                            <p id="modalStock"></p>
                        </div>
                    </div>
                    <!-- Columna Derecha: Imagen del Producto -->
                    <div class="w-50">
                        <label class="form-label fw-bold">Product Image</label><br>
                        <img id="modalImage" src="" alt="Product Image" class="img-fluid rounded border">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dynamicModal = document.getElementById('dynamicModal');

            dynamicModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var product = JSON.parse(button.getAttribute('data-product'));

                // Actualizar el contenido del modal
                document.getElementById('modalProductName').textContent = product.product_name;
                document.getElementById('modalSerial').textContent = product.serial;
                document.getElementById('modalCategory').textContent = product.category;
                document.getElementById('modalPrice').textContent = product.price;
                document.getElementById('modalStock').textContent = product.stock;
                document.getElementById('modalImage').src = '{{ asset('storage') }}/' + product.url;
                document.getElementById('modalImage').alt = product.product_name;
            });
        });
    </script>

@endsection
