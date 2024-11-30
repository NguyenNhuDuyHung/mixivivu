<div class="action-page">
    <form method="post" action="" id="UserAddForm">
        <div class="modal">
            <h6><?php echo $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="full_name" class="input-group">
                            <input id="full_name" class="p-md" placeholder="Nhập họ và tên" name="full_name"
                                value="<?php echo $this->oldInfo('full_name', $data) ?? $order['full_name'] ?>" autocomplete="off">
                            <input type="hidden" name="customer_id" value="<?php echo $order['customer_id'] ?>">
                            <label for="full_name" class="sm input-required">
                                Tên đầy đủ
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="email" class="input-group">
                            <input id="email" class="p-md" placeholder="Nhập email" name="email"
                                value="<?php echo $this->oldInfo('email', $data) ?? $order['customer_email'] ?>" autocomplete="off">
                            <label for="email" class="sm input-required">
                                Email
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="phone_number" class="input-group">
                            <input id="phone_number" class="p-md" placeholder="Nhập số điện thoại" name="phone_number"
                                value="<?php echo $this->oldInfo('phone_number', $data) ?? $order['phone_number'] ?>" autocomplete="off">
                            <label for="phone_number" class="sm input-required">
                                Phone
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="select-input">
                        <label for="status" class="input-group">
                            <input id="status" class="p-md" placeholder="Chọn vai trò" name="status"
                                value="<?php echo $this->oldInfo('status', $data) ?? $order['booking_status'] ?>" autocomplete="off">
                            <label for="status" class="sm input-required">
                                Trạng thái
                            </label>
                        </label>

                        <div class="dropdown">
                            <div class="dropdown-item" value="Đã gửi mail">
                                Đã gửi mail
                            </div>
                            <div class="dropdown-item" value="Đã xác nhận">
                                Đã xác nhận
                            </div>
                            <div class="dropdown-item" value="Thành công">
                                Thành công
                            </div>
                            <div class="dropdown-item" value="Đã hủy">
                                Đã hủy
                            </div>
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="booking_date" class="input-group">
                            <input id="booking_date" class="p-md" placeholder="Ngày đặt" name="booking_date"
                                value="<?php echo $this->oldInfo('booking_date', $data) ?? $order['booking_date'] ?>" autocomplete="off">
                            <label for="booking_date" class="sm input-required">
                                Ngày đặt
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="guests_number" class="input-group">
                            <input id="guests_number" class="p-md" placeholder="Nhập guests_number" name="guests_number"
                                value="<?php echo $this->oldInfo('guests_number', $data)  ?? $order['guests_number'] ?>" autocomplete="off">
                            <label for="guests_number" class="sm input-required">
                                Số khách
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div id="rooms" class="flex flex-col gap-40">
                <div class="flex flex-col gap-40 ShipDetail-room-types section-bg">
                    <div class="flex justify-end">
                        <button type="button" class="btn btn-sm btn-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M6 6L18 18M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="label sm">Xoá lựa chọn</div>
                        </button>
                    </div>

                    <form action="" method="post">
                        <div class="flex flex-col gap-16">
                            <?php
                            $roomId = [];
                            $totalPrice = 0;
                            ?>
                            <?php foreach ($rooms as $key => $room) : ?>
                                <?php $totalPrice += $room['total_price'] ?>
                                <?php $roomId[] = $room['room_id'] ?>
                                <div>
                                    <div class="card RoomCard-roomCard">
                                        <div class="RoomCard-img-wrapper">
                                            <div
                                                style="width: 100%; height: 100%; position: relative; overflow: hidden;">
                                                <img src="<?= $room['room_images'] ?>"
                                                    alt="room-thumbnail" width="100%" height="100%" loading="lazy"
                                                    style="object-fit: cover;">
                                            </div>
                                        </div>
                                        <div class="RoomCard-roomDetail">
                                            <div class="RoomCard-title"><?= $room['room_title'] ?></div>
                                            <div class="RoomCard-roomInfo">
                                                <div class="RoomCard-roomInfo-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M20 3.5H4C3.20435 3.5 2.44129 3.81607 1.87868 4.37868C1.31607 4.94129 1 5.70435 1 6.5V19.5C1 19.7652 1.10536 20.0196 1.29289 20.2071C1.48043 20.3946 1.73478 20.5 2 20.5H6C6.16471 20.4991 6.32665 20.4576 6.47145 20.3791C6.61625 20.3006 6.73941 20.1876 6.83 20.05L8.54 17.5H15.46L17.17 20.05C17.2606 20.1876 17.3838 20.3006 17.5285 20.3791C17.6733 20.4576 17.8353 20.4991 18 20.5H22C22.2652 20.5 22.5196 20.3946 22.7071 20.2071C22.8946 20.0196 23 19.7652 23 19.5V6.5C23 5.70435 22.6839 4.94129 22.1213 4.37868C21.5587 3.81607 20.7956 3.5 20 3.5ZM21 18.5H18.54L16.83 16C16.7454 15.8531 16.6248 15.7302 16.4796 15.6428C16.3344 15.5553 16.1694 15.5062 16 15.5H8C7.83529 15.5009 7.67335 15.5424 7.52855 15.6209C7.38375 15.6994 7.26059 15.8124 7.17 15.95L5.46 18.5H3V13.5H21V18.5ZM7 11.5V10.5C7 10.2348 7.10536 9.98043 7.29289 9.79289C7.48043 9.60536 7.73478 9.5 8 9.5H10C10.2652 9.5 10.5196 9.60536 10.7071 9.79289C10.8946 9.98043 11 10.2348 11 10.5V11.5H7ZM13 11.5V10.5C13 10.2348 13.1054 9.98043 13.2929 9.79289C13.4804 9.60536 13.7348 9.5 14 9.5H16C16.2652 9.5 16.5196 9.60536 16.7071 9.79289C16.8946 9.98043 17 10.2348 17 10.5V11.5H13ZM21 11.5H19V10.5C19 9.70435 18.6839 8.94129 18.1213 8.37868C17.5587 7.81607 16.7956 7.5 16 7.5H14C13.2599 7.50441 12.5476 7.78221 12 8.28C11.4524 7.78221 10.7401 7.50441 10 7.5H8C7.20435 7.5 6.44129 7.81607 5.87868 8.37868C5.31607 8.94129 5 9.70435 5 10.5V11.5H3V6.5C3 6.23478 3.10536 5.98043 3.29289 5.79289C3.48043 5.60536 3.73478 5.5 4 5.5H20C20.2652 5.5 20.5196 5.60536 20.7071 5.79289C20.8946 5.98043 21 6.23478 21 6.5V11.5Z"
                                                            fill="var(--gray-600, #475467)"></path>
                                                    </svg>
                                                    <p class="sm"><?= $room['room_size'] ?> m²</p>
                                                </div>

                                                <div class="RoomCard-roomInfo-item">
                                                    <p class="sm">Tối đa:</p>
                                                    <div class="flex gap-4 align-center">
                                                        <p class="sm"><?= $room['room_max_persons'] ?></p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M3 20C5.33579 17.5226 8.50702 16 12 16C15.493 16 18.6642 17.5226 21 20M16.5 7.5C16.5 9.98528 14.4853 12 12 12C9.51472 12 7.5 9.98528 7.5 7.5C7.5 5.01472 9.51472 3 12 3C14.4853 3 16.5 5.01472 16.5 7.5Z"
                                                                stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-20 justify-between align-center RoomCard-footer">
                                            <div>
                                                <div class="RoomCard-price subheading md"><?= number_format($room['room_price']) ?> đ</div>
                                                <div class="RoomCard-user">/khách</div>
                                            </div>

                                            <button type="button"
                                                class="btn RoomCard-roomBtn btn-normal btn-outline">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M6 12L18 12" stroke="#101828" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </div>

                                                <div class="label md"><?= $room['total_quantity_booked'] ?></div>
                                                <input type="hidden" class="quantity-input" name="roomQuantityOutSide[<?= $key ?>]" value="<?= $room['total_quantity_booked'] ?>">

                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M6 12H18M12 6V18" stroke="#101828" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach ?>

                            <?php
                            $roomId =  implode(',', $roomId);
                            ?>
                            <input type="hidden" name="roomIdOutside[]" value="<?php echo $roomId ?>">

                        </div>
                    </form>

                    <div class="flex align-center gap-40 justify-between ShipDetail-rooms-footer">
                        <div>
                            <label class="sm ShipDetail-price-label">Tổng tiền</label>
                            <div class="subheading lg ShipDetail-price">
                                <?= number_format($totalPrice) ?> đ
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-normal btn-primary submitBtn">
                    <div class="label md">Cập nhật</div>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var message = "<?php echo isset($_SESSION['toast-error']) ? $_SESSION['toast-error'] : ''; ?>";
        if (message) {
            toastr.error(message);
        }
        <?php $this->model->removeSession('toast-error'); ?>
    });
</script>