<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/id.js"></script>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Presensi Karyawan</h1>
    </div>
    <?php if (count($data)) : ?>
        <div class="d-flex flex-wrap">
            <?php foreach ($data as $employee) : ?>
                <div class="card mr-3 mb-4" style="width: 18rem;" onclick="myFunc(<?= $employee['employee_id']; ?>)">
                    <img src="<?= BASEURL ?>/img/profile.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $employee['employee_name']; ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        Data Kosong
    <?php endif; ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nursahid Arya Suyudi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="disini"></div>
            </div>
        </div>
    </div>
    <script>
        const myFunc = employee_id => {
            $.ajax({
                    url: `<?= BASEURL ?>/Attendance/detail/${employee_id}`,
                    method: "GET",
                    dataType: "json",
                })
                .done(function(msg) {
                    console.log(msg);
                    let x = [];
                    $.each(msg, function(index, value) {
                        x.push({
                            title: 'Presensi Pagi: ' + value['PAGI'],
                            start: value['DATE(a.created_at)'],
                            // backgroundColor: 'green',
                        });
                        x.push({
                            title: 'Presensi Pulang: ' + value['SORE'],
                            start: value['DATE(a.created_at)'],
                            // backgroundColor: 'green',
                        });
                    });

                    $('#exampleModal').on('shown.bs.modal', function() {
                        calendar.render();
                    });
                    $('#exampleModal').modal('show');

                    const calendarEl = document.getElementById('disini');
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        fixedWeekCount: false,
                        locale: 'id',
                        initialView: 'dayGridMonth',
                        events: x

                    });
                });
        }
        document.addEventListener('DOMContentLoaded', function() {

        });
    </script>
</div>

<!-- End of Main Content -->