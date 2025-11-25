<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\CSRF;
use App\Models\Order;
use App\Models\Product;

class CheckoutController extends Controller {
    public function show(Request $r, Response $res): void {
        $cart = $_SESSION['cart'] ?? [];
        $items = [];
        $total = 0;
        foreach ($cart as $pid => $qty) {
            $p = Product::find((int)$pid);
            if ($p) { $items[] = ['product'=>$p,'qty'=>$qty,'line_total'=>$p['price']*$qty]; $total += $p['price']*$qty; }
        }
        $this->view('checkout/show', ['items'=>$items,'total'=>$total]);
    }

    public function place(Request $r, Response $res): void {
        if (!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        $name = trim($r->input('name',''));
        $email = trim($r->input('email',''));
        $address = trim($r->input('address',''));
        $payment = $r->input('payment','cod');
        $cart = $_SESSION['cart'] ?? [];
        if (!$cart) { $res->setStatus(422)->send('Cart empty'); return; }
        $order = Order::createFromCart($name, $email, $address, $payment, $cart);
        if ($payment === 'cod') {
            unset($_SESSION['cart']);
            $res->redirect('/order/track?order_no='.$order['order_no']);
        } else {
            // Razorpay: client will open checkout, then verify on /checkout/razorpay/verify
            $this->view('checkout/razorpay', ['order'=>$order]);
        }
    }

    public function verifyRazorpay(Request $r, Response $res): void {
        // Minimal verification placeholder. Implement signature check with key secret in production.
        if (!CSRF::verify($r->input('_token'))) { $res->setStatus(422)->send('Invalid CSRF'); return; }
        $orderNo = $r->input('order_no');
        Order::markPaidByOrderNo($orderNo);
        unset($_SESSION['cart']);
        $res->redirect('/order/track?order_no='.$orderNo);
    }

    public function trackForm(Request $r, Response $res): void { $this->view('order/track', []); }
    public function track(Request $r, Response $res): void {
        $orderNo = $r->input('order_no');
        $order = Order::findByOrderNo($orderNo);
        $this->view('order/track', ['result'=>$order]);
    }
}
