<?php

function get_ip_range( $cidr ) {

	list( $ip, $mask ) 	= explode( '/', $cidr );

	$mask_binary 			= str_repeat( "1", $mask ) . str_repeat( "0", 32 - $mask );
	$mask_binary_inv 	= str_repeat( "0", $mask ) . str_repeat( "1", 32 - $mask );

	$ip_int				= ip2long( $ip );
	$mask_int			= bindec( $mask_binary );
  $mask_int_inv	= bindec( $mask_binary_inv );

	$network 			= $ip_int & $mask_int;

	$start_int 		= $network + 1;
	$end_int 			= ( $network | $mask_int_inv ) - 1;

  return array( 'start' => long2ip( $start_int ), 'end' => long2ip( $end_int ) );
}

?>

<!doctype html>
<html lang="en">
	<head>
	  <title>CIDR app!</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	  <link href="/style.css" rel="stylesheet">
	</head>

  <body>

    <div class="container">
      <header class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">CIDR app</h3>
      </header>

      <main role="main">

        <div class="row">
          <div class="col-lg-12">
            <h1>CIDR to IP-Range calculator</h4>

				<form method="GET" action="">

					<input name="cidr" type="text" value="<?php print $_GET[ 'cidr' ] ?>" placeholder='e.g. 213.139.12.16/5'>
					<input type="submit" value="go!">

				</form>

          </div>

<?php if ( ! empty( $_GET[ 'cidr' ] ) ) {

	$range = get_ip_range( $_GET[ 'cidr' ] );

?>

		<div class="col-lg-12">
			<h1>Your Results</h1>

			<code><?php print $range[ 'start' ] ?></code> - <code><?php print $range[ 'end' ] ?></code>

		</div>

<?php } ?>

      </main>

      <footer class="footer">
        <p>&copy; 2017</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
