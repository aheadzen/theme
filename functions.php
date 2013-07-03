<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

include_once('widgets_fun.php');
 
add_theme_support( 'woocommerce' );

define('CHILD_TEMPLATEPATH',get_stylesheet_directory());

//includes/compatnav.php
define('SIGN_COMPATIBILITY',1245); //442

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

	if( bp_is_group() )
	{
		$bc_template['href'] = get_linkTo( BP_GROUPS_SLUG . '/' );
		$bc_template['title'] = 'Groups Directory';
		$bc_template['text'] = 'Groups';
		$bc[] = $bc_template;

		$bc_template['href'] = bp_get_group_permalink();
		$bc_template['title'] = bp_get_group_name();
		$bc_template['text'] = bp_get_group_name();

		if( bp_is_group_home() )
			$bc_template['href'] = '';

		$bc[] = $bc_template;

		if( bp_is_group_forum() )
		{
			$bc_template['href'] = bp_get_forum_permalink();
			if( !bp_is_group_forum_topic() )
				$bc_template['href'] = '';
			$bc_template['title'] = 'Group Forum';
			$bc_template['text'] = 'Forum';
			$bc[] = $bc_template;
		
			if( bp_is_group_forum_topic() )
			{
				$bc_template['href'] = '';
				$bc_template['title'] = '';
				$bc_template['text'] = bp_get_the_topic_title();
				$bc[] = $bc_template;
			}
		} else if( bp_is_group_members() )
		{
			$bc_template['href'] = '';
			$bc_template['title'] = '';
			$bc_template['text'] = 'Members';
			$bc[] = $bc_template;
		}
		$btext = '';
	} else if( bp_is_user() )
	{
		$btext = '';

		$bc_template['href'] = get_linkTo( BP_MEMBERS_SLUG . '/' );
		$bc_template['title'] = 'Members Directory';
		$bc_template['text'] = 'Members';
		$bc[] = $bc_template;

		$bc_template['href'] = bp_get_displayed_user_link();
		$bc_template['title'] = bp_get_displayed_user_fullname();
		$bc_template['text'] = bp_get_displayed_user_fullname();

		if( bp_is_user_profile() )
			$bc_template['href'] = '';

		$bc[] = $bc_template;

		if( bp_is_user_activity() )
		{
			if( bp_is_current_action( 'just-me' ) )
				$bc_template['href'] = '';
			else $bc_template['href'] = bp_get_displayed_user_link() . BP_ACTIVITY_SLUG . '/';
			$bc_template['title'] = 'Activity';
			$bc_template['text'] = 'Activity';
			$bc[] = $bc_template;
		
			if( !bp_is_current_action( 'just-me' ) )
			{
				$bc_template['href'] = '';
				$bc_template['title'] = '';
				$bc_template['text'] = ucfirst( $bp->current_action );
				$bc[] = $bc_template;
			}
		} else if( bp_is_user_groups() )
		{
			$bc_template['href'] = '';
			$bc_template['title'] = '';
			$bc_template['text'] = 'Groups';
			$bc[] = $bc_template;
		} else if( bp_is_user_forums() )
		{
			$bc_template['href'] = '';
			$bc_template['title'] = '';
			$bc_template['text'] = 'Forums';
			$bc[] = $bc_template;
		} else if( bp_is_user_settings() )
		{
			if( bp_is_user_settings_general() )
				$bc_template['href'] = '';
			else $bc_template['href'] = bp_get_displayed_user_link() . BP_SETTINGS_SLUG . '/';
			$bc_template['title'] = 'Account Settings';
			$bc_template['text'] = 'Settings';
			$bc[] = $bc_template;

			if( !bp_is_user_settings_general() )
			{
				$bc_template['href'] = '';
				$bc_template['title'] = '';
				$bc_template['text'] = ucfirst( $bp->current_action );
				$bc[] = $bc_template;
			}
		}
	} else if ( bp_is_directory() ) {
		$btext = '';
		$bc_template['href'] = '';
		$bc_template['title'] = '';

		if ( !bp_current_component() )
			$bc_template['text'] = sprintf( __( '%s Directory', 'buddypress' ), bp_get_name_from_root_slug( bp_members_slug() ) );
		else
			$bc_template['text'] = sprintf( __( '%s Directory', 'buddypress' ), bp_get_name_from_root_slug( bp_get_root_slug() ) );

		$bc[] = $bc_template;
	}

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

function pagetype($number)
{
	switch($number)
	{
		case 68:
		case 127:
		case 70:
		case 69:
		case 25:
		case 153:
		case 167:
		case 166:
		case 190:
		case 239:
		case 214:
		case 202:
		case 226:
		case 313:
		case 342:
		case 281:
		case 301:
		case 293:
		case 324:
		case 351:
		case 273:
			return "aquarius";
			break;
		case 28:
		case 128:
		case 30:
		case 122:
		case 15:
		case 143:
		case 169:
		case 156:
		case 180:
		case 229:
		case 204:
		case 192:
		case 216:
		case 314:
		case 343:
		case 283:
		case 302:
		case 294:
		case 325:
		case 334:
		case 263:
			return "aries";
			break;
		case 40:
		case 129:
		case 42:
		case 41:
		case 18:
		case 146:
		case 172:
		case 159:
		case 183:
		case 232:
		case 207:
		case 195:
		case 219:
		case 315:
		case 344:
		case 282:
		case 303:
		case 295:
		case 326:
		case 335:
		case 266:
			return "cancer";
			break;
		case 36:
		case 131:
		case 38:
		case 37:
		case 17:
		case 171:
		case 145:
		case 158:
		case 182:
		case 231:
		case 206:
		case 194:
		case 218:
		case 316:
		case 345:
		case 284:
		case 305:
		case 298:
		case 354:
		case 337:
		case 265:
			return "gemini";
			break;
		case 43:
		case 132:
		case 46:
		case 45:
		case 19:
		case 147:
		case 173:
		case 160:
		case 184:
		case 233:
		case 208:
		case 196:
		case 220:
		case 317:
		case 292:
		case 306:
		case 338:
		case 328:
		case 357:
		case 356:
		case 274:
			return "leo";
			break;
		case 48:
		case 138:
		case 50:
		case 49:
		case 20:
		case 148:
		case 174:
		case 161:
		case 185:
		case 234:
		case 209:
		case 197:
		case 221:
		case 320:
		case 288:
		case 308:
		case 330:
		case 359:
		case 360:
		case 361:
		case 267:
			return "virgo";
			break;
		case 34:
		case 137:
		case 33:
		case 32:
		case 16:
		case 144:
		case 170:
		case 157:
		case 181:
		case 230:
		case 205:
		case 193:
		case 217:
		case 323:
		case 349:
		case 291:
		case 311:
		case 299:
		case 331:
		case 362:
		case 264:
			return "taurus";
			break;
		case 72:
		case 134:
		case 74:
		case 73:
		case 26:
		case 154:
		case 168:
		case 155:
		case 191:
		case 240:
		case 215:
		case 203:
		case 227:
		case 363:
		case 348:
		case 287:
		case 309:
		case 297:
		case 333:
		case 364:
		case 272:
			return "pisces";
			break;
		case 64:
		case 130:
		case 65:
		case 66:
		case 24:
		case 152:
		case 178:
		case 165:
		case 189:
		case 238:
		case 213:
		case 201:
		case 225:
		case 318:
		case 352:
		case 286:
		case 300:
		case 304:
		case 327:
		case 336:
		case 271:
			return "capricorn";
			break;
		case 56:
		case 136:
		case 58:
		case 57:
		case 22:
		case 150:
		case 176:
		case 163:
		case 187:
		case 236:
		case 211:
		case 199:
		case 223:
		case 322:
		case 350:
		case 289:
		case 310:
		case 341:
		case 365:
		case 366:
		case 269:
			return "scorpio";
			break;
		case 52:
		case 133:
		case 54:
		case 123:
		case 21:
		case 149:
		case 175:
		case 162:
		case 186:
		case 235:
		case 210:
		case 198:
		case 222:
		case 319:
		case 347:
		case 285:
		case 307:
		case 339:
		case 329:
		case 355:
		case 268:
			return "libra";
			break;
		case 60:
		case 135:
		case 62:
		case 61:
		case 23:
		case 151:
		case 177:
		case 164:
		case 188:
		case 237:
		case 212:
		case 200:
		case 224:
		case 321:
		case 346:
		case 290:
		case 312:
		case 340:
		case 296:
		case 332:
		case 270:
			return "sagittarius";
			break;
	}
}
function pagecategory($number)
{
	switch($number)
	{
		case 70:
		case 30:
		case 42:
		case 38:
		case 46:
		case 50:
		case 33:
		case 74:
		case 65:
		case 58:
		case 54:
		case 62:
		case 140:
			return "daily";
			break;
		case 69:
		case 122:
		case 41:
		case 37:
		case 45:
		case 49:
		case 32:
		case 73:
		case 66:
		case 57:
		case 123:
		case 61:
		case 11:
			return "weekly";
			break;
		case 68:
		case 28:
		case 40:
		case 36:
		case 43:
		case 48:
		case 34:
		case 72:
		case 64:
		case 56:
		case 52:
		case 60:
		case 139:
			return "monthly";
			break;
		case 127:
		case 128:
		case 129:
		case 131:
		case 132:
		case 138:
		case 137:
		case 134:
		case 130:
		case 136:
		case 133:
		case 135:
		case 126:
			return "yearly";
			break;
		case 15:
		case 16:
		case 17:
		case 18:
		case 19:
		case 20:
		case 21:
		case 22:
		case 23:
		case 24:
		case 25:
		case 26:
		case 241:
			return "KY";
			break;
		case 192:
		case 193:
		case 194:
		case 195:
		case 196:
		case 197:
		case 198:
		case 199:
		case 200:
		case 201:
		case 202:
		case 203:
		case 244:
			return "marriage";
			break;
		case 204:
		case 205:
		case 206:
		case 207:
		case 208:
		case 209:
		case 210:
		case 211:
		case 212:
		case 213:
		case 214:
		case 215:
		case 243:
			return "love";
			break;
		case 216:
		case 217:
		case 218:
		case 219:
		case 220:
		case 221:
		case 222:
		case 223:
		case 224:
		case 225:
		case 226:
		case 227:
		case 242:
			return "personality";
			break;
		case 229:
		case 230:
		case 231:
		case 232:
		case 233:
		case 234:
		case 235:
		case 236:
		case 237:
		case 238:
		case 239:
		case 240:
		case 249:
			return "friendship";
			break;
		case 180:
		case 181:
		case 182:
		case 183:
		case 184:
		case 185:
		case 186:
		case 187:
		case 188:
		case 189:
		case 190:
		case 191:
		case 245:
			return "career";
			break;
		case 155:
		case 156:
		case 157:
		case 158:
		case 159:
		case 160:
		case 161:
		case 162:
		case 163:
		case 164:
		case 165:
		case 166:
		case 246:
			return "teen";
			break;
		case 167:
		case 168:
		case 169:
		case 170:
		case 171:
		case 172:
		case 173:
		case 174:
		case 175:
		case 176:
		case 177:
		case 178:
		case 247:
			return "daily-love";
			break;
		case 263:
		case 264:
		case 265:
		case 266:
		case 267:
		case 268:
		case 269:
		case 270:
		case 271:
		case 272:
		case 273:
		case 274:
		case 280:
			return "profile";
			break;
		case 313:
		case 314:
		case 315:
		case 316:
		case 317:
		case 318:
		case 319:
		case 320:
		case 321:
		case 322:
		case 323:
		case 363:
		case 372:
		case 3753:
			return "yearly-career";
			break;
		case 342:
		case 343:
		case 344:
		case 345:
		case 346:
		case 347:
		case 348:
		case 349:
		case 350:
		case 359:
		case 352:
		case 356:
		case 371:
			return "yearly-love";
			break;
		case 334:
		case 335:
		case 336:
		case 337:
		case 338:
		case 339:
		case 340:
		case 341:
		case 360:
		case 364:
		case 362:
		case 351:
		case 370:
			return "monthly-love";
			break;
		case 301:
		case 302:
		case 303:
		case 304:
		case 305:
		case 306:
		case 307:
		case 308:
		case 309:
		case 310:
		case 311:
		case 312:
		case 3701:
			return "monthly-career";
			break;
		case 293:
		case 294:
		case 295:
		case 296:
		case 297:
		case 298:
		case 299:
		case 300:
		case 361:
		case 365:
		case 355:
		case 357:
		case 3727:
			return "weekly-career";
			break;
		case 324:
		case 325:
		case 326:
		case 327:
		case 328:
		case 329:
		case 330:
		case 331:
		case 332:
		case 333:
		case 354:
		case 366:
		case 369:
			return "weekly-love";
			break;
		case 281:
		case 282:
		case 283:
		case 284:
		case 285:
		case 286:
		case 287:
		case 288:
		case 289:
		case 290:
		case 291:
		case 292:
		case 3779:
			return "daily-career";
			break;
	}
}
function noads($number)
{
	$pageList = array( 110, 2834, 105, 101, 102, 104, 103, 582, 4142, 4138 );
	if( in_array( $number, $pageList ) || is_404() )
//		if($number > 1)
		return true;
	else return false;
}

function isGoalPage( $number )
{
	$pageList = array( 4142, 4138, 2834, 4089, 4122, 4056 );

	if( in_array( $number, $pageList ) )
		return true;
	else return false;
}

function antigender($gender = null)
{
	if(!empty($gender))
	{
		if($gender == 'man')
			return 'woman';
		else if($gender == 'woman')
			return 'man';
	}
}

add_filter( 'wp_mail_from_name', 'emailFromName', 20 );
add_filter( 'wp_redirect', 'myFunc', 20 );
add_filter( 'login_redirect', 'myLogin', 20, 3 );
add_filter( 'login_url', 'myLoginURL', 20, 2 );
//add_filter( 'show_admin_bar', '__return_false' );
add_filter( 'get_comment_author', 'my_get_comment_author' );
add_filter( 'bp_core_get_user_displayname', 'my_get_user_displayname', 20, 2 );

function my_get_user_displayname( $fullname, $user_id )
{
	$fullname = my_displayed_user_name( $user_id );
	
	if ( !empty( $fullname ) )
		wp_cache_set( 'bp_user_fullname_' . $user_id, $fullname, 'bp' );

	return $fullname;
}
function my_get_comment_author( $author = '' )
{
	$comment_ID = 0;
	$comment = get_comment( $comment_ID );

	if ( !empty( $comment->user_id ) )
		$author=my_displayed_user_name( $comment->user_id );

	return $author;
}

function my_page_title( $title )
{
	global $bp, $post, $wp_query, $current_blog;

	// Displayed user
	if ( !empty( $bp->displayed_user->fullname ) && !is_404() ) {

		$curr_action = bp_current_action();
		$skip_action = array( 'public', 'just-me', 'my-groups');
		if( !empty( $curr_action ) && !in_array( $curr_action, $skip_action ) )
			$title_action = ' &raquo; ' . ucwords(bp_current_action());
		
		if( bp_is_activity_component() && isset( $_REQUEST['acpage'] ) && intval( $_REQUEST['acpage'] ) != 1 )
		{
			$title_page = ' | Page ' . intval( $_REQUEST['acpage'] );
		}
		// translators: "displayed user's name | canonicalised component name"
		$title = strip_tags( sprintf( __( '%1$s | %2$s%4$s%3$s', 'buddypress' ), bp_get_displayed_user_fullname(), ucwords( bp_current_component() ), $title_action, $title_page ) );

	// A single group
	} elseif ( bp_is_active( 'groups' ) && !empty( $bp->groups->current_group ) && !empty( $bp->bp_options_nav[$bp->groups->current_group->slug] ) ) {
	
		$subnav = isset( $bp->bp_options_nav[$bp->groups->current_group->slug][$bp->current_action]['name'] ) ? $bp->bp_options_nav[$bp->groups->current_group->slug][$bp->current_action]['name'] : '';

		if ( bp_is_current_action( 'forum' ) && bp_is_action_variable( 'topic', 0 ) )
		{
			if ( function_exists('bp_has_forum_topic_posts') && bp_has_forum_topic_posts() )
			{
				$title = bp_get_the_topic_title() . " | ";
				$subnav = '';
				if ( isset( $_REQUEST['topic_page'] ) && intval( $_REQUEST['topic_page'] ) != 1 )
				{
					$title .= 'Page ' . intval( $_REQUEST['topic_page'] ) . ' | ';
				}

			}
		}
		else $title = '';

		$sep1 = ' | ';

		if( $subnav == 'Home' || empty( $subnav ) )
		{
			$sep1 = '';
			$subnav = '';
		}

		if( bp_is_group_forum() && isset( $_REQUEST['p'] ) && intval( $_REQUEST['p'] ) != 1 )
		{
			$title_page = '| Page ' . intval( $_REQUEST['p'] );
		}

		// translators: "group name | group nav section name"
		$title .= sprintf( __( '%1$s%3$s%2$s%4$s', 'buddypress' ), $bp->bp_options_title, $subnav, $sep1 , $title_page);

	// A single item from a component other than groups
	} elseif ( bp_is_single_item() ) {
		// translators: "component item name | component nav section name | root component name"
		$title = sprintf( __( '%1$s | %2$s | %3$s', 'buddypress' ), $bp->bp_options_title, $bp->bp_options_nav[$bp->current_item][$bp->current_action]['name'], bp_get_name_from_root_slug( bp_get_root_slug() ) );

	// An index or directory
	}
	else if( bp_is_activity_component() && isset( $_REQUEST['acpage'] ) && intval( $_REQUEST['acpage'] ) != 1 )
	{
		$title .= 'Page ' . intval( $_REQUEST['acpage'] );
	}
	else if( bp_is_members_component() && isset( $_REQUEST['upage'] ) && intval( $_REQUEST['upage'] ) != 1 )
	{
		$title .= 'Page ' . intval( $_REQUEST['upage'] );
	}
	else if( bp_is_forums_component() && isset( $_REQUEST['p'] ) && intval( $_REQUEST['p'] ) != 1 )
	{
		$title .= 'Page ' . intval( $_REQUEST['p'] );
	}
	else return $title;

	// Some BP nav items contain item counts. Remove them
	$title = preg_replace( '|<span>[0-9]+</span>|', '', $title );

	return $title;
}

add_filter( 'bp_modify_page_title', 'my_page_title' );

function myLoginURL($loc, $redirect)
{
	$loc = site_url('login/');
	if ( !empty($redirect) ) {
		$loc = add_query_arg('redirect_to', urlencode($redirect), $loc);
	}

	return $loc;
}
function emailFromName($name)
{
	return 'Ask-Oracle.com';
}

function registrationURL( $redirect )
{
	$loc = site_url('registration/');
	if ( !empty($redirect) ) {
		$loc = add_query_arg('redirect_to', urlencode($redirect), $loc);
	}
	return $loc;
}
function birthChartURL( $redirect )
{
	$loc = site_url('birth-chart/');
	if ( !empty($redirect) ) {
		$loc = add_query_arg('redirect_to', urlencode($redirect), $loc);
	}
	return $loc;
}

function myLogin($loc, $loc2, $user)
{
	$loc = 'home/';

	return $loc;
}

function setSign($user_id)
{
	if( isset( $_GET['setSign'] ) && isset( $_POST['zodiacSign'] ) && isset( $_POST['commit'] ) )
		$sign = $_POST['zodiacSign'];
	else return ;

	settype($sign, "integer");

	if( !empty($sign) && !empty($user_id) && $sign == -1 )
	{
		delete_usermeta( $user_id, 'zodiacsign' );
	}

	if( !empty($sign) && !empty($user_id) && $sign >=1 && $sign <=12 )
	{
		update_usermeta( $user_id, 'zodiacsign', $sign);
		unset( $_GET, $_POST );
	}
}

function myFunc($loc)
{
	if( $loc === 'wp-login.php?checkemail=registered' )
	{
		$user_login = $_POST['user_login'];
		$user = get_userdatabylogin($user_login);
		$user_id = $user->ID;
		wp_set_current_user($user_id, $user_login);
		wp_set_auth_cookie($user_id);
		do_action('wp_login', $user_login);
		$loc = 'home/';
	}
/*	else if(  $loc === 'wp-login.php?loggedout=true' )
	{
		$loc = '/';
	}
*/	else if(  $loc === 'profile.php?updated=true&wp_http_referer' )
	{
		$loc = 'settings/';
	}
	return $loc;
}

function homeURL()
{
	if( is_user_logged_in() )
		return site_url('home/');
	else return get_settings('home');
}

function linkTO($path = '')
{
	echo get_linkTO( $path );
}
function get_linkTO($path = '')
{
	return site_url( $path );
}

function getZodiacSignByNumber($num)
{
	$signByNumber = array(1 => 'aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn', 'aquarius', 'pisces');
	return $signByNumber[$num];
}

function pageComments( $comment, $args, $depth )
{
	$GLOBALS['comment'] = $comment;
	?>

<div id="comment-<?php comment_ID(); ?>">
  <div id="commentlist"> <strong><cite id="comments">
    <?php my_comment_author_link() ?>
    </cite></strong> (<?php echo my_comment_author_user_reply($comment->user_id); ?>) : <a href="#comment-<?php comment_ID(); ?>" class="alignright comment-permalink" title="Permanent Link to this Comment">
    <?php comment_date('F jS, Y') ?>
    </a>
    <?php if ($comment->comment_approved == '0') : ?>
    <em>Your comment is awaiting moderation.</em>
    <?php endif;	?>
    <div class="comment-avatar">
      <?php my_comment_author_avatar( $comment ); ?>
    </div>
    <div class="comment-content">
      <blockquote>
        <?php comment_text(); ?>
      </blockquote>
      <?php my_comment_author_reply_link($comment->user_id); ?>
    </div>
    <div class="clearboth"></div>
  </div>
</div>
<?php
		return $comment;
		}
function my_comment_author_avatar( $comment )
{
	if( empty( $comment->user_id ) )
		$img = get_avatar( $comment, bp_core_avatar_thumb_width() );
	else
		$img = bp_core_fetch_avatar( array( 'item_id' => $comment->user_id,  ) );

	$comment_ID = 0;
	$url    = get_comment_author_url( $comment_ID );
	$author = $img;

	if ( empty( $url ) || 'http://' == $url )
		$return = $author;
	else
		$return = "<a href='$url' class='url'>$author</a>";
	echo $return;
}

function my_comment_author_user_reply( $user_id = 0 )
{
	if( empty( $user_id ) )
	{
		$comment_ID = 0;
		$author = get_comment_author( $comment_ID );
		$author_reply = "@$author";
	}
	else
	{
		$profileuser = get_userdata($user_id);
		$author_reply = '@' . $profileuser->user_login;
	}

	return $author_reply;
}
function my_comment_author_reply_link( $user_id = 0 )
{
	$author = my_comment_author_user_reply( $user_id );

	$return = '<a href="#reply" class="comment-reply" reply_to="' . $author . '" rel="nofollow">Reply</a>';

	echo $return;
}

function my_comment_author_link()
{
	$comment_ID = 0;
	$url    = get_comment_author_url( $comment_ID );
	$author = get_comment_author( $comment_ID );

	if ( empty( $url ) || 'http://' == $url )
		$return = $author;
	else
		$return = "<a href='$url' class='url'>$author</a>";
	echo $return;
}

function my_is_group_forum() {
	global $bp;

	if ( BP_GROUPS_SLUG == $bp->current_component && $bp->is_single_item )
		return true;

	return false;
}

function my_forum_view_all_or_pagination()
{
	if( is_front_page() )
		return;

	global $bp, $forum_template;
	$link = '';
	echo '<div class="alignright">';
	if ( bp_is_group_home() ) {
		if( $forum_template->total_topic_count > 20 )
		{
			$url = bp_get_forum_permalink();
			$link = '<a class="alignright" href="' . $url . '/">View more &raquo;</a>';
		}
			echo $link;
	} else
	{
		echo '<div style="height: 25px;"><small>';
				bp_forum_pagination_count();
		echo '</small></div><div class="alignright">';
	bp_forum_pagination();
	echo '</div>';
	}
	echo '</div>';
}

function my_content_class()
{
	$class = "home";
	if( bp_is_group_forum() )
		$class = 'discussions';
	else if( bp_is_group_home() )
		$class = 'groups';
	echo $class;
}

function my_topic_reply_link()
{
	global $topic_template;
	$lastpage = $topic_template->pag->total_pages;
	$url = bp_get_the_topic_permalink();
	if( $lastpage == 1 )
		$url .= '#post-topic-reply';
	else
		$url .= '?topic_page=' .$topic_template->pag->total_pages . '#post-topic-reply';
	
	echo $url;
}

function get_group_by_zodiac_sign( $z)
{
	$signRulerNumber = array();
	$signRulerNumber['aries'] = 25;
	$signRulerNumber['taurus'] = 26;
	$signRulerNumber['gemini'] = 24;
	$signRulerNumber['cancer'] = 28;
	$signRulerNumber['leo'] = 29;
	$signRulerNumber['virgo'] = 30;
	$signRulerNumber['libra'] = 31;
	$signRulerNumber['scorpio'] = 32;
	$signRulerNumber['sagittarius'] = 33;
	$signRulerNumber['capricorn'] = 34;
	$signRulerNumber['aquarius'] = 35;
	$signRulerNumber['pisces'] = 36;

	return 	$signRulerNumber[$z];
}
function my_insert_activity_meta( $content = '' ) {
	global $activities_template, $bp;

	/* Strip any legacy time since placeholders -- TODO: Remove this in 1.3 */
	$content = str_replace( '<span class="time-since">%s</span>', '', $content );

	/* Insert the time since. */
//	$content .= apply_filters( 'bp_activity_time_since', '<span class="time-since">' . sprintf( __( '%s', 'buddypress' ), bp_core_time_since( $activities_template->activity->date_recorded ) ) . '</span>', &$activities_template->activity );

	/* Insert the permalink */
//	$content .= apply_filters( 'bp_activity_permalink', ' &middot; <a href="' . bp_activity_get_permalink( $activities_template->activity->id, $activities_template->activity ) . '" class="view" title="' . __( 'View Thread / Permalink', 'buddypress' ) . '">' . __( 'View', 'buddypress' ) . '</a>', &$activities_template->activity );

	echo apply_filters( 'bp_insert_activity_meta', $content );
}

function my_insert_activity_header()
{
	global $activities_template, $bp;

	$action = $activities_template->activity->action;
	
	echo $action;
}

function my_displayed_user_name( $user_id )
{
	$profileuser = get_userdata($user_id);
	return $profileuser->nickname;
}

function getCurrentComponent()
{
	global $bp;
	return $bp->current_component;
}

function getCurrentAction()
{
	global $bp;
	return $bp->current_action;
}

function isActivityPage()
{
	$cc = getCurrentComponent();
	$ca = getCurrentAction();

	if( basename( get_permalink() ) == 'home' )
		$ca = BP_ACTIVITY_SLUG;


	if( $cc == BP_ACTIVITY_SLUG || $ca == BP_ACTIVITY_SLUG )
		return true;

	return false;
}

function getActivitySettings()
{
	global $bp, $wpdb;

	$s = array();

	if( !isActivityPage() )
		$s['max'] = 5;
	if( basename( get_permalink() ) == 'home' )
	{
		unset( $s['max'] );
		//$s['user_id'] = $bp->loggedin_user->id . ',' . bp_get_following_ids( array( 'user_id' => $bp->loggedin_user->id ) );

		$following_ids = bp_get_following_ids( array( 'user_id' => $bp->loggedin_user->id ) );
		
		if( !empty( $following_ids ) )
			$activity_by_users = $bp->loggedin_user->id . ',' . $following_ids;
		else $activity_by_users = $bp->loggedin_user->id;

		//$include_activity_ids_by_comments = $wpdb->get_col('SELECT wp_bp_activity.id AS activity_id FROM wp_bp_activity JOIN (wp_comments, wp_email) ON (wp_email.user_id = ' . $bp->loggedin_user->id . ' AND wp_email.type= "blog_comment" AND wp_bp_activity.secondary_item_id = comment_ID AND wp_comments.comment_post_ID = wp_email.item_id ) WHERE wp_bp_activity.component = "blogs" AND wp_bp_activity.type="new_blog_comment"');
		$my_groups = groups_get_user_groups( $bp->loggedin_user->id );
		$my_groups_ids = implode( ',', (array)$my_groups['groups'] );

		$include_activity_ids_by_comments = $wpdb->get_col('SELECT ask_bp_activity.id AS activity_id FROM ask_bp_activity JOIN (ask_comments, ask_email) ON (ask_email.user_id = ' . $bp->loggedin_user->id . ' AND ask_email.type= "blog_comment" AND ask_bp_activity.secondary_item_id = comment_ID AND ask_comments.comment_post_ID = ask_email.item_id ) WHERE ask_bp_activity.component = "blogs" AND ask_bp_activity.type="new_blog_comment"');
		$include_activity_ids_by_groups = $wpdb->get_col("SELECT a.id AS activity_id FROM ask_bp_activity AS a WHERE a.component = 'groups' AND a.item_id IN ($my_groups_ids)" );
		$include_activity_ids_by_users = $wpdb->get_col("SELECT ask_bp_activity.id AS activity_id FROM ask_bp_activity WHERE user_id IN ($activity_by_users)" );

		$include_activity_ids = join( ',', array_merge( $include_activity_ids_by_comments, $include_activity_ids_by_users, $include_activity_ids_by_groups) );

		if( !empty( $include_activity_ids ) )
			$s['include'] = $include_activity_ids;
		else $s['user_id'] = $activity_by_users;

	} else 	if ( $bp->current_action == $bp->gifts->slug ) {
		$s['scope'] = 'mentions';
		$s['action'] = 'new_gifts';
	} else if( bp_current_action() == 'following' )
	{
		$user_id = ( $bp->displayed_user->id ) ? $bp->displayed_user->id : $bp->loggedin_user->id;
		$s['user_id'] = bp_get_following_ids( array( 'user_id' => $user_id ) );
	}
	return $s;
}

function my_member_suggestions( $is_sidebar = false )
{
	global $wpdb;

	if ( empty( $is_sidebar ) )
	{
		$limit = 100;
		$per_page = 20;
		$max = false;
		$fields = '';

		if ( !empty( $_REQUEST['s'] ) )
		{
				$search_terms = like_escape( $wpdb->escape( $_REQUEST['s'] ) );
		}
		else $search_terms = 'directory';
	} else
	{
		$search_terms = bp_get_member_profile_data(array( 'field' => 'Country', 'user_id' => bp_displayed_user_id()));
		if( empty( $search_terms ) || bp_displayed_user_id() == 0 )
			$search_terms = 'sidebar';

		$limit = 5;
		$per_page = 5;
		$max = 5;
		$fields = 'field_id = 125 AND';
	}
	$include_member_ids = wp_cache_get( 'my_member_suggestions_' . $search_terms );
	if ( false === $include_member_ids ) {
		if( $search_terms == 'directory' || $search_terms )
			$user_ids_by_country = $wpdb->get_col( "SELECT DISTINCT user_id FROM ask_bp_xprofile_data ORDER BY id DESC LIMIT $limit" );
		else $user_ids_by_country = $wpdb->get_col( "SELECT DISTINCT user_id FROM ask_bp_xprofile_data WHERE $fields value LIKE '%$search_terms%' ORDER BY id DESC LIMIT $limit" );

		$include_member_ids = join( ',', $user_ids_by_country );
		wp_cache_set( 'my_member_suggestions_' . $search_terms, $include_member_ids );
	} 

	if( !empty( $include_member_ids ) )
		return array( 'type' => 'newest', 'include' => $include_member_ids );
	
	return array(
		'type'			  => 'newest',
		'per_page'        => $per_page,
		'max'             => $max
	);
	
}

function my_permalink($type) {
	global $bp;

	if ( $bp->is_single_item )
		$permalink = $bp->root_domain . '/' . $bp->current_component . '/' . $bp->current_item . '/';
	else if ( $bp->current_component == 'profile' )
		$permalink = $bp->displayed_user->domain;
	else if ( basename( get_permalink() ) == 'home' )
		$permalink = $bp->loggedin_user->domain;
	else if ( is_front_page() )
		$permalink = $bp->root_domain . '/';
	else
		$permalink = $bp->root_domain . '/' . $bp->current_component . '/' . $bp->current_action . '/';

	echo $permalink . $type . '/';
}

//echo get_stylesheet_directory_uri();
//echo get_stylesheet_directory();

//define('CHARTS_INCLUDE_DIR', TEMPLATEPATH . '/include/classes/');
define('CHARTS_INCLUDE_DIR', get_stylesheet_directory(). '/include/classes/');

require_once CHARTS_INCLUDE_DIR . 'email.php';
// Load the AJAX functions for the theme
require CHARTS_INCLUDE_DIR . 'ajax.php';

// What to do when a new comment is posted
add_action('comment_post', 'my_blog_comments_email_subscription', 15, 2 );
add_action('bp_template_content', 'manage_blog_comments_email_subscription');
add_action('bp_template_content', 'manage_user_general_settings');
add_filter( 'bp_blogs_record_comment_post_types', 'my_blogs_record_comment_post_types' );
add_filter( 'bp_blogs_record_post_post_types', 'my_blogs_record_comment_post_types' );
add_filter( 'bp_get_add_friend_button', 'my_add_friend_button' );

function my_add_friend_button( $button )
{
	$button['wrapper'] = 'li';
	return $button;
}

function my_screen_location_settings()
{
	add_action( 'bp_template_title', 'my_screen_location_settings_title' );
	add_action( 'bp_template_content', 'my_screen_location_settings_content' );

	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}
function my_screen_location_settings_title()
{
	_e( 'Current Location Settings', 'buddypress' );
}
function my_screen_location_settings_content()
{
	define('CHARTS_INCLUDE_DIR', TEMPLATEPATH . '/include/classes/');
	require_once CHARTS_INCLUDE_DIR . 'Atlas.php';
	require_once CHARTS_INCLUDE_DIR . 'IndexPage.php';
	require_once( CHARTS_INCLUDE_DIR . 'functions.php' );

	global $wpdb;
	
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	
/*	if ( isset($_GET['verify']) )
	{
		$place_id = (int)( $_POST['place_id'] );
		if( !empty( $place_id ) );
			$query = "SELECT * FROM atlas WHERE place_id = $place_id";
	}*/
	if ( isset($_GET['saveLocation']) )
	{
		$saveLocation = array();
		$saveLocation['city_string_home'] = (int)$_POST['city_string_home'];
		$errors = new WP_Error();

		if ( empty( $saveLocation['city_string_home'] ) )
			$errors->add( 'place_id', __( '<strong>ERROR</strong>: We could not save your city settings at this time. Please contact us for further support.' ), array( 'form-field' => 'city' ) );
		else
		{
			$c_loc = Atlas::SetDefaultCity( $saveLocation['city_string_home'] );

			if( empty( $c_loc ) )
				$errors->add( 'place_id', __( '<strong>ERROR</strong>: We could not save your city settings at this time. Please contact us for further support.' ), array( 'form-field' => 'city' ) );
		}

		if ( !$errors->get_error_code() )
		{
			echo '<div id="message" class="updated fade">';
			echo '<p>Changes Saved.</p></div>';
		}

	}

	if( empty( $c_loc ) )
		$c_loc = get_user_meta($user_id, 'current_location', true);

	if( isset( $c_loc ) )
	{

		$current_location = unserialize( $c_loc );
		$city_string = $current_location['city_string_home'];
	}

	$out = new IndexPage();
		include(CHILD_TEMPLATEPATH."/include/errors.php");

	?>
<p style="padding-top: 10px;">My Saved Current Location: </p>
<p><strong><?php echo $city_string; ?></strong></p>
<h3 class="btmspace">Change Current Location:</h3>
<form id="sform" name="sform" class="standard-form" method="post" action="?saveLocation">
  <table>
    <tr>
      <td width="30%"><label for="country">Country</label>
        <?php $out->show_country($reportdata['country']); ?>
      </td>
      <td><label for="city">City</label>
        <input id="city" name="city" class="city required" />
      </td>
    </tr>
    <!--			<tr>
				<td></td>
				<td align="right"><input type="submit" value="Verify Location &raquo;" id="submit" class="auto" name="wp-submit"></td>
			</tr>
-->
  </table>
  <input type="hidden" value="" id="city_string_home" name="city_string_home" />
  <input type="submit" value="Save &raquo;" class="auto" id="submit" name="wp-submit">
</form>
<p></p>
<?php
//	include(CHILD_TEMPLATEPATH."/include/confirmreportform.php");
}
function my_blog_comments_email_subscription($comment_id, $status)
{
	if( $status === 1 )
	{
		$e = new MyEmail();
		
		$comment = get_comment( $comment_id );
		$e->addPostSubscription( $comment->comment_post_ID );		
	}
	return $comment_id;
}

function my_blogs_record_comment_post_types( $post_types ) {
  $post_types[] = 'page'; // Add your custom post type name to the array.

  return $post_types;
}

function manage_blog_comments_email_subscription()
{

	if( !strpos( $_SERVER['REQUEST_URI'], 'notifications' ) || !bp_is_user() )
		return;

	$post_id = (int)$_REQUEST['post_id'];

	$e = new MyEmail();

	if( $_REQUEST['action'] == 'remove' && !empty( $post_id ) )
		$e->removePostSubscription( $post_id );
	else if( $_REQUEST['action'] == 'add' && !empty( $post_id ) )
		$e->addPostSubscriptionByURL( $post_id );

	echo '<h3>Comments Subscriptions</h3>';
	$e->showPostSubscriptions();
}

function manage_user_general_settings()
{
	global $bp;

	if( !strpos( $_SERVER['REQUEST_URI'], 'settings' ) || $bp->current_action != 'general' )
		return;
}

function send_email_subscriptions()
{
	$sinceTimeStamp = get_option( 'last_send_email_subscriptions_run' );

	if( empty( $sinceTimeStamp ) )
		add_option( 'last_send_email_subscriptions_run', time(), '', 'yes' );

	$args = array( 'action' => 'new_blog_comment', 'object' => 'blogs' );
	if( bp_has_activities( $args ) )
	{
		while ( bp_activities() )
		{
			bp_the_activity();
			global $activities_template;
			$e = new MyEmail();
			$subject = strip_tags( $activities_template->activity->action );

			if( strtotime( bp_get_activity_date_recorded() ) > $sinceTimeStamp )
			{
				$users = $e->getSubscribedUsers( bp_get_activity_item_id() );
//				$users = $e->getSubscribedUsers( 2360 );
				if( $users )
				{
					foreach($users as $user)
					{
						$user_data = get_userdata( $user );
						//$to = $user_data->user_email;
						$to = 'admin@ask-oracle.com';
					}
				}
				$poster_name = 'hahahaha';
				$thread_link = bp_get_activity_thread_permalink();
				$content = bp_get_activity_content_body();
				$settings_link  = $e->getUserEmailSettingsURL();  //Needs current email receivers url
				$message = sprintf( __(
'%s said:

"%s"

To view all comments, visit: %s

---------------------
', 'buddypress' ), $poster_name, $content, $thread_link );

				$message .= sprintf( __( 'To disable these notifications please log in and go to: %s', 'buddypress' ), $settings_link );
			if( wp_mail( $to, $subject, $message ) )
				update_option( 'last_send_email_subscriptions_run', time() );
			}
			else break;
		}
	}

}
// send automatic scheduled email
if ( !wp_next_scheduled('send_email_subscriptions_cron') ) {
	wp_schedule_event( time(), 'hourly', 'send_email_subscriptions_cron' ); // hourly, daily and twicedaily
}

function userhome_notifications()
{
	if( !strpos( $_SERVER['REQUEST_URI'], 'home' ) || bp_is_group() )
		return;

	if( !is_user_logged_in() )
		return;

	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;

	$profileuser = get_userdata($user_id);

	if( !isset( $profileuser->birth_data ) )
	{
		echo '<div id="message" class="notification">Get your <a href="' . get_linkTO('birth-chart/') . '">free birth chart</a> analysis. Revealing and useful. Takes less than a minute! <a href="' . get_linkTO('birth-chart/') . '">GO &raquo;</a></div>';
	} else if ( !bp_get_user_has_avatar() && strpos( bp_get_loggedin_user_avatar( array( 'html' => false ) ), 'mystery-man' ) )
	{
		$change_avatar_link = bp_get_loggedin_user_link() . BP_XPROFILE_SLUG . '/change-avatar/';
		echo '<div id="message" class="notification"><strong>Next Step &raquo;</strong> <a href="' . $change_avatar_link . '">Upload your photo</a> to go with your profile. Easy and fast! <a href="' . $change_avatar_link . '">Upload Now &raquo;</a></div>';
	}
	echo '<div id="message" class="notification">Looking for answers and solutions? Try <a href="http://ask-oracle.oranum.com/">free chat</a> with our live psychics. <a href="http://ask-oracle.oranum.com/">GO &raquo;</a></div>';

}

function my_profile_link( $type = 'profile' )
{
	$profile_link = bp_get_loggedin_user_link() . BP_XPROFILE_SLUG . '/';
	switch( $type )
	{
		case 'edit':
			$profile_link .= $type . '/';
			break;
		case 'change-avatar':
			$profile_link .= $type . '/';
			break;
	}

	echo $profile_link;

}

function my_core_add_jquery_cropper()
{
	if ( !empty( $_FILES ) ) {
		remove_action( 'wp_print_scripts', 'bp_core_add_jquery_cropper' );
		//add_action( 'wp_head', 'bp_core_add_cropper_inline_js' );
		add_action( 'wp_head', 'bp_core_add_cropper_inline_css' );
	}
}
function my_aioseop_description( $description )
{
/*	if( !empty( $description ) )
		return $description;
*/
	global $post;
	$pgtyp = pagetype($post->ID);
	$pgcat = pagecategory($post->ID);
	$pgtyp_CAPS = ucfirst($pgtyp);
//	var_dump( $description, $pgcat, $pgtyp );

	switch( $pgcat )
	{
		case 'daily':
		case 'daily-love':
		case 'daily-career':
			$daily_date = strtotime( get_option( $pgcat ) );
			$_date = date("F d, Y", $daily_date );
			$_year = date("Y", $daily_date );
			$spc = ' ';
			$spc1 = '';
			$pgcat_CAPS = ucwords( str_replace("-", " ", $pgcat) );
			$pgcat_split = explode(" ", $pgcat_CAPS);
			$cat_CAPS = '';

			if( count($pgcat_split) > 1 )
			{
				$cat_CAPS = $pgcat_split[1];
				$spc1 = ' ';
			}
				
			if( empty( $pgtyp ) )
			{
				$pgtyp_CAPS = '';
				$_plural = 's';
				$spc = '';
			}
			$format = '%1$s : %2$s%6$s%7$s%8$sHoroscope%3$s for today. Free %2$s%6$s%4$s Horoscope%3$s. Also provided free %2$s%6$slove, career, yearly, monthly, weekly and daily horoscopes for %5$s.';
			$description = sprintf($format, $_date, $pgtyp_CAPS, $_plural, $pgcat_CAPS, $_year, $spc, $cat_CAPS, $spc1);
			break;
		case 'weekly':
		case 'weekly-love':
		case 'weekly-career':
			$weekly_date = strtotime( get_option( $pgcat ) );
			$_startdate = date("F d, Y", $weekly_date );
			$_enddate = date("F d, Y", $weekly_date + 6*86400);
			$_date = "$_startdate to $_enddate";
			$_year = date("Y", $weekly_date );
			$spc = ' ';
			$spc1 = '';
			$pgcat_CAPS = ucwords( str_replace("-", " ", $pgcat) );
			$pgcat_split = explode(" ", $pgcat_CAPS);
			$cat_CAPS = '';

			if( count($pgcat_split) > 1 )
			{
				$cat_CAPS = $pgcat_split[1];
				$spc1 = ' ';
			}
					
			if( empty( $pgtyp ) )
			{
				$pgtyp_CAPS = '';
				$_plural = 's';
				$spc = '';
			}
			$format = '%1$s : Free %2$s%6$s%4$s Horoscope%3$s. Also provided free %2$s%6$slove, career, yearly, monthly, weekly and daily horoscopes for %5$s.';
			$description = sprintf($format, $_date, $pgtyp_CAPS, $_plural, $pgcat_CAPS, $_year, $spc, $cat_CAPS, $spc1);
			break;
		case 'monthly':
		case 'monthly-love':
		case 'monthly-career':
			$monthy_date = strtotime( get_option( $pgcat ) );
			$_date = date("F Y", $monthy_date );
			$_year = date("Y", $monthy_date );
			$spc = ' ';
			$spc1 = '';
			$pgcat_CAPS = ucwords( str_replace("-", " ", $pgcat) );
			$pgcat_split = explode(" ", $pgcat_CAPS);
			$cat_CAPS = '';

			if( count($pgcat_split) > 1 )
			{
				$cat_CAPS = $pgcat_split[1];
				$spc1 = ' ';
			}
					
			if( empty( $pgtyp ) )
			{
				$pgtyp_CAPS = '';
				$_plural = 's';
				$spc = '';
			}
			$format = '%1$s : Free %2$s%6$s%4$s Horoscope%3$s. Also provided free %2$s%6$slove, career, yearly, monthly, weekly and daily horoscopes for %5$s.';
			$description = sprintf($format, $_date, $pgtyp_CAPS, $_plural, $pgcat_CAPS, $_year, $spc, $cat_CAPS, $spc1);
			break;
		case 'yearly':
		case 'yearly-love':
		case 'yearly-career':
			list($mm, $_year) = split('[/.-]', date("m.Y"));
			if( $mm > 11 )
				$_year += 1;

			$spc = ' ';
			$spc1 = '';
			$pgcat_CAPS = ucwords( str_replace("-", " ", $pgcat) );
			$pgcat_split = explode(" ", $pgcat_CAPS);
			$cat_CAPS = '';

			if( count($pgcat_split) > 1 )
			{
				$cat_CAPS = $pgcat_split[1];
				$spc1 = ' ';
			}
					
			if( empty( $pgtyp ) )
			{
				$pgtyp_CAPS = '';
				$_plural = 's';
				$spc = '';
			}
			$format = '%1$s Free %2$s%6$s%4$s Horoscope%3$s. Also provided free %2$s%6$slove, career, yearly, monthly, weekly and daily horoscopes for %5$s.';
			$description = sprintf($format, $_year, $pgtyp_CAPS, $_plural, $pgcat_CAPS, $_year, $spc, $cat_CAPS, $spc1);
			break;
	}
//	var_dump( $description );

	return $description;
}
function my_aioseop_title( $title )
{
	global $post;
	$pgtyp = pagetype($post->ID);
	$pgcat = pagecategory($post->ID);
	$pgtyp_CAPS = ucfirst($pgtyp);

	switch( $pgcat )
	{
		case 'monthly':
		case 'monthly-love':
		case 'monthly-career':
			$monthy_date = strtotime( get_option( $pgcat ) );
			$_date = date("F Y", $monthy_date );
			$spc = ' ';
			$pgcat_CAPS = ucwords( str_replace("-", " ", $pgcat) );
			$free = '';
			
			if( empty( $pgtyp ) )
			{
				$pgtyp_CAPS = '';
				$_plural = 's';
				$spc = '';
				$free = 'Free ';
			}
			$format = '%1$s - %5$s%2$s%6$s%4$s Horoscope%3$s | Ask Oracle';
			$title = sprintf( $format, $_date, $pgtyp_CAPS, $_plural, $pgcat_CAPS, $free, $spc );
			break;
		case 'yearly':
		case 'yearly-love':
		case 'yearly-career':
			list($mm, $_year) = split('[/.-]', date("m.Y"));
			if( $mm > 11 )
				$_year += 1;

			$spc = ' ';
			$spc1 = '';
			$pgcat_CAPS = ucwords( str_replace("-", " ", $pgcat) );
			$free = '';
					
			if( empty( $pgtyp ) )
			{
				$pgtyp_CAPS = '';
				$_plural = 's';
				$spc = '';
				$free = 'Free ';
			}
			$format = '%1$s %5$s%2$s%6$s%4$s Horoscope%3$s | Ask Oracle';
			$title = sprintf($format, $_year, $pgtyp_CAPS, $_plural, $pgcat_CAPS, $free, $spc);
			break;
	}

	return $title;
}
function my_the_topic_group_permalink() {
	echo my_get_the_topic_group_permalink();
}
	function my_get_the_topic_group_permalink() {

		// Currently this will only work with group forums, extended support in the future
		if ( bp_is_active( 'groups' ) )
			if(function_exists('bp_get_root_domain'))
			{
			$permalink = trailingslashit( bp_get_root_domain() . '/' . bp_get_groups_root_slug() . '/' . bp_get_the_topic_object_slug() );
			}
		else
			$permalink = '';

		return apply_filters( 'bp_get_the_topic_object_permalink', $permalink );
	}
function my_group_new_topic_button( $group = false ) {
	echo my_get_group_new_topic_button( $group );
}
	function my_get_group_new_topic_button( $group = false ) {
		global $groups_template;

		if ( !$group )
			$group =& $groups_template->group;

		if ( bp_group_is_user_banned() )
			return false;

		$button = bp_button( array (
			'id'                => 'new_topic',
			'component'         => 'groups',
			'must_be_logged_in' => false,
			'block_self'        => true,
			'wrapper_class'     => 'group-button',
			'link_href'         => bp_get_group_forum_permalink( $group ) . '/#post-new',
			'link_class'        => 'group-button show-hide-new',
			'link_id'           => 'new-topic-button',
			'link_text'         => __( 'Create New Topic', 'buddypress' ),
			'link_title'        => __( 'New Topic', 'buddypress' ),
		) );

		// Filter and return the HTML button
		return bp_get_button( apply_filters( 'bp_get_group_new_topic_button', $button ) );
	}

function my_meta_robots()
{
	global $bp;
	$noindex = 'noindex';
	$nofollow = 'nofollow';
	$display = false;
//	var_dump( $bp );
	if(function_exists('bp_is_active')){
	
	if ( bp_is_blog_page() && ( is_page_template( 'answer.php' ) || is_page_template( 'register.php' ) || strpos( $_SERVER['REQUEST_URI'], 'login' ) || strpos( $_SERVER['REQUEST_URI'], 'registration' ) ) )
		$display = true;

	if ( strpos( $_SERVER['REQUEST_URI'], 'login' ) || strpos( $_SERVER['REQUEST_URI'], 'registration' ) )
		$display = true;

	if( bp_is_activity_component() )
	{
		if( bp_is_single_activity() || ( bp_is_current_action( 'just-me' ) && strpos( $_SERVER['REQUEST_URI'], 'just-me' ) ) )
		{

			$display = true;
			$nofollow = 'follow';
		}
	}

	if( bp_is_profile_component() && ( bp_is_current_action( 'public' ) || bp_is_current_action( 'edit' ) || bp_is_current_action( 'change-avatar' ) ) )
	{
		if( strpos( $_SERVER['REQUEST_URI'], 'public' ) || strpos( $_SERVER['REQUEST_URI'], 'profile' ) )
		{
			$display = true;
			$nofollow = 'follow';
		}
	}

	if ( bp_is_groups_component() )

	{
		if( strpos( $_SERVER['REQUEST_URI'], 'home' ) || strpos( $_SERVER['REQUEST_URI'], 'my-groups' ) )
		{
			$display = true;
			$nofollow = 'follow';
		}
	}
	
	}
	if( $display )
		echo '<meta name="robots" content="' . $noindex . ', ' . $nofollow . '" />';
}
function my_rel_canonical()
{
	global $bp;
	if(function_exists('bp_get_root_domain'))
	{
	$href =  bp_get_root_domain() . '/';
	}
	$display = false;

	if(function_exists('bp_is_active'))
	{
	if( bp_is_single_activity() || ( bp_is_current_action( 'just-me' ) && strpos( $_SERVER['REQUEST_URI'], 'just-me' ) ) )
	{
		$display = true;
		$href = bp_get_displayed_user_link() . bp_get_activity_root_slug() . '/';
	} else if( bp_is_profile_component() && ( bp_is_current_action( 'public' ) || bp_is_current_action( 'edit' ) || bp_is_current_action( 'change-avatar' ) ) )
	{
		$display = true;
		$href = bp_get_displayed_user_link();
	} else if ( bp_is_groups_component() )
	{
		if( strpos( $_SERVER['REQUEST_URI'], 'my-groups' ) )
		{
			$display = true;
			$href = bp_get_displayed_user_link() . bp_get_groups_root_slug() . '/';
		} else if( strpos( $_SERVER['REQUEST_URI'], 'home' ) || bp_is_current_action( 'admin' ) )
		{
			$display = true;
			$href .= bp_get_groups_root_slug() . '/' . $bp->current_item . '/';
		}
	}
	}
	
	if( $display )
		echo '<link rel="canonical" href="' . $href . '" />';
}

function my_loginout($link = '') {
	if ( ! is_user_logged_in() )
		$link = '<a rel="nofollow" href="' . esc_url( wp_login_url($redirect) ) . '">' . __('Log in') . '</a>';
	else
		$link = '<a rel="nofollow" href="' . esc_url( wp_logout_url($redirect) ) . '">' . __('Log out') . '</a>';

	return $link;
}

function mybar_shorten( $text )
{
	if( strlen( $text ) > 20 )
		$text = substr($text, 0, 20) . " ...";

	return $text;

}
function my_xprofile_updated_profile( $user_id, $fields, $errors )
{
	$userlink = bp_core_get_userlink( $user_id );
			// Set the feedback messages
			if ( $errors )
				return false;
			else xprofile_record_activity( array(
		'user_id'   => $user_id,
		'action'    => apply_filters( 'bp_core_activity_registered_member_action', sprintf( __( '%s  updated their profile.', 'buddypress' ), $userlink ), $user_id ),
		'component' => 'xprofile',
		'type'      => 'updated_profile'
	) );

}
function my_core_activated_user( $user_id )
{
	$cl = Atlas::SetDefaultCity( '', $user_id );

	if( !empty( $cl ) )
	{
		$current_location = unserialize( $cl );
		xprofile_set_field_data( 125, $user_id, $current_location['country_name'] );
		xprofile_set_field_data( 126, $user_id, $current_location['name'] . ', ' . $current_location['region_name'] );
	}
	
}

function my_xprofile_data_value_before_save( $field_obj )
{
	if( $field_obj->field_id == '125' && strlen( $field_obj->value ) < 3 )
	{
		$country_name = Atlas::GetCountryByCode( $field_obj->value );
		$field_obj->value = $country_name;
		$place_id = (int)$_POST['city_string_home'];
		Atlas::SetDefaultCity( $place_id );
	}
	return $field_obj;
}

function my_member_age($birthday)
{
	try {
		$datetime = DateTime::createFromFormat('d-m-Y', $birthday);
		}
		catch (Exception $e) {
			return false;
		}

	if( $datetime )
		return $datetime->diff(new DateTime('now'))->y;
}

function my_album_add_css()
{
	global $bp;

	if ( $bp->current_component == $bp->album->slug )
		wp_enqueue_style( 'bp-album-css', WP_PLUGIN_URL .'/bp-album/includes/css/general.css' );
}

function my_deregister_javascript() {
	if( is_admin() )
		return;
	if( !is_page('write-a-story') )
		wp_deregister_script( 'jquery' );

	wp_dequeue_script( 'bp-follow-js' );
	wp_deregister_script('bp-activity-subscription-js');
	wp_dequeue_script( 'bp-activity-subscription-js' );

}
function my_deregister_style() {
	if( is_admin() )
		return;

	wp_deregister_style('activity-subscription-style');
	wp_dequeue_style('activity-subscription-style');
	wp_deregister_style('bp-admin-bar');
	wp_dequeue_style('bp-admin-bar');
	wp_deregister_style('woocommerce_frontend_styles');
	wp_dequeue_style('woocommerce_frontend_styles');
}

function prevent_admin_access() {
   if (!current_user_can('manage_options') && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php') {
	wp_redirect(site_url() );
	exit;
	}
}

if(class_exists('BP_Group_Extension')){
class Group_Chat extends BP_Group_Extension {

	function group_chat() {
		global $bp;

		$this->name = __('Chat', 'bp-chat');
		$this->slug = 'chat';

		// Only enable the notifications nav item if the user is a member of the group
		if ( bp_is_group() ) {
			$this->enable_nav_item = true;
		} else {
			$this->enable_nav_item = false;
		}

		$this->nav_item_position = 41;
		$this->enable_create_step = false;

		// hook in the css and js
		add_action ( 'wp_print_styles' , array( &$this , 'add_stylesheet' ) );
		add_action( 'wp_enqueue_scripts', array( &$this , 'add_javascript' ),1 );
	}

	public function add_stylesheet() {
		if ( bp_is_groups_component() && is_user_logged_in() ) {
		$style_url = get_linkTO('/cometchat/cometchatcss.php');
		    wp_register_style('group-chat-style', $style_url);
		    wp_enqueue_style('group-chat-style');
		}
	}

	public function add_javascript() {
		if ( bp_is_groups_component() && is_user_logged_in() ) {
			wp_register_script('group-chat-js', get_linkTO('/cometchat/cometchatjs.php') );
			wp_enqueue_script( 'group-chat-js' );
		}
	}

	// Display the notification settings form
	function display() {
		locate_template( array( 'include/membership.php' ), true );

		if ( is_user_logged_in() && 'public' == bp_get_group_status() )
		{
			echo '<iframe src="/cometchat/modules/chatrooms/index.php?id=1" width="550" height="400" frameborder="1" ></iframe>';
		}
		//ass_group_subscribe_settings();
	}


	// The remaining group API functions aren't used for this plugin but have to be overriden or api won't work

	function create_screen() {
		return false;
	}

	function create_screen_save() {
		return false;
	}

	function edit_screen() {
		// if ass-admin-can-send-email = no this won't show
		//ass_admin_notice_form(); // removed for now because it was broken
		return false;
	}

	function edit_screen_save() {
		return false;
	}

	function widget_display() {
		return false;
	}

}
}
function group_chat_activate_extension() {
	if(class_exists('Group_Chat')){
		$extension = new Group_Chat;
	}
	add_action( "wp", array( &$extension, "_register" ), 2 );
}

function my_birthday_permalinkfix( $vars )
{
	if( $vars['post_type'] == 'birthday' && !empty( $vars['birthday'] ) )
	{
		$vars['birthday'] .= $vars['page'];
		$vars['name'] .= $vars['page'];
	}
	return $vars;
}

function my_threewp_log_page_visits()
{
	global $post;

	if ( !is_user_logged_in() )
		return ;

	$user_object = wp_get_current_user();
	do_action('threewp_activity_monitor_new_activity', array(
		'activity_id' => 'my_page_visited',
		'activity_strings' => array(
			"" => "%user_display_name_with_link% is viewing %post_title_with_link%",
			'IP' => $_SERVER['REMOTE_HOST'] . ' <span class="threewp_activity_monitor_sep">|</span> '.$_SERVER['REMOTE_ADDR'],
			'User agent' => '%server_http_user_agent%',
		),
		'user_data' => $user_object,
		'post_data' => $post
	) );
}
function my_threewp_list_activities( $activities )
{
	$add_page_visits = array(
            'name' => _('User Page Visits'),
            'plugin' => _('Custom in functions.php'),
        );
	$activities['my_page_visited'] = $add_page_visits;
	return $activities;
}
function my_get_previous_post_where( $where )
{
	return my_get_adjacent_post_where( $where, -1 );
}
function my_get_next_post_where( $where )
{
	return my_get_adjacent_post_where( $where, 1 );
}
function my_get_adjacent_post_where( $where, $type )
{
	global $post, $wpdb;

	if ( empty( $post ) )
		return $where;

	if ( $post->post_type != 'bdcompatibility' )
		return $where;
	
	$adjacent_post_id = $type;

	$where = $wpdb->prepare("WHERE p.ID = %d AND p.post_type = %s AND p.post_status = 'publish'", $post->ID + $adjacent_post_id, $post->post_type);

	return $where;
}


include(CHILD_TEMPLATEPATH."/include/notifications.php");
include(CHILD_TEMPLATEPATH."/include/classes/AstroData.php");
include CHILD_TEMPLATEPATH . '/include/classes/IndexPage.php';

if( !is_blog_admin() )
	include(CHILD_TEMPLATEPATH."/include/mybar.php");

/* === COMMENTS */
if( !function_exists( 'yit_comment' ) ) {
    /**
     * Print comments
     * 
     * @param object $comment
     * @param array $args
     * @param int $depth
     * @return string
     * @since 1.0.0
     */
    function yit_comment( $comment, $args, $depth ) {
        
        $GLOBALS['comment'] = $comment;
        
        switch ( $comment->comment_type ) :
            case 'pingback'  :
            case 'trackback' :
        ?>
        <li class="post pingback">
            <p><?php _e( 'Pingback:', 'yit' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'yit'), ' ' ); ?></p>
        <?php
                break;
            
            default:
        ?>
        <li <?php comment_class( yit_comment_has_children( $comment->comment_ID ) ? ' parent' : '' ); ?> id="li-comment-<?php comment_ID(); ?>">
            <div class="<?php echo 'offset' . ( yit_comment_depth( get_comment_ID() ) - 1 ); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment-container">
					<div class="comment-wrap">
						<div class="avatar-wrap"> 
						<?php echo get_avatar( $comment, 70 ); ?>
						  <div class="avatar-frame"></div>
						</div>
					<div class="comment-header">
      <div class="comment-author"> <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?> </div>
      <!-- / comment-author -->
      <div class="comment-meta"> <a class="date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s', 'yit' ), get_comment_date( 'M, j - Y' ) ); ?>
            </a> </div>
      <!-- / comment-meta -->
    </div>
					<div class="comment-content">
		<?php if ( $comment->comment_approved == '0' ) : ?>
		<?php _e( 'Your comment is awaiting moderation.', 'yit' ); ?>
		<?php endif; ?>
		<?php comment_text(); ?>
    <!-- / comment-content -->
		<?php
	comment_reply_link( array_merge( $args, array(
		'depth' => $depth,
		'max_depth' => $args['max_depth'],
		'reply_text' => apply_filters( 'yit_comment_reply_link_text', '<div class="reply"><img class="comment-reply-link" src="' . YIT_THEME_TEMPLATES_URL . '/comments/images/comment-reply-link.png" title="' . __( 'reply', 'yit' ) . '" alt="+" />' . __( 'reply', 'yit' ).'</div>' )
	) ) ); ?>

  </div>
					</div>
                </div><!-- #comment-##  -->
            </div>
        <?php
                break;
        endswitch;
    }
}



if(!class_exists('wpw_messages')){
	class wpw_messages extends WP_Widget {
		function wpw_messages() {
		//Constructor
			$widget_ops = array('classname' => 'widget message', 'description' => '' );		
			$this->WP_Widget('wpw_messages','wp Messages', $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			?>
			<?php
			global $current_user;
			if($current_user->ID)
			{
			?>					
		  <div>
		  <?php if($title){?>
		  <?php  echo $before_title; ?>
		  <a href="<?php echo site_url('members/admin/messages/inbox/');?>" class="messages"><?php echo $title;?></a>
		  <?php echo $after_title;?>
		  <?php }?>
		  
		  <ul>
			<li><a href="<?php echo site_url('members/admin/messages/inbox/');?>" class="inbox"><?php _e('Inbox','yit');?></a></li>
			<li><a href="<?php echo site_url('members/admin/messages/sentbox/');?>" class="sentbox"><?php _e('Sent','yit');?></a></li>
			<li><a href="<?php echo site_url('members/admin/messages/compose/');?>" class="compose"><?php _e('Compose','yit');?></a></li>
			<li><a href="<?php echo site_url('members/admin/messages/notices/');?>" class="notices"><?php _e('All Member Notices','yit');?></a></li>
		  </ul>
		</div>
			<?php }?>      
		<?php
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );		
			$title = strip_tags($instance['title']);
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','yit');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>     
	<?php
	}}
	register_widget('wpw_messages');
}

if(!class_exists('wpw_settings')){
	class wpw_settings extends WP_Widget {
		function wpw_settings() {
		//Constructor
			$widget_ops = array('classname' => 'widget message', 'description' => '' );		
			$this->WP_Widget('wpw_settings','wp Settings', $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			?>
		<?php
		global $current_user;
		if($current_user->ID)
		{
		?>				
		  <div>
		  <?php if($title){?>
		  <?php  echo $before_title; ?>
		  <a href="<?php echo site_url('members/admin/settings/');?>" class="messages"><?php echo $title;?></a>
		  <?php echo $after_title;?>
		  <?php }?>
		  <ul>
			<li><a href="<?php echo site_url('members/admin/settings/general/');?>" class="general"><?php _e('General','yit');?></a></li>
			<li><a href="<?php echo site_url('members/admin/settings/notifications/');?>" class="notifications"><?php _e('Notifications','yit');?></a></li>
			<li><a href="<?php echo site_url('members/admin/profile/edit/group/');?>" class="edit_profile"><?php _e('Edit Profile','yit');?></a></li>
			<li><a href="<?php echo site_url('members/admin/profile/change-avatar/');?>" class="change_avtar"><?php _e('Change Avatar','yit');?></a></li>
		  </ul>
		</div>
      	<?php }?>
		<?php
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );		
			$title = strip_tags($instance['title']);
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','yit');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>     
	<?php
	}}
	register_widget('wpw_settings');
}	

// Register widgetized areas
if ( function_exists('register_sidebar') ) {

	 register_sidebars(1,array('name' => 'Additional Sidebar','id' => 'additional_sidebar','before_widget' => '<div>','after_widget' => '</div>'));
}

add_action('yit_before_content','yit_before_content_fun');
function yit_before_content_fun()
{
	include('sidebar-left.php');
}

global $wpdb;
$sql1 = "UPDATE wp_posts SET ping_status='closed' WHERE post_status = 'publish' AND post_type = 'post'";
$sql2 = "UPDATE wp_posts SET ping_status='closed' WHERE post_status = 'publish' AND post_type = 'page'";
$wpdb->query($sql1);
$wpdb->query($sql2);


if( !function_exists( 'yit_header' ) ) {
    function yit_header() {
		//yit_get_template( '/header/header.php' );
		include('templates/header/header.php');
    }
}

add_action('wp_footer','footer_activity_comment_js');
function footer_activity_comment_js()
{
?>
<script type="text/javascript">
function showhidecomments(divid)
{
	if(document.getElementById(divid).style.display=='none')
	{
		document.getElementById(divid).style.display='';
	}else{
		document.getElementById(divid).style.display='none';
	}
}
</script>
<?php
}

$admin_path = TEMPLATEPATH . '/admin/';
$wpw_admin_url = get_stylesheet_directory_uri() . '/admin/';
define('WPW_ADMIN_PATH',$admin_path);
define('WPW_ADMIN_URL',$wpw_admin_url);
include_once('admin/common-functions.php');

add_action('wp_head','wp_head_noindex');
function wp_head_noindex()
{
?>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<?php
}
?>
