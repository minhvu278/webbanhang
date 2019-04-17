<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý bình luận</title>
    <?php
    include 'partial/header_script.php';
    ?>
    <link rel="stylesheet" href="../admin/theme/dist/css/AdminLTE.min.css">

    <script>
        function setEditData(id, news_id, name, email, content) {
            $('#edit_id').val(id);
            $('#edit_news_id').val(news_id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_content').val(content);

        }
        function setRemoveData(id, news_id, name, email, content) {
            $('#remove_id').val(id);
            $('#remove_news_id').val(news_id);
            $('#remove_name').val(name);
            $('#remove_email').val(email);
            $('#remove_content').val(content);

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
                <h3 class="box-title">Danh mục bình luận</h3>

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
                        Thêm bình luận
                    </button>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="5%">STT</th>
                        <th width="20%">Tin tức</th>
                        <th width="10%">Tên</th>
                        <th width="15%">Email</th>
                        <th width="25%">Content</th>
                        <th width="25%">Hành động</th>
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
                <h4 class="modal-title">Thêm mới bình luận</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-3">Tên tin tức</label>
                    <div class="col-sm-9">
                        <input id="add_news_id" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập tên tin tức" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Tên</label>
                    <div class="col-sm-9">
                        <input id="add_name" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập tên" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Email</label>
                    <div class="col-sm-9">
                        <input id="add_email" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập email" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Nội dung</label>
                    <div class="col-sm-9">
                        <input id="add_content" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập nội dung" autofocus required>
                    </div>
                </div>
                </form>
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
                <h4 class="modal-title">Sửa bình luận</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editForm" method="POST" action="xuly_category.php">

                    <input id="edit_id" name="id"
                           type="hidden">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tên tin tức</label>
                        <div class="col-sm-9">
                            <input id="edit_news_id" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập tên tin tức" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Tên</label>
                        <div class="col-sm-9">
                            <input id="edit_name" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập tên" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Email</label>
                        <div class="col-sm-9">
                            <input id="edit_email" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Nội dung</label>
                        <div class="col-sm-9">
                            <input id="edit_content" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập nội dung" required>
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
                <h4 class="modal-title">Xóa bình luận</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có thực sự muốn xóa bình luận <b><span id="remove_name"></span></b> ?</p>
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
                url: 'service/comment.php?mode=get_data',
                success: function (data) {
                    var obj = JSON.parse(data)
                    console.log(obj);
                    var HTML = '';
                    var id, news_id, name, email, content, params;
                    for (var i = 0; i < obj.data.length; i++) {
                        id = obj.data[i].id;
                        news_id = obj.data[i].news_id;
                        name = obj.data[i].name;
                        email = obj.data[i].email;
                        content = obj.data[i].content;
                        params = id + ", '" + news_id + "', '" + name + "', '" + email + "','" + content + "'";


                        HTML += "<tr>"
                        HTML += "<td>" + (i + 1) + "</td>"
                        HTML += "<td>" + news_id + "</td>"
                        HTML += "<td>" + name + "</td>"
                        HTML += "<td>" + email + "</td>"
                        HTML += "<td>" + content + "</td>"
                        HTML += "<td>" + '<button data-toggle="modal" data-target="#modalEdit" class="btn btn-warning" onclick="setEditData(' + params + ')"><i class="fa fa-edit"></i>&nbsp; Sửa danh mục</button>' + '<button data-toggle="modal" data-target="#modalRemove" style="margin-left: 5px" class="btn btn-danger" onclick="setRemoveData (' + params + ')"><i class="fa fa-remove"></i>&nbsp;Xoá danh mục</button>' + "</td>"
                        HTML += "</tr>";
                    }
                    $('#tableBody').html(HTML)
                }
            })

        }

        function insertData() {
            var news_id = $('#add_news_id').val()
            var name = $('#add_name').val()
            var email = $('#add_email').val()
            var content = $('#add_content').val()

            if (name.length == 0) {
                createNotify('Thông báo', 'Chưa có tên danh mục', 'error')
                return;
            }

            var url = 'service/comment.php?mode=insert_data&news_id=' + news_id + '&name=' + name +'&email=' + email + '&content=' + content;

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
            var news_id = $('#edit_news_id').val()
            var name = $('#edit_name').val()
            var email = $('#edit_email').val()
            var content = $('#edit_content').val()


            var url = 'service/comment.php?mode=edit_data&id=' + id + '&news_id=' + news_id + '&name=' + name + '&email=' + email + '&content=' + content;

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
            var url = 'service/comment.php?mode=remove_data&id=' + id;

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