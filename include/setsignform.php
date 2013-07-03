<?php
	$optionStart = '<option value="';
	$optionStop = '</option>';
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$profileuser = get_userdata($user_id);
	$selectOptionsHTML = array();
	$selectOptionsText = array();
	$selectOptionsText["-1"] = '-- SELECT --';
	$selectOptionsText[1] = 'Aries (Mar 21 to Apr 20)';
	$selectOptionsText[2] = 'Taurus (Apr 21 to May 21)';
	$selectOptionsText[3] = 'Gemini (May 22 to Jun 21)';
	$selectOptionsText[4] = 'Cancer (Jun 22 to Jul 22)';
	$selectOptionsText[5] = 'Leo (Jul 23 to Aug 22)';
	$selectOptionsText[6] = 'Virgo (Aug 23 to Sep 22)';
	$selectOptionsText[7] = 'Libra (Sep 23 to Oct 22)';
	$selectOptionsText[8] = 'Scorpio (Oct 23 to Nov 21)';
	$selectOptionsText[9] = 'Sagittarius (Nov 22 to Dec 21)';
	$selectOptionsText[10] = 'Capricorn (Dec 22 to Jan 20)';
	$selectOptionsText[11] = 'Aquarius (Jan 21 to Feb 19)';
	$selectOptionsText[12] = 'Pisces (Feb 20 to Mar 20)';

	$isSetZodiacSign = isset( $profileuser->zodiacsign );
	
	foreach( $selectOptionsText as $key => $text )
	{
		$selectedOption = '';
		if( !$isSetZodiacSign && $key == -1 )
		{
			$selectedOption = ' selected="selected"';
		}
		if( $isSetZodiacSign && $key == $profileuser->zodiacsign )
			$selectedOption = ' selected="selected"';
		$selectOptionsHTML[] = $optionStart . $key . '"' . $selectedOption . '>' . $text . $optionStop;
	}
	$selectOptions = implode('', $selectOptionsHTML );
?>
<p><strong>Please select your zodiac sign</strong></p>
<form action="?setSign" method="post">
	<select name="zodiacSign">
		<?php echo $selectOptions; ?>
	</select>
	<input type="submit" value="Save My Sign" name="commit">
</form>
