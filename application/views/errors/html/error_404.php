<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>404</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<style type="text/css">
			/* helpers/align.css */
			
			.align {
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-orient: horizontal;
			-webkit-box-direction: normal;
			-ms-flex-direction: row;
			flex-direction: row;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			}
			
			/* helpers/animation.css */
			
			.animation {
			-webkit-animation-duration: 0.6s;
			animation-duration: 0.6s;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both;
			}
			
			.animation--reverse {
			-webkit-animation-direction: reverse;
			animation-direction: reverse;
			}
			
			/* helpers/animation-shake.css */
			
			@-webkit-keyframes shake-vertical {
			
			15%,
			45%,
			75% {
			-webkit-transform: translateY(-0.75rem);
            transform: translateY(-0.75rem);
			}
			
			30%,
			60% {
			-webkit-transform: translateY(0.75rem);
            transform: translateY(0.75rem);
			}
			
			}
			
			@keyframes shake-vertical {
			
			15%,
			45%,
			75% {
			-webkit-transform: translateY(-0.75rem);
            transform: translateY(-0.75rem);
			}
			
			30%,
			60% {
			-webkit-transform: translateY(0.75rem);
            transform: translateY(0.75rem);
			}
			
			}
			
			.animation--shake--vertical {
			-webkit-animation-name: shake-vertical;
			animation-name: shake-vertical;
			will-change: transform;
			}
			
			.grid {
			margin-left: auto;
			margin-right: auto;
			max-width: 640px;
			max-width: 40rem;
			width: 90%;
			}
			
			.grid__row {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin: -1.5%;
			}
			
			.grid__col {
			margin: 1.5%;
			-webkit-box-flex: 1;
			-ms-flex-positive: 1;
			flex-grow: 1;
			}
			
			/* layout/base.css */
			
			*,
			*::before,
			*::after {
			-webkit-box-sizing: inherit;
			box-sizing: inherit;
			}
			
			html {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 100%;
			height: 100%;
			}
			
			body {
			background-color: #f9f8f5;
			color: #353535;
			font-family: 'Roboto', sans-serif;
			font-size: 16px;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			margin: 0;
			min-height: 100%;
			}
			
			/* modules/box.css */
			
			.box {
			background-color: #fff;
			-webkit-box-shadow: 0 1rem 2rem rgba(0, 0, 0, .3);
			box-shadow: 0 1rem 2rem rgba(0, 0, 0, .3);
			font-size: 100px;
			font-size: 6.25rem;
			padding-bottom: 48px;
			padding-bottom: 3rem;
			padding-left: 32px;
			padding-left: 2rem;
			padding-right: 32px;
			padding-right: 2rem;
			padding-top: 48px;
			padding-top: 3rem;
			text-align: center;
			}
			
		</style>
	</head>
	
	<body class="align">
	
		<div class="grid">
			<div class="grid__row">
				<div class="grid__col">
					<div class="box animation animation--shake--vertical">4</div>
				</div>
				
				<div class="grid__col">
					<div class="box animation animation--reverse animation--shake--vertical">0</div>
				</div>
				
				<div class="grid__col">
					<div class="box animation animation--shake--vertical">4</div>
				</div>
			</div>
		</div>
	</body>
</html>
