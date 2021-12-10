<div class="container">
    <div class="row mb-3">
        <div class="col-lg-4">
            <br>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Karyawan</h1>
            </div>
            <br>
            <div class="row" style="margin-left:7px">
                <?php Flasher::flash(); ?>
            </div>
            <form action="<?= BASEURL; ?>/employee/add" method="post">

                <div class="form-group names">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                </div>

                <label for="password">Password</label>
                <div class="input-group input-container mb-3">

                    <input type="password" id="password" name="password" class="form-control">
                    <div class="input-group-append">
                        <button class="btn input-group-text" type="button" onclick="myFunction()" id="button-addon2"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <br>

                <button class="btn btn-primary" type="submit" style="float:right">Simpan</button>

            </form>
        </div>
    </div>

</div>

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }

    }
</script>