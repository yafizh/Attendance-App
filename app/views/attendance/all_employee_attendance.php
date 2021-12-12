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
    <?php if (!empty($data)) : ?>
        <div class="d-flex flex-wrap">
            <?php foreach ($data as $employee) : ?>
                <div class="card mr-3 mb-4" style="width: 18rem;" onclick="attendanceHistory(<?= $employee['employee_id']; ?>)">
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
    <div class="modal fade" id="detailAttendanceModal" tabindex="-1" aria-labelledby="detailAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailAttendanceModalLabel">Nursahid Arya Suyudi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="attendanceHistory"></div>
            </div>
        </div>
    </div>
</div>

<!-- End of Main Content -->
<script>
    let calendar = "";
    $('#detailAttendanceModal').on('shown.bs.modal', function() {
        calendar.render();
    });
    $('#detailAttendanceModal').on('hidden.bs.modal', function() {
        $("#attendanceHistory").html("");
    });
    const attendanceHistory = (employee_id) => {
        $.ajax({
                url: `<?= BASEURL ?>/Attendance/attendanceHistory/${employee_id}`,
                method: "GET",
                dataType: "json"
            })
            .done(function(response) {
                console.log(response)
                let attendanceHistory = [];
                $.each(response, function(index, value) {
                    if (!(value["PAGI"] == null)) {
                        let attendance_time = value['PAGI'].split(':')[0] + value['PAGI'].split(':')[1];
                        attendanceHistory.push({
                            title: 'Presensi Pagi: ' + value['PAGI'],
                            start: value['attendance_date'],
                            backgroundColor: (parseInt(attendance_time) <= 730) ? "green" : "red"
                        });
                    } else
                        attendanceHistory.push({
                            title: 'Tidak Mengisi Presensi',
                            start: value['attendance_date'],
                            backgroundColor: 'gray',
                        });

                    if (!(value["SORE"] == null))
                        attendanceHistory.push({
                            title: 'Presensi Pulang: ' + value['SORE'],
                            start: value['attendance_date'],
                            // backgroundColor: 'green',
                        });
                    else
                        attendanceHistory.push({
                            title: 'Tidak Mengisi Presensi',
                            start: value['attendance_date'],
                            backgroundColor: 'gray',
                        });
                });

                calendar = new FullCalendar.Calendar(document.getElementById('attendanceHistory'), {
                    fixedWeekCount: false,
                    locale: 'id',
                    initialView: 'dayGridMonth',
                    events: attendanceHistory
                });

                $('#detailAttendanceModal').modal('show');
            });
    }
</script>