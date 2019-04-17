<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lí tác giả</title>
    <?php
    include 'partial/header_script.php';
    ?>
    <link rel="stylesheet" href="../admin/theme/dist/css/AdminLTE.min.css">

    <script>
        function setEditData(id, name) {
            $('#edit_id').val(id);
            $('#edit_tentacgia').val(name);
        }
        function setRemoveData(id, name) {
            $('#remove_id').val(id);
            $('#remove_tentacgia').val(name);
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
                        Thêm tác giả
                    </button>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="5%">STT</th>
                        <th width="20%">Tên tác giả</th>
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
                <h4 class="modal-title">Thêm mới tác giả</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-sm-3">Tên tác giả</label>
                    <div class="col-sm-9">
                        <input id="add_tentacgia" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập tên tác giả" autofocus required>
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
                <h4 class="modal-title">Sửa tác giả</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editForm" method="POST" action="xuly_category.php">

                    <input id="edit_id" name="id"
                           type="hidden">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tên tác giả</label>
                        <div class="col-sm-9">
                            <input id="edit_tentacgia" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập tên tác giả" required>
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
                url: 'service/author.php?mode=get_data',
                success: function (data) {
                    var obj = JSON.parse(data)
                    console.log(obj);
                    var HTML = '';
                    var id, name, params;
                    for (var i = 0; i < obj.data.length; i++) {
                        id = obj.data[i].id;
                        name = obj.data[i].name;
                        params = id + ", '" + name + "'";


                        HTML += "<tr>"
                        HTML += "<td>" + (i + 1) + "</td>"
                        HTML += "<td>" + name + "</td>"
                        HTML += "<td>" + '<button data-toggle="modal" data-target="#modalEdit" class="btn btn-warning" onclick="setEditData(' + params + ')"><i class="fa fa-edit"></i>&nbsp; Sửa danh mục</button>' + '<button data-toggle="modal" data-target="#modalRemove" style="margin-left: 5px" class="btn btn-danger" onclick="setRemoveData (' + params + ')"><i class="fa fa-remove"></i>&nbsp;Xoá danh mục</button>' + "</td>"
                        HTML += "</tr>";
                    }
                    $('#tableBody').html(HTML)
                }
            })

        }

        function insertData() {
            var tentacgia = $('#add_tentacgia').val()

            if (tentacgia.length == 0) {
                createNotify('Thông báo', 'Chưa có tên tác giả', 'error')
                return;
            }

            var url = 'service/author.php?mode=insert_data&tentacgia=' + tentacgia;

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
            var tentacgia = $('#edit_tentacgia').val()

            var url = 'service/author.php?mode=edit_data&id=' + id + '&tentacgia=' + tentacgia;

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
            var url = 'service/author.php?mode=remove_data&id=' + id;

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