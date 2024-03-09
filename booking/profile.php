<?php include('header.php');
if (!isset($_SESSION['user'])) {
	header('location:login.php');
}
$qry2 = mysqli_query($con, "select * from tbl_movie where movie_id='" . $_SESSION['movie'] . "'");
$movie = mysqli_fetch_array($qry2);
?>
<div class="content">
	<div class="wrap">
		<div class="content-top">
			<div class="section group">
				<div class="about span_1_of_2">
					<h3 style="color:black;" class="text-center">BOOKING HISTORY</h3>
					<?php include('msgbox.php'); ?>
					<?php
					$bk = mysqli_query($con, "SELECT tbl_movie.movie_id as movie_id, tbl_movie.movie_name as movie_name , seat.id as seat_id , seat.name as seat_name FROM reserved_seat inner join tbl_movie on reserved_seat.movie_id = tbl_movie.movie_id inner join seat on reserved_seat.seat_id = seat.id where user = " . $_SESSION['user']);
					if (mysqli_num_rows($bk)) {
					?>
						<table class="table table-bordered">
							<thead>
								<th>Movie</th>
								<th>Seats</th>
							</thead>
							<tbody>
								<?php
								while ($bkg = mysqli_fetch_array($bk)) {
									// $m = mysqli_query($con, "select * from tbl_movie where movie_id=(select movie_id from tbl_shows where s_id='" . $bkg['show_id'] . "')");
									// $mov = mysqli_fetch_array($m);
									// $s = mysqli_query($con, "select * from tbl_screens where screen_id='" . $bkg['screen_id'] . "'");
									// $srn = mysqli_fetch_array($s);
									// $tt = mysqli_query($con, "select * from tbl_theatre where id='" . $bkg['t_id'] . "'");
									// $thr = mysqli_fetch_array($tt);
									// $st = mysqli_query($con, "select * from tbl_show_time where st_id=(select st_id from tbl_shows where s_id='" . $bkg['show_id'] . "')");
									// $stm = mysqli_fetch_array($st);
								?>
									<tr>

										<td>
											<?php echo $bkg['movie_name']; ?>
										</td>
										<td>
											<?php echo $bkg['seat_name']; ?>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					<?php
					} else {
					?>
						<h3 style="color:red;" class="text-center">No Previous Bookings Found!</h3>
						<p>Once you start booking movie tickets with this account, you'll be able to see all the booking history.</p>
					<?php
					}
					?>
				</div>
				<?php include('movie_sidebar.php'); ?>

			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
</body>

</html>