<?php
include('koneksi.php');
include('login.php');
                                
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // Mendapatkan data yang akan diperbarui dari formulir
                                    $idKaderToUpdate = $_POST['id_kader'];
                                    $namaKaderToUpdate = $_POST['nama_kader'];
                                    $tanggalLahirToUpdate = $_POST['tgl_lahir'];
                                    $alamatToUpdate = $_POST['alamat'];
                                    $jabatanToUpdate = $_POST['jabatan'];
                                    $tugasPokokToUpdate = $_POST['tugas_pokok'];
                                
                                    // Query SQL UPDATE untuk memperbarui data kader
                                    $sqlUpdate = "UPDATE tbl_kader SET 
                                        nama_kader = '$namaKaderToUpdate',
                                        tgl_lahir = '$tanggalLahirToUpdate',
                                        alamat = '$alamatToUpdate',
                                        jabatan = '$jabatanToUpdate',
                                        tugas_pokok = '$tugasPokokToUpdate'
                                        WHERE id_kader = $idKaderToUpdate";
                                
                                    if ($koneksi->query($sqlUpdate) === TRUE) {
                                        echo "Data kader berhasil diperbarui.";
                                    } else {
                                        echo "Terjadi kesalahan saat memperbarui data: " . $koneksi->error;
                                    }
                                }
                                ?>