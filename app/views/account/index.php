<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ganti Password</h1>
    </div>
    <div class="row" style="margin-left:7px">
        <?php Flasher::flash(); ?>
    </div>
    <form action="<?= BASEURL; ?>/Account/changePassword" method="POST" class="w-100">
        <div class="row">
            <div class="right-inner-addon input-container form-group col-md-6 col-sm-12 col-xl-4">
                <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Password Lama" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="right-inner-addon input-container form-group col-md-6 col-sm-12 col-xl-4">
                <input type="password" id="new-password" name="new-password" class="form-control" placeholder="Password Baru" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="right-inner-addon input-container form-group col-md-6 col-sm-12 col-xl-4">
                <input type="password" id="confirm-new-password" name="confirm-new-password" class="form-control " placeholder="Konfirmasi Password Baru" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="form-check form-check-inline pl-1 ml-3">
                <input class="form-check-input" id="toggle-password" type="checkbox" onclick="togglePassword()">
                <label style="text-indent: 5px;" class="form-check-label" for="toggle-password">Show Password</label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xl-4">
                <button type="submit" class="btn btn-primary btn-block">Ganti Password</button>
            </div>
        </div>
    </form>
</div>

<!-- End of Main Content -->
<script>
    let passwordToggle = true;
    const togglePassword = () => {
        if (passwordToggle) {
            $("#old-password").attr("type", "text");
            $("#new-password").attr("type", "text");
            $("#confirm-new-password").attr("type", "text");
        } else {
            $("#old-password").attr("type", "password");
            $("#new-password").attr("type", "password");
            $("#confirm-new-password").attr("type", "password");
        }
        passwordToggle = !passwordToggle;
    }
</script>