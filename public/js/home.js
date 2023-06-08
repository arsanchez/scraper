const isValidUrl = urlString=> {
    var urlPattern = new RegExp('^(https?:\\/\\/)?'+ // validate protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // validate domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // validate OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // validate port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // validate query string
        '(\\#[-a-z\\d_]*)?$','i'); // validate fragment locator
    return !!urlPattern.test(urlString);
}

$(function() {
    // Setting the datatable
    let tableRef = $('#sites_table').DataTable({
        ajax: '/get_pages',
        columnDefs: [
            {
                target: 1,
                render: function (data, type, row) {
                    let itemID = row[2];
                    return '<a href="/get_links/' + itemID + '">' + data + '</a>';
                },
            },
            {
                target: 2,
                visible: false,
                searchable: false,
            },
        ],
    });

    $('#add_page').on('click', function () {
       // Saving the new page to scrape
        let page = $('#new_scrape_page').val();
        if (isValidUrl(page)) {
            // Saving the new page to scrape
            $.post("/scrape_page", {page},
            function(data, status){
                if (data.success) {
                    $('#new_scrape_page').val('');
                    tableRef.ajax.reload();
                } else {
                    alert(data.message)
                }
            });
        } else {
            alert('Please input a valid URL');
        }
    });
});