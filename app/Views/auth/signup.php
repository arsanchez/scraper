<?php
$this->extend('layout');

$this->section('content')
?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Signup</h1>
            <?php if(isset($validation)):?>
                <div class="alert alert-warning">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif;?>
            <form action="<?php echo base_url(); ?>auth/signup" method="post">
                <div class="form-group">
                    <label for="username">Email address</label>
                    <input value="<?= set_value('username') ?>" type="text" class="form-control" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password">Confirm password</label>
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Signup</button>
                <p class="mt-3">Already have an account? <a href="/auth/login">Login here</a></p>
            </form>
        </div>
    </div>
<?php
$this->endSection()
?>