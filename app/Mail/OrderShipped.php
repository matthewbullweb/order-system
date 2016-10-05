<?php

namespace App\Mail;

use App\Orders;
use App\OrderLines;
use App\PromoBox;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
	
    /**
     * The order instance.
     *
     * @var Order
     */
    protected $order, $order_line, $promoBox_desc;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Orders $order, OrderLines $order_line, String $promoBox)
    {
        $this->order = $order;
		$this->order_line = $order_line;
		$this->promoBox_desc = $promoBox;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('matthew@matthewbullweb.co.uk')
					->text('emails.orders.shipped')
					->with([
								'first_name' => $this->order->first_name,
								'surname' => $this->order->surname,
								'email' => $this->order->email,
								'address_line1' => $this->order->address_line1,
								'city' => $this->order->city,
								'post_code' => $this->order->post_code,
								'sku' =>  $this->order_line->sku,
								'desc' =>  $this->promoBox_desc,
								'qty' =>  $this->order_line->qty,
						   ]);
    }
}
