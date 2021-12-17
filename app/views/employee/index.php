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
                    <i class='bx bx-plus-medical'></i> Tambah Data
                </button>
            </div>
        </div>
        <table class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Unique number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $employees = $data;
                foreach ($employees as $employee) : ?>
                    <tr>
                        <td>
                            <img src="<?= BASEURL; ?>/img/profile_employee/<?= $employee['employee_image']; ?>" alt="pict" style="width: 130px; height: 170px;">
                        </td>
                        <td><?= $employee['employee_name']; ?></td>
                        <td><?= $employee['employee_unique_number']; ?></td>
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
                    <button type="button" class="role" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL ?>/Employee/addEmployee" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
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
                            <label for="unique">Unique Number</label>
                            <input type="text" class="form-control" id="unique" name="unique" autocomplete="off">
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