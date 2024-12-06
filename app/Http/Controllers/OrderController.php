<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\Payment;
use App\Models\Refund;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json([
                "status" => false,
                "message" => "The cart doesn't exist."
            ]);
        }

        try {
            Stripe::setApiKey(config("services.stripe.secret"));
            $paymentIntent = PaymentIntent::create([
                "amount" => (int)(100 * $cart->total),
                "currency" => "EUR",
                "payment_method_types" => ["card"],
                "description" => "Carrito EasyShop",
                "shipping" => [
                    "name" => $request->name,
                    "address" => [
                        "line1" => $request->address,
                        "city" => $request->city,
                        "country" => "ES",
                        "postal_code" => $request->cp
                    ]
                ]
            ]);

            return response()->json([
                "status" => true,
                "key" => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Stripe Error: " . $e->getMessage(),
            ]);
        }
    }

    public function createOrder(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'payment_intent_id' => 'required|string',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'cp' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
        ]);

        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json([
                "status" => false,
                "message" => "The cart doesn't exist.",
            ]);
        }

        try {
            Stripe::setApiKey(config("services.stripe.secret"));
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status !== 'succeeded') {
                return response()->json([
                    "status" => false,
                    "message" => "Payment not confirmed.",
                ]);
            }

            $order = Order::create([
                "user_id" => $user->id,
                "total" => $cart->total,
                "status" => "paid"
            ]);

            foreach ($cart->products as $cartProduct) {
                $order->products()->attach($cartProduct->id, [
                    "quantity" => $cartProduct->pivot->quantity,
                    "price" => $cartProduct->pivot->price,
                ]);
            }

            $request->request->add(["order_id" => $order->id]);
            OrderAddress::create($request->all());

            Payment::create([
                "user_id" => $user->id,
                "order_id" => $order->id,
                "method" => "stripe",
                "amount" => $order->total,
                "status" => "success"
            ]);

            $cart->products()->detach();
            $cart->delete();

            return response()->json([
                "status" => true,
                "message" => "Order created successfully.",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error creating order: " . $e->getMessage(),
            ]);
        }
    }



    public function index()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)
               ->orderBy('created_at', 'desc')
               ->get();

        return response()->json(OrderResource::collection($orders));
    }

    public function refund($id)
    {

        $user = auth()->user();

        $order = Order::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json([
                "status" => false,
                "message" => "order not found"
            ]);
        }


        if ($order->status != "delivered" && $order->delivered_at->diffInDays(now()) > 15) {
            return response()->json([
                "status" => false,
                "message" => "refund period expired"
            ]);
        }

        Refund::create([
            "order_id" => $order->id
        ]);

        return response()->json([
            "status" => true,
            "message" => "Successfull"
        ]);
    }
}
