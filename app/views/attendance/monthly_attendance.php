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
    <div id="disini"></div>
    <script>
        $.ajax({
                url: `<?= BASEURL ?>/Attendance/getMonthlyAttendanceData`,
                method: "GET",
                dataType: "json",
            })
            .done(function(msg) {
                console.log(msg);
                let data = {};
                $.each(msg, function(index, value) {
                    if (value["DATE(a.created_at)"] in data) {
                        data[value["DATE(a.created_at)"]]["orang"].push(value);
                    } else {
                        data[value["DATE(a.created_at)"]] = {
                            "orang": [value],
                            "telat": 0,
                            "tepat": 0,
                            "null": 0
                        };
                    }
                });
                $.each(data, function(index, value) {
                    $.each(value["orang"], function(index2, value2) {
                        if (value2.PAGI == null) {
                            data[index]["null"]++;
                        } else {
                            if (parseInt((value2.PAGI.split(':')[0]).toString() + (value2.PAGI.split(':')[1]).toString() + (value2.PAGI.split(':')[2]).toString()) == 0) {
                                data[index]["null"]++;
                            } else if (parseInt((value2.PAGI.split(':')[0]).toString() + (value2.PAGI.split(':')[1]).toString() + (value2.PAGI.split(':')[2]).toString()) > 73000) {
                                data[index]["telat"]++;
                            } else {
                                data[index]["tepat"]++;
                            }
                        }

                    });
                });
                console.log(data);
                let x = [];
                $.each(data, function(index, value) {
                    x.push({
                        title: `Mengisi Presensi ${parseInt(value.tepat)} Orang`,
                        start: index,
                        backgroundColor: 'green'
                    });
                    x.push({
                        title: `Terlambat ${parseInt(value.telat)} Orang`,
                        start: index,
                        backgroundColor: 'red'
                    });
                    x.push({
                        title: `Tidak mengisi presensi ${parseInt(value.null)} Orang`,
                        start: index,
                        backgroundColor: 'gray'
                    });
                    x.push({
                        title: `Total Karyawan ${parseInt(value.telat)+parseInt(value.tepat)+parseInt(value.null)} Orang`,
                        start: index,
                        backgroundColor: '#4e73df'
                    });
                });

                const calendarEl = document.getElementById('disini');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    fixedWeekCount: false,
                    locale: 'id',
                    initialView: 'dayGridMonth',
                    eventClick: function(info) {
                        // alert('Event: ' + info.event.title);
                        // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                        // alert('View: ' + info.view.type);
                        console.log(info)
                    },
                    contentHeight: 700,
                    events: x

                });

                calendar.render();
            });
        document.addEventListener('DOMContentLoaded', function() {

        });
    </script>
</div>

<!-- End of Main Content -->