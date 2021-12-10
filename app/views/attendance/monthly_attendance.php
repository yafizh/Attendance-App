<!-- End of Topbar -->
?>
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
                            "telat": 0
                        };
                    }
                });
                $.each(data, function(index, value) {
                    $.each(value["orang"], function(index2, value2) {
                        if (parseInt((value2.PAGI.split(':')[0]).toString() + (value2.PAGI.split(':')[1]).toString() + (value2.PAGI.split(':')[2]).toString()) > 73000) {
                            data[index]["telat"]++;
                        } else {
                            console.log(parseInt((value2.PAGI.split(':')[0]).toString() + (value2.PAGI.split(':')[1]).toString() + (value2.PAGI.split(':')[2]).toString()))
                        }
                    });
                });
                console.log(data);
            });
        document.addEventListener('DOMContentLoaded', function() {
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
                events: [{
                        title: 'Mengisi Presensi 25 Orang',
                        start: '2021-12-01',
                        backgroundColor: 'green'
                    },
                    {
                        title: 'Terlambat 5 Orang',
                        start: '2021-12-01',
                        backgroundColor: 'red',
                    },
                    {
                        title: 'Tidak Mengisi Presensi: 2 Orang',
                        start: '2021-12-01',
                        backgroundColor: 'gray',
                    },
                    {
                        title: 'Total Karyawan 32 Orang',
                        start: '2021-12-01',
                        backgroundColor: '#4e73df',
                    },
                    {
                        title: 'Mengisi Presensi 25 Orang',
                        start: '2021-12-07',
                        backgroundColor: 'green'
                    },
                    {
                        title: 'Terlambat 5 Orang',
                        start: '2021-12-07',
                        backgroundColor: 'red',
                    },
                    {
                        title: 'Tidak Mengisi Presensi: 2 Orang',
                        start: '2021-12-07',
                        backgroundColor: 'gray',
                    },
                    {
                        title: 'Total Karyawan 32 Orang',
                        start: '2021-12-07',
                        backgroundColor: '#4e73df',
                    }

                ]

            });

            calendar.render();
        });
    </script>
</div>

<!-- End of Main Content -->