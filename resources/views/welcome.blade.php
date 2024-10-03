@extends('layouts.menu')

@section('title', 'Stock List')

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

    <div class="list">
       @foreach ($products as $product)
        <div class="product">
            <img src="{{ asset('storage/' . $product->url) }}" alt="{{ $product->name }}">
            <ul>
                <li><b>Product: </b>{{ $product->product_name }}</li>
                <li><b>Category: </b>{{ $product->category }}</li>
            </ul>
            <a href="#" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                <i class="fas fa-info-circle"></i> Details
            </a>
        </div>
        @endforeach

        {{-- <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/150" alt="">
            <ul>
                <li><b>Product: </b>product name</li>
                <li><b>Category: </b>product category</li>
                <li><b>Stock: </b>10</li>
            </ul>
        </div>
 --}}
    </div>

    @foreach ($products as $product)
    <!-- Modal -->
    <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="productModalLabel{{ $product->id }}">Product Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex">
            <!-- Left Column: Info -->
            <div class="w-50 me-3">
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Name</label>
                    <p>{{ $product->product_name }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Serial</label>
                    <p>{{ $product->serial }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Category</label>
                    <p class="text-capitalize">{{ $product->category }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Price per unit</label>
                    <p>{{$product->price}}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Units in stock</label>
                    <p>{{$product->stock}}</p>
                </div>
            </div>
            <!-- Right Column: Image -->
            <div class="w-50">
                <label class="form-label fw-bold">Product Image</label>
                <br>
                <img src="{{ asset('storage/' . $product->url) }}" alt="Product Image" class="img-fluid">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    @endforeach

@endsection
