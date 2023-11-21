$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

$(document).ready(function() {
    // Fungsi untuk mengambil data dari server dan mengisikan ke tabel
    function fetchData() {
        $.ajax({
            url: 'crud.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Mengosongkan tabel
                $('#anak-table tbody').empty();

                // Mengisi tabel dengan data yang diterima dari server
                $.each(data, function(index, item) {
                    $('#anak-table tbody').append(
                        '<tr>' +
                        '<td>' + item.NIK_Anak + '</td>' +
                        '<td>' + item.Nama_Anak + '</td>' +
                        '<td>' + item.Jenis_Kelamin + '</td>' +
                        '<td>' + item.Tanggal_Lahir + '</td>' +
                        '<td>' + item.Berat_Badan + '</td>' +
                        '<td>' + item.Tinggi_Badan + '</td>' +
                        '<td>' + item.Alamat + '</td>' +
                        '<td>' + item.nama_ibu + '</td>' +
                        '<td>' +
                        '<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>Edit</a>' +
                        '<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>Delete</a>' +
                        '</td>' +
                        '</tr>'
                    );
                });
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data dari server.');
            }
        });
    }

    // Memanggil fetchData() saat halaman pertama kali dimuat
    fetchData();
});
