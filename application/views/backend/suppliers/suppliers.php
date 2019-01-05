<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Dialog - Modal form</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="dialog_css.css">
    <style>
    </style>
<body>
<div class="col-sm-10 col-md-11 main">
    <div class="row" style="margin-right:0px;">
        <hr>
    </div>
    <div class="row" style="margin-right:0px;margin-bottom: 10px;width: 500px">
        <div class="col-sm-4 col-md-4" style="padding-left:0px;width: 1000px">
            <form class="form-inline" method="POST" action="../admin/suppliers" style="float:left">
                <div class="form-group">
                    <input type="text" class="form-control" id="supplier_search" name="supplier_search"
                           placeholder="<?php echo lang('Supplier cd') ?>">
                    <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" type="submit"
                            class="btn btn-primary"><?php echo lang('Search supplier'); ?>Search
                    </button>

                    <button style="margin-right:5px;margin-bottom: 10px; margin-top:10px;" type="button" id="btnadd"
                            class="btn btn-advance"> Add
                    </button>
                </div>
            </form>

            <form method="post" class="col-sm-4 col-md-4" action="" enctype="multipart/form-data" style="float: left;width:500px;">
                <input type="file" name="file" style="float: left;margin-top: 18px"/>
                <button type="submit" name="uploadclick" class="btn btn-primary"
                        style="margin-right:5px;margin-bottom: 10px; margin-top:10px;float: left" value="Upload">Up File
                </button>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th><?php echo $this->session->userdata['user_id'] ?></th>
                    <th><?php echo lang('ID number'); ?></th>
                    <th><?php echo lang('First name'); ?></th>
                    <th><?php echo lang('Last name'); ?></th>
                    <th><?php echo lang('Supplier'); ?></th>
                    <th><?php echo lang('Supplier'); ?></th>
                    <th><?php echo lang('Supplier'); ?></th>
                    <th><?php echo lang('Options'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $this->load->model('supplier'); ?>

                <?php
                if ($this->pagination->per_page > $this->pagination->total_rows) $i = 1;
                else $i = 1 + ($this->pagination->cur_page - 1) * $this->pagination->per_page;
                foreach ($suppliers as $supplier):
                    ?>
                    <tr>

                        <td><?php echo $i ?></td>
                        <td><?php echo $supplier->sup_id ?></td>
                        <td><?php echo $supplier->sup_name ?></td>
                        <td><?php echo $supplier->sup_fullname ?></td>
                        <td><?php echo $supplier->sup_type ?></td>
                        <td><?php echo $supplier->active ?></td>
                        <td><?php echo $supplier->sup_profile_id ?></td>

                        <!--  // cái list_tickets là gì đấuy
                         //hinh nhu no la cai danh sách thoi ông
                         uh còn cái model kia ô muốn lấy gì thì select cái đó nhé nãy tôi tiện nên tôi lấy * luôn còn ông muốn lấy trường nào thì lấy trg đó vs lại nó có oder by đó -->

                        <td style="text-align:center">
                            <div class="btn-group" role="group">
                                <!--                                <a href="" onclick="return confirm('Are you sure you want to delete this booking ticket?')" class="btn btn-default btn-xs"><span class="icon-cancel-2" style="color:red"></span> -->
                                <?php //echo lang('Delete')
                                ?><!--</a>-->
                                <a href="<?php echo base_url('admin/suppliers/delete_supplier/' . $supplier->sup_id); ?>"
                                   onclick="return confirm('Are you sure you want to delete this booking ticket?')"
                                   class="btn btn-default btn-xs"><span
                                            class="icon-cancel-2" 6
                                            style="color:red"></span>
                                    <?php echo lang('Delete') ?></a>

                            </div>
                        </td>

                    </tr>
                    <?php $i++; endforeach; ?>

                </tbody>
            </table>
        </div>
        <ul class="pagination"><?php echo $links ?></ul>
    </div>
</div>

<div
"form-2" id="dialog-form" style="display: none; " title="Create new user">
<p class="validateTips">All form fields are required.</p>

<form name="myform" method="POST" action="../admin/suppliers" onsubmit="return validateForm()">
    <fieldset>

        <label style="width: 300px" for="userName">Name</label>
        <input type="text" name="userName" id="userName" value="" class="text ui-widget-content ui-corner-all">

        <label style="width: 300px" for="FullName">SupplierFullName</label>
        <input type="text" name="FullName" id="FullName" value="" class="text ui-widget-content ui-corner-all">

        <label style="width: 300px" for="SupplierType">Supplier Type</label>
        <input type="text" name="SupplierType" id="SupplierType" value=""
               class="text ui-widget-content ui-corner-all">

        <label style="width: 300px" for="active">active</label>
        <input type="text" name="active" id="active" value="" class="text ui-widget-content ui-corner-all">

        <label style="width: 300px" for="sup_profile_id">Sup profile id</label>
        <input type="text" name="sup_profile_id" id="sup_profile_id" value=""
               class="text ui-widget-content ui-corner-all">
        <!--            <submit></submit>-->

        <button style="width:100px; margin-top:20px" type="submit" class="btn btn-success" value="submit"><span
                    class="icon-checkmark"></span> <?php echo lang('Submit') ?></button>
        <!-- Allow form submission with keyboard without duplicating the dialog button -->
        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
</form>


</div>

</body>
<script>


    function validateForm() {
        // Bước 1: Lấy giá trị của username và password

        var userName = document.myform.username.value;
        var FullName = document.myform.FullName.value;
        var SupplierType = document.myform.SupplierType.value;
        var active = document.myform.active.value;
        var sup_profile_id = document.myform.sup_profile_id.value;

        // Bước 2: Kiểm tra dữ liệu hợp lệ hay không
        if (userName == '') {
            alert('Bạn chưa nhập tên đăng nhập');
        } else if (FullName == '') {
            alert('Bạn chưa nhập tên');
        } else if (SupplierType == '' || !isNaN(SupplierType)) {
            alert("nhap khong hop le!");
        } else if (active == '') {
            alert("bạn chưa nhập dữ liệu");
        } else if (sup_profile_id == '') {
            alert("bạn chưa nhập dữ liệu");
        }
        return false;

    }

    $(document).ready(function () {
        $("#btnadd").click(function () {

            $('#dialog-form').dialog();

            //TODO daon nay chu ok chua check dc
            validateForm();
        })
    });


</script>