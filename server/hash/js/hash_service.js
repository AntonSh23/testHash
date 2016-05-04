'use strict';

var HashService = (function () {

    return {
        getAllFilesData: function () {
            $.ajax({
                type: 'POST',
                url: 'router.php?page=hash&action=getAllFilesData',
                success: function (response) {
                    renderDataTable(response);
                }
            })
        }
    }
})
();