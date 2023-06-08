$(function() {
    // Setting the datatable
    let page_id = $('#page_id').val();
    let tableRef = $('#links_table').DataTable({
        ajax: '/get_links_table/' + page_id
    });
});