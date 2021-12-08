<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
    </div>

    <div id="container">
        <table class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Unique number</th>
                    <th scope="col">password</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Edited_at</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($data as $data) { ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $data['employee_name']; ?></td>
                        <td><?= $data['employee_unique_number']; ?></td>
                        <td><?= $data['employee_password']; ?></td>
                        <td><?= $data['created_at']; ?></td>
                        <td><?= $data['edited_at']; ?></td>
                    </tr>
                <?php $i++;
                }  ?>
            </tbody>
        </table>

    </div>

    <!-- End of Main Content -->