<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			Shoping Cart
		</span>
	</div>
</div>


<!-- Shoping Cart -->
<div class="container">
	<div class="" style="display: flex;">
		<form action="index.php?act=updatecart" method="post" class="bg0 ">
			<div class="">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<?php
						$tong = 0;
						$i = 0;

						if ((isset($_SESSION['cart'])) && (count($_SESSION['cart']) > 0)) {
						?>
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th></th>
								</tr>

								<?php
								foreach ($_SESSION['cart'] as $item) {
									$product = product_detail_select_by_id($item[0]);
									extract($product);
									$color = color_select_by_id($color_id);
									extract($color);
									$size = size_select_by_id($size_id);
									extract($size);
									$total = $item[3] * $item[4];
									$tong += $total;


								?>
									<tr class="table_row">
										<td class="column-1">
											<a href="index.php?act=delcart&i=<?= $i ?>">
												<div class="how-itemcart1">
													<img src="../upload/<?= $item[2] ?>" alt="IMG">
												</div>
											</a>
										</td>

										<td class="column-2"><?= $item[1] ?>(<?= $size_name ?>,<?= $color_name ?>)</td>
										<td class="column-3"><?= $item[3] ?>$</td>
										<td class="column-4">
											<div class="wrap-num-product flex-w m-l-auto m-r-0">
												<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div>

												<input class="mtext-104 cl3 txt-center num-product" type="number" name="so_luong[<?= $item[0] ?>]" value="<?= $item[4] ?>">

												<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div>
											</div>
										</td>

										<td class="column-5"><?= $total ?>$</td>

									</tr>
								<?php
									$i++;
								}
								?>

							</table>
							<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
								<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
									<button type="submit">Update Cart</button>
								</div>
							</div>

						<?php
						} else {
							echo "<h1 style='text-align: center;'>
								Cart is empty</h1>";
						}

						?>
						<table class="table-shopping-cart">
							<tr class="table_head">
								<th class="column-1">Code orders</th>
								<th class="column-2"></th>
								<th class="column-3">Date</th>
								<th class="column-4">Total</th>
								<th class="column-5">Status</th>

								<th class="column-6"></th>
							</tr>
							<?php
							if (isset($_SESSION['user_kh'])) {
								extract($_SESSION['user_kh']);
								$dhs = dh_select_all_user($user_id);
								foreach ($dhs as $dh) {
									extract($dh);
									echo "
									<tr class='table_row'>
									

									<td class='column-1'>" . $order_id . "</td>
									<td class='column-2'></td>
									<td class='column-3'>" . $order_date . "</td>
									</td>
									<td class='column-4'>" . $order_total . "$</td>
									<td class='column-5'>";
									if ($order_status == '1') {
										echo "Waiting</td>";
									} else if ($order_status == 2) {
										echo "Delivery</td>";
										$button_status = "Received";
										echo "<td class='column-6'><a href = index.php?act=status_update&order_id=$order_id>$button_status</a></td>";
									} else if ($order_status == 3) {
										echo "Complete</td>";
									}
									"
								
								</tr>
								";
								}
							} else if (isset($_SESSION['dh'])) {
								extract($_SESSION['dh']);
								$dhs = dh_select_all_order_id($order_id);
								foreach ($dhs as $dh) {
									extract($dh);
									echo "
									<tr class='table_row'>
									

									<td class='column-1'>" . $order_id . "</td>
									<td class='column-2'></td>
									<td class='column-3'>" . $order_date . "</td>
									</td>
									<td class='column-4'>" . $order_total . "$</td>
									<td class='column-5'>";
									if ($order_status == '1') {
										echo "Waiting</td>";
									} else if ($order_status == 2) {
										echo "Delivery</td>";
										$button_status = "Received";
										echo "<td class='column-6'><a href = index.php?act=status_update&order_id=$order_id>$button_status</a></td>";
									} else if ($order_status == 3) {
										echo "Complete</td>";
									}
									"
								
								</tr>
								";
								}
							}
							?>
						</table>
					</div>

				</div>
			</div>
		</form>

		<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
			<?php if ((isset($_SESSION['cart'])) && (count($_SESSION['cart']) > 0)) { ?>
			<form action="index.php?act=thanhtoan" method="post">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Cart Totals
					</h4>

					<div class="flex-w flex-t bor12 p-b-13">
						<div class="size-208">
							<span class="stext-110 cl2">
								Subtotal: <?= $tong ?>$
							</span>
						</div>

						<div class="size-209">
							<span class="mtext-110 cl2">
								<!-- <?= $total ?>$ -->
							</span>
						</div>
					</div>

					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								Shipping:
							</span>
						</div>

						<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
							<div class="p-t-15">
								<div class="bor8 bg0 m-b-12">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="order_address" placeholder="Address" value="<?= $order_address ?? '' ?>">
								</div>
								<span style="color:red">
									<?= $errors['order_address'] ?? '' ?>
								</span>
								<div class="bor8 bg0 m-b-12">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="order_email" placeholder="Email" value="<?= $order_email ?? '' ?>">
								</div>
								<span style="color:red">
									<?= $errors['order_email'] ?? '' ?>
								</span>
								<div class="bor8 bg0 m-b-22">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="tel" name="order_phone" placeholder="Phonenumber" value="<?= $order_phone ?? '' ?>">
								</div>
								<span style="color:red">
									<?= $errors['order_phone'] ?? '' ?>
								</span>
								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
									<select id="province" class="js-select2" name="payment_id">
										<?php foreach ($payments as $payment) : ?>
											<option value="<?= $payment['payment_id'] ?>">
												<?= $payment['payment_name'] ?>
											</option>
										<?php endforeach ?>
									</select>
									<div class="dropDownSelect2"></div>
								</div>

							</div>
						</div>
					</div>

					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">
								Total: <?= $tong ?>$
								<input type="hidden" name="order_total" value="<?= $tong ?>">
							</span>
						</div>


					</div>

					<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
						Proceed to Checkout
					</button>
				</div>
			</form>
			<?php }?>
		</div>

	</div>
</div>