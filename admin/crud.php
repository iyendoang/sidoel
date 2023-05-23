<?php
    $conn = new mysqli("localhost", "root", "", "sidoel_sneat");

$action = $_POST['action'];

if ($action === "insert") {
    $nomor = $_POST['nomor'];
    $tanggal = $_POST['tanggal'];

    // Validasi dan manipulasi data jika diperlukan

    $query = "INSERT INTO t_suratmasuk (suratmasuk_nomor, suratmasuk_tgl) VALUES ('$nomor', '$tanggal')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array("status" => "success", "message" => "Data surat masuk berhasil ditambahkan");
    } else {
        $response = array("status" => "error", "message" => "Terjadi kesalahan saat menambahkan data surat masuk");
    }

    echo json_encode($response);
} elseif ($action === "update") {
    $id = $_POST['id'];
    $nomor = $_POST['nomor'];
    $tanggal = $_POST['tanggal'];

    // Validasi dan manipulasi data jika diperlukan

    $query = "UPDATE t_suratmasuk SET suratmasuk_nomor = '$nomor', suratmasuk_tgl = '$tanggal' WHERE id_suratmasuk = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array("status" => "success", "message" => "Data surat masuk berhasil diperbarui");
    } else {
        $response = array("status" => "error", "message" => "Terjadi kesalahan saat memperbarui data surat masuk");
    }

    echo json_encode($response);
} elseif ($action === "delete") {
    $id = $_POST['id'];

    $query = "DELETE FROM t_suratmasuk WHERE id_suratmasuk = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response = array("status" => "success", "message" => "Data surat masuk berhasil dihapus");
    } else {
        $response = array("status" => "error", "message" => "Terjadi kesalahan saat menghapus data surat masuk");
    }

    echo json_encode($response);
} elseif ($action === "fetch") {
    $query = "SELECT * FROM t_suratmasuk";
    $result = mysqli_query($conn, $query);

    $suratMasuk = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $suratMasuk[] = $row;
    }

    echo json_encode($suratMasuk);
}

mysqli_close($conn);
