<div class="navigation">
    <div class="left"></div>
    <div class="right">
        <a class="navigation-link" href="admin.php?on=home">HOME</a>
        <a class="navigation-link" href="admin.php?on=accounts">ACCOUNTS</a>
        <a class="navigation-link" href="admin.php?on=requests">REQUESTS</a>
        <a class="navigation-link" href="admin.php?on=approved">APPROVED</a>
        <a class="navigation-link" href="admin.php?on=completed">COMPLETED</a>
        <a class="navigation-link" href="registration.php">LOGOUT</a>

        <img class="profile-pic" src="">
    </div>
</div>

<script>
    function getURLParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    const activeParam = getURLParameter('on');
    const links = document.querySelectorAll('.navigation-link');

    links.forEach(link => {
        const hrefParam = new URL(link.href).searchParams.get('on');

        if (hrefParam && hrefParam === activeParam) {
            link.classList.add('active');
            link.setAttribute('aria-current', 'page');
        }
    });

    document.querySelector('.navigation-link.active')?.addEventListener('click', function (e) {
        e.preventDefault();
    });

</script>