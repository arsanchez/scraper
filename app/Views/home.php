<?php
$this->extend('layout');

$this->section('content');
?>

<h1>Scraped sites</h1>

<div class="form-group">
    <input type="text" class="form-control" id="search" placeholder="Search">
</div>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>John Doe</td>
        <td>johndoe@example.com</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Jane Smith</td>
        <td>janesmith@example.com</td>
    </tr>
    <!-- Add more table rows here -->
    </tbody>
</table>

<?php
$this->endSection()
?>
