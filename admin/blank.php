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
                    <button
                            data-toggle="modal" data-target="#modalEdit"
                            class="btn btn-info">
                        <i class="fa fa-upload"></i>
                        Tải ảnh
                    </button>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="5%">STT</th>
                        <th width="25%">Tên danh mục</th>
                        <th width="25%">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td></td>
                        <td class="text-center"></td>

                        <td>

                            <button class="btn btn-warning"
                                    onclick="setEditName('<?php echo $value['name']; ?>', '<?php echo $value['id']; ?>')">

                                <i class="fa fa-edit"></i>
                                &nbsp; Sửa danh mục
                            </button>
                            <button
                                    onclick="setRemoveName('<?php echo $value['id']; ?>', '<?php echo $value['name']; ?>')"
                                    class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                                &nbsp; Xóa
                            </button>
                        </td>
                    </tr>

                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!--End slide box-->
    </section>
</div>
<?php
include 'partial/footer.php';
include 'partial/footer_script.php';
?>
</body>
</html>