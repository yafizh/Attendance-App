<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
    </div>
    <div class="row">
        <?php Flasher::flash(); ?>
    </div>
    <div id="container">
        <div class="row mb-3">
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary add_employee" data-toggle="modal" data-target="#formModal">
                    <i class='bx bx-plus-medical'></i> Tambah Data Karyawan
                </button>
            </div>
        </div>
        <table class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $employees = $data;
                foreach ($employees as $index => $employee) : ?>
                    <tr>
                        <td><?= ($index + 1) ?></td>
                        <td><?= $employee['employee_name']; ?></td>
                        <td><?= $employee['employee_nip']; ?></td>
                        <td>
                            <div class="row">
                                <button class='btn btn-sm btn-info mr-1 edit_employee' data-toggle="modal" data-target="#formModal" data-id="<?= $employee['employee_id']; ?>"><i class="fas fa-edit"></i></button>
                                <a href="<?= BASEURL; ?>/Employee/deleteEmployee/<?= $employee['employee_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- End of Main Content -->

    <!-- modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-tabelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Data Karyawan</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL ?>/Employee/addEmployee" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="employee_id" id="employee_id">
                        <input type="hidden" name="old_image" id="old_image">

                        <div class="form-group">
                            <label for="image" class="col-form-label">Profile Image</label><br>
                            <img src="<?= BASEURL ?>/img/default.png" id="show" style="width: 80px; height: 100px;" class="img-thumbnail img-preview">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" onchange="previewImg()">
                                <label class="custom-file-label" id="lab" for="image"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Karyawan</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="employee_nip">NIP</label>
                            <input type="text" class="form-control" id="employee_nip" name="employee_nip" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const previewImg = () => {
            const img = document.querySelector("#image");
            const imgLabel = document.querySelector(".custom-file-label");
            const imgShow = document.querySelector(".img-preview");

            imgLabel.textContent = img.files[0].name;

            const fileImg = new FileReader();
            fileImg.readAsDataURL(img.files[0]);

            fileImg.onload = function(e) {
                imgShow.src = e.target.result;
            }
        }


        $('.add_employee').on('click', function() {
            $('#formModalLabel').html('Tambah data Karyawan');
            $(".modal-footer button[type=submit]").html('Tambah data');
            $('.modal-body form').attr('action', '<?= BASEURL ?>/Employee/addEmployee');
            $('#name').val('');
            $('#employee_nip').val('');
            $('#password').val('');
            $('#lab').text('Pilih Gambar...');
            $('#show').attr('src', '<?= BASEURL ?>/img/profile_employee/default.png');
        });

        $('.edit_employee').on('click', function() {
            $('#formModalLabel').html('Ubah data Karyawan');
            $('.modal-footer button[type=submit]').html('Ubah data');
            $('.modal-body form').attr('action', '<?= BASEURL ?>/Employee/updateEmployee');

            $.ajax({
                url: "<?= BASEURL ?>/Employee/getEmployee",
                data: {
                    id: $(this).data('id')
                },
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#name').val(data.employee_name);
                    $('#employee_nip').val(data.employee_nip);
                    $('#password').val(data.employee_password);
                    $('#lab').text(data.employee_image);
                    $('#old_image').val(data.employee_image);
                    $('#show').attr('src', '<?= BASEURL ?>/img/profile_employee/' + data.employee_image);
                    $('#employee_id').val(data.employee_id);
                }
            });
        });
    </script>