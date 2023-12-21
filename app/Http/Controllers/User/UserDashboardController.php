<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\DB;
use App\Models\SystemSettings;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Color;
use App\Models\Variation;
use App\Models\CartItems;
use App\Models\Cart;
use App\Models\OrderAddress;
use App\Models\Order;
use App\Models\OrderItem;
use dompdf\dompdf;

 // تأكد من استدعاء الـ namespace الصحيح لمكتبة TCPDF
class UserDashboardController extends Controller
{
    public function index()
    {
        // التحقق من تواجد مستخدم مسجل الدخول
        if (Auth::check()) {
            // استخراج بيانات المستخدم الحالي
            $users = Auth::user();

            // استعرض البيانات الأخرى التي ترغب في تمريرها (كما هو الحال مع $setting)
            $setting = SystemSettings::first();

            return view('user.index', compact('users', 'setting'));
        } else {
            // يمكنك إعادة التوجيه إلى صفحة تسجيل الدخول أو إجراء آخر
            return redirect('/');
        }
    }

    public function order()
    {
        $users = Auth::user();
        $setting = SystemSettings::first();
        $products = Product::join('variations', 'products.id', '=', 'variations.product_id')
        ->join('colors', 'variations.color_id', '=', 'colors.id')
        ->select('products.*','variations.id as variation_id', 'variations.price', 'variations.size', 'colors.name as color_name')
        ->get();
    
        return view('user.orders', compact('users','products', 'setting'));
    }

 // تعديل الدالة addToCart
 public function addToCart(Request $request)
 {
     $variations = $request->input('selectedVariations');
     $quantities = $request->input('quantities');
     $user_id = auth()->user()->id;
 
     // Get the cart_id for the user
     $cartId = Cart::where('user_id', $user_id)->value('id');
 
     // If the user doesn't have a cart, you may need to create one for them
     if (!$cartId) {
         $cart = Cart::create(['user_id' => $user_id]);
         $cartId = $cart->id;
     }
 
     // Check if variations is not null and is an array
     if (!is_null($variations) && is_array($variations)) {
         // Add the orders to the cart_items table
         for ($i = 0; $i < count($variations); $i++) {
             CartItems::create([
                 'cart_id' => $cartId,
                 'variation_id' => $variations[$i],
                 'quantity' => $quantities[$i],
                 'price' => $request->input('prices')[$i], // تفضيلًا، قم بتغيير 'prices' إلى اسم الحقل الذي يحتوي على الأسعار في الفورم
             ]);
         }
 
         // تحديث العودة إلى نموذج HTML
         return redirect()->route('cart.show');

     } else {
        
         return redirect()->route('cart.show');

     }
 }
 
 public function showCart()
{
    $user = Auth::user();
    $setting = SystemSettings::first();

    $cartItems = Variation::select('variations.id', 'variations.quantity', 'variations.price')
    ->join('products', 'variations.product_id', '=', 'products.id')
    ->join('colors', 'variations.color_id', '=', 'colors.id')
    ->join('cart_items', 'variations.id', '=', 'cart_items.variation_id')
    ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
    ->join('users', 'carts.user_id', '=', 'users.id')
    ->select('variations.id', 'variations.price', // هنا إزالة الفراغ الزائد بعد variations.id
             'products.name as product_name', 'colors.name as color_name',
             'cart_items.quantity as cart_item_quantity', 'carts.id as cart_id',
             'users.name as user_name')
    ->get();

    // عرض واجهة عرض السلة
    return view('user.cart_show', compact('cartItems','user','setting'));
}


public function confirmPurchase(Request $request)
{ 
    $request->validate([
        'street_address' => 'required|string|max:191',
        'area' => 'required|string|max:191',
        'city' => 'required|string|max:191',
        'cartItems' => 'required|array',
        'cartItems.*.price' => 'required|numeric|min:0',
        'cartItems.*.quantity' => 'required|integer|min:1',
    ]);

    // استخراج معرف المستخدم
    $user_id = auth()->user()->id;

    // الحصول على عناصر السلة وحساب المبلغ الإجمالي
    $cartItems = $request->input('cartItems', []);
    $totalAmount = 0;

    $cartItems = array_filter($cartItems, function($item) {
        return $item['quantity'] > 0 && empty($item['exclude']);
    });

    foreach ($cartItems as $variationId => $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // إنشاء العنوان للطلب
    $orderAddress = OrderAddress::create([
        'street_address' => $request->input('street_address'),
        'area' => $request->input('area'),
        'city' => $request->input('city'),
    ]);

    // إنشاء الطلب
    $order = Order::create([
        'user_id' => $user_id,
        'order_address_id' => $orderAddress->id,
        'total_amount' => $totalAmount,
        'status' => 'pending',
    ]);

    // إنشاء عناصر الطلب
    foreach ($cartItems as $variationId => $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'total_price' => $item['price'] * $item['quantity'],
            'variation_id' => $variationId,
        ]);
    }

    return redirect()->route('showOrders');
}


public function showOrders()
{
    $users = Auth::user();
    $setting = SystemSettings::first(); 

    $user = Auth::user();
    $orders = DB::table('orders')
    ->select('orders.id as order_id', 'users.name as customer_name', 
        DB::raw('SUM(orders.total_amount) as total_amount'), 
        DB::raw('MAX(orders.status) as order_status'), 
        'orders.created_at as order_date', 
        DB::raw('COUNT(order_items.id) as total_items'))
    ->join('users', 'users.id', '=', 'orders.user_id')
    ->join('order_items', 'order_items.order_id', '=', 'orders.id')
    ->where('users.id', $user->id)
    ->groupBy('orders.id', 'users.name', 'orders.created_at')
    ->get();
    
    
    return view('user.order_list', compact('orders','users','setting'));
}

public function generatePDF($orderId)
{
    require_once base_path('vendor/tcpdf/tcpdf.php');
    
    // Fetch order details and customer information from the database based on the order ID
    // Replace the query with your actual SQL query to retrieve order details
    $user = Auth::user();
    $customer= Auth::user();
    
    $orders = DB::table('orders')
    ->select(
        'orders.id as order_id',
        'users.name as customer_name',
        'orders.total_amount',
        'orders.created_at as date',
        'orders.status as order_status',
        'orders.created_at as order_date',
        'order_addresses.city',
        'order_addresses.area',
        'order_addresses.street_address',
        'products.name as product_name',
        'order_items.quantity as quantity',
        'order_items.price  as price',
        'colors.name as color_name',
        'variations.size as size'

    )
    ->join('users', 'users.id', '=', 'orders.user_id')
    ->join('order_addresses', 'order_addresses.id', '=', 'orders.order_address_id')
    ->join('order_items', 'order_items.order_id', '=', 'orders.id')
    ->join('variations', 'variations.id', '=', 'order_items.variation_id')
    ->join('products', 'products.id', '=', 'variations.product_id')
    ->join('colors', 'colors.id', '=', 'variations.color_id')
    ->where('users.id', $user->id)
    ->where('orders.id', $orderId)
    ->get();


    // إنشاء مثيل لمكتبة TCPDF
    $pdf = new \TCPDF();


    // قم بتحميل النموذج الخاص بملف PDF وقم بتمرير بيانات الطلب إليه
    $view = view('user.order_pdf', compact('orders','customer'))->render();

    // إضافة النموذج المُرتجِع من الـ view إلى مكتبة TCPDF
    $pdf->AddPage();
    $pdf->writeHTML($view, true, false, true, false, '');

    // عرض ملف PDF في المتصفح
    $pdf->Output("order_{$orderId}.pdf", 'I');
}

}
