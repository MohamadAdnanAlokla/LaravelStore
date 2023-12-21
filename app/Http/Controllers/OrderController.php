<?php

// OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\SystemSettings;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; // استدعاء نموذج الطلبيات
use App\Models\User;
use App\Models\DeliveryOrder;
use App\Models\Product;
use App\Models\Color;
use App\Models\Variation;
use App\Models\CartItems;
use App\Models\Cart;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use dompdf\dompdf;

class OrderController extends Controller
{
    // عرض جميع الطلبيات
    public function index()
    {
        $orders = Order::all();
        $deliveryDrivers = User::where('role_id', 3)->get();
        $DeliveryOrder=DeliveryOrder::get();
        $setting = SystemSettings::first();
        return view('admin.order', compact('orders','setting','deliveryDrivers','DeliveryOrder'));
    }

     public function updateDriver(Request $request, $id)
        {
             // استقبل مُعرف الموصل ومُعرف الطلبية من النموذج
                        $deliveryDriverId = $request->input('delivery_driver');
                    

                        // التحقق مما إذا كان مُعرف الطلبية موجودًا في جدول delivery_orders
                        $existingDeliveryOrder = DeliveryOrder::find($id);

                        if ($existingDeliveryOrder) {
                            // إذا وُجِدَت الطلبية في الجدول، قم بتغيير مُعرف الموصل فقط
                            $existingDeliveryOrder->update([
                                'delivery_driver_id' => $deliveryDriverId,
                            ]);
                        } else {
                            // إذا لم يتم العثور على الطلبية في الجدول، قم بإنشاء سجل جديد
                            DeliveryOrder::create([
                                'order_id' => $id,
                                'delivery_driver_id' => $deliveryDriverId,
                                'delivery_date' => now(), // أو يمكنك استخدام القيمة المناسبة لتاريخ التوصيل هنا
                            ]);
                        }
                        return redirect()->route('orders.create');
                      
        }


    // عرض تفاصيل طلب محدد
    public function show($id)
    {
        require_once base_path('vendor/tcpdf/tcpdf.php');
    
    // Fetch order details and customer information from the database based on the order ID
    // Replace the query with your actual SQL query to retrieve order details
    
    
    
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
        'variations.size as size',
        'users.id as user_id'

    )
    ->join('users', 'users.id', '=', 'orders.user_id')
    ->join('order_addresses', 'order_addresses.id', '=', 'orders.order_address_id')
    ->join('order_items', 'order_items.order_id', '=', 'orders.id')
    ->join('variations', 'variations.id', '=', 'order_items.variation_id')
    ->join('products', 'products.id', '=', 'variations.product_id')
    ->join('colors', 'colors.id', '=', 'variations.color_id')
    ->where('orders.id', $id)
    ->get();

    $customer = User::where('id', $orders[0]->user_id)->first();
    // إنشاء مثيل لمكتبة TCPDF
    $pdf = new \TCPDF();


    // قم بتحميل النموذج الخاص بملف PDF وقم بتمرير بيانات الطلب إليه
    $view = view('admin.order_pdf', compact('orders','customer'))->render();

    // إضافة النموذج المُرتجِع من الـ view إلى مكتبة TCPDF
    $pdf->AddPage();
    $pdf->writeHTML($view, true, false, true, false, '');

    // عرض ملف PDF في المتصفح
    $pdf->Output("order_{$orders[0]->user_id}.pdf", 'I');

    }

    // تعديل حالة الطلب
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('orders.create');
        }
    
        $order->status = $request->input('status');
        $order->save();
        return redirect()->route('orders.create');
    }

    // حذف طلب
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('orders.create');
    }
}
