<div class="container-approved">
    <div class="table-controls">
        <input type="text" id="searchInput" placeholder="Search by name or ID">
        <select id="requestFilter">
            <option value="">All Types</option>
            <option value="Clearance">Clearance</option>
            <option value="Permit">Permit</option>
            <option value="Certificate">Certificate</option>
        </select>
        <button id="searchBtn">Search</button>
    </div>

    <table class="request-table">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Requester Name</th>
                <th>Date Approved At</th>

                <th>Request Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>
</div>

<script>
    const requests = [
        { id: 1, name: 'EXAMPLE', date: '06-16-2004', type: 'Permit' },
        { id: 2, name: 'EXAMPLE', date: '06-16-2004', type: 'Certificate' },
        { id: 3, name: 'EXAMPLE', date: '06-16-2004', type: 'Clearance' },

        { id: 4, name: 'EXAMPLE2', date: '06-16-2004', type: 'Permit' },
        { id: 5, name: 'EXAMPLE2', date: '06-16-2004', type: 'Certificate' },
        { id: 6, name: 'EXAMPLE2', date: '06-16-2004', type: 'Clearance' },

        { id: 7, name: 'EXAMPLE3', date: '06-16-2004', type: 'Permit' },
        { id: 8, name: 'EXAMPLE3', date: '06-16-2004', type: 'Certificate' },
        { id: 9, name: 'EXAMPLE3', date: '06-16-2004', type: 'Clearance' },

        { id: 10, name: 'EXAMPLE4', date: '06-16-2004', type: 'Permit' },
        { id: 11, name: 'EXAMPLE4', date: '06-16-2004', type: 'Certificate' },
        { id: 12, name: 'EXAMPLE4', date: '06-16-2004', type: 'Clearance' },

        { id: 13, name: 'EXAMPLE5', date: '06-16-2004', type: 'Permit' },
        { id: 14, name: 'EXAMPLE5', date: '06-16-2004', type: 'Certificate' },
        { id: 15, name: 'EXAMPLE5', date: '06-16-2004', type: 'Clearance' },
    ];

    function renderTable(filteredRequests) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        filteredRequests.forEach(request => {
            const row = `
            <tr>
                <td>${request.id}</td>
                <td>${request.name}</td>
                <td>${request.date}</td>
                <td>${request.type}</td>
                <td>
                    <button class="action-btn details-btn">DETAILS</button>
                    <button class="action-btn approve-btn">ADD NOTES</button>
                    <button class="action-btn complete-btn">COMPLETE</button>
                </td>
            </tr>
        `;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    }

    renderTable(requests);
    document.getElementById('searchBtn').addEventListener('click', function () {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const filterValue = document.getElementById('requestFilter').value;

        const filteredRequests = requests.filter(request => {
            const matchesSearch = request.name.toLowerCase().includes(searchValue) || request.id.toString().includes(searchValue);
            const matchesFilter = filterValue === '' || request.type === filterValue;
            return matchesSearch && matchesFilter;
        });

        renderTable(filteredRequests);
    });

</script>