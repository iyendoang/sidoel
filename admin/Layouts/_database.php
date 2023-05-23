<?php
require '../../config/database.php';

if ($pg == 'createTable') {
    $sql = "CREATE TABLE IF NOT EXISTS e_lembaga (
        lembaga_id varchar(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        lembaga_nsm varchar(20) NOT NULL UNIQUE,
        lembaga_profile mediumtext DEFAULT NULL,
        lembaga_foto varchar(250) DEFAULT NULL,
        tahunajaran_id char(4) DEFAULT NULL,
        semester_id INT(11) DEFAULT NULL,
        password varchar(400) DEFAULT NULL,
        sistem_penilaian INT(1) DEFAULT 1
    )";
    mysqli_query($koneksi, $sql); // Execute the first table creation
    $sql = "CREATE TABLE IF NOT EXISTS t_lembaga (
        id_m_lembaga bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        lembaga_id varchar(100) NOT NULL UNIQUE UNIQUE,
        lembaga_nama varchar(255) DEFAULT NULL UNIQUE,
        lembaga_nsm varchar(20) DEFAULT NULL,
        lembaga_npsn varchar(20) DEFAULT NULL,
        lembaga_npwp varchar(100) DEFAULT NULL,
        jenjang_id varchar(100) DEFAULT NULL,
        lembaga_status varchar(10) DEFAULT NULL,
        lembaga_alamat TEXT DEFAULT NULL,
        lembaga_kota varchar(150) DEFAULT NULL,
        lembaga_provinsi varchar(150) DEFAULT NULL,
        lembaga_kec varchar(150) DEFAULT NULL,
        lembaga_kel varchar(150) DEFAULT NULL,
        lembaga_rt char(4) DEFAULT NULL,
        lembaga_rw char(4) DEFAULT NULL,
        lembaga_kodepos varchar(10) DEFAULT NULL,
        lembaga_notelp varchar(20) DEFAULT NULL,
        lembaga_email varchar(255) DEFAULT NULL,
        lembaga_web varchar(255) DEFAULT NULL,
        lembaga_link_rdm varchar(255) DEFAULT NULL,
        lembaga_siopstatus varchar(10) DEFAULT NULL,
        lembaga_no_siop varchar(255) DEFAULT NULL,
        lembaga_tgl_siop DATE DEFAULT NULL,
        lembaga_siop_end DATE DEFAULT NULL,
        lembaga_akre varchar(255) DEFAULT NULL,
        lembaga_nilai_akre varchar(255) DEFAULT NULL,
        lembaga_no_akre varchar(255) DEFAULT NULL,
        lembaga_tgl_akre DATE DEFAULT NULL,
        lembaga_tgl_akre_end DATE DEFAULT NULL,
        lembaga_thnberdiri varchar(10) DEFAULT NULL,
        lembaga_pengawas varchar(255) DEFAULT NULL,
        lembaga_nip_pengawas varchar(255) DEFAULT NULL,
        lembaga_kasie varchar(255) DEFAULT NULL,
        lembaga_nip_kasie varchar(255) DEFAULT NULL,
        lembaga_kamad varchar(255) DEFAULT NULL,
        lembaga_nip_kamad varchar(255) DEFAULT NULL,
        lembaga_kamad_notelp varchar(255) DEFAULT NULL,
        lembaga_operator varchar(255) DEFAULT NULL,
        lembaga_nip_operator varchar(255) DEFAULT NULL,
        lembaga_operator_notelp varchar(255) DEFAULT NULL,
        lembaga_komite varchar(255) DEFAULT NULL,
        lembaga_nip_komite varchar(255) DEFAULT NULL,
        lembaga_kop_surat varchar(255) DEFAULT NULL,
        LY_noakta varchar(255) DEFAULT NULL,
        LY_tglakta DATE DEFAULT NULL,
        LY_namanotaris varchar(255) DEFAULT NULL,
        LY_noakta_update varchar(255) DEFAULT NULL,
        LY_tglakta_update DATE DEFAULT NULL,
        LY_namaakta_update varchar(255) DEFAULT NULL,
        LY_sk_kemenkumham varchar(255) DEFAULT NULL,
        LY_tgl_kemenkumham DATE DEFAULT NULL,
        lembaga_filekopsurat varchar(500) DEFAULT NULL,
        lembaga_filesiop varchar(500) DEFAULT NULL,
        lembaga_fileakre varchar(500) DEFAULT NULL,
        lembaga_fileakta varchar(500) DEFAULT NULL,
        lembaga_fileaktaend varchar(500) DEFAULT NULL,
        lembaga_fileskmenkumham varchar(500) DEFAULT NULL,
        lembaga_filenpsn varchar(500) DEFAULT NULL,
        lembaga_filenpwp varchar(500) DEFAULT NULL,
        lembaga_filestempel varchar(500) DEFAULT NULL,
        lembaga_filettdkamad varchar(500) DEFAULT NULL,
        L_tglkartupelajar DATE DEFAULT NULL,
        L_judulkartu varchar(500) DEFAULT NULL,
        L_isikartu TEXT DEFAULT NULL,
        L_templatekartu varchar(500) DEFAULT NULL,
        L_ujian_nama  varchar(500) DEFAULT NULL,
        L_ujian_nopes  varchar(500) DEFAULT NULL,
        L_ujian_headercard  varchar(500) DEFAULT NULL,
        L_ujian_tglujian  DATE DEFAULT NULL,
        lembaga_sidoel  varchar(500) DEFAULT NULL,
        lembaga_active  INT(10) DEFAULT NULL,
        lembaga_tgl_tigalima  DATE DEFAULT NULL,
        lembaga_ppdb_embed  varchar(500) DEFAULT NULL,
        username  varchar(500) DEFAULT NULL,
        password  varchar(500) DEFAULT NULL,
        FOREIGN KEY (lembaga_id) REFERENCES e_lembaga(lembaga_id)
    )";
    mysqli_query($koneksi, $sql); // Execute the second table creation

    $sql = "CREATE TABLE IF NOT EXISTS f_siswa_act (
         siswa_act_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        siswa_id bigint(100) NOT NULL UNIQUE,
        siswa_edit_status INT(11) DEFAULT NULL,
        siswa_act_hobi varchar(100) DEFAULT NULL,
        siswa_act_cita varchar(100) DEFAULT NULL,
        siswa_act_abk varchar(100) DEFAULT NULL,
        siswa_act_disability varchar(100) DEFAULT NULL,
        siswa_act_email varchar(100) DEFAULT NULL,
        siswa_act_status varchar(10) DEFAULT NULL,
        siswa_akta_nama varchar(225) DEFAULT NULL,
        siswa_akta_nik varchar(20) DEFAULT NULL,
        siswa_akta_tempat varchar(100) DEFAULT NULL,
        siswa_akta_tgllahir date DEFAULT NULL,
        siswa_akta_ayah varchar(225) DEFAULT NULL,
        siswa_akta_ibu varchar(225) DEFAULT NULL,
        file_akta_siswa varchar(225) DEFAULT NULL,
        siswa_ijz_asal varchar(100) DEFAULT NULL,
        siswa_ijz_statusasal varchar(20) DEFAULT NULL,
        siswa_ijz_npsnasal varchar(20) DEFAULT NULL,
        siswa_ijz_sekolahasal varchar(225) DEFAULT NULL,
        siswa_ijz_kotaasal varchar(225) DEFAULT NULL,
        siswa_ijz_nama varchar(225) DEFAULT NULL,
        siswa_ijz_nisn varchar(20) DEFAULT NULL,
        siswa_ijz_tempat varchar(225) DEFAULT NULL,
        siswa_ijz_tgllahir date DEFAULT NULL,
        siswa_ijz_namaortu varchar(225) DEFAULT NULL,
        siswa_ijz_noujian varchar(225) DEFAULT NULL,
        siswa_ijz_noseri varchar(225) DEFAULT NULL,
        siswa_ijz_thnlulus varchar(10) DEFAULT NULL,
        file_ijz_siswa varchar(225) DEFAULT NULL,
        siswa_kk_nomor varchar(20) DEFAULT NULL,
        siswa_kk_kepala varchar(225) DEFAULT NULL,
        siswa_kk_alamat text DEFAULT NULL,
        siswa_kk_rt varchar(10) DEFAULT NULL,
        siswa_kk_rw varchar(10) DEFAULT NULL,
        siswa_kk_kelurahan varchar(100) DEFAULT NULL,
        siswa_kk_kecamatan varchar(100) DEFAULT NULL,
        siswa_kk_kota varchar(100) DEFAULT NULL,
        siswa_kk_provinsi varchar(100) DEFAULT NULL,
        siswa_kk_kodepos varchar(10) DEFAULT NULL,
        siswa_kk_nama varchar(225) DEFAULT NULL,
        siswa_kk_wn varchar(100) DEFAULT NULL,
        siswa_kk_nik varchar(20) DEFAULT NULL,
        siswa_kk_tempat varchar(100) DEFAULT NULL,
        siswa_kk_tgllahir date DEFAULT NULL,
        siswa_kk_anakke varchar(10) DEFAULT NULL,
        siswa_kk_jmlsaudara varchar(10) DEFAULT NULL,
        siswa_kk_darah varchar(100) DEFAULT NULL,
        ayah_kk_nama varchar(225) DEFAULT NULL,
        ayah_kk_status varchar(5) DEFAULT NULL,
        ayah_kk_wn varchar(100) DEFAULT NULL,
        ayah_kk_nik varchar(20) DEFAULT NULL,
        ayah_kk_tempat varchar(100) DEFAULT NULL,
        ayah_kk_tgllahir date DEFAULT NULL,
        ayah_kk_pendidikan varchar(50) DEFAULT NULL,
        ayah_kk_pekerjaan varchar(50) DEFAULT NULL,
        ayah_kk_penghasilan varchar(50) DEFAULT NULL,
        ayah_kk_hp varchar(20) DEFAULT NULL,
        ibu_kk_nama varchar(225) DEFAULT NULL,
        ibu_kk_status varchar(5) DEFAULT NULL,
        ibu_kk_wn varchar(100) DEFAULT NULL,
        ibu_kk_nik varchar(20) DEFAULT NULL,
        ibu_kk_tempat varchar(50) DEFAULT NULL,
        ibu_kk_tgllahir date DEFAULT NULL,
        ibu_kk_pendidikan varchar(50) DEFAULT NULL,
        ibu_kk_pekerjaan varchar(100) DEFAULT NULL,
        ibu_kk_penghasilan varchar(50) DEFAULT NULL,
        ibu_kk_hp varchar(20) DEFAULT NULL,
        siswa_wali_hubungan varchar(50) DEFAULT NULL,
        wali_kk_nama varchar(225) DEFAULT NULL,
        wali_kk_hubungan varchar(100) DEFAULT NULL,
        wali_kk_wn varchar(20) DEFAULT NULL,
        wali_kk_nik varchar(20) DEFAULT NULL,
        wali_kk_tempat varchar(50) DEFAULT NULL,
        wali_kk_tgllahir date DEFAULT NULL,
        wali_kk_pendidikan varchar(50) DEFAULT NULL,
        wali_kk_pekerjaan varchar(50) DEFAULT NULL,
        wali_kk_penghasilan varchar(100) DEFAULT NULL,
        wali_kk_hp varchar(20) DEFAULT NULL,
        file_kk_siswa varchar(225) DEFAULT NULL,
        file_ktp_ayah varchar(225) DEFAULT NULL,
        file_ktp_ibu varchar(225) DEFAULT NULL,
        file_ktp_wali varchar(225) DEFAULT NULL,
        siswa_dom_statusrumah varchar(100) DEFAULT NULL,
        siswa_dom_jarak varchar(100) DEFAULT NULL,
        siswa_dom_waktu varchar(100) DEFAULT NULL,
        siswa_dom_transportasi varchar(100) DEFAULT NULL,
        siswa_dom_statusalamat varchar(100) DEFAULT NULL,
        siswa_dom_alamat text DEFAULT NULL,
        siswa_dom_rt varchar(10) DEFAULT NULL,
        siswa_dom_rw varchar(10) DEFAULT NULL,
        siswa_dom_kelurahan varchar(100) DEFAULT NULL,
        siswa_dom_kecamatan varchar(100) DEFAULT NULL,
        siswa_dom_kota varchar(100) DEFAULT NULL,
        siswa_dom_provinsi varchar(100) DEFAULT NULL,
        siswa_dom_kodepos varchar(10) DEFAULT NULL,
        ayah_dom_statusalamat varchar(100) DEFAULT NULL,
        ayah_dom_alamat text DEFAULT NULL,
        ayah_dom_rt varchar(10) DEFAULT NULL,
        ayah_dom_rw varchar(10) DEFAULT NULL,
        ayah_dom_kelurahan varchar(100) DEFAULT NULL,
        ayah_dom_kecamatan varchar(100) DEFAULT NULL,
        ayah_dom_kota varchar(100) DEFAULT NULL,
        ayah_dom_provinsi varchar(100) DEFAULT NULL,
        ayah_dom_kodepos varchar(10) DEFAULT NULL,
        ibu_dom_statusalamat varchar(100) DEFAULT NULL,
        ibu_dom_alamat text DEFAULT NULL,
        ibu_dom_rt varchar(10) DEFAULT NULL,
        ibu_dom_rw varchar(10) DEFAULT NULL,
        ibu_dom_kelurahan varchar(100) DEFAULT NULL,
        ibu_dom_kecamatan varchar(100) DEFAULT NULL,
        ibu_dom_kota varchar(100) DEFAULT NULL,
        ibu_dom_provinsi varchar(100) DEFAULT NULL,
        ibu_dom_kodepos varchar(10) DEFAULT NULL,
        wali_dom_statusalamat varchar(100) DEFAULT NULL,
        wali_dom_alamat text DEFAULT NULL,
        wali_dom_rt varchar(10) DEFAULT NULL,
        wali_dom_rw varchar(10) DEFAULT NULL,
        wali_dom_kelurahan varchar(100) DEFAULT NULL,
        wali_dom_kecamatan varchar(100) DEFAULT NULL,
        wali_dom_kota varchar(100) DEFAULT NULL,
        wali_dom_provinsi varchar(100) DEFAULT NULL,
        wali_dom_kodepos varchar(10) DEFAULT NULL,
        siswa_kjp_status varchar(50) DEFAULT NULL,
        siswa_kjp_nomoratm varchar(100) DEFAULT NULL,
        file_kjp_atm varchar(225) DEFAULT NULL,
        siswa_kjp_norek varchar(100) DEFAULT NULL,
        siswa_kjp_namarek varchar(225) DEFAULT NULL,
        siswa_kjp_bankcab varchar(225) DEFAULT NULL,
        file_kjp_bukurek varchar(225) DEFAULT NULL,
        file_kjp_ktpwali varchar(225) DEFAULT NULL,
        siswa_kip_status varchar(50) DEFAULT NULL,
        siswa_kip_nomoratm varchar(100) DEFAULT NULL,
        file_kip_atm varchar(225) DEFAULT NULL,
        siswa_kip_norek varchar(100) DEFAULT NULL,
        siswa_kip_namarek varchar(225) DEFAULT NULL,
        siswa_kip_bankcab varchar(225) DEFAULT NULL,
        file_kip_bukurek varchar(225) DEFAULT NULL,
        file_kip_ktpwali varchar(225) DEFAULT NULL,
        health_hepatitis_b varchar(10) DEFAULT NULL,
        health_campak varchar(10) DEFAULT NULL,
        health_bcg varchar(10) DEFAULT NULL,
        health_dpt varchar(10) DEFAULT NULL,
        health_polio varchar(10) DEFAULT NULL,
        health_covid_one varchar(10) DEFAULT NULL,
        health_covid_two varchar(10) DEFAULT NULL,
        health_booster_one varchar(10) DEFAULT NULL,
        health_booster_two varchar(10) DEFAULT NULL,
        siswa_mutasi_tgl date DEFAULT NULL,
        siswa_mutasi_tahunajaran_id varchar(225) DEFAULT NULL,
        siswa_mutasi_kelaslama varchar(225) DEFAULT NULL,
        siswa_mutasi_alasan varchar(225) DEFAULT NULL,
        siswa_mutasi_ke varchar(225) DEFAULT NULL,
        siswa_mutasi_kestatus varchar(20) DEFAULT NULL,
        siswa_mutasi_namasekolah varchar(225) DEFAULT NULL,
        siswa_mutasi_npsnsekolah varchar(20) DEFAULT NULL,
        siswa_lulus_tahunajaran_id varchar(10) DEFAULT NULL,
        siswa_lulus_noseri varchar(225) DEFAULT NULL,
        siswa_lulus_ke varchar(225) DEFAULT NULL,
        siswa_lulus_kestatus varchar(225) DEFAULT NULL,
        siswa_lulus_namasekolah varchar(225) DEFAULT NULL,
        siswa_lulus_npsnsekolah varchar(225) DEFAULT NULL,
        file_lulus_ijz varchar(225) DEFAULT NULL,
        FOREIGN KEY (siswa_id) REFERENCES t_suratmasuk(siswa_id)
    )";
    mysqli_query($koneksi, $sql); // Execute the third table creation

    $sql = "CREATE TABLE IF NOT EXISTS t_judulsurat (
       judul_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT UNIQUE,
        judul_nama VARCHAR(225) DEFAULT NULL,
        judul_alias VARCHAR(100) DEFAULT NULL,
        judul_icon VARCHAR(100) DEFAULT NULL,
        judul_link_add VARCHAR(225) DEFAULT NULL,
        judul_link_edit VARCHAR(225) DEFAULT NULL,
        judul_status INT(10) DEFAULT NULL,
        judul_on VARCHAR(225) DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the fourth table creation

    $sql = "CREATE TABLE IF NOT EXISTS t_suratkeluar (
        suratkeluar_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        siswa_id bigint(100) NOT NULL,
        kelas_id bigint(100) NOT NULL,
        tahunajaran_id bigint(100) NOT NULL,
        judul_id bigint(100) NOT NULL,
        suratkeluar_nomor VARCHAR(225) DEFAULT NULL,
        suratkeluar_tgl DATE DEFAULT NULL,
        suratkeluar_perihal VARCHAR(225) DEFAULT NULL,
        suratkeluar_maksud VARCHAR(225) DEFAULT NULL,
        suratkeluar_isi TEXT DEFAULT NULL,
        suratkeluar_penutup VARCHAR(225) DEFAULT NULL,
        sukel_mut_nama VARCHAR(225) DEFAULT NULL,
        sukel_mut_tingkat VARCHAR(225) DEFAULT NULL,
        sukel_mut_tgllahir VARCHAR(225) DEFAULT NULL,
        sukel_mut_gender VARCHAR(225) DEFAULT NULL,
        sukel_mut_alasan VARCHAR(225) DEFAULT NULL,
        sukel_mut_tujuan VARCHAR(225) DEFAULT NULL,
        sukel_kjp_jenis VARCHAR(225) DEFAULT NULL,
        sukel_mut_tujuan VARCHAR(225) DEFAULT NULL,
        sukel_kjp_walibefore VARCHAR(225) DEFAULT NULL,
        sukel_kjp_waliafter VARCHAR(225) DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the fifth table creation
    $sql = "CREATE TABLE IF NOT EXISTS f_add_prestasi (
        prestasi_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        siswa_id bigint(100) NOT NULL UNIQUE,
        kelas_id VARCHAR(100) DEFAULT NULL,
        prestasi_thn_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_nama_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_bid_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_panra_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_tingkat_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_peringkat_lomba VARCHAR(225) DEFAULT NULL,
        file_bukti_lomba VARCHAR(225) DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        updated_at DATETIME DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the sixth table creation
    $sql = "CREATE TABLE IF NOT EXISTS f_add_kesehatan (
        add_kes_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        siswa_id bigint(100) NOT NULL UNIQUE,
        siswa_nis VARCHAR(20) DEFAULT NULL,
        add_kes_nama VARCHAR(225) DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        updated_at DATETIME DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the seventh table creation
    $sql = "CREATE TABLE IF NOT EXISTS f_add_prestasi (
        prestasi_id bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        siswa_id bigint(100) NOT NULL UNIQUE,
        kelas_id VARCHAR(100) DEFAULT NULL,
        prestasi_thn_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_nama_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_bid_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_panra_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_tingkat_lomba VARCHAR(225) DEFAULT NULL,
        prestasi_peringkat_lomba VARCHAR(225) DEFAULT NULL,
        file_bukti_lomba VARCHAR(225) DEFAULT NULL,
        created_id bigint(100) DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        updated_at DATETIME DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the eigth table creation
    $sql = "CREATE TABLE IF NOT EXISTS m_uploadfile (
        id_upload bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        upload_id VARCHAR(100) NOT NULL,
        upload_name VARCHAR(225) DEFAULT NULL,
        upload_file VARCHAR(225) DEFAULT NULL,
        upload_status VARCHAR(225) DEFAULT NULL,
        siswa_id bigint(100) DEFAULT NULL,
        guru_id bigint(100) DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        updated_at DATETIME DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the ninth table creation
    $sql = "CREATE TABLE IF NOT EXISTS t_jenjang (
        id_jenjang bigint(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        jenjang_id VARCHAR(100) NOT NULL,
        jenjang_nama VARCHAR(225) DEFAULT NULL,
        jenjang_alias VARCHAR(225) DEFAULT NULL,
        jenjang_users VARCHAR(225) DEFAULT NULL,
        jenjang_status VARCHAR(10) DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the ten table creation
    $sql = "CREATE TABLE IF NOT EXISTS t_jenjangbefore (
        jenjangbefore_id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        jenjang_id int(10) DEFAULT NULL,
        jenjangbefore_nama VARCHAR(225) DEFAULT NULL,
        jenjangbefore_alias VARCHAR(225) DEFAULT NULL,
        jenjangbefore_urut int(10) DEFAULT NULL,
        jenjangbefore_status int(10) DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the eleven table creation
    $sql = "CREATE TABLE IF NOT EXISTS t_ppdbjurusan (
        ppdbjurusan_id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        ppdbjurusan_alias VARCHAR(225) DEFAULT NULL UNIQUE,
        ppdbjurusan_kuota int(10) DEFAULT NULL,
        ppdbjurusan_name VARCHAR(225) DEFAULT NULL,
        ppdbjurusan_actived int(10) DEFAULT NULL,
        ppdbjurusan_desc VARCHAR(225) DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the eleven table creation
    $sql = "CREATE TABLE IF NOT EXISTS t_ppdbperiode (
        ppdbperiode_id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        tahunajaran_id INT(10) DEFAULT NULL UNIQUE,
        ppdbperiode_opened DATE DEFAULT NULL,
        ppdbperiode_closed DATE DEFAULT NULL,
        ppdbjurusan_actived int(10) DEFAULT NULL,
        update_at DATETIME DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the eleven table creation
    $sql = "CREATE TABLE IF NOT EXISTS t_ppdbregist (
       ppdbregist_id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        tahunajaran_id int(10) DEFAULT NULL,
        ppdbjurusan_id int(10)  DEFAULT NULL,
        ppdbregist_number varchar(200)  DEFAULT NULL,
        ppdbregist_name varchar(200)  DEFAULT NULL,
        ppdbregist_gender varchar(10)  DEFAULT NULL,
        ppdbregist_tempat varchar(200)  DEFAULT NULL,
        ppdbregist_tgllahir text  DEFAULT NULL,
        ppdbregist_nisn varchar(20)  DEFAULT NULL,
        ppdbregist_nokk varchar(20)  DEFAULT NULL,
        ppdbregist_nik varchar(20)  DEFAULT NULL,
        ppdbregist_nohp varchar(20)  DEFAULT NULL,
        ppdbregist_anakke varchar(10)  DEFAULT NULL,
        ppdbregist_saudara varchar(10)  DEFAULT NULL,
        ppdbregist_hobi varchar(100)  DEFAULT NULL,
        ppdbregist_cita varchar(100)  DEFAULT NULL,
        ppdbregist_actived int(10)  DEFAULT NULL,
        password varchar(200)  DEFAULT NULL,
        ppdbregist_stt varchar(100)  DEFAULT NULL,
        ppdbregist_prov varchar(100)  DEFAULT NULL,
        ppdbregist_kota varchar(100)  DEFAULT NULL,
        ppdbregist_kec varchar(100)  DEFAULT NULL,
        ppdbregist_kel varchar(100)  DEFAULT NULL,
        ppdbregist_alamat text  DEFAULT NULL,
        ppdbregist_rt varchar(5)  DEFAULT NULL,
        ppdbregist_rw varchar(5)  DEFAULT NULL,
        ppdbregist_kodepos varchar(10)  DEFAULT NULL,
        ppdbregist_jarak varchar(100)  DEFAULT NULL,
        ppdbregist_transportasi varchar(100)  DEFAULT NULL,
        ppdbayah_status varchar(100)  DEFAULT NULL,
        ppdbayah_name varchar(225)  DEFAULT NULL,
        ppdbayah_wn varchar(100)  DEFAULT NULL,
        ppdbayah_nik varchar(100)  DEFAULT NULL,
        ppdbayah_tempat varchar(100)  DEFAULT NULL,
        ppdbayah_tgllahir date  DEFAULT NULL,
        ppdbayah_pekerjaan varchar(100)  DEFAULT NULL,
        ppdbayah_pendidikan varchar(100)  DEFAULT NULL,
        ppdbayah_penghasilan varchar(100)  DEFAULT NULL,
        ppdbayah_nohp varchar(100)  DEFAULT NULL,
        ppdbibu_status varchar(100)  DEFAULT NULL,
        ppdbibu_name varchar(225)  DEFAULT NULL,
        ppdbibu_wn varchar(100)  DEFAULT NULL,
        ppdbibu_nik varchar(100)  DEFAULT NULL,
        ppdbibu_tempat varchar(100)  DEFAULT NULL,
        ppdbibu_tgllahir date  DEFAULT NULL,
        ppdbibu_pekerjaan varchar(100)  DEFAULT NULL,
        ppdbibu_pendidikan varchar(100)  DEFAULT NULL,
        ppdbibu_penghasilan varchar(100)  DEFAULT NULL,
        ppdbibu_nohp varchar(100)  DEFAULT NULL,
        ppdbwali_name varchar(225)  DEFAULT NULL,
        ppdbwali_status varchar(100)  DEFAULT NULL,
        ppdbwali_wn varchar(100)  DEFAULT NULL,
        ppdbwali_nik varchar(100)  DEFAULT NULL,
        ppdbwali_tempat varchar(100)  DEFAULT NULL,
        ppdbwali_tgllahir date  DEFAULT NULL,
        ppdbwali_pekerjaan varchar(100)  DEFAULT NULL,
        ppdbwali_pendidikan varchar(100)  DEFAULT NULL,
        ppdbwali_penghasilan varchar(100)  DEFAULT NULL,
        ppdbwali_nohp varchar(100)  DEFAULT NULL,
        ppdbasal_jenjang varchar(100)  DEFAULT NULL,
        ppdbasal_status varchar(100)  DEFAULT NULL,
        ppdbasal_npsn varchar(100)  DEFAULT NULL,
        ppdbasal_sekolah varchar(225)  DEFAULT NULL,
        ppdbasal_kota varchar(225)  DEFAULT NULL,
        ppdbasal_tahun varchar(100)  DEFAULT NULL,
        ppdbasal_noujian varchar(225)  DEFAULT NULL,
        ppdbasal_noijazah varchar(225)  DEFAULT NULL,
        update_at date DEFAULT NULL
    )";
    mysqli_query($koneksi, $sql); // Execute the eleven table creation

    $sql = "CREATE TABLE IF NOT EXISTS user (
        id_user INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        nama_user VARCHAR(225) DEFAULT NULL,
         level VARCHAR(225) DEFAULT NULL,
         username VARCHAR(225) DEFAULT NULL UNIQUE,
         password text DEFAULT NULL,
         status int(1) DEFAULT NULL,
         foto VARCHAR(500) DEFAULT NULL,
         akses VARCHAR(500) DEFAULT NULL,
         useer_versi VARCHAR(500) DEFAULT NULL,
         createby VARCHAR(500) DEFAULT NULL,
         title_app VARCHAR(500) DEFAULT NULL
     )";
     mysqli_query($koneksi, $sql); // Execute the fourth table creation


     $sql = "SHOW TABLES LIKE 'user'";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) == 0) {
        // Copy lembaga_nsm and lembaga_id from e_lembaga to t_lembaga
        $sql = "INSERT INTO `user` (`id_user`, `nama_user`, `level`, `username`, `password`, `status`, `foto`, `akses`, `user_versi`, `createby`, `title_app`) VALUES 
        (NULL, 'Administrator', 'admin', 'admin', '$2y$10$3aN3Bd8L0wMno/4d7sBSOe1kyunplnL9Qp.ruKj5a65go8phAl6x.', '2', NULL, 'admin', '0,2', 'FKMTs Jakarta Barat', 'Sidoel-&-RDM');
            ";
        mysqli_query($koneksi, $sql); // INSERT Execute the ten table creation

        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Berhasil menyalin data dari tabel e_lembaga ke t_lembaga",
        ];
    } else {
        $response = [
            'status'        => 200,
            'icon'          => "info",
            'message'       => "Tabel t_lembaga sudah ada di database, operasi penyalinan dibatalkan",
        ];
    }
    echo json_encode($response); 
    $sql = "SHOW TABLES LIKE 't_jenjangbefore'";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) == 0) {
        // Copy lembaga_nsm and lembaga_id from e_lembaga to t_lembaga
        $sql = "INSERT INTO `t_jenjangbefore` (`jenjangbefore_id`, `jenjang_id`, `jenjangbefore_nama`, `jenjangbefore_alias`, `jenjangbefore_urut`, `jenjangbefore_status`) 
                VALUES 
                (NULL, '2', 'Raudlatul Athfal', 'RA', '1', '1'), 
                (NULL, '2', 'Taman Kanak-kanak', 'TK', '2', '1'), 
                (NULL, '2', 'Orangtua', 'Ortu', '3', '1'), 
                (NULL, '3', 'Madrasah Ibtida`iyyah', 'MI', '1', '1'), 
                (NULL, '3', 'Sekolah Dasar', 'SD', '2', '1'), 
                (NULL, '3', 'PAKET A', 'Paket A', '3', '1'), 
                (NULL, '4', 'Madrasah Tsnawiyah', 'MTs', '1', '1'), 
                (NULL, '4', 'Sekolah Menengah Pertama', 'SMP', '2', '1'), 
                (NULL, '4', 'PAKET B', 'Paket B', '3', '1') 
            ";
        mysqli_query($koneksi, $sql); // INSERT Execute the ten table creation

        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Berhasil menyalin data dari tabel e_lembaga ke t_lembaga",
        ];
    } else {
        $response = [
            'status'        => 200,
            'icon'          => "info",
            'message'       => "Tabel t_lembaga sudah ada di database, operasi penyalinan dibatalkan",
        ];
    }
    echo json_encode($response);
    $sql = "SHOW TABLES LIKE 't_jenjang'";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) == 0) {
        // Copy lembaga_nsm and lembaga_id from e_lembaga to t_lembaga
        $sql = "INSERT INTO `t_jenjang` (`id_jenjang`, `jenjang_id`, `jenjang_nama`, `jenjang_alias`, `jenjang_users`, `jenjang_status`) 
                VALUES 
                (NULL, '1', 'Raudlatul Athfal (RA)', 'RA', 'admin_ra', '1'), 
                (NULL, '2', 'Madrasah Ibtida`iyyah (MI)', 'MI', 'admin_mi', '1'), 
                (NULL, '3', 'Madrasah Tsnawiyah (MTs)', 'MTs', 'admin_mts', '1'), 
                (NULL, '4', 'Madrasah `Aliyah (MA)', 'MA', 'admin_ma', '1'), 
                (NULL, '5', 'Kantorr Kementerian Agama', 'Kemenag', 'admin_kota', '2')
            ";
        mysqli_query($koneksi, $sql); // INSERT Execute the ten table creation

        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Berhasil menyalin data dari tabel e_lembaga ke t_lembaga",
        ];
    } else {
        $response = [
            'status'        => 200,
            'icon'          => "info",
            'message'       => "Tabel t_lembaga sudah ada di database, operasi penyalinan dibatalkan",
        ];
    }
    echo json_encode($response);

    $sql = "SHOW TABLES LIKE 't_lembaga'";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) == 0) {
        // Copy lembaga_nsm and lembaga_id from e_lembaga to t_lembaga
        $sql = "INSERT INTO t_lembaga (lembaga_nsm, lembaga_id)
                SELECT lembaga_nsm, lembaga_id FROM e_lembaga";
        mysqli_query($koneksi, $sql);
        $response = [
            'status'        => 200,
            'icon'          => "success",
            'message'       => "Berhasil menyalin data dari tabel e_lembaga ke t_lembaga",
        ];
    } else {
        $response = [
            'status'        => 200,
            'icon'          => "info",
            'message'       => "Tabel t_lembaga sudah ada di database, operasi penyalinan dibatalkan",
        ];
    }
    echo json_encode($response);
} else {
    $response = [
        'status' => 500,
        'icon' => "error",
        'message' => "Gagal Membuat Tabel dalam database sidoel_sneat",
    ];
    echo json_encode($response);
}
