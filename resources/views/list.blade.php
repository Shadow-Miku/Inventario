@extends('layouts.menu')

@section('title', 'Products List')

@section('contents')

    @if(Session::has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
        </svg>
        <div>
            {{ Session::get('success') }}
        </div>
    </div>
    @endif

    @if(Session::has('updated'))
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-highlighter me-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.096.644a2 2 0 0 1 2.791.036l1.433 1.433a2 2 0 0 1 .035 2.791l-.413.435-8.07 8.995a.5.5 0 0 1-.372.166h-3a.5.5 0 0 1-.234-.058l-.412.412A.5.5 0 0 1 2.5 15h-2a.5.5 0 0 1-.354-.854l1.412-1.412A.5.5 0 0 1 1.5 12.5v-3a.5.5 0 0 1 .166-.372l8.995-8.07zm-.115 1.47L2.727 9.52l3.753 3.753 7.406-8.254zm3.585 2.17.064-.068a1 1 0 0 0-.017-1.396L13.18 1.387a1 1 0 0 0-1.396-.018l-.068.065zM5.293 13.5 2.5 10.707v1.586L3.707 13.5z"/>
        </svg>
        <div>
            {{ Session::get('updated') }}
        </div>
    </div>
    @endif

    @if(Session::has('deleted'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle me-2" viewBox="0 0 16 16">
            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
        </svg>
        <div>
            {{ Session::get('deleted') }}
        </div>
    </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->category }}</td>
            <td>
                <!-- Update button -->
                <a href="#"
                   class="btn btn-outline-primary btn-sm update-product-btn"
                   data-bs-toggle="modal"
                   data-bs-target="#updateProductModal"
                   data-id="{{ $product->id }}"
                   data-name="{{ $product->product_name }}"
                   data-serial="{{ $product->serial }}"
                   data-category="{{ $product->category }}"
                   data-price="{{ $product->price }}"
                   data-stock="{{ $product->stock }}"
                   data-url="{{ asset('storage/' . $product->url) }}">
                   Update product
                </a>

                <!-- Delete button -->
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>

        @endforeach
        </tbody>
    </table>

    <!-- Modal Update Product -->
    <div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                    <form id="updateProductForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <!-- Left Column: Form -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="update_product_name" class="form-label" style="font-weight: bold;">Name</label>
                                    <input type="text" name="product_name" id="update_product_name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="update_serial" class="form-label" style="font-weight: bold;">Serial</label>
                                    <input type="text" name="serial" id="update_serial" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="update_category" class="form-label" style="font-weight: bold;">Category</label>
                                    <input type="text" name="category" id="update_category" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="update_price" class="form-label" style="font-weight: bold;">Price</label>
                                    <input type="number" step="0.25" name="price" id="update_price" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="update_stock" class="form-label" style="font-weight: bold;">Stock</label>
                                    <input type="number" name="stock" id="update_stock" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="update_url" class="form-label" style="font-weight: bold;">Image</label>
                                    <input type="file" id="update_url" name="url" class="form-control" onchange="previewImage2(this)">
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                            <!-- Right Column: Image Preview -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label id="update_imageLabel2" class="form-label" style="font-weight: bold;">Current Image</label>
                                    <br>
                                    <img id="update_imagePreview2" src="" alt="Current Image" class="img-fluid rounded border">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage2(input) {
            const file = input.files[0];
            const preview = document.getElementById('update_imagePreview2');
            const label = document.getElementById('update_imageLabel2');
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    label.textContent = 'Preview';
                };
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const updateModal = document.getElementById('updateProductModal');
            updateModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Botón que abrió el modal
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const serial = button.getAttribute('data-serial');
                const category = button.getAttribute('data-category');
                const price = button.getAttribute('data-price');
                const stock = button.getAttribute('data-stock');
                const url = button.getAttribute('data-url');

                // Actualiza la acción del formulario
                const form = document.getElementById('updateProductForm');
                form.action = `/list/update/${id}`;

                // Rellena los campos del formulario
                document.getElementById('update_product_name').value = name;
                document.getElementById('update_serial').value = serial;
                document.getElementById('update_category').value = category;
                document.getElementById('update_price').value = price;
                document.getElementById('update_stock').value = stock;
                document.getElementById('update_imagePreview2').src = url;
            });
        });
    </script>

@endsection
