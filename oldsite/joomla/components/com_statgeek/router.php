<?php
/*------------------------------------------------------------------------
# router.php - Stat Geek Component
# ------------------------------------------------------------------------
# author    Nate Mason
# copyright Copyright (C) 2013. All Rights Reserved
# license   GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.bricklayertech.com
-------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

function StatgeekBuildRoute(&$query)
{
	$segments = array();

	if(isset($query['view'])):
		$segments[] = $query['view'];
		unset($query['view']);
	endif;

	if(isset($query['id'])):
		$segments[] = $query['id'];
		unset($query['id']);
	endif;

	return $segments;
}

function StatgeekParseRoute($segments)
{
	$vars = array();
	// Count segments
	$count = count($segments);
	//Handle View and Identifier
	switch($segments[0])
	{
		case 'statgeek':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'statgeek';
			break;

		case 'statgeek':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'statgeek';
			break;
		case 'sports':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'sports';
			break;

		case 'sport':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'sport';
			break;
		case 'leagues':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'leagues';
			break;

		case 'league':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'league';
			break;
		case 'seasons':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'seasons';
			break;

		case 'season':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'season';
			break;
		case 'games':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'games';
			break;

		case 'game':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'game';
			break;
		case 'stats':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'stats';
			break;

		case 'stat':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'stat';
			break;
		case 'positions':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'positions';
			break;

		case 'position':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'position';
			break;
		case 'teams':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'teams';
			break;

		case 'team':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'team';
			break;
		case 'players':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'players';
			break;

		case 'player':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'player';
			break;
		case 'coaches':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'coaches';
			break;

		case 'coache':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'coache';
			break;
		case 'attributes':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'attributes';
			break;

		case 'attribute':
			$id = explode(':', $segments[$count-1]);
			$vars['id'] = (int) $id[0];
			$vars['view'] = 'attribute';
			break;
	}

	return $vars;
}
?>