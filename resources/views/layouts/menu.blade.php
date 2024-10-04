<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Import Bootstrap CSS and JS for modals -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" ></script>
    <!-- Import Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Import JS, Styles and icon -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- TOP MENU -->
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">F.R.E.S.H</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('list') }}">List</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- Botón de navegación para abrir el modal -->
                        <li class="nav-item register-product">
                            <a class="btn btn-outline-success btn-sm create-product-btn" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#registerProductModal">Register product</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

<!-- Modal -->
    <div class="modal fade" id="registerProductModal" tabindex="-1" aria-labelledby="registerProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerProductLabel">Register Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                    <!-- Left Column: Info -->
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="w-30 me-4">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="serial" class="form-label">Serial</label>
                                <input type="text" class="form-control" id="serial" name="serial" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step=".25" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>

                            <div class="mb-3">
                                <label for="url" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                                <div class="mt-2">
                                    <input type="file" id="url" name="url" class="block w-full text-gray-900" onchange="previewImage(this)">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register Product</button>
                    </form>
                    <!-- Right Column: Image preview -->
                    <div class="col-md-6">
                        <label class="form-label" style="font-weight: bold;">Preview</label>
                        <div>
                            <img id="imagePreview" src="" class="img-fluid rounded border border-secondary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- Main Content -->
        <main class="container my-4">
            <div>@yield('contents')</div>
        </main>
    </div>


</body>


</html>
