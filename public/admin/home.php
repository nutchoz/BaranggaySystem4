<div class="container-home">
	<div class="dashboard">
		<div class="analytics">
			<h1 class="analytics-title">ANALYTICS OVERVIEW</h1>
			<p class="analytics-description">
				A snapshot of key metrics and trends to help you monitor system performance and user behavior.
			</p>
			<div class="chart-container">
				<canvas id="requestChart"></canvas>
			</div>
			<div class="chart-summary">
				<div class="summary-item">
					<span class="summary-label">Approval Rate:</span>
					<span class="summary-value">93.1%</span>
				</div>
				<div class="summary-item">
					<span class="summary-label">Disapproval Rate:</span>
					<span class="summary-value">3.8%</span>
				</div>
				<div class="summary-item">
					<span class="summary-label">Completion Rate:</span>
					<span class="summary-value">92.8%</span>
				</div>
			</div>
		</div>

		<div class="home-dash">
			<div class="card-dash">
				<div class="card-title">TOTAL REQUESTS</div>
				<div class="card-value">5,234</div>
				<div class="card-extra">+12% from last month</div>
			</div>
			<div class="card-dash approved">
				<div class="card-title">TOTAL APPROVED</div>
				<div class="card-value">4,870</div>
				<div class="card-extra">+8% from last month</div>
			</div>
			<div class="card-dash disapproved">
				<div class="card-title">TOTAL DISAPPROVED</div>
				<div class="card-value">200</div>
				<div class="card-extra">-5% from last month</div>
			</div>
			<div class="card-dash completed">
				<div class="card-title">TOTAL COMPLETED</div>
				<div class="card-value">4,860</div>
				<div class="card-extra">+10% from last month</div>
			</div>
		</div>
	</div>
</div>

<script>
	const requestData = {
		totalRequests: 5234,
		totalApproved: 4870,
		totalDisapproved: 200,
		totalCompleted: 4860,
	};

	const ctx = document.getElementById('requestChart').getContext('2d');
	const requestChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ['Approved', 'Disapproved', 'Completed'],
			datasets: [{
				data: [requestData.totalApproved, requestData.totalDisapproved, requestData.totalCompleted],
				backgroundColor: ['#28a745', '#dc3545', '#17a2b8'],
				hoverOffset: 10,
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					display: true,
					position: 'bottom',
				},
				tooltip: {
					enabled: true,
				}
			}
		}
	});
</script>