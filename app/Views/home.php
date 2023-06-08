<?php
$this->extend('layout');

$this->section('content');
?>

<h1>Scraped sites</h1>

<div class="row">
    <div class="col-md-6 ">
        <input type="text" class="form-control" placeholder="Scrape" id="new_scrape_page">
    </div>
    <div class="col-md-6 ">
        <div class="input-group mb-3">
            <a class="btn btn-primary" type="button" id="add_page">Scrape</a>
        </div>
    </div>
</div>


<table class="table table-bordered" id="sites_table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Total links</th>
        <th>ID</th>
    </tr>
    </thead>
    <tfoot>
        <th>Name</th>
        <th>Total links</th>
        <th>ID</th>
    </tfoot>
</table>

<?php
$this->endSection();
$this->section('scripts');
?>

<script type="text/javascript" src="<?php echo base_url('js/home.js'); ?>"></script>

<?php
$this->endSection();
?>


