<?php
class OrderController extends Controller {
    private $orderModel;

    public function __construct() {
        $this->orderModel = $this->model('OrderModel');
    }

    public function lookup() {
        $data = [
            'title' => 'Tra cứu đơn hàng',
            'order' => null,
            'items' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['order_id'])) {
            $orderId = (int)filter_var($_POST['order_id'], FILTER_SANITIZE_NUMBER_INT);
            $order = $this->orderModel->getOrderById($orderId);
            
            if ($order) {
                $data['order'] = $order;
                $data['items'] = $this->orderModel->getOrderItems($orderId);
            } else {
                $_SESSION['message'] = 'Không tìm thấy đơn hàng với mã này.';
                $_SESSION['msg_type'] = 'danger';
            }
        }

        $this->view('layouts/header', $data);
        $this->view('order/lookup', $data);
        $this->view('layouts/footer', $data);
    }
}
