<!-- Sidebar -->
<div class="side-navigation d-flex flex-column bg-success text-light p-3"
    style="min-width: 250px; width: 250px; height: 100vh;">
    <div class="sidebar-content d-flex flex-column gap-3">
        <!-- Profile Picture -->
        <img class="profile-pic img-fluid rounded-circle mb-3"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShvd1sFjAzHzxBXcmk4JK82I2r2nsxz8n0ew&s"
            alt="Profile Picture">

        <!-- Navigation Links -->
        <a class="navigation-link text-light px-3 py-2 rounded d-block" href="admin.php?on=accounts">ACCOUNTS</a>
        <a class="navigation-link text-light px-3 py-2 rounded d-block" href="admin.php?on=requests">REQUESTS</a>
        <a class="navigation-link text-light px-3 py-2 rounded d-block" href="admin.php?on=approved">APPROVED</a>
        <a class="navigation-link text-light px-3 py-2 rounded d-block" href="admin.php?on=completed">COMPLETED</a>
        <a class="navigation-link text-light px-3 py-2 rounded d-block" href="admin.php?on=feedback">FEEDBACK</a>
        <a class="navigation-link text-light px-3 py-2 rounded d-block" href="registration.php">LOGOUT</a>
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

<style>
    /* Customize Sidebar for Bootstrap */
    .side-navigation {
        background-color: #056B05FF;
        /* Same as original background color */
        color: #ecf0f1;
        /* Light text color */
    }

    .profile-pic {
        width: 80%;
        height: auto;
        object-fit: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: auto;
    }

    .navigation-link {
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .navigation-link:hover,
    .navigation-link.active {
        background-color: #115511FF;
        /* Darker green for hover and active state */
    }
</style>