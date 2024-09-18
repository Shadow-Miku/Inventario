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
                <li><b>Stock: </b>{{ $product->stock }}</li>
            </ul>
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

@endsection
