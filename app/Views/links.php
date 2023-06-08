<?php
$this->extend('layout');

$this->section('content');
?>

<h1>Links sites</h1>
<a href="/">< Back</a>
<input type="hidden" id="page_id" value="<?php echo $page_id; ?>">
<table class="table table-bordered" id="links_table">
    <thead>
    <tr>
        <th>Name</th>
        <th>URL</th>
    </tr>
    </thead>
    <tfoot>
    <th>Name</th>
    <th>URL</th>
    </tfoot>
</table>

<?php
$this->endSection();
$this->section('scripts');
?>

<script type="text/javascript" src="<?php echo base_url('js/links.js'); ?>"></script>

<?php
$this->endSection();
?>
