<?php
/***********************************************************************

  Copyright (C) 2002-2005  Rickard Andersson (rickard@punbb.org)

  This file is part of PunBB.

  PunBB is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  PunBB is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston,
  MA  02111-1307  USA

************************************************************************/


// Load the appropriate DB layer class
switch ($db_type)
{
	case 'mysql':
		require ROOT.'config/classes/mysql.class.php';
		break;

	case 'mysqli':
		require ROOT.'config/classes/mysqli.class.php';
		break;

	case 'pgsql':
		require ROOT.'config/classes/pgsql.class.php';
		break;

	case 'sqlite':
		require ROOT.'config/classes/sqlite.class.php';
		break;

	default:
		trigger_error('\''.$db_type.'\' is not a valid database type. Please check settings in config.php.',E_USER_ERROR);
		break;
}


// Create the database adapter object (and open/connect to/select db)
if (SERVEUR == 'local' )
	$db = new DBLayer($db_local_host, $db_local_username, $db_local_password, $db_local_name, '', $p_local_connect);
else
	$db = new DBLayer($db_host, $db_username, $db_password, $db_name, '', $p_connect);
?>