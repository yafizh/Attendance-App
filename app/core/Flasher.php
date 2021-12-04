<?php
class Flasher {

    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        if( isset($_SESSION['flash'] ) ) {
            echo '
<<<<<<< HEAD
            <div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert"> Data Mahasiswa
=======
            <div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
>>>>>>> 5b18368 (login work and generate code)
                <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
                <button type="button" class="close" data-dismiss="alert" aria-table="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
        unset($_SESSION['flash']);
        }
    }


}
<<<<<<< HEAD
?>
=======
>>>>>>> 5b18368 (login work and generate code)
