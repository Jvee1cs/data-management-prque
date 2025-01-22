<form action="{{ route('store-people-data') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="profile_picture">Profile Picture</label>
        <input type="file" name="profile_picture" class="form-control">
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="gender">Gender</label>
        <input type="text" name="gender" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" name="age" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="location" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="class">Class</label>
        <input type="text" name="class" class="form-control" required>
    </div>


    <button type="submit" class="btn btn-primary">Save</button>
</form>
