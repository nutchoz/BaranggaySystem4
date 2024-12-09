<?php
$service = SQLFunction::getAllCompletedServices();
?>

<div class="container-approved mt-4 px-5 justify-content-center align-items-center"
    style="width: 90vw; min-height: 70vh; padding: 20px 0; ">
    <div class="table-controls d-flex justify-content-between align-items-center mb-4">
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search by name or ID">
        <select id="requestFilter" class="form-select w-auto">
            <option value="">All Types</option>
            <option value="Application">Application</option>
            <option value="Clearance">Clearance</option>
            <option value="Permit">Permit</option>
            <option value="Certificate">Certificate</option>
        </select>
        <div>
            <button id="searchBtn" style="background-color: #66ff77;" class="btn">Search</button>
            <button id="sortDateBtn" class="btn btn-secondary">Sort by Date</button>
            <button id="printTableBtn" class="btn btn-success">Print Table</button>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Client Name</th>
                <th>Service Name</th>
                <th>Feedback</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>

    <nav>
        <ul id="pagination" class="pagination justify-content-center"></ul>
    </nav>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Service Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Dynamic Content will be injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    const requests = <?php echo json_encode($service); ?>;

    const rowsPerPage = 10;
    let currentPage = 1;
    let filteredRequests = requests;
    let sortAscending = true;

    function renderTable(requestsToRender) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        requestsToRender.forEach(request => {
            if (request.alreadyFeedback == 1) {
                return;
            }
            const row = `
                <tr>
                    <td>${request.id}</td>
                    <td>${request.userName}</td>
                    <td>${request.name}</td>
                    <td>${request.feedback}</td>
                    <td>${request.rating}</td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', row);
        });

        document.querySelectorAll('.details-btn').forEach(button => {
            button.addEventListener('click', function () {
                const requestId = this.getAttribute('data-id');
                const request = requests.find(req => req.id == requestId);
                showDetails(request);
            });
        });

    }

    function showDetails(request) {
        let formattedInfo = '';
        try {
            const info = JSON.parse(request.information);
            if (typeof info === 'object') {
                formattedInfo = Object.entries(info).map(([key, value]) => {
                    return `<p><strong>${key}:</strong> ${value}</p>`;
                }).join('');
            } else {
                formattedInfo = `<p><strong>Information:</strong> ${info}</p>`;
            }
        } catch (e) {
            formattedInfo = `<p><strong>Information:</strong> Invalid data format</p>`;
        }

        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = `
            <h5>Service Details for Request ID: ${request.id}</h5>
            <p><strong>Name:</strong> ${request.name}</p>
            <p><strong>Status:</strong> ${request.status}</p>
            <p><strong>Type:</strong> ${request.type}</p>
            ${formattedInfo}
            <p><strong>Date Accepted:</strong> ${request.dateAccepted ? new Date(request.dateAccepted).toLocaleDateString() : 'N/A'}</p>
            <p><strong>Price:</strong> ${request.price}</p>
            `;
        const serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'));
        serviceModal.show();
    }


    function showTracking(request) {
        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = `
        <h5>Tracking Information for Request ID: ${request.id}</h5>
        <p><strong>Status:</strong> ${request.track}</p>
    `;
        const serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'));
        serviceModal.show();
    }



    function renderPagination() {
        const pageCount = Math.ceil(filteredRequests.length / rowsPerPage);
        const paginationElement = document.getElementById('pagination');
        paginationElement.innerHTML = '';

        for (let i = 1; i <= pageCount; i++) {
            const pageItem = document.createElement('li');
            pageItem.classList.add('page-item');
            pageItem.innerHTML = `<a style="background-color: #2DB13DFF; color: white" class="page-link" href="#">${i}</a>`;
            pageItem.querySelector('a').addEventListener('click', function () {
                currentPage = i;
                updateTableAndPagination();
            });
            paginationElement.appendChild(pageItem);
        }
    }

    function updateTableAndPagination() {
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const requestsToRender = filteredRequests.slice(startIndex, endIndex);
        renderTable(requestsToRender);
        renderPagination();
    }

    document.getElementById('searchBtn').addEventListener('click', function () {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        filteredRequests = requests.filter(request => {
            return request.name.toLowerCase().includes(searchValue) || request.id.toString().includes(searchValue);
        });
        currentPage = 1;
        updateTableAndPagination();
    });

    document.getElementById('requestFilter').addEventListener('change', function () {
        const filterValue = document.getElementById('requestFilter').value.toLowerCase();
        filteredRequests = requests.filter(request => {
            return filterValue === '' || request.type.toLowerCase() === filterValue;
        });
        currentPage = 1;
        updateTableAndPagination();
    });

    document.getElementById('sortDateBtn').addEventListener('click', function () {
        filteredRequests.sort((a, b) => {
            const dateA = new Date(a.dateAccepted);
            const dateB = new Date(b.dateAccepted);
            return sortAscending ? dateA - dateB : dateB - dateA;
        });
        sortAscending = !sortAscending;
        updateTableAndPagination();
    });

    document.getElementById('printTableBtn').addEventListener('click', function () {
        const tableClone = document.querySelector('.table').cloneNode(true); // Update to the correct class
        let actionIndex = Array.from(tableClone.querySelectorAll('th')).findIndex(th => th.textContent === 'Actions');

        if (actionIndex !== -1) {
            tableClone.querySelectorAll('th')[actionIndex].remove();
            tableClone.querySelectorAll('tr').forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells[actionIndex]) {
                    cells[actionIndex].remove();
                }
            });
        }

        const printContent = tableClone.outerHTML;
        const printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write(`
        <html>
            <head>
                <title>Print Table</title>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f4f4f4;
                    }
                </style>
            </head>
            <body>${printContent}</body>
        </html>
        `);
        printWindow.document.close();
        printWindow.print();
    });


    updateTableAndPagination();
</script>