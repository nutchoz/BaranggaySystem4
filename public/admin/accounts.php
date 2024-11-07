<div class="container-account">
    <div class="table-controls">
        <input type="text" id="searchInput" placeholder="Search by email or ID">
        <button id="searchBtn">Search</button>
    </div>

    <table class="request-table">
        <thead>
            <tr>
                <th>Account Request ID</th>
                <th>Date Requested At</th>
                <th>Email</th>
                <th>Actions</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>
</div>

<?php
$accounts = SQLFunction::getAllAccounts();
?>
<script>
    const requests = <?php echo json_encode($accounts); ?>;

    function renderTable(filteredRequests) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        filteredRequests.forEach(request => {
            const row = `
            <tr>
                <td>${request.id}</td>
                <td>${request.date}</td>
                <td>${request.email}</td>
                <td>
                    <form method="POST"  action="redirect.php">
                        <input type="hidden" name="type" value="send-code">
                        <input type="hidden" name="email" value="${request.email}">
                        <button class="action-btn approve-btn">SEND GENERATED CODE</button>
                    </form>
                </td>
                <td>
                    <button class="action-btn disapprove-btn">REMOVE</button>
                </td>
            </tr>
        `;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    }

    renderTable(requests);
    document.getElementById('searchBtn').addEventListener('click', function () {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();

        const filteredRequests = requests.filter(request => {
            const matchesSearch = request.email.toLowerCase().includes(searchValue) || request.id.toString().includes(searchValue);
            return matchesSearch;
        });
        renderTable(filteredRequests);
    });

</script>