@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, {{ $user->name }}!</h1>

        <h2>Your Store: {{ $store->store_name }}</h2>
        <p>Description: {{ $store->store_description }}</p>

        <form action="{{ route('updateStore', ['store' => $store->id]) }}" method="post">
            @csrf
            @method('PUT')

            <label for="store_name">Store Name:</label>
            <input type="text" name="store_name" value="{{ $store->store_name }}" required>

            <label for="store_description">Store Description:</label>
            <textarea name="store_description" rows="3" required>{{ $store->store_description }}</textarea>

            <button type="submit">Update Store</button>
        </form>

        <h3>Items in the Store:</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Item Logo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->item_description }}</td>
                        <td>{{ $item->item_quantity }}</td>
                        <td>${{ $item->item_price }}</td>
                        <td>${{ $item->item_logo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('addItem', ['store' => $store->id]) }}" method="post">
            @csrf
            <label for="item_name">Item Name:</label>
            <input type="text" name="item_name" required>

            <label for="item_description">Item Description:</label>
            <textarea name="item_description" rows="3" required></textarea>

            <label for="item_quantity">Quantity:</label>
            <input type="number" name="item_quantity" required>

            <label for="item_price">Price:</label>
            <input type="number" name="item_price" step="0.01" required>

            <label for="item_logo">Item Logo</label>
            <input type="text" name="item_logo"  required>

            <button type="submit">Add Item</button>
        </form>
    </div>
@endsection