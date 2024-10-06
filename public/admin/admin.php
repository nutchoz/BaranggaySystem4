<?php require_once "../../includes/initialize.php" ?>
<?php createHeader("Hotel Reservation System", ["../css/homepage", "../css/picker", "../css/hotelform", "../css/customAlert"]); ?>

<body>
	<?php include_layout_template("../layouts/customAlert.php") ?>
	<div class="container2">
		<div class="left-side">
			<div class="picker">
				<a href="admin.php?type=ahotel"><img src="https://cdn-icons-png.flaticon.com/256/189/189755.png" /><div class="picker-div">Add Hotel</div></a>
				<a href="admin.php?type=aroom" ><img src="https://cdn-icons-png.flaticon.com/256/189/189755.png" /><div class="picker-div">Add Room</div></a>
				<a href="admin.php?type=dhotel"><img src="https://cdn-icons-png.flaticon.com/512/1828/1828843.png" /><div class="picker-div">Remove Hotel</div></a>
				<a href="admin.php?type=droom" ><img src="https://cdn-icons-png.flaticon.com/512/1828/1828843.png" /><div class="picker-div">Remove Room</div></a>
				<a href="admin.php?type=uhotel"><img src="https://cdn-icons-png.flaticon.com/512/4370/4370942.png" /><div class="picker-div">Update Hotel</div></a>
				<a href="admin.php?type=uroom" ><img src="https://cdn-icons-png.flaticon.com/512/4370/4370942.png" /><div class="picker-div">Update Room</div></a>
			</div>

			<div class="statistics">
				<?php
					createAnalytics("https://cdn-icons-png.freepik.com/512/3429/3429149.png", "Booking Trends", "JDM Hotel");
					createAnalytics("https://cdn-icons-png.flaticon.com/512/12211/12211399.png", "Occupancy Rates", "90%");
					createAnalytics("https://cdn-icons-png.flaticon.com/512/3449/3449305.png", "Financial Reports", "Successful");
				?>
			</div>
		</div>

		<div class="hotel-form">
			<?php
				if (isset($_GET['type']))
				{
					$type = $_GET['type'];
					if     ($type ==='ahotel' ) include_layout_template("addHotel.php");
					elseif ($type ==='aroom'  ) include_layout_template("addRoom.php");
					elseif ($type ==='dhotel' ) include_layout_template("deleteHotel.php");
					elseif ($type ==='droom'  ) include_layout_template("deleteRoom.php");
					elseif ($type ==='uhotel' ) include_layout_template("updateHotel.php");
					elseif ($type ==='uroom'  ) include_layout_template("updateRoom.php");
					elseif ($type ==='users'  ) include_layout_template("allUser.php");
					elseif ($type ==='reserve') include_layout_template("allReservation.php");
				}
			?>
		</div>	

	</div>

	<div class="container">
		<div class="navigation">
			<div class="title">🔑 ADMIN - HotelReserve</div>
			<div class="nav">
				<div><a href="admin.php?type=users">Users</a></div>
				<div><a href="admin.php?type=reserve">Reservation</a></div>
				<div><a href="../registration.php">Logout</a></div>
			</div>
		</div>
	</div>

</body>
</html>