@include('admin.navigation')

<link rel="stylesheet" type="text/css" href="{{ asset('css/spectrum.css') }}">
<!-- تعويض "path/to/spectrum.css" بمسار الملف الفعلي لملف CSS لمكتبة Spectrum -->

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div id="content" class="p-4 p-md-5">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h1>Colors</h1>
                <br><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Hex Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                            <tr>
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td>{{ $color->hex_code }}</td>
                                <td>
                                    <form action="{{ route('colors.delete', $color) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- تحميل مكتبة Spectrum Color Picker -->
<!-- تحميل مكتبة Spectrum Color Picker -->

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Add Color</h2>
                <form action="{{ route('colors.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control form-control-sm" name="color" id="color" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm">Save Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<br><br><br><br><br>
@include('admin.down')
