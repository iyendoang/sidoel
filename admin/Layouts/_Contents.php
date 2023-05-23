<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php
if ($pg == '') {
    include "Dashboard/v_dashboard.php";
    //INSTITUTIONS
} elseif ($pg == 'institution-profile') {
    include "Institution/v_profile_institution.php";
} elseif ($pg == 'institution-address') {
    include "Institution/v_address_institution.php";
} elseif ($pg == 'institution-foundation') {
    include "Institution/v_foundation_institution.php";
} elseif ($pg == 'institution-leader') {
    include "Institution/v_leader_institution.php";
} elseif ($pg == 'institution-document') {
    include "Institution/files/files-institution.php";
    //STUDENTS
} elseif ($pg == 'students-masters') {
    include "Students/Pages/Lists/students-masters.php";
} elseif ($pg == 'students-active') {
    include "Students/Pages/Lists/students_start.php";
} elseif ($pg == 'students-mutations') {
    include "Students/Pages/Lists/students-mutations.php";
} elseif ($pg == 'students-alumnus') {
    include "Students/Pages/Lists/students-alumnus.php";
} elseif ($pg == 'student-activity') {
    include "Students/Pages/Forms/student-activity.php";
} elseif ($pg == 'student-certificate-of-birth') {
    include "Students/Pages/Forms/student-certificate-of-birth.php";
} elseif ($pg == 'student-previous-level') {
    include "Students/Pages/Forms/student-previous-level.php";
} elseif ($pg == 'student-family-card') {
    include "Students/Pages/Forms/student-family-card.php";
} elseif ($pg == 'student-residence') {
    include "Students/Pages/Forms/student-residence.php";
} elseif ($pg == 'student-immunization') {
    include "Students/Pages/Forms/student-immunization.php";
} elseif ($pg == 'student-donation-scholarship') {
    include "Students/Pages/Forms/student-donation-scholarship.php";
} elseif ($pg == 'students-achievement') {
    include "Students/Pages/Lists/students-achievement.php";
} elseif ($pg == 'student-mutation') {
    include "Students/Pages/Forms/student-mutation.php";
} elseif ($pg == 'student-alumni') {
    include "Students/Pages/Forms/student-alumni.php";
} elseif ($pg == 'students-reports') {
    include "Students/Pages/Lists/students-reports.php";
} elseif ($pg == 'students-print-masters') {
    include "Students/Pages/Print/students-print-masters.php";
} elseif ($pg == 'students-test') {
    include "Students/Pages/lists/students-test.php";
    // CORESPONDENCE MAIL

} else {
    include "Error.php";
}
