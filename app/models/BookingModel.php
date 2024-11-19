<?php
class BookingModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createOrder()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $customerData = [
                'full_name' => $filterAll['full_name'],
                'phone_number' => $filterAll['phone_number'],
                'email' => $filterAll['email'],
                'created_at' => date('Y/m/d H:i:s'),
            ];

            $bookingData = [
                'code' => uniqid(),
                'booking_date' => date('Y-m-d', strtotime($filterAll['calendar'])),
                'additional_info' => $filterAll['additional_info'],
                'guests_number' => $filterAll['quantity'],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $bookingRoom = [
                'booking_id' => '',
                'room_id' => explode(',', $filterAll['cruiseRoomId'][0]),
                'quantity' => explode(',', $filterAll['cruiseRoomQuantity'][0]),
            ];

            try {
                $createCustomer = $this->db->insert('customer', $customerData);
                if (!$createCustomer) {
                    $this->setSession('toast-error', 'Đặt phòng không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $createBooking = $this->db->insert('booking', $bookingData);
                if (!$createBooking) {
                    $this->setSession('toast-error', 'Đặt phòng không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $bookingId = $this->db->lastInsertId();
                $customerId = $this->db->lastInsertId();

                foreach ($bookingRoom['room_id'] as $key => $roomId) {
                    $bookingRoom['booking_id'] = $bookingId;

                    $dataToInsert = [
                        'booking_id' => $bookingId,
                        'room_id' => $roomId,
                        'quantity' => $bookingRoom['quantity'][$key] ?? 0,
                    ];
                    $createBookingRoom = $this->db->insert('booking_room', $dataToInsert);
                }

                if (!$createBookingRoom) {
                    $this->setSession('toast-error', 'Đặt phòng không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                $createBookingCustomer = $this->db->insert('booking_customer', [
                    'booking_id' => $bookingId,
                    'customer_id' => $customerId,
                ]);

                if (!$createBookingCustomer) {
                    $this->setSession('toast-error', 'Đặt phòng không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                $this->setSession('toast-success', 'Đặt phòng thành công! Vui lòng kiểm tra email của bạn!');
                return true;
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Đặt phòng không thành công! Vui lòng thử lại sau!');
                return false;
            }
        }
    }
}
