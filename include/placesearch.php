<?php 
if( empty( $placeSearch ) )
				{
					echo '<p>Please enter coordinates and timezone for <strong>' . $reportdata['city'] . '</strong></p>';
							include(CHILD_TEMPLATEPATH."/include/confirmreportform.php");

				}
				else if( count( $placeSearch ) == 1 )
				{
					echo '<p>Please verify coordinates and timezone for <strong>' . $reportdata['city'] . '</strong></p>';
					$cityCoordinates = Atlas::getCoordinates( $placeSearch[0] );
					include(CHILD_TEMPLATEPATH."/include/confirmreportform.php");
				}
				else
				{
					?>
					<p>We found following matches for your birth place, please select an appropriate option</p>
					<form name="placeform" id="placeform" action="?ConfirmLocation" method="post">
					<input type="hidden" name="action" value="report" />
		<?php
					$html = array();
					foreach( $placeSearch as $place)
					{
						$cityCoordinates = Atlas::getCoordinates( $place );
						$html[] = '<p><label>';
						$html[] = '<input type="radio" name="place" value="' . $place['place_id'] . '" /> ';
						$html[] = $place['name'];
						$html[] = ' ( ';
						$html[] = $cityCoordinates['long']['degrees'] . '&deg;' . $cityCoordinates['long']['min'] . '&prime;' . $cityCoordinates['long']['direction'];
						$html[] = ' ';
						$html[] = $cityCoordinates['lat']['degrees'] . '&deg;' . $cityCoordinates['lat']['min'] . '&prime;' . $cityCoordinates['lat']['direction'];
						$html[] = ' )';
						$html[] = '</label></p>';
					}
					echo join('', $html);
		?>
					<p><label><input type="radio" name="place" value="NOTA" checked="checked" /> None of the Above</label></p>
					<p><input type="submit" name="wp-submit" id="submit" value="Verify Birth Details &raquo" /></p>
					</form>
			<?php
				} ?>