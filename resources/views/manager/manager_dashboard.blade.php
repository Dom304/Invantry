@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .top-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #343a40;
        color: #ffffff;
    }

    .top-toolbar a {
        text-decoration: none;
        color: #ffffff;
    }

    .logo {
        width: 40px;
        height: 40px;
    }

    .app-name {
        margin: 0;
        color: #ffffff;
    }

    .search-container {
        text-align: center;
    }

    .container {
        margin: 20px;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #dee2e6;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #343a40;
        color: #ffffff;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    input, textarea, button {
        margin-bottom: 10px;
        padding: 8px;
        width: 100%;
        box-sizing: border-box;
    }

    button {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

<div class="top-toolbar">
    <a href="/home">
        <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
    </a>
    <h1 class="app-name">Inventory</h1>
    <div class="search-container">
        <h2>Store: {{ $store->store_name }}</h2>
    </div>
    <div>
        <form method="GET" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="container">
    <h1>Welcome, {{ $user->name }}!</h1>
    <img src="{{ asset('storage/' . $store->store_logo) }}" alt="Item Logo">
    <form action="{{ route('updateStore', ['store' => $store->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="store_name">Store Name:</label>
    <input type="text" name="store_name" value="{{ $store->store_name }}" required>

    <label for="store_description">Store Description:</label>
    <textarea name="store_description" rows="3" required>{{ $store->store_description }}</textarea>

    <label for="store_logo">Update Store Picture:</label>
    <input type="file" name="store_logo" accept="image/*">

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
                <th>Actions</th>
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
                    <td>
                    <form action="{{ route('deleteItem', ['store' => $store->id, 'item' => $item->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('addItem', ['store' => $store->id]) }}" method="post" enctype="multipart/form-data">
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
        <input type="file" name="item_logo" accept="image/*" required>

        <button type="submit">Add Item</button>
    </form>
</div>

@endsection