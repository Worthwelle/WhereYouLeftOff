<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Where You Left Off</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
        
        <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        
        <style>
            .page-header {
                margin-bottom: 0px;
            }
            .page-header img {
                height: 90px;
            }
            .vertical-center {
                min-height: 75%;  /* Fallback for browsers do NOT support vh unit */
                min-height: 75vh; /* These two lines are counted as one :-)       */
                margin-bottom: 0px;
                display: flex;
                align-items: center;
            }
            .mailing {
                margin-top: 50px;
            }
			
			.social {
				margin-top: 50px;
			}
			
			.center-block {  
				width:325px;  
				padding:10px;  
				background-color:#eceadc;  
				color:#ec8007  
			}  

			
            @font-face {
				font-family: 'si';
				src: url('font/socicon.eot');
				src: url('font/socicon.eot?#iefix') format('embedded-opentype'),
					 url('font/socicon.woff') format('woff'),
					 url('font/socicon.ttf') format('truetype'),
					 url('font/socicon.svg#icomoonregular') format('svg');
				font-weight: normal;
				font-style: normal;

			}

			@media screen and (-webkit-min-device-pixel-ratio:0) {
				@font-face {
					font-family:si;
					src: url(font/socicon.svg) format(svg);
				}
			}

			.soc {
				overflow:hidden;
				margin:0; padding:0;
				list-style:none;
				text-align:center;
			}

			.soc li {
				display:inline-block;
				*display:inline;
				zoom:1;
			}

			.soc li a {
				font-family:si!important;
				font-style:normal;
				font-weight:400;
				-webkit-font-smoothing:antialiased;
				-moz-osx-font-smoothing:grayscale;
				-webkit-box-sizing:border-box;
				-moz-box-sizing:border-box;
				-ms-box-sizing:border-box;
				-o-box-sizing:border-box;
				box-sizing:border-box;

				overflow:hidden;
				text-decoration:none;
				text-align:center;
				display:block;
				position: relative;
				z-index: 1;
				width: 47px;
				height: 47px;
				line-height: 47px;
				font-size: 25px;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
				margin-right: 10px;
				color: #ffffff;
				background-color: none;
			}


			.soc-icon-last{
				margin:0 !important;
			}

			.soc-twitter {
				background-color: #4da7de;
			}
			.soc-twitter:before {
				content:'\e040';
			}
			.soc-instagram {
				background-color: #405de6;
			}
			.soc-instagram:before {
				content:'\e057';
			}
			.soc-tumblr {
				background-color: #45556c;
			}
			.soc-tumblr:before {
				content:'\e059';
			}
			.soc-facebook {
				background-color: #3e5b98;
			}
			.soc-facebook:before {
				content:'\e041';
			}
			.soc-github {
				background-color: #221e1b;
			}
			.soc-github:before {
				content:'\e030';
			}
        </style>
    </head>
        <div class="jumbotron vertical-center">
            <div class="container">
                <div class="page-header text-center">
                    <h1>Where You Left Off</h1>
                    <h1><img src="img/wylo_icons.png"></h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center"><h3>Getting back to the story</h3></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center"><h3>Coming Soon</h3></div>
                </div>
				<div class="row social">
					<ul class="soc">
						<!-- http://perfecticons.com/ -->
						<li><a class="soc-twitter" href="https://www.twitter.com/WhereYouLeftOff"></a></li>
						<li><a class="soc-instagram" href="https://www.instagram.com/WhereYouLeftOff"></a></li>
						<li><a class="soc-tumblr" href="http://blog.whereyouleftoff.com"></a></li>
						<li><a class="soc-facebook" href="https://www.facebook.com/WhereYouLeftOff"></a></li>
						<li><a class="soc-github soc-icon-last" href="https://github.com/Worthwelle/WhereYouLeftOff"></a></li>
					</ul>
				</div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="text-center text-muted"><small>Where You Left Off &copy; 2017 Worthwelle Design</small></p>
            </div>
        </footer>
    </body>
</html>
