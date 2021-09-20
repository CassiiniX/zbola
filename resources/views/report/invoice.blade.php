<!DOCTYPE html>
<html>
<head>
	<title>Laporan Invoice</title>
	<style>
		body{
			background: lightgray;
		}

		.box-content{
			width:630px;
			margin:auto;
			background:white;
			height:100%;
			padding:20px;
		}

		.date-content{
			margin-top:50px;
			margin-bottom:20px;
			font-size:15px;
			padding-left:20px;
		}

		.title-content{
			text-align:right;
			margin-bottom:20px;
		}

		.title-content > span{
			padding-right:50px;
			font-size:20px;
		}

		table{
			margin:auto
		}

		.td-content{
			padding-left:20px;
			padding-right:20px;
			padding-top:10px;
			padding-bottom:10px;
			font-size:15px;
			border-top:1px solid lightgray;
			border-bottom:1px solid lightgray;
		}

		.td-content-fill{
 			padding-left:20px;
 			padding-right:20px;
 			padding-top:10px;
 			padding-bottom:10px;
 			font-size:15px;
		}
		.content-not-found{
			text-align:center;
			font-size:19px;
			margin-top:30px;
			margin-bottom:200px;
		}

		.sub-total{
			font-size:15px;
			text-align:right;
			padding:10px;
			border-bottom:1px solid lightgray;
		}
		.sub-total-fill{
			text-align:center;
			padding:10px;
			font-size:20px;
		}

		.text-red{
			padding: 5px;
			color: red;
		}

		.text-yellow{
 			padding:5px;
 			color:yellow;
		}

		.text-green{
			padding: 5px;
			color: green;
		}

		.text-light-green{
			padding:5px;
			color:lightgreen;
		}

		.text-gray{
			padding:5px;
			color:gray;
		}
	</style>
</head>
<body >
	<div class="box-content">
		<div class="date-content">
			Laporan Tgl : {{$start_date}} - {{$end_date}}
		</div>

		<div class="title-content">		
			<span>
				Table Invoice
			</span>
		</div>

		<table>
			<tr>
				<td class="td-content">Id</td>
				<td class="td-content">Username</td>
				<td class="td-content">Alamat</td>
				<td class="td-content">Status</td>
				<td class="td-content">Total</td>
				<td class="td-content">Dibuat</td>
			</tr>

			@foreach($invoice as $item)
			<tr>
				<td class="td-content-fill">{{$item->id}}</td>
				<td class="td-content-fill">{{$item->user->username}}</td>
				<td class="td-content-fill">{{$item->product->address}}</td>
				<td class="td-content-fill">
					@if($item->status == "pending")
						<span class="text-yellow">
							Pending
						</span>
					@elseif($item->status == "payment")
					 	<span class="text-light-green">
					 		Pembayaran
					 	</span>
					@elseif($item->status == "waiting")
						<span class="text-yellow">
							Menunggu
						</span>
					@elseif($item->status == "running")
						<span class="text-yellow">
							Berjalan
						</span>
					@elseif($item->status == "compeleted")
						<span class="text-gray">
					 		Selesai
					 	</span>
					@elseif($item->status == "failed")
						<span class="text-red">
					 		Digagalkan
					 	</span>
					@elseif($item->status == "canceled")
						<span class="text-red">
					 		Dibatalkan
					 	</span>
					@elseif($item->status == "rejected")
						<span class="text-red">
					 		Ditolak
					 	</span>
					@endif
				</td>
				<td class="td-content-fill">
					Rp.{{number_format($item->total,2)}}
				</td>
				<td class="td-content-fill">
					{{$item->get_human_created_at}}
				</td>
			</tr>
			@endforeach

			@if(!count($invoice))
			<tr>
				<td colspan="6">
					<div class="content-not-found">
						Data invoice tidak ditemukan
					</div>
				</td>
			</tr>
			@endif

			<tr>
				<td colspan="4" class="sub-total">
					Sub Total :
				</td>
				<td colspan="2" class="sub-total-fill">
					Rp.{{number_format($sub_total,2)}}
				</td>
			</tr>
		</table>
	</div>

	<script>
		window.print();
	</script>
</body>
</html>