<section id="input-group-basic">
    <form id="form-export" name="formExports" action="Students/Pages/Print/students-exports.php" method="post" onsubmit="return validateForm()">
        <div class="col-12">
            <div class="card">
                <div class="divider mb-0">
                    <div class="divider-text text-dark"><b>REPORT DATA SISWA EXCEL</b> </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="mb-1">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <div class="form-check form-check-danger">
                                            <input class="form-check-input" type="checkbox" id="checkAll" />
                                        </div>
                                    </div>
                                    <label class="form-control" for="checkAll">check Semua</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="mb-1">
                                <input type="hidden" name="tahunajaran_id" value="<?= $e_tahunajaran['tahunajaran_id']; ?>">
                                <select class="select2 form-select" name="kelas_id" id="kelas_id" data-placeholder="Pilih Data Export">
                                    <option value=""></option>
                                    <option value="ALL">--Pilih Semua Siswa Aktif--</option>
                                    <?php
                                    $sql = mysqli_query($koneksi, "SELECT * FROM e_kelas where tahunajaran_id='$e_tahunajaran[tahunajaran_id]'") or die(mysqli_error($koneksi));
                                    while ($kelas = mysqli_fetch_array($sql)) {
                                        $tingkat = fetch($koneksi, 'e_tingkat', ['tingkat_id' => $kelas['tingkat_id']]);
                                    ?>
                                        <option value="<?php echo $kelas['kelas_id'] ?>"><?php echo $tingkat['tingkat_nama'] ?>-<?php echo $kelas['kelas_nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-0">
                                <button type="submit" class="btn btn-warning">
                                    <i data-feather='download-cloud' class="me-25"></i>
                                    <span>Export</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="divider mb-1 mt-0">
                                <div class="divider-text text-dark"><b>DATA RDM</b> </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check form-check-danger">
                                            <input class="form-check-input" type="radio" name="siswa_nama" id="siswa_nama" checked />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_nama" readonly>Nama Siswa</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check form-check-danger">
                                            <input class="form-check-input" type="radio" name="siswa_nis" id="siswa_nis" checked />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_nis" readonly>NIS Lokal</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check form-check-danger">
                                            <input class="form-check-input" type="radio" name="siswa_nisn" id="siswa_nisn" checked />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_nisn" readonly>NISN</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check form-check-danger">
                                            <input class="form-check-input" type="radio" name="siswa_gender" id="siswa_gender" checked />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_gender" readonly>Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_tempat" name="siswa_tempat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_tempat">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_tgllahir" name="siswa_tgllahir" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_tgllahir">Tanggal Lahir</label>
                                </div>
                            </div>

                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_telpon" name="siswa_telpon" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_telpon">Nomor Handphone</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_alamat" name="siswa_alamat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_alamat">Alamat</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="nama_ayah" name="nama_ayah" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="nama_ayah">Nama Ayah</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="nik_ayah" name="nik_ayah" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="nik_ayah">NIK Ayah</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="nama_ibu" name="nama_ibu" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="nama_ibu">Nama Ibu</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="nik_ibu" name="nik_ibu" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="nik_ibu">NIK Ibu</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="telpon_ortu" name="telpon_ortu" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="telpon_ortu">Nomor Handphone Orangtua</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="nama_wali" name="nama_wali" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="nama_wali">Nama Wali</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="telpon_wali" name="telpon_wali" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="telpon_wali">Nomor Handphone Wali</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="alamat_wali" name="alamat_wali" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="alamat_wali">Alamat Wali</label>
                                </div>
                            </div>
                            <div class="divider mb-1 mt-0">
                                <div class="divider-text text-dark"><b>DATA AKTE</b> </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_akta_nama" name="siswa_akta_nama" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_akta_nama">Nama di Akta</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_akta_nik" name="siswa_akta_nik" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_akta_nik">NIK di Akta</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_akta_tempat" name="siswa_akta_tempat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_akta_tempat">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_akta_tgllahir" name="siswa_akta_tgllahir" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_akta_tgllahir">Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_akta_ayah" name="siswa_akta_ayah" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_akta_ayah">Nama Ayah</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_akta_ibu" name="siswa_akta_ibu" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_akta_ibu">Nama Ibu</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="divider mb-1 mt-0">
                                <div class="divider-text text-dark"><b>Jenjang Sebelumnya</b> </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_asal" name="siswa_ijz_asal" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_asal">Sekolah Asal</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_statusasal" name="siswa_ijz_statusasal" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_statusasal">Status Sekolah Asal</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_npsnasal" name="siswa_ijz_npsnasal" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_npsnasal">NPSN Sekolah Asal</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_sekolahasal" name="siswa_ijz_sekolahasal" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_sekolahasal">Nama Sekolah Asal</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_kotaasal" name="siswa_ijz_kotaasal" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_kotaasal">Alamat Sekolah Asal</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_nama" name="siswa_ijz_nama" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_nama">Nama Siswa Ijazah Sebelumnya</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_nisn" name="siswa_ijz_nisn" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_nisn">NISN Siswa Ijazah Sebelumnya</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_tempat" name="siswa_ijz_tempat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_tempat">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_tgllahir" name="siswa_ijz_tgllahir" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_tgllahir">Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_namaortu" name="siswa_ijz_namaortu" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_namaortu">Nama Orgtua di Ijazah</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_noujian" name="siswa_ijz_noujian" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_noujian">Nomor Ujian</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_noseri" name="siswa_ijz_noseri" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_noseri">No. Seri Ijazah</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_ijz_thnlulus" name="siswa_ijz_thnlulus" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_ijz_thnlulus">Tahun Lulus</label>
                                </div>
                            </div>
                            <div class="divider mb-1 mt-0">
                                <div class="divider-text text-dark"><b>DATA KARTU KELUARGA</b> </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_nomor" name="siswa_kk_nomor" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_nomor">No. KK</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_kepala" name="siswa_kk_kepala" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_kepala">Nama Kepala Keluarga</label>
                                </div>
                            </div>

                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_provinsi" name="siswa_kk_provinsi" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_provinsi">Provinsi</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_kota" name="siswa_kk_kota" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_kota">Kota</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_kecamatan" name="siswa_kk_kecamatan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_kecamatan">Kecamatan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_kelurahan" name="siswa_kk_kelurahan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_kelurahan">Kelurahan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_alamat" name="siswa_kk_alamat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_alamat">Alamat</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_rt" name="siswa_kk_rt" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_rt">RT / RW</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_kodepos" name="siswa_kk_kodepos" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_kodepos">Kode Pos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_nama" name="siswa_kk_nama" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_nama">Nama Siswa di KK</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_wn" name="siswa_kk_wn" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_wn">Kewarganegaraan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_nik" name="siswa_kk_nik" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_nik">NIK/Kitas</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_tempat" name="siswa_kk_tempat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_tempat">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_tgllahir" name="siswa_kk_tgllahir" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_tgllahir">Tanggal. Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_anakke" name="siswa_anakke" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_anakke">Anak Ke-</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_jmlsaudara" name="siswa_kk_jmlsaudara" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_jmlsaudara">Jml Saudara</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kk_darah" name="siswa_kk_darah" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kk_darah">Gol Darah</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_nama" name="ayah_kk_nama" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_nama">Nama Ayah</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_status" name="ayah_kk_status" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_status">Status Ayah</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_wn" name="ayah_kk_wn" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_wn">Ayah Kewarganegaraan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_nik" name="ayah_kk_nik" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_nik">Ayah NIK/Kitas</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_tempat" name="ayah_kk_tempat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_tempat">Ayah Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_tgllahir" name="ayah_kk_tgllahir" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_tgllahir">Ayah Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_pendidikan" name="ayah_kk_pendidikan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_pendidikan">Ayah Pendidikan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_pekerjaan" name="ayah_kk_pekerjaan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_pekerjaan">Ayah Pekerjaan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ayah_kk_penghasilan" name="ayah_kk_penghasilan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ayah_kk_penghasilan">Ayah Penghasilan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_nama" name="ibu_kk_nama" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_nama">Nama Ibu</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_status" name="ibu_kk_status" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_status">Status Ibu</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_wn" name="ibu_kk_wn" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_wn">Ibu Kewarganegaraan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_nik" name="ibu_kk_nik" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_nik">Ibu NIK/Kitas</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_tempat" name="ibu_kk_tempat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_tempat">Ibu Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_tgllahir" name="ibu_kk_tgllahir" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_tgllahir">Ibu Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_pendidikan" name="ibu_kk_pendidikan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_pendidikan">Ibu Pendidikan</label>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_pekerjaan" name="ibu_kk_pekerjaan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_pekerjaan">Ibu Pekerjaan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ibu_kk_penghasilan" name="ibu_kk_penghasilan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="ibu_kk_penghasilan">Ibu Penghasilan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wali_kk_nama" name="wali_kk_nama" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="wali_kk_nama">Nama Wali</label>
                                </div>
                            </div>

                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wali_kk_wn" name="wali_kk_wn" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="wali_kk_wn">Wali Kewarganegaraan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wali_kk_nik" name="wali_kk_nik" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="wali_kk_nik">Wali NIK/Kitas</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wali_kk_tempat" name="wali_kk_tempat" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="wali_kk_tempat">Wali Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wali_kk_tgllahir" name="wali_kk_tgllahir" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="wali_kk_tgllahir">Wali Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wali_kk_pendidikan" name="wali_kk_pendidikan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="wali_kk_pendidikan">Wali Pendidikan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wali_kk_pekerjaan" name="wali_kk_pekerjaan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="wali_kk_pekerjaan">Wali Pekerjaan</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wali_kk_penghasilan" name="wali_kk_penghasilan" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="wali_kk_penghasilan">Wali Penghasilan</label>
                                </div>
                            </div>
                            <div class="divider mb-1 mt-0">
                                <div class="divider-text text-dark"><b>DATA IMUNISASI</b> </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="imunisasi_danvaksin" name="imunisasi_danvaksin" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="imunisasi_danvaksin">Imunisasi Dan Vaksin</label>
                                </div>
                            </div>
                            <div class="divider mb-1 mt-0">
                                <div class="divider-text text-dark"><b>DATA BANTUAN KJP</b> </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kjp_status" name="siswa_kjp_status" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kjp_status">Status Penerima KJP</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kjp_namarek" name="siswa_kjp_namarek" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kjp_namarek">Nama di Rekening KJP</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kjp_norek" name="siswa_kjp_norek" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kjp_norek">Nomor Rekening KJP</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kjp_bankcab" name="siswa_kjp_bankcab" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kjp_bankcab">Bank Cabang</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kjp_nomoratm" name="siswa_kjp_nomoratm" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kjp_nomoratm">Nomor Kartu KJP</label>
                                </div>
                            </div>
                            <div class="divider mb-1 mt-0">
                                <div class="divider-text text-dark"><b>DATA BANTUAN KIP</b> </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kip_status" name="siswa_kip_status" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kip_status">Status Penerima KIP</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kip_namarek" name="siswa_kip_namarek" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kip_namarek">Nama di Rekening KIP</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kip_norek" name="siswa_kip_norek" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kip_norek">Nomor Rekening KIP</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kip_bankcab" name="siswa_kip_bankcab" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kip_bankcab">Bank Cabang</label>
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-text input-group-text-sm">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="siswa_kip_nomoratm" name="siswa_kip_nomoratm" />
                                        </div>
                                    </div>
                                    <label class="form-control form-control-sm" for="siswa_kip_nomoratm">Nomor Kartu KIP</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">
                    <i data-feather='download-cloud' class="me-25"></i>
                    <span>Export</span>
                </button>
            </div>
        </div>
    </form>
</section>
<script>
      $('#checkAll').click(function() {
        $('input:checkbox').prop('checked', this.checked);
    });
    function validateForm() {
        if (document.forms["formExports"]["kelas_id"].selectedIndex < 1) {
            Swal.fire({
                title: "Warning!",
                text: "Pilih Kelas Export Terlebih Dahulu",
                icon: "error",
                customClass: {
                    confirmButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });
            return false;
            document.forms["formExports"]["kelas_id"].focus();
            return false;
        } else {
            $("#modalExcelStudents").modal("hide");
        }
    }
</script>