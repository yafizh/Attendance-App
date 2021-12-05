<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ganti Password</h1>
    </div>
    <div class="d-flex">
        <form action="" method="POST">

            <div class="right-inner-addon input-container form-group">
                <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
            </div>

            <div class="right-inner-addon input-container form-group">
                <input type="password" id="password_baru" name="password_baru" class="form-control" placeholder="Password Baru" autocomplete="off">
            </div>

            <div class="right-inner-addon input-container form-group">
                <input type="password" id="password_konfirmasi" name="password_konfirmasi" class="form-control " placeholder="Konfirmasi Password Baru" autocomplete="off">
            </div>
            <div class="form-check form-check-inline pl-1">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" onclick="myFunction()">
                <label style="text-indent: 5px;" class="form-check-label" for="inlineCheckbox1">Show Password</label>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary btn-block">Ganti Password</button>
        </form>
    </div>
</div>

<!-- End of Main Content -->
<script>
    function myFunction() {
        var x = document.getElementById("password_lama");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }

        var x = document.getElementById("password_baru");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }

        var x = document.getElementById("password_konfirmasi");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>