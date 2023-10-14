@extends('layouts.app')

@section('content')
Hello World
<body>
    <h1>Insert Item</h1>

    <form action="{{ route('insert.post') }}" method="post">
        @csrf
        <label for="store_id">Store ID:</label>
        <input type="number" name="store_id" required><br>

        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required><br>

        <label for="item_description">Item Description:</label>
        <textarea name="item_description" required></textarea><br>

        <label for="item_quantity">Item Quantity:</label>
        <input type="number" name="item_quantity" required><br>

        <label for="item_price">Item Price:</label>
        <input type="number" step="0.01" name="item_price" required><br>

        <input type="submit" value="Insert Item">
    </form>
</body>
@endsection
