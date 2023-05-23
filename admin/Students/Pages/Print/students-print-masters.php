<?php
if (isset($_POST["btnstudentsCardPrint"])) {
    include '../../../Students/Pages/Print/students-card.php';
} elseif (isset($_POST["btnstudentsDetailPrint"])) {
    include '../../../Students/Pages/Print/students-book.php';
} else {
    echo "N0, mail is not set";
}
