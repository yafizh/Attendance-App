<!-- Footer -->
<!-- <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer> -->
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    const link = window.location.href;
    const ex = link.split('/');

    if (ex[6] == 'getAllAttendance') {

        document.getElementById("presensi").className += " active";
        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("collapseUtilities").className += " show";
        document.getElementById("getAllAttendance").className += " active";

    } else if (ex[6] == 'getMonthlyAttendance') {

        document.getElementById("presensi").className += " active";
        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("collapseUtilities").className += " show";
        document.getElementById("getMonthlyAttendance").className += " active";

    } else if (ex[5] == 'Attendance') {

        document.getElementById("presensi").className += " active";
        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("collapseUtilities").className += " show";
        document.getElementById("attendance").className += " active";

    } else if (ex[5] == 'Account') {

        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("account").className += " active";

    } else if (ex[6] == 'add_employee') {

        document.getElementById("karyawan").className += " active";
        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("collapseTwo").className += " show";
        document.getElementById("add_employee").className += " active";

    } else if (ex[5] == 'Employee') {

        document.getElementById("karyawan").className += " active";
        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("collapseTwo").className += " show";
        document.getElementById("employee").className += " active";

    }
</script>
<!-- Core plugin JavaScript-->
<script src="js/script.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>