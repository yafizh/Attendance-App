
// for add employee
$(function(){
    $('.add_employee').on('click', function(){
        $('#formModalLabel').html('Tambah data Karyawan');
        $(".modal-footer button[type=submit]").html('Tambah data');
        $('#kodeBuku').val('');
        $('#judul').val('');
        $('#pengarang').val('');
        $('#penerbit').val('');
        $('#tahunTerbit').val('');
        $('#stok').val('');
            
    });

    $('.edit_employee').on('click', function(){
        $('#formModalLabel').html('Ubah data Karyawan');    
        $('.modal-footer button[type=submit]').html('Ubah data');
        $('.modal-body form' ).attr('action', 'http://localhost:8080/Attendance-App/public/Employee/update');
    
        const id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: "http://localhost:8080/Attendance-App/public/Employee/getEmployee",
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#name').val(data.employee_name);
                $('#unique').val(data.employee_unique_number);
                $('#password').val(data.employee_password);
                $('#id').val(data.employee_id);
                console.log(data);
            }

        });
    });
});