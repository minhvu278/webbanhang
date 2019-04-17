<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý tin tức</title>
    <?php
    include 'partial/header_script.php';
    ?>
    <link rel="stylesheet" href="../admin/theme/dist/css/AdminLTE.min.css">
    <script src="theme/bower_components/ckeditor/ckeditor.js"></script>

    <script>
        var newsMap = {}
        function setEditData(id, author_id, cat_id, title, images, view) {
            $('#edit_id').val(id);
            $('#select_sua_tacgia').val(author_id);
            $('#select_sua_danhmuc').val(cat_id);
            $('#edit_title').val(title);
            $('#edit_images').val(images);
            $('#edit_view').val(view);
            // $('#edit_content').val(content);

            // Lấy ra content từ map theo id
            var singleNew = newsMap[id]
            if (singleNew){
                CKEDITOR.instances.edit_content.setData(singleNew['content']);
            }
        }
        function setRemoveData(id) {
            $('#remove_id').val(id);


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
                <h3 class="box-title">Danh mục tin tức</h3>

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
                        Thêm tin tức
                    </button>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="5%">STT</th>
                        <th width="10%">Tên tác giả</th>
                        <th width="10%">Tên danh mục</th>
                        <th width="10%">Tên</th>
                        <th width="15%">Images</th>
                        <th width="20%">Content</th>
                        <th width="5%">View</th>
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
                <h4 class="modal-title">Thêm mới tin tức</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Chọn tác giả</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="select_them_tacgia">
                                <option value="1">Tác giả 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Chọn danh mục</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="select_them_danhmuc">
                                <option value="1">Tác giả 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tiêu đề</label>
                        <div class="col-sm-9">
                            <input id="add_title" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập tiêu đề" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Images</label>
                        <div class="col-sm-9">
                            <input id="add_images" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập images" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Content</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" id="add_content"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">View</label>
                        <div class="col-sm-9">
                            <input id="add_view" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập view" required>
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
                <h4 class="modal-title">Sửa tin tức</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editForm" method="POST">

                    <input id="edit_id" name="id"
                           type="hidden">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Chọn tác giả</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="select_sua_tacgia">
                                <option value="1">Tác giả 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Chọn danh mục</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="select_sua_danhmuc">
                                <option value="1">Tác giả 1</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Tin tức</label>
                        <div class="col-sm-9">
                            <input id="edit_title" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập tin tức" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Images</label>
                        <div class="col-sm-9">
                            <input id="edit_images" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập images" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Content</label>
                        <div class="col-sm-9">
                            <input id="edit_content" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập Content" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">View</label>
                        <div class="col-sm-9">
                            <input id="edit_view" name="name"
                                   type="text" class="form-control"
                                   placeholder="Nhập view" required>
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
    var newsMap = {}
    $(document).ready(function () {
        // Code chay lan dau
        getData()
        getDataTacGia()
        getDataDanhMuc()

        // Khoi tao ckeditor
        CKEDITOR.replace('add_content');
        CKEDITOR.replace('edit_content');

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
                url: 'service/news.php?mode=get_data',
                success: function (data) {
                    var obj = JSON.parse(data)
                    console.log(obj);
                    var HTML = '';
                    var id, author_id, author_name, cat_id, category_name, title, images, content, view, params;
                    for (var i = 0; i < obj.data.length; i++) {
                        id = obj.data[i].id;
                        author_name = obj.data[i].author_name;
                        author_id = obj.data[i].author_id;
                        cat_id = obj.data[i].cat_id;
                        category_name = obj.data[i].category_name;
                        title = obj.data[i].title;
                        images = obj.data[i].images;
                        content = obj.data[i].content;
                        // Tạo map để map dữ liệu theo id: id => tin tức của có id đó.
                        newsMap[id] = obj.data[i]

                        content = content.replace(/"/g, "'")
                        var display_content = $(content).text()

                        if (display_content.length > 50){
                            display_content = display_content.substring(0, 100) + '...'
                        }

                        view = obj.data[i].view;
                        params = id + ", '" + author_id + "', '" + cat_id + "', '" + title + "', '" + images + "', '" + view + "'";


                        HTML += "<tr>"
                        HTML += "<td>" + (i + 1) + "</td>"
                        HTML += "<td>" + author_name + "</td>"
                        HTML += "<td>" + category_name + "</td>"
                        HTML += "<td>" + title + "</td>"
                        HTML += "<td>" + images + "</td>"
                        HTML += "<td>" + display_content  + "<p hidden id='news_content_" + id + "'></p>"  + "</td>"
                        HTML += "<td>" + view + "</td>"
                        HTML += "<td>" + '<button data-toggle="modal" data-target="#modalEdit" class="btn btn-warning" onclick="setEditData(' + params + ')"><i class="fa fa-edit"></i>&nbsp; Sửa danh mục</button>' + '<button data-toggle="modal" data-target="#modalRemove" style="margin-left: 5px" class="btn btn-danger" onclick="setRemoveData (' + id + ')"><i class="fa fa-remove"></i>&nbsp;Xoá danh mục</button>' + "</td>"
                        HTML += "</tr>";
                    }
                    $('#tableBody').html(HTML)
                }
            })

        }

        function getDataTacGia(){
            // Get du lieu tac gia
            $.ajax({
                method: 'GET',
                url: 'service/author.php?mode=get_data',
                success: function (data) {
                    var obj = JSON.parse(data)
                    console.log(obj);

                    // Sinh ra HTML cho select
                    var HTML = '';
                    var id, name;
                    for (var i = 0; i < obj.data.length; i++) {
                        id = obj.data[i].id;
                        name = obj.data[i].name;

                        HTML += "<option "
                        HTML += "value= '" + id + "'>" + name
                        HTML += "</option>"
                    }
                    $('#select_them_tacgia').html(HTML)
                    $('#select_sua_tacgia').html(HTML)
                }
            })



            // Gan vao select_them_tacgia
        }

        function getDataDanhMuc(){
            // Get du lieu danh muc
            $.ajax({
                method: 'GET',
                url: 'service/category.php?mode=get_data',
                success: function (data) {
                    var obj = JSON.parse(data)
                    console.log(obj);

                    // Sinh ra HTML cho select
                    var HTML = '';
                    var id, name;
                    for (var i = 0; i < obj.data.length; i++) {
                        id = obj.data[i].id;
                        name = obj.data[i].name;

                        HTML += "<option "
                        HTML += "value= '" + id + "'>" + name
                        HTML += "</option>"
                    }
                    $('#select_them_danhmuc').html(HTML)
                    $('#select_sua_danhmuc').html(HTML)
                }
            })



            // Gan vao select_them_tacgia
        }



        function insertData() {
            var author_id = $('#select_them_tacgia').val();
            var cat_id = $('#select_them_danhmuc').val();
            var title = $('#add_title').val();
            var content = CKEDITOR.instances.add_content.getData();
            // content = encodeURI(content)
            var view = $('#add_view').val()
            var images = $('#add_images').val()

            if (title.length == 0) {
                createNotify('Thông báo', 'Chưa có tin tức', 'error')
                return;
            }

            var dataSend = {
                mode: 'insert_data',
                author_id: author_id,
                cat_id: cat_id,
                title: title,
                content: content,
                view: view,
                images: images
            }

            $.ajax({
                url: 'service/news.php',
                method: 'POST',
                data: dataSend,
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
            debugger
            var id = $('#edit_id').val();
            var author_id = $('#select_sua_tacgia').val();
            var cat_id = $('#select_sua_danhmuc').val();
            var title = $('#edit_title').val();
            var images = $('#edit_images').val();
            var content = CKEDITOR.instances.edit_content.getData();
            content = encodeURI(content)
            var view = $('#edit_view').val()


            var url = 'service/news.php?mode=edit_data&id=' + id + '&author_id=' + author_id + '&cat_id=' + cat_id + '&title=' + title + '&content=' + content + '&view=' + view + '&images=' + images;

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
            var url = 'service/news.php?mode=remove_data&id=' + id;

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