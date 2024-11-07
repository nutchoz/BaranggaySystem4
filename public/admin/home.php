<div class="container-home">
	<div class="dashboard">
		<div class="analytics">
			<h1 style="margin: 10px; color: #333">
				<center>ANALYTICS OVERVIEW</center>
			</h1>
			<div class="chart-container">
				<canvas id="requestChart"></canvas>
			</div>
		</div>

		<div class="home-dash">
			<div class="card-dash">
				<div class="card-title">TOTAL REQUEST</div>
				<div class="card-value">5234</div>
			</div>
			<div class="card-dash approved">
				<div class="card-title">TOTAL APPROVED</div>
				<div class="card-value">4870</div>
			</div>
			<div class="card-dash disapproved">
				<div class="card-title">TOTAL DISAPPROVED</div>
				<div class="card-value">200</div>
			</div>
			<div class="card-dash completed">
				<div class="card-title">TOTAL COMPLETED</div>
				<div class="card-value">4860</div>
			</div>
		</div>

	</div>
</div>

<script>
	const requestData = {
		totalRequests: 100,
		totalApproved: 60,
		totalDisapproved: 20,
		totalCompleted: 20,
	};

	const ctx = document.getElementById('requestChart').getContext('2d');
	const requestChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ['Approved', 'Disapproved', 'Completed'],
			datasets: [{
				data: [requestData.totalApproved, requestData.totalDisapproved, requestData.totalCompleted],
				backgroundColor: ['#28a745', '#dc3545', '#17a2b8'],
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					position: 'top',
				},
				tooltip: {
					enabled: true
				}
			}
		}
	});

</script>