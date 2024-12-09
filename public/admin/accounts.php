<div class="container-account mt-4 px-5" style="width: 90vw; min-height: 70vh; padding: 20px 0; ">
    <div class="table-controls d-flex justify-content-between align-items-center mb-4">
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search by email or ID">

        <div>
            <button id="searchBtn" style="background-color: #66ff77;" class="btn text-white">Search</button>
            <button id="sortDateBtn" class="btn btn-secondary">Sort by Date</button>
            <!-- <button id="printTableBtn" class="btn btn-success">Print Table</button> -->
        </div>
    </div>

    <table class="table table-striped table-bordered">
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

    <nav>
        <ul id="pagination" class="pagination justify-content-center">
        </ul>
    </nav>
</div>


<?php
$accounts = SQLFunction::getAllAccounts();
?>
<script>
    const requests = <?php echo json_encode($accounts); ?>;
    let sortAscending = true;

    function renderTable(filteredRequests) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        filteredRequests.forEach(request => {
            const row = `
            <tr>
                <td>${request.id}</td>
                <td>${new Date(request.date).toLocaleDateString()}</td>
                <td>${request.email}</td>
                <td>
                    <form method="POST" action="redirect.php">
                        <input type="hidden" name="type" value="send-code">
                        <input type="hidden" name="email" value="${request.email}">
                        <button style="background-color: #66ff77" class="btn action-btn details-btn">Send Generated Code</button>
                    </form>
                </td>
                <td>
                    <button class="btn btn-danger action-btn disapprove-btn">Remove</button>
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

    document.getElementById('sortDateBtn').addEventListener('click', function () {
        const sortedRequests = [...requests].sort((a, b) => {
            const dateA = new Date(a.date);
            const dateB = new Date(b.date);
            return sortAscending ? dateA - dateB : dateB - dateA;
        });
        sortAscending = !sortAscending;
        renderTable(sortedRequests);
    });

    // document.getElementById('printTableBtn').addEventListener('click', function () {
    //     const tableClone = document.querySelector('.request-table').cloneNode(true);
    //     let actionIndex = Array.from(tableClone.querySelectorAll('th')).findIndex(th => th.textContent === 'Remove');
    //     if (actionIndex !== -1) {
    //         tableClone.querySelectorAll('th')[actionIndex].remove();
    //         tableClone.querySelectorAll('tr').forEach(row => {
    //             const cells = row.querySelectorAll('td');
    //             if (cells[actionIndex]) {
    //                 cells[actionIndex].remove();
    //             }
    //         });
    //     }
    //     actionIndex = Array.from(tableClone.querySelectorAll('th')).findIndex(th => th.textContent === 'Actions');
    //     if (actionIndex !== -1) {
    //         tableClone.querySelectorAll('th')[actionIndex].remove();
    //         tableClone.querySelectorAll('tr').forEach(row => {
    //             const cells = row.querySelectorAll('td');
    //             if (cells[actionIndex]) {
    //                 cells[actionIndex].remove();
    //             }
    //         });
    //     }

    //     const printContent = tableClone.outerHTML;
    //     const printWindow = window.open('', '_blank');
    //     printWindow.document.open();
    //     printWindow.document.write(`
    //     <html>
    //         <head>
    //             <title>Print Table</title>
    //             <style>
    //                 table {
    //                     width: 100%;
    //                     border-collapse: collapse;
    //                 }
    //                 th, td {
    //                     border: 1px solid #ddd;
    //                     padding: 8px;
    //                     text-align: left;
    //                 }
    //                 th {
    //                     background-color: #f4f4f4;
    //                 }
    //             </style>
    //         </head>
    //         <body>${printContent}</body>
    //     </html>
    // `);
    //     printWindow.document.close();
    //     printWindow.print();
    // });
</script>