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
    <div class="d-flex flex-wrap">
        <div class="card mr-3 mb-4" style="width: 18rem;" id="x">
            <img src="<?= BASEURL ?>/img/profile.jpg" class="card-img-top" alt="...">
            <div class="card-body text-center">
                <h5 class="card-title">Nursahid Arya Suyudi</h5>
            </div>
        </div>
    </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('x').addEventListener("click", function() {
                $('#exampleModal').modal('show');
            });
            $('#exampleModal').on('shown.bs.modal', function() {
                calendar.render();
            });
            const calendarEl = document.getElementById('disini');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                fixedWeekCount: false,
                locale: 'id',
                initialView: 'dayGridMonth',
                events: [{
                        title: 'Presensi Pagi: 07:30',
                        start: '2021-12-01',
                        backgroundColor: 'green',
                    },
                    {
                        title: 'Presensi Pulang: 16:30',
                        start: '2021-12-01',
                        backgroundColor: 'green',
                    },
                    {
                        title: 'Presensi Pagi: 09:30',
                        start: '2021-12-02',
                        backgroundColor: 'red',
                    },
                    {
                        title: 'Presensi Pulang: 16:30',
                        start: '2021-12-02',
                        backgroundColor: 'green',
                    }

                ]

            });
        });
    </script>
</div>

<!-- End of Main Content -->