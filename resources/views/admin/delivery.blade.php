@include('admin.navigation')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Users</h3><br>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>
                                            @if ($user->image)
                                                <img src="{{ asset('images/' . $user->image) }}" alt="User Image" width="50">
                                            @else
                                                <img src="images/default.png" alt="Default Image" width="50">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('delivery-users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('delivery-users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
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
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Add User</h3><br>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('delivery-users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control form-control-sm" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="birth">Birth Date</label>
                            <input type="date" name="birth" class="form-control form-control-sm" required>
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <br><br><br><br><br><br>

    @include('admin.down')
</div>
