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


// Make sure we have built in support for MySQL
if (!function_exists('mysqli_connect'))
	exit('This PHP environment doesn\'t have MySQL support built in. MySQL support is required if you want to use a MySQL database to run this forum. Consult the PHP documentation for further assistance.');


class DBLayer
{
	var $prefix;
	var $link_id;
	var $query_result;

	var $saved_queries = array();
	var $num_queries = 0;

    var $error_no = false;
    var $error_msg = 'Unknown';

	function DBLayer($db_host, $db_username, $db_password, $db_name, $db_prefix, $p_connect)
	{
        $this->prefix = $db_prefix;

        // Was a custom port supplied with $db_host?
        if (strpos($db_host, ':') !== false)
        list($db_host, $db_port) = explode(':', $db_host);
        
        // Persistent connection in MySQLi are only available in PHP 5.3 and later releases
        $p_connect = $p_connect && version_compare(PHP_VERSION, '5.3.0', '>=') ? 'p:' : '';
        
        if (isset($db_port))
            $this->link_id = mysqli_connect($p_connect.$db_host, $db_username, $db_password, $db_name, $db_port);
        else
            $this->link_id = mysqli_connect($p_connect.$db_host, $db_username, $db_password, $db_name);

		if (!$this->link_id)
			trigger_error('<<< Unable to connect to MySQL server. >>> ',E_USER_ERROR);
	}


	function start_transaction()
	{
		return;
	}


	function end_transaction()
	{
		return;
	}


	function query($sql, $unbuffered = false)
	{
	    $this->query_result = mysqli_query($this->link_id, $sql);

		if ($this->query_result)
		{
 			++$this->num_queries;
			return $this->query_result;
		}
		else
		{
            $this->error_no = mysqli_errno($this->link_id);
            $this->error_msg = mysqli_error($this->link_id);		    
			trigger_error('<<< Erreur SQL >>> '.$sql." Erreur ".$this->error_no." : ".$this->error_msg."  Sur la page  : ".$_SERVER['SCRIPT_NAME'], E_USER_WARNING);
			return false;
		}
	}


	function result($query_id = 0, $row = 0, $col = 0)
	{
        if ($query_id)
        {
            if ($row !== 0 && mysqli_data_seek($query_id, $row) === false)
                return false;
            
            $cur_row = mysqli_fetch_row($query_id);
            if ($cur_row === false)
                return false;
            
            return $cur_row[$col];
        }
        else
            return false;
	}


	function fetch_assoc($query_id = 0)
	{
		return ($query_id) ? mysqli_fetch_assoc($query_id) : false;
	}


	function fetch_row($query_id = 0)
	{
		return ($query_id) ? mysqli_fetch_row($query_id) : false;
	}


	function num_rows($query_id = 0)
	{
		return ($query_id) ? mysqli_num_rows($query_id) : false;
	}


	function affected_rows()
	{
		return ($this->link_id) ? mysqli_affected_rows($this->link_id) : false;
	}


	function insert_id()
	{
		return ($this->link_id) ? mysqli_insert_id($this->link_id) : false;
	}


	function get_num_queries()
	{
		return $this->num_queries;
	}

	function get_saved_queries()
	{
		return $this->saved_queries;
	}


	function free_result($query_id = false)
	{
		return ($query_id) ? mysqli_free_result($query_id) : false;
	}


	function escape($str)
	{
		  return is_array($str) ? '' : mysqli_real_escape_string($this->link_id, $str);
	}


	function error()
	{
		$result['error_sql'] = current(end($this->saved_queries));
		$result['error_no'] = $this->error_no;
		$result['error_msg'] = $this->error_msg;

		return $result;
	}


	function close()
	{
		if ($this->link_id)
		{
			if ($this->query_result)
				mysqli_free_result($this->query_result);

			return mysqli_close($this->link_id);
		}
		else
			return false;
	}
}
?>