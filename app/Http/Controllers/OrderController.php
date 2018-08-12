<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Order;
use App\Product;
use App\ProductType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('productTypes')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with('productTypes')->get();
        return view('orders.create', compact('products'));
    }

    /**
     * calculate the total price of order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTotalPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productTypes' => 'bail|required',
        ]);

        $price = 0;

        if (!$validator->fails()) {
            foreach ($request->productTypes as $pt) {
                $productType = ProductType::findOrFail($pt['name']);
                $price += $productType->price * intval($pt['value']);
            }
        }
        return number_format($price);
    }

    public function ordersChart($type)
    {
        $chart = new SampleChart;
        if ($type == 'today') {
            $chart = $this->todayChart($chart);
        } else if ($type == 'month') {
            $chart = $this->monthChart($chart);
        }

        return view('orders.chart', compact('chart', 'type'));
    }

    private function todayChart($chart)
    {
        $data = [];
        $chart->labels([
            '04:00 - 00:00',
            '08:00 - 04:00',
            '12:00 - 08:00',
            '16:00 - 12:00',
            '20:00 - 16:00',
            '24:00 - 20:00',
        ]);

        $chartLabelDates = [
            [date('Y-m-d H:i:s', strtotime('today 00:00')), date('Y-m-d H:i:s', strtotime('today 04:00'))],
            [date('Y-m-d H:i:s', strtotime('today 04:00')), date('Y-m-d H:i:s', strtotime('today 08:00'))],
            [date('Y-m-d H:i:s', strtotime('today 08:00')), date('Y-m-d H:i:s', strtotime('today 12:00'))],
            [date('Y-m-d H:i:s', strtotime('today 12:00')), date('Y-m-d H:i:s', strtotime('today 16:00'))],
            [date('Y-m-d H:i:s', strtotime('today 16:00')), date('Y-m-d H:i:s', strtotime('today 20:00'))],
            [date('Y-m-d H:i:s', strtotime('today 20:00')), date('Y-m-d H:i:s', strtotime('today 24:00'))],
        ];

        foreach ($chartLabelDates as $key => $chartData) {
            $order = Order::whereBetween('created_at', $chartData)->get();
            $price = 0;
            foreach ($order as $o) {
                $price += $o->orderTotalPrice();
            }
            $data[] = $price;
        }

        $chart->dataset('فروش امروز', 'line', $data)
            ->options([
                'borderColor' => 'rgba(25, 112, 62, 0.8)',
                'backgroundColor' => 'rgba(46, 204, 113, 0.3)',
            ]);

        return $chart;
    }

    private function monthChart($chart)
    {
        $data = [];
        $labels = [];

        $jalaliDay = intval(jdate()->format('d'));

        if ($jalaliDay > 1) {
            for ($day = 0; $day <= $jalaliDay; $day++) {
                if ($day != 0) {
                    $labels[] = $day;
                }

                // $data[] = Order::whereDate('created_at', '=', Carbon::now()->subDays($day)->format('Y-m-d'))->count();
                $order = Order::whereDate('created_at', '=', Carbon::now()->subDays($day)->format('Y-m-d'))->get();
                $price = 0;
                foreach ($order as $o) {
                    $price += $o->orderTotalPrice();
                }
                $data[] = $price;
            }
        }

        $chart->labels(array_reverse($labels));

        $chart->dataset('فروش ماه جاری', 'line', $data)
            ->options([
                'borderColor' => 'rgba(25, 112, 62, 0.8)',
                'backgroundColor' => 'rgba(46, 204, 113, 0.3)',
            ]);

        return $chart;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'productTypes' => 'bail|required',
        ]);

        $makeOrder = false;

        foreach ($request->productTypes as $pt) {
            if ($pt['value'] > 0) {
                $makeOrder = true;
            }
        }

        if ($makeOrder) {
            $order = new Order;
            $order->save();

            foreach ($request->productTypes as $pt) {
                if ($pt['value'] > 0) {
                    $productType = ProductType::findOrFail($pt['name']);
                    $order->productTypes()->attach($productType->id, ['amount' => $pt['value']]);
                }
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }
}
