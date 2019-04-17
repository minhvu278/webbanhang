<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
    include 'partial/header_script.php';
    ?>
    <link rel="stylesheet" href="../admin/theme/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="include/pnotify/pnotify.custom.min.css">

    <script>
        function setEditData(id, name, url, note) {
            $('#edit_id').val(id);
            $('#edit_tendm').val(name);
            $('#edit_url').val(url);
            $('#edit_ghichu').val(note);

        }
        function setRemoveData(id, name, url, note) {
            $('#remove_id').val(id);
            $('#remove_tendm').val(name);
            $('#remove_url').val(url);
            $('#remove_ghichu').val(note);

        }
    </script>

</head>
<body>
<?php
include 'partial/header.php';
include 'partial/menu.php';
?>
<div class="content-wrapper">
    <section class="content">
        <!--Slide box-->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Danh mục sản phẩm</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row mp-margin-15" style="margin: 15px;">
                    <button
                            data-toggle="modal" data-target="#modalAdd"
                            class="btn btn-success">
                        <i class="fa fa-plus"></i>
                        Thêm danh mục
                    </button>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="5%">STT</th>
                        <th width="20%">Tên danh mục</th>
                        <th width="20%">Url</th>
                        <th width="20%">Ghi chú</th>
                        <th width="30%">Hành động</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!--End slide box-->
    </section>
</div>

<!-- Modal add -->
<div class="modal fade" id="modalAdd" role="dialog">
    <div class="modal-dialog">

        <!-- Modal add content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thêm mới danh mục</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-3">Tên danh mục</label>
                    <div class="col-sm-9">
                        <input id="add_tendm" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập tên danh mục" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Ghi chú</label>
                    <div class="col-sm-9">
                        <input id="add_ghichu" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập ghi chú" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Url</label>
                    <div class="col-sm-9">
                        <input id="add_url" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập url" autofocus required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnAdd" class="btn btn-success">
                    <i class="fa fa-check"></i>
                    Thêm
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-ban"></i>
                    Hủy
                </button>
            </div>
        </div>

    </div>
</div>
<!--End modal add-->

<!-- Modal edit -->
<div class="modal fade" id="modalEdit" role="dialog">
    <div class="modal-dialog">

        <!-- Modal edit content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sửa danh mục</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editForm" method="POST" action="xuly_category.php">

                    <input id="edit_id" name="id"
                           type="hidden">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tên danh mục</label>
                        <div class="col-sm-9">
                            <input id="edit_tendm" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập tên danh mục" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Url</label>
                        <div class="col-sm-9">
                            <input id="edit_url" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập url" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Ghi chú</label>
                        <div class="col-sm-9">
                            <input id="edit_ghichu" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập ghi chú" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnEdit" type="submit" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                    Cập nhật
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-ban"></i>
                    Hủy
                </button>
            </div>
        </div>

    </div>
</div>
<!--End modal edit-->

<!-- Modal remove -->
<div class="modal fade" id="modalRemove" role="dialog">
    <div class="modal-dialog">

        <!-- Modal remove-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Xóa danh mục</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có thực sự muốn xóa danh mục <b><span id="remove_name"></span></b> ?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="remove_id">
                <input type="hidden" name="source" value="remove_form">
                <button
                        id="btnRemove"
                        type="submit"
                        class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                    Xóa
                </button>

                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fa fa-ban"></i>
                    Hủy
                </button>
            </div>
        </div>

    </div>
</div>
<?php
include 'partial/footer.php';
include 'partial/footer_script.php';
?>
<script src="include/pnotify/pnotify.custom.min.js"></script>

<script>
    $(document).ready(function () {
        // Code chay lan dau
        getData()

        // Gan su kien cho button
        $('#reloadData').on('click', function () {
            getData();
        })

        $('#btnAdd').on('click', function () {
            insertData()
            $('#modalAdd').modal('hide')
        })

        $('#btnEdit').on('click', function () {
            editData()
            $('#modalEdit').modal('hide')
        })

        $('#btnRemove').on('click', function () {
            removeData()
            $('#modalRemove').modal('hide')
        })

        // Dinh nghia cac ham
        function getData() {
            $.ajax({
                method: 'GET',
                url: 'service/category.php?mode=get_data',
                success: function (data) {
                    var obj = JSON.parse(data)
                    console.log(obj);
                    var HTML = '';
                    var id, name, url, note, params;
                    for (var i = 0; i < obj.data.length; i++) {
                        id = obj.data[i].id;
                        name = obj.data[i].name;
                        url = obj.data[i].url;
                        note = obj.data[i].note;
                        params = id + ", '" + name + "', '" + url + "','" + note + "'";


                        HTML += "<tr>"
                        HTML += "<td>" + (i + 1) + "</td>"
                        HTML += "<td>" + name + "</td>"
                        HTML += "<td>" + url + "</td>"
                        HTML += "<td>" + note + "</td>"
                        HTML += "<td>" + '<button data-toggle="modal" data-target="#modalEdit" class="btn btn-warning" onclick="setEditData(' + params + ')"><i class="fa fa-edit"></i>&nbsp; Sửa danh mục</button>' + '<button data-toggle="modal" data-target="#modalRemove" style="margin-left: 5px" class="btn btn-danger" onclick="setRemoveData (' + params + ')"><i class="fa fa-remove"></i>&nbsp;Xoá danh mục</button>' + "</td>"
                        HTML += "</tr>";
                    }
                    $('#tableBody').html(HTML)
                }
            })

        }

        function insertData() {
            var tendm = $('#add_tendm').val()
            var url = $('#add_url').val()
            var ghichu = $('#add_ghichu').val()

            if (tendm.length == 0) {
                createNotify('Thông báo', 'Chưa có tên danh mục', 'error')
                return;
            }

            var url = 'service/category.php?mode=insert_data&tendm=' + tendm + '&url=' + url +'&ghichu=' + ghichu;

            $.ajax({
                url: url,
                success: function (data) {
                    var decodedData = JSON.parse(data)
                    console.log(decodedData)

                    if (decodedData.status) {
                        createNotify('Thông báo', 'Insert thành công.', 'success')
                        getData();
                    } else {
                        createNotify('Thông báo', 'Insert thất bại', 'error')
                    }
                }
            })
        }

        function editData() {
            var id = $('#edit_id').val()
            var tendm = $('#edit_tendm').val()
            var url = $('#edit_url').val()
            var ghichu = $('#edit_ghichu').val()


            var url = 'service/category.php?mode=edit_data&id=' + id + '&tendm=' + tendm + '&url=' + url + '&ghichu=' + ghichu;

            $.ajax({
                url: url,
                success: function (data) {
                    var decodedData = JSON.parse(data)
                    console.log(decodedData)

                    if (decodedData.status) {
                        createNotify('Thông báo', 'Cập nhật thành công', 'success')
                        getData()
                    } else {
                        createNotify('Thông báo', 'Cập nhật thất bại', 'error')
                    }
                }

            });
        }

        function removeData() {
            var id = $('#remove_id').val()
            var url = 'service/category.php?mode=remove_data&id=' + id;

            $.ajax({
                url: url,
                success: function (data) {
                    var decodedData = JSON.parse(data)
                    console.log(decodedData)

                    if (decodedData.status) {
                        createNotify('Thông báo', 'Xoá thành công', 'success')
                        getData()
                    } else {
                        createNotify('Thông báo', 'Xoá thất bại', 'error')
                    }
                }

            });
        }

        function createNotify(title, content, type) {
            new PNotify({
                title: title,
                text: content,
                type: type
            });
        }
    })
</script>
</body>
</html>
