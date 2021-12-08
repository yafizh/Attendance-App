<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Presensi Hari ini<?= (isset($data['attemdamce_code_today'][0])) ? (": " . $data['attemdamce_code_today'][0]["attendance_unique_code"]) : ''; ?></h1>
    </div>
    <style>
        .col {
            margin-bottom: 16px;
        }
    </style>
    <?php if (isset($data['attendance_code_today'][0])) : ?>
        <div class="d-flex flex-wrap">
            <?php foreach ($data['employee_data'] as $employee) : ?>
                <div class="card mr-3 mb-4" style="width: 18rem;">
                    <img src="<?= BASEURL ?>/img/profile.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $employee['employee_name']; ?></h5>
                    </div>
                    <div class="card-footer d-flex p-0" style="overflow: hidden;">
                        <div style="flex:1 ;" class="p-2 text-center"><?= ($employee['PAGI'] == null) ? "Presensi Pagi" : $employee['PAGI']; ?></div>
                        <div style="flex:1 ;" class="p-2 text-center"><?= ($employee['SORE'] == null) ? "Presensi Sore" : $employee['SORE']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="d-flex flex-wrap">
            Belum Generate Code Hari ini
        </div>
    <?php endif; ?>
</div>

<!-- End of Main Content -->