<?php
require_once("../includes/initialize.php");

$session = new Session();
if (!$session->has('isLoggedIn') || $session->get('isLoggedIn') !== 'true') {
    redirect_to('registration.php');
}
?>
<?php createHeader("", [
    "css/main",
    "css/dashboard",
    "css/navigation",
    "admin/css/home",
    "admin/css/requests",
    "admin/css/approved",
    "admin/css/completed",
    "admin/css/accounts",
    "css/bottom",
    "css/modal"
]); ?>

<?php
require_once("modals/modals.php");
require_once("modals/service_modal.php");

if (isset($_SESSION['success'])) {
    echo "<script>showSuccessModal('{$_SESSION['success']}');</script>";
    unset($_SESSION['success']);
} elseif (isset($_SESSION['error'])) {
    echo "<script>showErrorModal('{$_SESSION['error']}');</script>";
    unset($_SESSION['error']);
}
?>

<body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="main-container d-flex">
        <?php include_layout_template("admin/navigation.php") ?>

        <?php
        $on = $_GET['on'] ?? 'home';
        switch ($on) {
            case 'approved':
                include_layout_template("admin/approved.php");
                break;
            case 'completed':
                include_layout_template("admin/completed.php");
                break;
            case 'accounts':
                include_layout_template("admin/accounts.php");
                break;
            case 'feedback':
                include_layout_template("admin/feedback.php");
                break;
            case 'requests':
            default:
                include_layout_template("admin/requests.php");
                break;
        }
        ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</html>