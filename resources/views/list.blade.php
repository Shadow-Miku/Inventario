@extends('layouts.menu')

@section('title', 'Products List')

@section('contents')

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
                <td><a href="/products/{{ $product->id }}">Update</a>  <a href="/products/{{ $product->id }}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
