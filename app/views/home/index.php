<!-- End of Topbar -->

<?php
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid h-75">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="flex-column d-flex justify-content-center align-items-center h-100">
        <h1><?= $data['generate_code'] ? generateRandomString() : "" ?></h1>
        <form action="<?= BASEURL ?>/Home" method="POST">
            <input type="text" name="generate_code" hidden>
            <button class="btn btn-primary mt-3" <?= $data['generate_code'] ? "disabled" : "" ?>>Generate Code</button>
        </form>
    </div>
</div>

<!-- End of Main Content -->