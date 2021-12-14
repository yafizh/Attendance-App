function previewImg(){
    const img = document.querySelector("#image");
    const imgLabel = document.querySelector(".custom-file-label");
    const imgShow = document.querySelector(".img-preview");

    imgLabel.textContent = img.files[0].name;

    const fileImg = new FileReader();
    fileImg.readAsDataURL(img.files[0]);

    fileImg.onload = function(e){
        imgShow.src = e.target.result;
    }
}


// for add employee
$(function(){
    $('.add_employee').on('click', function(){
        $('#formModalLabel').html('Tambah data Karyawan');
        $(".modal-footer button[type=submit]").html('Tambah data');
        $('.modal-body form' ).attr('action', 'http://localhost/Attendance-App/public/Employee/add');
        $('#name').val('');
        $('#unique').val('');
        $('#password').val('');
        $('#lab').text('Pilih Gambar...');
        $('#show').attr('src', 'http://localhost/Attendance-App/public/img/profile_employee/default.png');
            
    });

    $('.edit_employee').on('click', function(){
        $('#formModalLabel').html('Ubah data Karyawan');    
        $('.modal-footer button[type=submit]').html('Ubah data');
        $('.modal-body form' ).attr('action', 'http://localhost/Attendance-App/public/Employee/update');
    
        const id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: "http://localhost/Attendance-App/public/Employee/getEmployee",
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#name').val(data.employee_name);
                $('#unique').val(data.employee_unique_number);
                $('#password').val(data.employee_password);
                $('#lab').text(data.employee_image);
                $('#old_image').val(data.employee_image);
                $('#show').attr('src', 'http://localhost/Attendance-App/public/img/profile_employee/' + data.employee_image);
                $('#id').val(data.employee_id);
                console.log(data);
            }

        });
    });
});




