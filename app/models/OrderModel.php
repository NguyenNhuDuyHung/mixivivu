<?php
class OrderModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT 
            b.id AS booking_id,
            b.booking_date,
            b.status AS booking_status,
            b.created_at AS booking_created_at,
            c.email AS customer_email
        FROM 
            booking b
        JOIN 
            booking_customer bc ON b.id = bc.booking_id
        JOIN 
            customer c ON bc.customer_id = c.id
        LIMIT " . $offset . ", " . $recordsPerPage;
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM booking";
        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    public function getOrderById($id)
    {
        $sql = "SELECT 
            b.id AS booking_id,
            b.guests_number,
            b.booking_date,
            b.status AS booking_status,
            b.created_at AS booking_created_at,
            c.id AS customer_id,
            c.email AS customer_email,
            c.full_name AS full_name,
            c.phone_number AS phone_number
        FROM 
            booking b
        JOIN 
            booking_customer bc ON b.id = bc.booking_id
        JOIN 
            customer c ON bc.customer_id = c.id
        WHERE 
            b.id = $id";

        $data = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getRoomsByOrderId($id)
    {
        $sql = "SELECT 
            r.id AS room_id,
            r.title AS room_title,
            r.images AS room_images,
            r.price AS room_price,
            r.max_persons AS room_max_persons,
            r.size AS room_size,
            SUM(br.quantity) AS total_quantity_booked,
            SUM(br.quantity * r.price) AS total_price
        FROM 
            booking b
        JOIN 
            booking_room br ON b.id = br.booking_id
        JOIN 
            rooms r ON br.room_id = r.id
        WHERE 
            b.id = $id
        GROUP BY 
            r.id, r.title, r.size, r.max_persons, r.price
        ORDER BY 
            total_quantity_booked DESC;
        ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function updateOrder($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $customerData = [
                'id' => $filterAll['customer_id'],
                'full_name' => $filterAll['full_name'],
                'phone_number' => $filterAll['phone_number'],
                'email' => $filterAll['email'],
                'updated_at' => date('Y/m/d H:i:s'),
            ];

            $bookingData = [
                'booking_date' => date('Y-d-m', strtotime($filterAll['booking_date'])),
                'guests_number' => $filterAll['guests_number'],
                'status' => $filterAll['status'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $bookingRoom = [
                'booking_id' => $id,
                'room_id' => explode(',', $filterAll['roomIdOutside'][0]),
                'quantity' => $filterAll['roomQuantityOutSide']
            ];

            try {
                $updateCustomer = $this->db->update('customer', $customerData, "id =" . $customerData['id']);
                if (!$updateCustomer) {
                    $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $createBooking = $this->db->update('booking', $bookingData, "id = " . $id);
                if (!$createBooking) {
                    $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                $clearBookingRoom = $this->db->delete('booking_room', "booking_id = " . $id);
                if (!$clearBookingRoom) {
                    $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                foreach ($bookingRoom['room_id'] as $key => $roomId) {
                    $bookingRoom['booking_id'] = $customerData['id'];

                    $dataToInsert = [
                        'booking_id' => $id,
                        'room_id' => $roomId,
                        'quantity' => $bookingRoom['quantity'][$key] ?? 0,
                    ];
                    $createBookingRoom = $this->db->insert('booking_room', $dataToInsert);
                }

                if (!$createBookingRoom) {
                    $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                $clearBookingCustomer = $this->db->delete('booking_customer', "booking_id = " . $id);
                if (!$clearBookingCustomer) {
                    $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                $createBookingCustomer = $this->db->insert('booking_customer', [
                    'booking_id' => $id,
                    'customer_id' => $customerData['id'],
                ]);

                if (!$createBookingCustomer) {
                    $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                // Gửi mail xác nhận thanh toán
                // $subject = 'Xác nhận đặt phòng thành công!';
                // $content = '
                //     <p>Kính gửi quý khách <strong>' . $filterAll['full_name'] . '</strong>,</p>
                //     <p>Cảm ơn quý khách đã đặt phòng. Chúng tôi sẽ liên hệ với quý khách trong thời gian sớm nhất để xác nhận lại thông tin và thanh toán.</p>
                //     <br>
                //     <p>Trân trọng,</p>
                //     <p><strong>Công ty TNHH Du lịch và Dịch vụ Mixivivu</strong></p>
                //     <p>Số nhà 25, Ngõ 38 Phố Yên Lãng, Phường Láng Hạ, Quận Đống Đa, Hà Nội</p>
                //     <p>Hotline 1: 0922222016</p>
                //     <p>Hotline 2: 0812 505 505</p>
                //     <p>Email: <a href="mailto:info@mixivivu.com">info@mixivivu.com</a></p>
                // ';
                // $sendMail = $this->sendMail($filterAll['email'], $subject, $content);
                $this->setSession('toast-success', 'Cập nhật thành công!');
                return true;
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                return false;
            }
        }
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT 
        b.id AS booking_id,
        b.booking_date,
        b.status AS booking_status,
        b.created_at AS booking_created_at,
        c.email AS customer_email
        FROM 
            booking b
        JOIN 
            booking_customer bc ON b.id = bc.booking_id
        JOIN 
            customer c ON bc.customer_id = c.id
        WHERE 
            c.email LIKE '%$keyword%'
        LIMIT " . $offset . ", " . $recordsPerPage;
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }
}
