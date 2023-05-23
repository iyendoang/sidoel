<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php
if ($pg == '') {
    include "Dashboard/v_dashboard.php";
} elseif ($pg == 'ppdb-periode') {
    include "Periode/index.php";
} elseif ($pg == 'ppdb-majors') {
    include "Majors/index.php";
} elseif ($pg == 'ppdb-registrations') {
    include "Registrations/index.php";
} elseif ($pg == 'edit-student-regist') {
    include "Registrations/edit-student-regist.php";
} elseif ($pg == 'edit-student-address') {
    include "Registrations/edit-student-address.php";
} elseif ($pg == 'edit-student-parent') {
    include "Registrations/edit-student-parent.php";
} elseif ($pg == 'edit-student-previous-level') {
    include "Registrations/edit-student-previous-level.php";
} elseif ($pg == 'edit-student-upload-file') {
    include "Registrations/edit-student-upload-file.php";
} else {
    include "../Error.php";
}
