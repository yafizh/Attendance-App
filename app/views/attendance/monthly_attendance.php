<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/id.js"></script>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Presensi Bulanan</h1>
    </div>
    <div id="monthly-attendance"></div>
    <script>
        $.ajax({
                url: `<?= BASEURL ?>/Attendance/getMonthlyAttendanceData`,
                method: "GET",
                dataType: "json",
            })
            .done(function(response) {
                let attendancePerDate = {};
                $.each(response, function(index, value) {
                    if (value["attendance_date"] in attendancePerDate)
                        attendancePerDate[value["attendance_date"]]["employee"].push(value);
                    else {
                        attendancePerDate[value["attendance_date"]] = {
                            "employee": [value],
                            "late": 0,
                            "on_time": 0,
                            "null": 0
                        };
                    }
                });
                $.each(attendancePerDate, function(index, value) {
                    $.each(value["employee"], function(index2, value2) {
                        if (value2.PAGI == "00:00:00")
                            attendancePerDate[index]["null"]++;
                        else {
                            let attendance_time = parseInt((value2.PAGI.split(':')[0]).toString() + (value2.PAGI.split(':')[1]).toString());
                            (attendance_time > 730) ? attendancePerDate[index]["late"]++: attendancePerDate[index]["on_time"]++;
                        }
                    });
                });
                let monthlyAttendance = [];
                $.each(attendancePerDate, function(index, value) {
                    monthlyAttendance.push({
                        title: `Mengisi Presensi ${parseInt(value.on_time)} Orang`,
                        start: index,
                        backgroundColor: 'green'
                    });
                    monthlyAttendance.push({
                        title: `Terlambat ${parseInt(value.late)} Orang`,
                        start: index,
                        backgroundColor: 'red'
                    });
                    monthlyAttendance.push({
                        title: `Tidak mengisi presensi ${parseInt(value.null)} Orang`,
                        start: index,
                        backgroundColor: 'gray'
                    });
                    monthlyAttendance.push({
                        title: `Total Karyawan ${parseInt(value.on_time)+parseInt(value.late)+parseInt(value.null)} Orang`,
                        start: index,
                        backgroundColor: '#4e73df'
                    });
                });

                const calendar = new FullCalendar.Calendar(document.getElementById('monthly-attendance'), {
                    fixedWeekCount: false,
                    locale: 'id',
                    initialView: 'dayGridMonth',
                    contentHeight: 700,
                    events: monthlyAttendance

                });

                calendar.render();
            });
    </script>
</div>

<!-- End of Main Content -->