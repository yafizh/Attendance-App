<!-- End of Topbar -->
<?php

if (!empty($data['attendance_code'])) {
    $employees = $data['employee_data'];
    foreach ($employees as $index => $value) {
        if ($employees[$index]["PAGI"] == "00:00:00") {
            $employees[$index]["PAGI"] = "Presensi Pagi";
            $employees[$index]["backgroundColorPagi"] = "bg-light";
            $employees[$index]["textColorPagi"] = "";
        } else {
            $time = explode(':', $value["PAGI"])[0] . explode(':', $value["PAGI"])[1];
            $employees[$index]['PAGI'] = explode(':', $value["PAGI"])[0] . ":" . explode(':', $value["PAGI"])[1];
            if ((int)$time <= 730) {
                $employees[$index]["backgroundColorPagi"] = "bg-success";
            } else {
                $employees[$index]["backgroundColorPagi"] = "bg-danger";
            }
            $employees[$index]["textColorPagi"] = "text-white";
        }

        if ($employees[$index]["SORE"] == "00:00:00") {
            $employees[$index]["SORE"] = "Presensi Sore";
            $employees[$index]["backgroundColorSore"] = "bg-light";
            $employees[$index]["textColorSore"] = "";
        } else {
            $employees[$index]['SORE'] = explode(':', $value["SORE"])[0] . ":" . explode(':', $value["SORE"])[1];
            $employees[$index]["textColorSore"] = "text-white";
            $employees[$index]["backgroundColorSore"] = "bg-success";
        }
    }
}

?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Presensi Hari ini<?= (!empty($data['attendance_code'])) ? (": " . $data['attendance_code']["attendance_unique_code"]) : ''; ?></h1>
    </div>
    <?php if (!empty($data['attendance_code'])) : ?>
        <div class="d-flex flex-wrap">
            <?php foreach ($employees as $employee) : ?>
                <div class="card mr-3 mb-4" style="width: 18rem;">
                    <img height="350" style="object-fit: cover;" src="<?= BASEURL ?>/img/profile_employee/<?= $employee['employee_image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $employee['employee_name']; ?></h5>
                        <h6 class="card-title"><?= $employee['employee_unique_number']; ?></h6>
                    </div>
                    <div class="card-footer d-flex p-0" style="overflow: hidden;">
                        <div style="flex:1;" class="p-2 text-center <?= $employee['backgroundColorPagi']; ?> <?= $employee['textColorPagi']; ?>"><?= $employee['PAGI']; ?></div>
                        <div style="flex:1;" class="p-2 text-center <?= $employee['backgroundColorSore']; ?> <?= $employee['textColorSore']; ?>"><?= $employee['SORE']; ?></div>
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