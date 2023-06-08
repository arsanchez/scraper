<?php
$this->extend('layout');

$this->section('content')
?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Login</h1>
            <form action="<?php echo base_url(); ?>auth/login" method="post">
                <div class="form-group">
                    <label for="email">Username</label>
                    <input type="texy" class="form-control" name="username" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p class="mt-3">Don't have an account? <a href="/auth/signup">Signup here</a></p>
            </form>
        </div>
    </div>
<?php
    $this->endSection()
?>