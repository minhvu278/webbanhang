<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý người dùng</title>
    <?php
    include 'partial/header_script.php';
    ?>
    <link rel="stylesheet" href="../admin/theme/dist/css/AdminLTE.min.css">

    <script>
        function setEditData(id, name, email, password, role, avatar, address) {
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_password').val(password);
            $('#edit_role').val(role);
            $('#edit_avatar').val(avatar);
            $('#edit_address').val(address);
        }
        function setRemoveData(id, name, email, password, role, avatar, address) {
            $('#remove_id').val(id);
            $('#remove_name').val(name);
            $('#remove_email').val(email);
            $('#remove_password').val(password);
            $('#remove_role').val(role);
            $('#remove_avatar').val(avatar);
            $('#remove_address').val(address);
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
                <h3 class="box-title">Danh mục người dùng</h3>

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
                        <th width="10%">Tên người dùng</th>
                        <th width="15%">Email</th>
                        <th width="15%">Password</th>
                        <th width="10%">Vai trò</th>
                        <th width="10%">Avatar</th>
                        <th width="10%">Địa chỉ</th>
                        <th width="20%">Hành động</th>
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
                <h4 class="modal-title">Thêm mới người dùng</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-3">Tên người dùng</label>
                    <div class="col-sm-9">
                        <input id="add_name" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập tên người dùng" autofocus required>
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
                    <label class="control-label col-sm-3">Password</label>
                    <div class="col-sm-9">
                        <input id="add_password" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập password" autofocus required>
                    </div>
                </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Vai trò</label>
                        <div class="col-sm-9">
                            <input id="add_role" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập vai trò" autofocus required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Avatar</label>
                        <div class="col-sm-9">
                            <input id="add_avatar" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập avatar" autofocus required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Địa chỉ</label>
                        <div class="col-sm-9">
                            <input id="add_address" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập address" autofocus required>
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
                <h4 class="modal-title">Sửa người dùng</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editForm" >

                    <input id="edit_id" name="id"
                           type="hidden">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tên người dùng</label>
                        <div class="col-sm-9">
                            <input id="edit_name" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập tên người dùng" required>
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
                        <label class="control-label col-sm-3">Password</label>
                        <div class="col-sm-9">
                            <input id="edit_password" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Vai trò</label>
                        <div class="col-sm-9">
                            <input id="edit_role" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập vai trò" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Avatar</label>
                        <div class="col-sm-9">
                            <input id="edit_avatar" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập avatar" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Địa chỉ</label>
                        <div class="col-sm-9">
                            <input id="edit_address" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập địa chỉ" required>
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
                <h4 class="modal-title">Xóa người dùng</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có thực sự muốn xóa người dùng<b><span id="remove_name"></span></b> ?</p>
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
                url: 'service/users.php?mode=get_data',
                success: function (data) {
                    var obj = JSON.parse(data)
                    console.log(obj);
                    var HTML = '';
                    var id, name, email, password, role, avatar, address, params;
                    for (var i = 0; i < obj.data.length; i++) {
                        id = obj.data[i].id;
                        name = obj.data[i].name;
                        email = obj.data[i].email;
                        password = obj.data[i].password;
                        role = obj.data[i].role;
                        avatar = obj.data[i].avatar;
                        address = obj.data[i].address;
                        params = id + ", '" + name + "', '" + email + "', '" + password + "', '" + role + "', '" + avatar + "','" + address + "'";


                        HTML += "<tr>"
                        HTML += "<td>" + (i + 1) + "</td>"
                        HTML += "<td>" + name + "</td>"
                        HTML += "<td>" + email + "</td>"
                        HTML += "<td>" + password + "</td>"
                        HTML += "<td>" + role + "</td>"
                        HTML += "<td>" + avatar + "</td>"
                        HTML += "<td>" + address + "</td>"
                        HTML += "<td>" + '<button data-toggle="modal" data-target="#modalEdit" class="btn btn-warning" onclick="setEditData(' + params + ')"><i class="fa fa-edit"></i>&nbsp; Sửa danh mục</button>' + '<button data-toggle="modal" data-target="#modalRemove" style="margin-left: 5px" class="btn btn-danger" onclick="setRemoveData (' + params + ')"><i class="fa fa-remove"></i>&nbsp;Xoá danh mục</button>' + "</td>"
                        HTML += "</tr>";
                    }
                    $('#tableBody').html(HTML)
                }
            })

        }

        function insertData() {
            var name = $('#add_name').val()
            var email = $('#add_email').val()
            var password = $('#add_password').val()
            var role = $('#add_role').val()
            var avatar = $('#add_avatar').val()
            var address = $('#add_address').val()

            if (name.length == 0) {
                createNotify('Thông báo', 'Chưa có tên người dùng', 'error')
                return;
            }

            var url = 'service/users.php?mode=insert_data&name=' + name + '&email=' + email +'&password=' + password + '&role=' + role + '&avatar=' + avatar + '&address=' + address;

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
            var name = $('#edit_name').val()
            var email = $('#edit_email').val()
            var password = $('#edit_password').val()
            var role = $('#edit_role').val()
            var avatar = $('#edit_avatar').val()
            var address = $('#edit_address').val()


            var url = 'service/users.php?mode=edit_data&id=' + id + '&name=' + name + '&email=' + email + '&password=' + password + '&role=' + role + '&avatar=' + avatar + '&address=' + address;

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
            var url = 'service/users.php?mode=remove_data&id=' + id;

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