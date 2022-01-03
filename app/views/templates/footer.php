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

<script type="text/javascript">
    const page = window.location.href.split('/');

    if (page[6] == 'getAllAttendance') {
        document.getElementById("presensi").className += " active";
        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("collapseUtilities").className += " show";
        document.getElementById("getAllAttendance").className += " active";
    } else if (page[6] == 'getMonthlyAttendance') {
        document.getElementById("presensi").className += " active";
        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("collapseUtilities").className += " show";
        document.getElementById("getMonthlyAttendance").className += " active";
    } else if (page[5] == 'Attendance') {
        document.getElementById("presensi").className += " active";
        document.getElementById("dashboard").classList.remove('active');
        document.getElementById("collapseUtilities").className += " show";
        document.getElementById("attendance").className += " active";
    } else if (page[5] == 'Account') {
        <?php if ($_SESSION['login'] == 'admin') : ?>
            document.getElementById("dashboard").classList.remove('active');
        <?php else : ?>
            document.getElementById("presensi2").classList.remove('active');
        <?php endif; ?>
        document.getElementById("account").className += " active";
    } else if (page[5] == 'Employee') {
        document.getElementById("karyawan").className += " active";
        document.getElementById("dashboard").classList.remove('active');
    }
</script>
<!-- Core plugin JavaScript-->
<script src="js/script.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
</body>

</html>