<?php
/**
 * Created by PhpStorm.
 * User: ashulpekov
 * Date: 04.05.2016
 * Time: 11:15
 */
require_once('header.php');
?>
<script type="text/javascript" src="server/hash/js/hash_controller.js"></script>
<script type="text/javascript" src="server/hash/js/hash_service.js"></script>
<div class="col-md-12">
    <form class="form-horizontal" method="post" id="sendExcel" name="sendExcel" enctype="multipart/form-data"
          action="../router.php?page=hash&action=saveFile">
        <fieldset>
            <legend>Загрузите файл для его сохранения:</legend>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Загрузите файл</label>

                <div class="col-lg-10">
                    <input name="file" size="18" type="file" value="">
                    <button type="submit" class="btn btn-primary btn-xs submit">Загрузить</button>
                </div>

            </div>
        </fieldset>
    </form>
</div>

<div class="col-md-12">

    <div class="btn btn-primary btn-xs" id="getFiles">Показать файлы</div>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Скачать</th>
            <th>Дата добавления</th>
            <th>Имя файла</th>
        </tr>
        </thead>
        <tbody id="filesDataTable">
        </tbody>
    </table>
</div>

</body>
</html>
