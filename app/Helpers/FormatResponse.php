<?php

namespace App\Helpers;

class FormatResponse{
	public static function successBack($message = ""){
		if(empty($message)){
			return back();
		}

		return back()->with([
			"comeback" => [
				"message" => "success",
				"success" => $message
			]
		]);
	}

	public static function success($redirect,$message = ""){
		if(empty($message)){
			return redirect()->to($redirect);
		}

		return redirect()->to($redirect)->with([
            "comeback" => [
                "message" => "success",
                "success" => $message,
            ]
        ]);
	}

	public static function failed($error){
		$response = [
			"message" => "failed"
		];

		if($error->getCode() != 422){
			\Log::channel("coex")->info($error->getMessage());
			$response["failed"] = "Terjadi Kesalahan";
		}else{
			$response["failed"] = $error->getMessage();
		}

		return back()
		    ->withInput()
			->with([
	            "comeback" => $response             
        	]);
	}	
}