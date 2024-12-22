<?php

namespace App\Http\Controllers;

use App\Models\location;
use App\Models\order_items;
use App\Models\orders;
use App\Models\User;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrdersController extends Controller
{
    public function index(Request $request) {
        $input = $request->all();
    
        // Validate the input
        if (!isset($input['id']) || empty($input['id'])) {
            return response()->json(['message' => 'User ID is required.'], 400);
        }
    
        $user = User::find($input['id']);
    
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $orders = orders::with(['user', 'location'])
            ->when($user->role_id !== 1, function ($query) use ($user) {
                return $query->where('user_id', '=', $user->id);
            })
            ->paginate(10);
    
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'There are no orders.'], 404);
        }
    
        foreach ($orders as $order) {
            if (isset($order->items) && is_iterable($order->items)) {
                foreach ($order->items as $order_item) {
                    $product = products::where('id', $order_item->product_id)->pluck('name')->first();
                    $order_item->product_name = $product;
                }
            }
        }
    
        return response()->json($orders, 200);
    }
    
    
    

    public function search(Request $request)
    {
        $input = $request->all();
    
        // Validate the input
        if (!isset($input['id']) || empty($input['id'])) {
            return response()->json(['message' => 'User ID is required.'], 400);
        }
    
        $user = User::find($input['id']);
    
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $orders = orders::with(['user', 'location', 'items'])
            ->where('status', 'LIKE', '%' . $input['searchTerm'] . '%')
            ->when($user->role_id !== 1, function ($query) use ($user) {
                return $query->where('user_id', '=', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->paginate(20);
    
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders match the search criteria.'], 404);
        }
    
        return response()->json($orders, 200);
    }
    
    public function orders()
    {
        $orders = orders::when(Auth::user()->role_id !== 1, function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        })
        ->orderBy('created_at','asc')->get();

        return response()->json($orders, 200);
    }

    public function show($id) {
        $order = orders::find($id);
        return response()->json($order, 200);
    }

    


    public function store(Request $request) {

        $input = $request->all();

        $user = User::where('email', '=', $input['email'])->first();

        if(!$user) {
            $user = User::create([
                'name'=>$input['name'],
                'phone'=>$input['phone'],
                'email'=>$input['email'],
                'role_id'=> 2,
                'password' => bcrypt($input['password']),
            ]);
        }

        $location = location::create([
            'user_id'=>$user->id, 
            'area'=>$input['area'], 
            'street'=>$input['street'], 
            'building'=>$input['building'],
        ]);

        $request->validate([
            "order_items" => "required",
            "total_price" => "required"
        ]);

        $order = new orders();
        $order->user_id = $user->id;
        $order->location_id = $location->id;
        $order->total_price = $input['total_price'];
        $order->date_of_delivery = Carbon::now()->addDays(3)->toDateString();
        $order->save();

        foreach ($input['order_items'] as $order_item) {
            $item = new order_items();
            $item->order_id = $order->id;
            $item->price = $order_item['price'];
            $item->product_id = $order_item['_id'];
            $item->quantity = $order_item['quantity'];
            $item->save();

            $product = products::where('id', $order_item['_id'])->first();
            $product->stock -= $order_item['quantity'];
            $product->save();
        }

        return response()->json(['message' => 'order added'],201);
    }

    public function get_order_items($id) {
        $order_items = order_items::with(['product', 'order'])->where('order_id', $id)->get();
        
        if ($order_items) {
            foreach ($order_items as $order_item) {
                $product = products::where('id', $order_item->product_id)->pluck('name');
                $order_item->product_name = $product;
            }
            return response()->json($order_items);
        } else {
            return response()->json("No items found");
        }
    }

    public function get_user_orders($id) {
        $orders = orders::where('user_id', $id)
            ->with('items')
            ->latest()
            ->get();

        if ($orders) {
            foreach ($orders as $order) {
                foreach ($order->items as $order_item) {
                    $product = products::where('id', $order_item->product_id)->pluck('name');
                    $order_item->product_name = $product;
                }
            }
            return response()->json($orders);
        } else {
            return response()->json("No orders found for this user");
        }
    }

    public function change_order_status($id, Request $request) {

        
        $order = Orders::find($id);
        
        if ($order) {
            try {
                $order->status = $request->status; // Direct assignment instead of update method
                $order->save();
                
                return response()->json([
                    'message' => "Status changed successfully",
                    'status' => $order->status
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => "Invalid status value",
                    'error' => $e->getMessage()
                ], 422);
            }
        }
        
        return response()->json([
            'message' => "Order was not found"
        ], 404);
    }
}
