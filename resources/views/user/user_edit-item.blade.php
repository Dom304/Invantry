<form action="{{ route('updateItem', ['store' => $store->id, 'item' => $item->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" name="item_name" value="{{ $item->item_name }}" required>

    <label for="item_description">Item Description:</label>
    <textarea id="item_description" name="item_description" rows="3" required>{{ $item->item_description }}</textarea>

    <label for="item_quantity">Quantity:</label>
    <input type="number" id="item_quantity" name="item_quantity" value="{{ $item->item_quantity }}" required>

    <label for="item_price">Price:</label>
    <input type="number" id="item_price" name="item_price" step="0.01" value="{{ $item->item_price }}" required>

    <label for="item_logo">Item Logo</label>
    <input type="file" name="item_logo" accept="image/*">

    <button type="submit">Update Item</button>
</form>