<?php
function get_breadcrumb( $btext = '' ) {
	global $bp;
	$url = explode( "?", $_SERVER["REQUEST_URI"] );
    $urlArray = explode("/", substr( $url[0], 1, -1 ) );

	$bc_template = array('href' => '', 'title' => '', 'text' => '' );

	$bc = array();
	$bc[0] = array();
	$bc[0]['href']  = get_bloginfo('url') . '/';
	$bc[0]['title'] = get_bloginfo('name') . ' Home';
	$bc[0]['text']  = 'Home';

	//array_shift($urlArray);

	if( empty( $urlArray ) )
		return ;

	if( bp_is_blog_page() )
	{
		switch( count( $urlArray ) )
		{
			case 1:
				if( $urlArray[0] == 'horoscope' || $urlArray[0] == 'sign-compatibility' )
					break;
				break;
			case 2:
				switch( $urlArray[0] )
				{
					case 'horoscope':
						$bc[1] = array();
						$bc[1]['href']  = $bc[0]['href'] . $urlArray[0] . '/';
						$bc[1]['title'] = get_bloginfo('name') . ' Horoscopes';
						$bc[1]['text']  = 'Horoscopes';
						break;
					case 'sign-compatibility':
						$bc[1] = array();
						$bc[1]['href']  = $bc[0]['href'] . $urlArray[0] . '/';
						$bc[1]['title'] = 'Zodiac Sign Compatibility';
						$bc[1]['text']  = 'Compatibility';
						
						$type = explode("-", $urlArray[1] );
						if( count( $type ) == 4 )
						{
							$bc[2] = array();
							$bc[2]['href']  = $bc[1]['href'] . $type[0] . '-' . $type[1] . '/';
							$bc[2]['title'] = ucfirst( $type[0] ) . ' ' . ucfirst( $type[1] ) . ' Compatibility';
							$bc[2]['text']  = ucfirst( $type[0] ) . ' ' . ucfirst( $type[1] );
							$bc[3] = array();
							$bc[3]['href']  = $bc[1]['href'] . $type[2] . '-' . $type[3] . '/';
							$bc[3]['title'] = ucfirst( $type[2] ) . ' ' . ucfirst( $type[3] ) . ' Compatibility';
							$bc[3]['text']  = ucfirst( $type[2] ) . ' ' . ucfirst( $type[3] );
						}
						else if( count( $type ) == 2 )
						{
							if( !in_array( $type[1], array('man', 'woman' ) ) )
							{
								$bc[2] = array();
								$bc[2]['href']  = $bc[1]['href'] . $type[0] . '/';
								$bc[2]['title'] = ucfirst( $type[0] ) . ' Compatibility';
								$bc[2]['text']  = ucfirst( $type[0] );
								
								if( $type[0] != $type[1] )
								{
									$bc[3] = array();
									$bc[3]['href']  = $bc[1]['href'] . $type[1] . '/';
									$bc[3]['title'] = ucfirst( $type[1] ) . ' Compatibility';
									$bc[3]['text']  = ucfirst( $type[1] );						
								}
							}
						
						}
						break;
				}
				break;
			case 3:
				$bc[1] = array();
				$bc[1]['href']  = $bc[0]['href'] . $urlArray[0] . '/';
				$bc[1]['title'] = get_bloginfo('name') . ' Horoscopes';
				$bc[1]['text']  = 'Horoscopes';
				
				$type = explode("-", $urlArray[1] );
				
				$bc[2] = array();
				$bc[2]['href']  = $bc[1]['href'] . $urlArray[1] . '/';
				$bc[2]['title'] = ucfirst( $urlArray[1] ) . ' Horoscopes';
				$bc[2]['text']  = ucfirst( $urlArray[1] );

				if( count( $type ) == 2 )
				{
					$bc[2]['title'] = ucfirst( $type[0] ) . ' ' . ucfirst( $type[1] ) . ' Horoscopes';
					$bc[2]['text']  = ucfirst( $type[0] ) . ' ' . ucfirst( $type[1] );
				}
				break;
		}
	}

	foreach( $bc as $count => $level)
	{
		if( empty( $level['href'] ) )
			echo $level['text'];
		else echo '<a href="' . $level['href'] . '" title="' . $level['title'] . '">' . $level['text'] . '</a>';
		if( $count + 1 != count( $bc ) )
			echo " &raquo; ";
	}

	if( empty($btext) && bp_is_blog_page() )
		wp_title();
	else echo $btext;
}
?>