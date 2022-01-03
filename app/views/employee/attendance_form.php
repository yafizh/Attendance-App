<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Presensi Hari ini</h1>
    </div>
    <div class="row" style="margin-left:3px">
        <?php Flasher::flash(); ?>
    </div>
    <?php if (empty(ACCESS_IP_ADDRESS) || ACCESS_IP_ADDRESS == $_SERVER['REMOTE_ADDR']) : ?>
        <?php if (!empty($data)) : ?>
            <form action="<?= BASEURL ?>/Employee/postAttendance/<?= $_SESSION['employee_unique_number']; ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="absen_code" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" value="<?= $data; ?>" name="attendance_type" class="btn btn-primary w-100"><?= ($data == "PAGI") ? "Presensi Pagi" : "Presensi Sore"; ?></button>
                </div>
            </form>
        <?php else : ?>
            Kode Presensi Belum Dibuat
        <?php endif; ?>
    <?php else : ?>
        Tidak terhubung dengan jaringan kantor
    <?php endif; ?>
</div>

<!-- End of Main Content -->