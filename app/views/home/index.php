<<<<<<< HEAD
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

=======
>>>>>>> 5b18368 (login work and generate code)
<!-- Begin Page Content -->
<div class="container-fluid h-75">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="flex-column d-flex justify-content-center align-items-center h-100">
<<<<<<< HEAD
        <h1><?= $data['generate_code'] ? generateRandomString() : "" ?></h1>
        <form action="<?= BASEURL ?>/Home" method="POST">
            <input type="text" name="generate_code" hidden>
            <button class="btn btn-primary mt-3" <?= $data['generate_code'] ? "disabled" : "" ?>>Generate Code</button>
=======


        <form action="<?= BASEURL ?>/Home/addGenerate" method="POST">

            <div class="input-group input-container mb-3">
                <input type="text" id="generate_code1" disabled name="generate_code" class="form-control">
                <input type="text" id="generate_code2" name="generate_code" class="form-control" hidden>

                <div class="input-group-append">
                    <button class="cir btn input-group-text" onclick="password_generator()" type="button" id="button-addon2">Generate</button>
                </div>
            </div>

            <div class="flex-column d-flex justify-content-center align-items-center">
                <button class="btn btn-primary mt-3">Save</button>
            </div>
>>>>>>> 5b18368 (login work and generate code)
        </form>
    </div>
</div>

<<<<<<< HEAD
<!-- End of Main Content -->
=======

<!-- End of Main Content -->
<script>
    function password_generator() {
        var length = 10;
        var string = "abcdefghijklmnopqrstuvwxyz"; //to upper 
        var numeric = '0123456789';
        var punctuation = '!@#$%^&*()_+~`|}{[]\:;?><,./-=';
        var code = "";
        var character = "";
        var crunch = true;
        while (code.length < length) {
            entity1 = Math.ceil(string.length * Math.random() * Math.random());
            entity2 = Math.ceil(numeric.length * Math.random() * Math.random());
            entity3 = Math.ceil(punctuation.length * Math.random() * Math.random());
            hold = string.charAt(entity1);
            hold = (code.length % 2 == 0) ? (hold.toUpperCase()) : (hold);
            character += hold;
            character += numeric.charAt(entity2);
            character += punctuation.charAt(entity3);
            code = character;
        }
        code = code.split('').sort(function() {
            return 0.5 - Math.random()
        }).join('');

        document.getElementById("generate_code1").value = code;
        document.getElementById("generate_code2").value = code;
    }
</script>
>>>>>>> 5b18368 (login work and generate code)
