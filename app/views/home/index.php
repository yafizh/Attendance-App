<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid h-75">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="flex-column d-flex justify-content-center align-items-center h-100">
        <form action="<?= BASEURL ?>/Home/addAttendanceCode" method="POST">

            <h3>Generate Kode Hari ini</h3>
            <br>
            <div class="input-group input-container mb-3">
                <input type="text" name="attendance_code" value="<?= !empty($data) ? $data['attendance_unique_code'] : ''; ?>" readonly class="form-control">

                <?php if (empty($data)) : ?>
                    <div class="input-group-append">
                        <button class="cir btn input-group-text" onclick="generateCode()" type="button">Generate</button>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (empty($data)) : ?>
                <div class="flex-column d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary mt-3" disabled>Save</button>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- End of Main Content -->
<script>
    const attendanceCodeGenerator = () => {
        var length = 10;
        var string = "abcdefghijklmnopqrstuvwxyz"; //to upper 
        var numeric = '0123456789';
        var code = "";
        var character = "";
        var crunch = true;
        while (code.length < length) {
            entity1 = Math.ceil(string.length * Math.random() * Math.random());
            entity2 = Math.ceil(numeric.length * Math.random() * Math.random());
            hold = string.charAt(entity1);
            hold = (code.length % 2 == 0) ? (hold.toUpperCase()) : (hold);
            character += hold;
            character += numeric.charAt(entity2);
            code = character;
        }
        code = code.split('').sort(function() {
            return 0.5 - Math.random()
        }).join('');

        return code;
    }

    const generateCode = () => {
        $("input[name=attendance_code]").val(attendanceCodeGenerator());
        $("button[disabled]").removeAttr("disabled");
    }
</script>