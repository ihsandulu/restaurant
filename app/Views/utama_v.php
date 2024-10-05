<?php echo $this->include("template/header_v"); ?>

<div class='container'>
	<div class='row'>
		<div class='col'>
			<div class="row">
				<!-- Column -->
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="card-two">
								<header>
									<div class="avatar">
										<img src="images/global/user.png" alt="<?= session()->get("user_name"); ?>" />
									</div>
								</header>
								<h3><?= session()->get("position_name"); ?></h3>
								<div class="desc">
									<?= session()->get("identity_name"); ?>
								</div>
								<!-- <div class="contacts"><?= session()->get("position_name"); ?>
									<div class="clear"></div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php //print_r(session()->get("position_administrator"));?>
			<div class="row">
				
				<?php
				$from = date("Y-m-d");
				$to = date("Y-m-d");
				$builder = $this->db
					->table("booking");
				$builder->where("booking.booking_date >=", $from);
				$builder->where("booking.booking_date <=", $to);
				$harian = $builder->get();
				$tpemesananharian = $harian->getNumRows();
				// echo $this->db->getLastquery();
				$troomharian=0;
				foreach($harian->getResult() as $value){
					$troomharian+=$value->booking_roomcount;
				}
				?>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-title">
							<h4>Booking Hari Ini</h4>
						</div>
						<div class="todo-list">
							<div class="tdl-holder">
								<div class="tdl-content">
									<ul>
										<li class="color-default">
											<label>
												<?= $tpemesananharian; ?> Pemesanan
											</label>
										</li>
										<li class="color-info">
											<label>
												<i class="fa fa-building"></i> <?=$troomharian;?> Rooms
											</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<?php
				$from = date("Y-m-01");
				$to = date("Y-m-t");
				$builder = $this->db
					->table("booking");
				$builder->where("booking.booking_date >=", $from);
				$builder->where("booking.booking_date <=", $to);
				$bulanan = $builder->get();
				$tpemesananbulanan = $bulanan->getNumRows();
				// echo $this->db->getLastquery();
				$troombulanan=0;
				foreach($bulanan->getResult() as $value){
					$troombulanan+=$value->booking_roomcount;
				}
				?>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-title">
							<h4>Booking Bulan Ini</h4>
						</div>
						<div class="todo-list">
							<div class="tdl-holder">
								<div class="tdl-content">
									<ul>
										<li class="color-default">
											<label>
												<?= $tpemesananbulanan; ?> Pemesanan
											</label>
										</li>
										<li class="color-warning">
											<label>
												<i class="fa fa-building"></i> <?=$troombulanan;?> Rooms
											</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<?php
				$from = date("Y-01-01");
				$to = date("Y-12-31");
				$builder = $this->db
					->table("booking");
				$builder->where("booking.booking_date >=", $from);
				$builder->where("booking.booking_date <=", $to);
				$tahunan = $builder->get();
				$tpemesanantahunan = $tahunan->getNumRows();
				// echo $this->db->getLastquery();
				$troomtahunan=0;
				foreach($tahunan->getResult() as $value){
					$troomtahunan+=$value->booking_roomcount;
				}
				?>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-title">
							<h4>Booking Tahun Ini</h4>
						</div>
						<div class="todo-list">
							<div class="tdl-holder">
								<div class="tdl-content">
									<ul>
										<li class="color-default">
											<label>
												<?= $tpemesanantahunan; ?> Pemesanan
											</label>
										</li>
										<li class="color-primary">
											<label>
												<i class="fa fa-building"></i> <?=$troomtahunan;?> Rooms
											</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<canvas id="harianroom" style="width:100%;"></canvas>				
				
				<script>
				const dataharianroom = [
					<?php	
					$from = date("Y-01-01");
					$to = date("Y-12-31");
					$builder = $this->db
						->table("booking");
					$builder->select("SUM(booking.booking_roomcount)as jmlroom,booking_date");
					$builder->where("booking.booking_date <=", $to);
					$builder->groupBy("booking.booking_date");
					$tahunanroom = $builder->get();
					// echo $this->db->getLastquery();
					$no=0;
					foreach($tahunanroom->getResult() as $bulan){
					?>
					<?php if($no==0){?>						
						{ hari: '<?=date("Y-m-d",strtotime("-1 days", strtotime($bulan->booking_date)));?>', count: 0 },
					<?php }?>
					{ hari: '<?=$bulan->booking_date;?>', count: <?=$bulan->jmlroom;?> },
					<?php 
					$no++;
					}?>
				];

				new Chart("harianroom", {
				type: "line",
				data: {
					labels: dataharianroom.map(row => row.hari),
					datasets: [{
						label: 'Acquisitions by month',
            			data: dataharianroom.map(row => row.count),
						borderColor: "#8B93DA",
						fill: false
					}]
				},
				options: {
					legend: {display: false},
					title: {
					display: true,
					text: "Jumlah Room Tahun <?=date("Y");?>"
					}
				}
				});
				</script>
			</div>
			<div class="row">
				<canvas id="harianpesanan" style="width:100%;"></canvas>				
				
				<script>
				const dataharianpesanan = [
					<?php		
					$from = date("Y-01-01");
					$to = date("Y-12-31");
					$builder = $this->db
						->table("booking");
					$builder->select("COUNT(booking.booking_id)as jmlpesanan,booking_date");
					$builder->where("booking.booking_date <=", $to);
					$builder->groupBy("booking.booking_date");
					$tahunanpesanan = $builder->get();
					// echo $this->db->getLastquery();
					$no=0;
					foreach($tahunanpesanan->getResult() as $bulan){
					?>
					<?php if($no==0){?>						
						{ hari: '<?=date("Y-m-d",strtotime("-1 days", strtotime($bulan->booking_date)));?>', count: 0 },
					<?php }?>
					{ hari: '<?=$bulan->booking_date;?>', count: <?=$bulan->jmlpesanan;?> },
					<?php 
					$no++;
					}?>
				];

				new Chart("harianpesanan", {
				type: "line",
				data: {
					labels: dataharianpesanan.map(row => row.hari),
					datasets: [{
						label: 'Acquisitions by month',
            			data: dataharianpesanan.map(row => row.count),
						borderColor: "#8BD4D9",
						fill: false
					}]
				},
				options: {
					legend: {display: false},
					title: {
					display: true,
					text: "Jumlah Pesanan Tahun <?=date("Y");?>"
					}
				}
				});
				</script>
			</div>
		</div>
	</div>
</div>

<?php echo  $this->include("template/footer_v"); ?>

<?php //echo $this->endSection(); 
?>