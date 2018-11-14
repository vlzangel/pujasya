<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

include __DIR__.'/stripe/init.php';

class Stripe_lib {

	function __construct(){
	}

	public function pagar($data){
		try {
			\Stripe\Stripe::setApiKey("sk_test_nXyRTchXmQL26YaA4gf3FVXm");

			$r = \Stripe\Charge::create([
			  "amount" => $data["monto"]*100,
			  "currency" => "usd",
			  "source" => $data["stripeToken"],
			  "description" => "Charge for ".$data["titular"]
			]);

			echo json_encode([
				"status" => $r->status
			]);
		} catch (\Stripe\Error\Card $e) {
		    echo json_encode([
				"status" => $e->getHttpStatus(),
				"error" => $e->getJsonBody()
			]);
		}
	}

	public function probar(){
		\Stripe\Stripe::setApiKey("sk_test_nXyRTchXmQL26YaA4gf3FVXm");

		$r = \Stripe\Charge::create([
		  "amount" => 100,
		  "currency" => "usd",
		  "source" => "tok_amex", // obtained with Stripe.js
		  "description" => "Charge for vlzangel@test.com"
		]);

		echo "<pre>";
			print_r($r);
		echo "</pre>";
	}
}