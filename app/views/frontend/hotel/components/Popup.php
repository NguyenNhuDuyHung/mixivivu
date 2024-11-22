<div class="popup-root">
    <div class="popup-overlay" tabindex="-1" data-popup="modal" data-testid="overlay"
        style="position: fixed; inset: 0px; display: none; z-index: 999; pointer-events: auto;">
        <div class="popup-content" role="dialog" id="popup"
            style="position: relative; margin: auto; pointer-events: auto;">
            <div>
                <div class="Modal-close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M6 6L18 18M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <form action="<?php echo _WEB_ROOT ?>/booking/hotel" method="post" id="booking-form">
                    <div class="ShipDetail-booking-detail-modal">
                        <h6>Đặt du thuyền</h6>
                        <div class="ShipDetail-divider"></div>
                        <div class="flex flex-col gap-24">
                            <div class="ShipDetail-group-input">
                                <div class="DatePicker-mixi-date-picker">
                                    <div class="DatePicker-wrapper">
                                        <div class="DatePicker-input-container">
                                            <div class="">
                                                <label for="calendar" class="input-group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M3 9H21M7 3V5M17 3V5M6 12H10V16H6V12ZM6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z"
                                                            stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <input id="calendar" name="calendar" class="p-md"
                                                        value="04/10/2024">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path d="M6 9L12 15L18 9" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <label for="calendar" class="sm">Ngày nhận phòng</label>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="RoomPicker-room-picker">
                                    <div class="">
                                        <label for="quantity" class="input-group">
                                            <input id="quantity" class="p-md" name="quantity" readonly
                                                value="3 Người lớn - 2 Trẻ em">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path d="M6 9L12 15L18 9" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                            <label for="quantity" class="sm">Số lượng</label>
                                        </label>
                                    </div>

                                    <div class="RoomPicker-room-picker-dropdown">
                                        <div class="RoomPicker-content flex flex-col gap-16">
                                            <div class="RoomPicker-item flex gap-8">
                                                <div class="subheading md RoomPicker-item-value">3</div>
                                                <label class="lg flex-grow">Người lớn</label>
                                                <div class="RoomPicker-group-btn">
                                                    <div class="RoomPicker-item-btn RoomPicker-minus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M6 12L18 12" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="RoomPicker-item-btn RoomPicker-plus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M6 12H18M12 6V18" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="RoomPicker-item flex gap-8">
                                                <div class="subheading md RoomPicker-item-value">3</div>
                                                <label class="lg flex-grow">Trẻ em</label>
                                                <div class="RoomPicker-group-btn">
                                                    <div class="RoomPicker-item-btn RoomPicker-minus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M6 12L18 12" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="RoomPicker-item-btn RoomPicker-plus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M6 12H18M12 6V18" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="RoomPicker-actions">
                                            <button type="button"
                                                class="btn RoomPicker-action-btn btn-sm btn-primary">
                                                <div class="label sm">Áp dụng</div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <label for="full_name" class="input-group">
                                        <input id="full_name" class="p-md" placeholder="Nhập họ và tên"
                                            name="full_name" value="" autocomplete="off">
                                        <label for="full_name" class="sm input-required">
                                            Họ và tên
                                        </label>
                                    </label>
                                </div>
                                <div class="error"></div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <label for="phone_number" class="input-group">
                                        <input id="phone_number" class="p-md" placeholder="Nhập số điện thoại"
                                            name="phone_number" value="" autocomplete="off">
                                        <label for="phone_number" class="sm input-required">
                                            Số điện thoại
                                        </label>
                                    </label>
                                </div>
                                <div class="error"></div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <label for="email" class="input-group">
                                        <input id="email" class="p-md" placeholder="Nhập email" name="email"
                                            value="" autocomplete="off">
                                        <label for="email" class="sm input-required">
                                            Địa chỉ email
                                        </label>
                                    </label>
                                </div>
                                <div class="error"></div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <label class="input-group" for="additional_info">
                                        <textarea id="additional_info" class="p-md" name="additional_info"
                                            placeholder="Nhập yêu cầu của bạn" autocomplete="off"></textarea>
                                        <label for="additional_info" class="sm">
                                            Yêu cầu của bạn
                                        </label>
                                    </label>
                                </div>
                                <div class="error"></div>
                            </div>

                        </div>
                        <div class="flex gap-40 justify-between ShipDetail-booking-detail-modal-footer">
                            <div class="flex flex-col gap-6">
                                <label class="sm ShipDetail-price-label">Tổng tiền</label>
                                <div class="subheading lg ShipDetail-price"
                                    style="color: var(--primary-dark, #0E4F4F);">0 đ</div>
                            </div>
                            <div class="ShipDetail-actions flex gap-16 flex-grow justify-end">
                                <button type="button" class="btn btn-normal btn-outline">
                                    <div class="label md">Đăng ký tư vấn</div>
                                </button>

                                <button type="submit" class="btn btn-normal btn-primary">
                                    <div class="label md">Đặt ngay</div>
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.5 6H9.5M9.5 6L6.5 3M9.5 6L6.5 9" stroke="var(--gray-800, #1d2939)" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>