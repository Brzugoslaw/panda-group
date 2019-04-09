<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="/assets/css/form.css">
<div class="container main-container">
    <h2>Register</h2>
    <form method="POST" action="formupload.php">
        <div class="row">
            <div class="col-sm-4">
                <label for="fname">Name</label><input id="fname" type="text" name="fname" class="form-control">
                <label for="email">email</label><input id="email" type="email" name="email" class="form-control" required>
            </div>
            <div class="col-sm-4">
                <label for="sname">Surename</label>
                <input id="sname" type="text" name="sname" class="form-control">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control" required>
                <label id="gender" for="male">Gender: </label>
                <label for="male">
                    <input type="radio" id="male" name="gender" value="Male">Male</label>
                <label for="female">
                    <input type="radio" id="female" name="gender" value="Female">Female</label>
            </div>
        </div>
        <input class="btn btn-primary" type="submit">
    </form>
</div>