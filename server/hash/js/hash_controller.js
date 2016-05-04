/**
 * Created by ashulpekov on 04.05.2016.
 */

document.addEventListener("DOMContentLoaded", function () {
    var getFilesBtn = document.getElementById('getFiles');

    getFilesBtn.addEventListener('click', getFilesData, false);
});

var getFilesData = function () {
    HashService.getAllFilesData();
};

var renderDataTable = function (data) {

    $('#filesDataTable').empty();
    var tableData = JSON.parse(data);
    var objLen = tableData.length;
    var table = document.getElementById('filesDataTable');
    var count = 0;


    while (objLen > count) {
        var row = document.createElement('tr');
        for (cur in tableData[count]) {
            var cell = document.createElement('td');
            if (cur == 'unit_link') {
                var link = document.createElement('a');
                link.className = 'btn btn-primary btn-xs download';
                link.innerHTML = tableData[count][cur];
                link.setAttribute('data-file-link', tableData[count][cur]);
                link.setAttribute('data-name', tableData[count].filename);
                link.addEventListener('click', getFile, false);
                cell.appendChild(link);
            } else {
                cell.innerHTML = tableData[count][cur];
            }
            row.appendChild(cell);
        }

        row.setAttribute('data-cell-id', data[count].id);
        table.appendChild(row);
        count++
    }
};

var getFile = function () {
    var path = this.getAttribute('data-file-link');
    var name = this.getAttribute('data-name');
    window.open('router.php?page=hash&action=getFileFromServer&path=' + path + name);
};
