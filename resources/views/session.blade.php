<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h2>Hello World</h2><br>
	@if(session('status'))
		{{session('status')}}
	@else
		<p>No session</p>
	@endif
	<br>
	<a href="{{url('/setSingle')}}">
		<button>set single session</button>
	</a>
	<a href="{{url('getSingle')}}">
		<button>get single session</button>
	</a>
	<a href="{{url('deleteSession')}}">
		<button>delete session</button>
	</a>
	<br><br>
    <a href="{{url('setMultiple')}}">
  		<button>set Multiple session</button>
    </a>
    <a href="{{url('getMultiple')}}">
  		<button>get Multiple session</button>
    </a>
</body>
</html>