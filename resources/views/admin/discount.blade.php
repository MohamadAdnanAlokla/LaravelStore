
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    @include('admin.navigation')
    <br><br>
    <div class="container mt-4">
        <h1>Product Discounts</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Variation ID</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Discount Percentage</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->variation_id }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->size }}</td>
                            <td>{{ $product->color_name }}</td>
                            <td>{{ $product->discount_percentage }}%</td>
                            <td>
                                <!-- إضافة نموذج لتحديث التخفيض -->
                                <form action="{{ route('addDiscount') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="variation_id" value="{{ $product->variation_id }}">
                                    <label for="discount">Discount:</label>
                                    <input type="number" name="discount" min="0" max="100" step="1" placeholder="Add Discount">
                                    <br>
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date" placeholder="Start Date">
                                    <br>
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="end_date" id="end_date" placeholder="End Date">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                </form>


                                <!-- نموذج لحذف التخفيض -->
                                <form action="{{ route('removeDiscount') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="variation_id" value="{{ $product->variation_id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    @include('admin.down')

