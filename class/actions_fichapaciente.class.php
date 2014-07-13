<?php
/*
 * Copyright (C) 2014      Ion Agorria          <cubexed@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *      \file       actions_fichapaciente.class.php
 *      \brief      File of hooks for module
 */

require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';

class ActionsFichaPaciente // extends CommonObject
{
	/**
	 *  @param      parameters         meta datas of the hook (context, etc...)
	 *  @param      object             the object you want to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 *  @param      action             current action (if set). Generally create or edit or null
	 *  @return       void
	 */
	function printTopRightMenu($parameters, &$object, &$action, $hookmanager)
	{
		return $this->check_client($hookmanager->db);
	}
	function printLeftBlock($parameters, &$object, &$action, $hookmanager)
	{
		return $this->check_client($hookmanager->db);
	}

	private function check_client($db)
	{
		global $conf;
		if (empty($conf->fichapaciente_checked)) { //Run once
			$conf->fichapaciente_checked = True;
			$id = (GETPOST('socid','int') ? GETPOST('socid','int') : GETPOST('id','int'));
			$object = new Societe($db);
			$object->fetch($id);
			if (in_array($object->client, array(1,2,3))) {
				$conf->fichapaciente_tab = True;
			}
		}
	}
}

?>