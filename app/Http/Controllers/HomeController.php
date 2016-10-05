<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PromoBox;
use App\Orders;
use App\OrderLines;
/*use App\Jobs\OrderShipped;*/
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$pb = PromoBox::all();
		//get item with heighest value		
		$max_qtys = PromoBox::select([DB::raw('MAX(qty) AS qty')])->first();
		//return whole data object
		$pre_select = PromoBox::where('qty','=',$max_qtys->qty)->first();
		
        return view('home', ['PromoBoxes' => $pb, 'max_qtys' => $max_qtys, 'pre_select' => $pre_select]);
    }
	
    public function post(Request $request)
    {
		
		/*$order = Orders::create(
			[
				'first_name' => $request->first_name,
				'surname' => $request->surname,
				'email' => $request->email,
				'address_line1' => $request->address_line1,
				'city' => $request->city,
				'post_code' => $request->post_code
			]
		);*/

		$validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
			'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:orders',
            'address_line1' => 'required|max:255',
			'city' => 'required|max:255',
			'post_code' => 'required|max:255',
        ]);
		
		
		
		if ($validator->fails()) {
			
			//dd($validator);
			
			return redirect('home')->withErrors($validator)->withInput();
			
			
		}
		else 
		{

		try{
			
			//save order
			$order = new Orders();
			$order->first_name = $request->first_name;
			$order->surname = $request->surname;
			$order->email = $request->email;
			$order->address_line1 = $request->address_line1;
			$order->city = $request->city;
			$order->post_code = $request->post_code;
			$order->save();
			
			//save order line
			$order_line = new OrderLines();
			$order_line->order_id = $order->id;
			$order_line->line_id = $order->id;
			$order_line->sku = $request->selectedPromoBox;
			$order_line->qty = 1;
			$order_line->save();
			
			//update pro box stock (minus one)
			$pb = PromoBox::where('sku','=',$order_line->sku)->first();
			$pb2 = PromoBox::where('sku','=',$order_line->sku)->update(['qty' => $pb->qty - 1]);
			
			//dd([$pb, $pb2]);
			
			//not sure how to queue mail - can use it normally
			//Mail::to($request->email)->queue(new OrderShipped($order));
	
		}
		catch (\Illuminate\Database\QueryException $e) {
			dd($e);
		}

			return redirect('home')->with('status', 'Order placced!');
		
		}
		
		
		
    }
}
