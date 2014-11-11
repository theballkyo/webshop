<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	{{$time}}
	<table style="width:100%; border-spacing:0px">
		@foreach($orders as $order)
		<tr>
			<td style="border: 1px solid black; padding:10px">
				{{$order['name']}} <br/>
				{{nl2br($order['address'])}} </br></br></br>
				ID : {{$order['id']}} <br/>
				@foreach($order['pd'] as $pd)
					{{$pd['detail'][1]['data']['text']}} : {{$pd['detail'][0]['data']['code']}} 
					x {{$pd['amount']}}
					<br/>
				@endforeach
			</td>
		</tr>
		@endforeach
	</table>
</body>
