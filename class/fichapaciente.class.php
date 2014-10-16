<?php
/* Copyright (C) 2007-2012 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2014      Ion Agorria          <ion@agorria.com>
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
 *  \file       dev/skeletons/fichapaciente.class.php
 *  \ingroup    mymodule othermodule1 othermodule2
 *  \brief      This file is an example for a CRUD class file (Create/Read/Update/Delete)
 *				Initialy built by build_class_from_table on 2014-07-10 00:00
 */

// Put here all includes required by your class file
require_once(DOL_DOCUMENT_ROOT."/core/class/commonobject.class.php");
//require_once(DOL_DOCUMENT_ROOT."/societe/class/societe.class.php");
//require_once(DOL_DOCUMENT_ROOT."/product/class/product.class.php");


/**
 *	Put here description of your class
 */
class FichaPaciente extends CommonObject
{
	var $db;							//!< To store db handler
	var $error;							//!< To return error code (or message)
	var $errors=array();				//!< To return several error codes (or messages)
	var $element='fichapaciente';			//!< Id that identify managed objects
	var $table_element='fichapaciente';		//!< Name of table without prefix where object is stored

    var $id;

	var $fk_patient;
	var $optometrist;
	var $test_date='';
	var $anamnesis;
	var $od_avsc;
	var $od_avcc;
	var $od_dnp;
	var $od_kx;
	var $oi_avsc;
	var $oi_avcc;
	var $oi_dnp;
	var $oi_kx;
	var $tests_2;
	var $od_esf;
	var $od_cil;
	var $od_eje;
	var $od_ad;
	var $od_av;
	var $oi_esf;
	var $oi_cil;
	var $oi_eje;
	var $oi_ad;
	var $oi_av;
	var $tests_4;
	var $note1_4;
	var $note2_4;
	var $note3_4;
	var $note4_4;
	var $note5_4;
	var $note6_4;
	var $note7_4;
	var $note_5;

    /**
     *  Constructor
     *
     *  @param	DoliDb		$db      Database handler
     */
    function __construct($db)
    {
        $this->db = $db;
        return 1;
    }

    /**
     *  Create object into database
     *
     *  @return int      		   	 <0 if KO, Id of created object if OK
     */
    function create()
    {
    	global $conf, $langs;
		$error=0;

		// Clean parameters

		if (isset($this->fk_patient)) $this->fk_patient=trim($this->fk_patient);
		if (isset($this->optometrist)) $this->optometrist=trim($this->optometrist);
		if (isset($this->anamnesis)) $this->anamnesis=trim($this->anamnesis);
		if (isset($this->od_avsc)) $this->od_avsc=trim($this->od_avsc);
		if (isset($this->od_avcc)) $this->od_avcc=trim($this->od_avcc);
		if (isset($this->od_dnp)) $this->od_dnp=trim($this->od_dnp);
		if (isset($this->od_kx)) $this->od_kx=trim($this->od_kx);
		if (isset($this->oi_avsc)) $this->oi_avsc=trim($this->oi_avsc);
		if (isset($this->oi_avcc)) $this->oi_avcc=trim($this->oi_avcc);
		if (isset($this->oi_dnp)) $this->oi_dnp=trim($this->oi_dnp);
		if (isset($this->oi_kx)) $this->oi_kx=trim($this->oi_kx);
		if (isset($this->tests_2)) $this->tests_2=trim($this->tests_2);
		if (isset($this->od_esf)) $this->od_esf=trim($this->od_esf);
		if (isset($this->od_cil)) $this->od_cil=trim($this->od_cil);
		if (isset($this->od_eje)) $this->od_eje=trim($this->od_eje);
		if (isset($this->od_ad)) $this->od_ad=trim($this->od_ad);
		if (isset($this->od_av)) $this->od_av=trim($this->od_av);
		if (isset($this->oi_esf)) $this->oi_esf=trim($this->oi_esf);
		if (isset($this->oi_cil)) $this->oi_cil=trim($this->oi_cil);
		if (isset($this->oi_eje)) $this->oi_eje=trim($this->oi_eje);
		if (isset($this->oi_ad)) $this->oi_ad=trim($this->oi_ad);
		if (isset($this->oi_av)) $this->oi_av=trim($this->oi_av);
		if (isset($this->tests_4)) $this->tests_4=trim($this->tests_4);
		if (isset($this->note1_4)) $this->note1_4=trim($this->note1_4);
		if (isset($this->note2_4)) $this->note2_4=trim($this->note2_4);
		if (isset($this->note3_4)) $this->note3_4=trim($this->note3_4);
		if (isset($this->note4_4)) $this->note4_4=trim($this->note4_4);
		if (isset($this->note5_4)) $this->note5_4=trim($this->note5_4);
		if (isset($this->note6_4)) $this->note6_4=trim($this->note6_4);
		if (isset($this->note7_4)) $this->note7_4=trim($this->note7_4);
		if (isset($this->note_5)) $this->note_5=trim($this->note_5);



		// Check parameters
		// Put here code to add control on parameters values

        // Insert request
		$sql = "INSERT INTO ".MAIN_DB_PREFIX."fichapaciente(";

		$sql.= "fk_patient,";
		$sql.= "optometrist,";
		$sql.= "test_date,";
		$sql.= "anamnesis,";
		$sql.= "od_avsc,";
		$sql.= "od_avcc,";
		$sql.= "od_dnp,";
		$sql.= "od_kx,";
		$sql.= "oi_avsc,";
		$sql.= "oi_avcc,";
		$sql.= "oi_dnp,";
		$sql.= "oi_kx,";
		$sql.= "tests_2,";
		$sql.= "od_esf,";
		$sql.= "od_cil,";
		$sql.= "od_eje,";
		$sql.= "od_ad,";
		$sql.= "od_av,";
		$sql.= "oi_esf,";
		$sql.= "oi_cil,";
		$sql.= "oi_eje,";
		$sql.= "oi_ad,";
		$sql.= "oi_av,";
		$sql.= "tests_4,";
		$sql.= "note1_4,";
		$sql.= "note2_4,";
		$sql.= "note3_4,";
		$sql.= "note4_4,";
		$sql.= "note5_4,";
		$sql.= "note6_4,";
		$sql.= "note7_4,";
		$sql.= "note_5";


        $sql.= ") VALUES (";

		$sql.= " ".(! isset($this->fk_patient)?'NULL':"'".$this->fk_patient."'").",";
		$sql.= " ".(! isset($this->optometrist)?'NULL':"'".$this->db->escape($this->optometrist)."'").",";
		$sql.= " ".(! isset($this->test_date) || dol_strlen($this->test_date)==0?'NULL':$this->db->idate($this->test_date)).",";
		$sql.= " ".(! isset($this->anamnesis)?'NULL':"'".$this->db->escape($this->anamnesis)."'").",";
		$sql.= " ".(! isset($this->od_avsc)?'NULL':"'".$this->db->escape($this->od_avsc)."'").",";
		$sql.= " ".(! isset($this->od_avcc)?'NULL':"'".$this->db->escape($this->od_avcc)."'").",";
		$sql.= " ".(! isset($this->od_dnp)?'NULL':"'".$this->db->escape($this->od_dnp)."'").",";
		$sql.= " ".(! isset($this->od_kx)?'NULL':"'".$this->db->escape($this->od_kx)."'").",";
		$sql.= " ".(! isset($this->oi_avsc)?'NULL':"'".$this->db->escape($this->oi_avsc)."'").",";
		$sql.= " ".(! isset($this->oi_avcc)?'NULL':"'".$this->db->escape($this->oi_avcc)."'").",";
		$sql.= " ".(! isset($this->oi_dnp)?'NULL':"'".$this->db->escape($this->oi_dnp)."'").",";
		$sql.= " ".(! isset($this->oi_kx)?'NULL':"'".$this->db->escape($this->oi_kx)."'").",";
		$sql.= " ".(! isset($this->tests_2)?'NULL':"'".$this->db->escape($this->tests_2)."'").",";
		$sql.= " ".(! isset($this->od_esf)?'NULL':"'".$this->db->escape($this->od_esf)."'").",";
		$sql.= " ".(! isset($this->od_cil)?'NULL':"'".$this->db->escape($this->od_cil)."'").",";
		$sql.= " ".(! isset($this->od_eje)?'NULL':"'".$this->db->escape($this->od_eje)."'").",";
		$sql.= " ".(! isset($this->od_ad)?'NULL':"'".$this->db->escape($this->od_ad)."'").",";
		$sql.= " ".(! isset($this->od_av)?'NULL':"'".$this->db->escape($this->od_av)."'").",";
		$sql.= " ".(! isset($this->oi_esf)?'NULL':"'".$this->db->escape($this->oi_esf)."'").",";
		$sql.= " ".(! isset($this->oi_cil)?'NULL':"'".$this->db->escape($this->oi_cil)."'").",";
		$sql.= " ".(! isset($this->oi_eje)?'NULL':"'".$this->db->escape($this->oi_eje)."'").",";
		$sql.= " ".(! isset($this->oi_ad)?'NULL':"'".$this->db->escape($this->oi_ad)."'").",";
		$sql.= " ".(! isset($this->oi_av)?'NULL':"'".$this->db->escape($this->oi_av)."'").",";
		$sql.= " ".(! isset($this->tests_4)?'NULL':"'".$this->db->escape($this->tests_4)."'").",";
		$sql.= " ".(! isset($this->note1_4)?'NULL':"'".$this->db->escape($this->note1_4)."'").",";
		$sql.= " ".(! isset($this->note2_4)?'NULL':"'".$this->db->escape($this->note2_4)."'").",";
		$sql.= " ".(! isset($this->note3_4)?'NULL':"'".$this->db->escape($this->note3_4)."'").",";
		$sql.= " ".(! isset($this->note4_4)?'NULL':"'".$this->db->escape($this->note4_4)."'").",";
		$sql.= " ".(! isset($this->note5_4)?'NULL':"'".$this->db->escape($this->note5_4)."'").",";
		$sql.= " ".(! isset($this->note6_4)?'NULL':"'".$this->db->escape($this->note6_4)."'").",";
		$sql.= " ".(! isset($this->note7_4)?'NULL':"'".$this->db->escape($this->note7_4)."'").",";
		$sql.= " ".(! isset($this->note_5)?'NULL':"'".$this->db->escape($this->note_5)."'")."";


		$sql.= ")";

		$this->db->begin();

	   	dol_syslog(get_class($this)."::create sql=".$sql, LOG_DEBUG);
        $resql=$this->db->query($sql);
    	if (! $resql) { $error++; $this->errors[]="Error ".$this->db->lasterror(); }

		if (! $error)
        {
            $this->id = $this->db->last_insert_id(MAIN_DB_PREFIX."fichapaciente");
        }

        // Commit or rollback
        if ($error)
		{
			foreach($this->errors as $errmsg)
			{
	            dol_syslog(get_class($this)."::create ".$errmsg, LOG_ERR);
	            $this->error.=($this->error?', '.$errmsg:$errmsg);
			}
			$this->db->rollback();
			return -1*$error;
		}
		else
		{
			$this->db->commit();
            return $this->id;
		}
    }


    /**
     *  Load object in memory from the database
     *
     *  @param	int		$id    Id object
     *  @return int          	<0 if KO, >0 if OK
     */
    function fetch($id)
    {
    	global $langs;
        $sql = "SELECT";
		$sql.= " t.rowid,";

		$sql.= " t.fk_patient,";
		$sql.= " t.optometrist,";
		$sql.= " t.test_date,";
		$sql.= " t.anamnesis,";
		$sql.= " t.od_avsc,";
		$sql.= " t.od_avcc,";
		$sql.= " t.od_dnp,";
		$sql.= " t.od_kx,";
		$sql.= " t.oi_avsc,";
		$sql.= " t.oi_avcc,";
		$sql.= " t.oi_dnp,";
		$sql.= " t.oi_kx,";
		$sql.= " t.tests_2,";
		$sql.= " t.od_esf,";
		$sql.= " t.od_cil,";
		$sql.= " t.od_eje,";
		$sql.= " t.od_ad,";
		$sql.= " t.od_av,";
		$sql.= " t.oi_esf,";
		$sql.= " t.oi_cil,";
		$sql.= " t.oi_eje,";
		$sql.= " t.oi_ad,";
		$sql.= " t.oi_av,";
		$sql.= " t.tests_4,";
		$sql.= " t.note1_4,";
		$sql.= " t.note2_4,";
		$sql.= " t.note3_4,";
		$sql.= " t.note4_4,";
		$sql.= " t.note5_4,";
		$sql.= " t.note6_4,";
		$sql.= " t.note7_4,";
		$sql.= " t.note_5";


        $sql.= " FROM ".MAIN_DB_PREFIX."fichapaciente as t";
        $sql.= " WHERE t.rowid = ".$id;

    	dol_syslog(get_class($this)."::fetch sql=".$sql, LOG_DEBUG);
        $resql=$this->db->query($sql);
        if ($resql)
        {
            $num = $this->db->num_rows($resql);
            if ($num)
            {
                $obj = $this->db->fetch_object($resql);

                $this->id    = $obj->rowid;

				$this->fk_patient = $obj->fk_patient;
				$this->optometrist = $obj->optometrist;
				$this->test_date = $this->db->jdate($obj->test_date);
				$this->anamnesis = $obj->anamnesis;
				$this->od_avsc = $obj->od_avsc;
				$this->od_avcc = $obj->od_avcc;
				$this->od_dnp = $obj->od_dnp;
				$this->od_kx = $obj->od_kx;
				$this->oi_avsc = $obj->oi_avsc;
				$this->oi_avcc = $obj->oi_avcc;
				$this->oi_dnp = $obj->oi_dnp;
				$this->oi_kx = $obj->oi_kx;
				$this->tests_2 = $obj->tests_2;
				$this->od_esf = $obj->od_esf;
				$this->od_cil = $obj->od_cil;
				$this->od_eje = $obj->od_eje;
				$this->od_ad = $obj->od_ad;
				$this->od_av = $obj->od_av;
				$this->oi_esf = $obj->oi_esf;
				$this->oi_cil = $obj->oi_cil;
				$this->oi_eje = $obj->oi_eje;
				$this->oi_ad = $obj->oi_ad;
				$this->oi_av = $obj->oi_av;
				$this->tests_4 = $obj->tests_4;
				$this->note1_4 = $obj->note1_4;
				$this->note2_4 = $obj->note2_4;
				$this->note3_4 = $obj->note3_4;
				$this->note4_4 = $obj->note4_4;
				$this->note5_4 = $obj->note5_4;
				$this->note6_4 = $obj->note6_4;
				$this->note7_4 = $obj->note7_4;
				$this->note_5 = $obj->note_5;


            }
            $this->db->free($resql);

            return $num;
        }
        else
        {
      	    $this->error="Error ".$this->db->lasterror();
            dol_syslog(get_class($this)."::fetch ".$this->error, LOG_ERR);
            return -1;
        }
    }


    /**
     *  Load object in memory from the database using id of patient
     *
     *  @param  int     $id    Id of patient
     *  @return int             <0 if KO, >0 if OK
     */
    function fetch_patient($fk_patient)
    {
        global $langs;
        $sql = "SELECT";
        $sql.= " t.rowid,";

        $sql.= " t.fk_patient,";
        $sql.= " t.optometrist,";
        $sql.= " t.test_date,";
        $sql.= " t.anamnesis,";
        $sql.= " t.od_avsc,";
        $sql.= " t.od_avcc,";
        $sql.= " t.od_dnp,";
        $sql.= " t.od_kx,";
        $sql.= " t.oi_avsc,";
        $sql.= " t.oi_avcc,";
        $sql.= " t.oi_dnp,";
        $sql.= " t.oi_kx,";
        $sql.= " t.tests_2,";
        $sql.= " t.od_esf,";
        $sql.= " t.od_cil,";
        $sql.= " t.od_eje,";
        $sql.= " t.od_ad,";
        $sql.= " t.od_av,";
        $sql.= " t.oi_esf,";
        $sql.= " t.oi_cil,";
        $sql.= " t.oi_eje,";
        $sql.= " t.oi_ad,";
        $sql.= " t.oi_av,";
        $sql.= " t.tests_4,";
        $sql.= " t.note1_4,";
        $sql.= " t.note2_4,";
        $sql.= " t.note3_4,";
        $sql.= " t.note4_4,";
        $sql.= " t.note5_4,";
        $sql.= " t.note6_4,";
        $sql.= " t.note7_4,";
        $sql.= " t.note_5";


        $sql.= " FROM ".MAIN_DB_PREFIX."fichapaciente as t";
        $sql.= " WHERE t.fk_patient = ".$fk_patient;

        dol_syslog(get_class($this)."::fetch sql=".$sql, LOG_DEBUG);
        $resql=$this->db->query($sql);
        if ($resql)
        {
            $num = $this->db->num_rows($resql);
            if ($num)
            {
                $obj = $this->db->fetch_object($resql);

                $this->id    = $obj->rowid;

                $this->fk_patient = $obj->fk_patient;
                $this->optometrist = $obj->optometrist;
                $this->test_date = $this->db->jdate($obj->test_date);
                $this->anamnesis = $obj->anamnesis;
                $this->od_avsc = $obj->od_avsc;
                $this->od_avcc = $obj->od_avcc;
                $this->od_dnp = $obj->od_dnp;
                $this->od_kx = $obj->od_kx;
                $this->oi_avsc = $obj->oi_avsc;
                $this->oi_avcc = $obj->oi_avcc;
                $this->oi_dnp = $obj->oi_dnp;
                $this->oi_kx = $obj->oi_kx;
                $this->tests_2 = $obj->tests_2;
                $this->od_esf = $obj->od_esf;
                $this->od_cil = $obj->od_cil;
                $this->od_eje = $obj->od_eje;
                $this->od_ad = $obj->od_ad;
                $this->od_av = $obj->od_av;
                $this->oi_esf = $obj->oi_esf;
                $this->oi_cil = $obj->oi_cil;
                $this->oi_eje = $obj->oi_eje;
                $this->oi_ad = $obj->oi_ad;
                $this->oi_av = $obj->oi_av;
                $this->tests_4 = $obj->tests_4;
                $this->note1_4 = $obj->note1_4;
                $this->note2_4 = $obj->note2_4;
                $this->note3_4 = $obj->note3_4;
                $this->note4_4 = $obj->note4_4;
                $this->note5_4 = $obj->note5_4;
                $this->note6_4 = $obj->note6_4;
                $this->note7_4 = $obj->note7_4;
                $this->note_5 = $obj->note_5;


            }
            $this->db->free($resql);

            return $num;
        }
        else
        {
            $this->error="Error ".$this->db->lasterror();
            dol_syslog(get_class($this)."::fetch ".$this->error, LOG_ERR);
            return -1;
        }
    }


    /**
     *  Update object into database
     *
     *  @return int     		   	 <0 if KO, >0 if OK
     */
    function update()
    {
    	global $conf, $langs;
		$error=0;

		// Clean parameters

		if (isset($this->fk_patient)) $this->fk_patient=trim($this->fk_patient);
		if (isset($this->optometrist)) $this->optometrist=trim($this->optometrist);
		if (isset($this->anamnesis)) $this->anamnesis=trim($this->anamnesis);
		if (isset($this->od_avsc)) $this->od_avsc=trim($this->od_avsc);
		if (isset($this->od_avcc)) $this->od_avcc=trim($this->od_avcc);
		if (isset($this->od_dnp)) $this->od_dnp=trim($this->od_dnp);
		if (isset($this->od_kx)) $this->od_kx=trim($this->od_kx);
		if (isset($this->oi_avsc)) $this->oi_avsc=trim($this->oi_avsc);
		if (isset($this->oi_avcc)) $this->oi_avcc=trim($this->oi_avcc);
		if (isset($this->oi_dnp)) $this->oi_dnp=trim($this->oi_dnp);
		if (isset($this->oi_kx)) $this->oi_kx=trim($this->oi_kx);
		if (isset($this->tests_2)) $this->tests_2=trim($this->tests_2);
		if (isset($this->od_esf)) $this->od_esf=trim($this->od_esf);
		if (isset($this->od_cil)) $this->od_cil=trim($this->od_cil);
		if (isset($this->od_eje)) $this->od_eje=trim($this->od_eje);
		if (isset($this->od_ad)) $this->od_ad=trim($this->od_ad);
		if (isset($this->od_av)) $this->od_av=trim($this->od_av);
		if (isset($this->oi_esf)) $this->oi_esf=trim($this->oi_esf);
		if (isset($this->oi_cil)) $this->oi_cil=trim($this->oi_cil);
		if (isset($this->oi_eje)) $this->oi_eje=trim($this->oi_eje);
		if (isset($this->oi_ad)) $this->oi_ad=trim($this->oi_ad);
		if (isset($this->oi_av)) $this->oi_av=trim($this->oi_av);
		if (isset($this->tests_4)) $this->tests_4=trim($this->tests_4);
		if (isset($this->note1_4)) $this->note1_4=trim($this->note1_4);
		if (isset($this->note2_4)) $this->note2_4=trim($this->note2_4);
		if (isset($this->note3_4)) $this->note3_4=trim($this->note3_4);
		if (isset($this->note4_4)) $this->note4_4=trim($this->note4_4);
		if (isset($this->note5_4)) $this->note5_4=trim($this->note5_4);
		if (isset($this->note6_4)) $this->note6_4=trim($this->note6_4);
		if (isset($this->note7_4)) $this->note7_4=trim($this->note7_4);
		if (isset($this->note_5)) $this->note_5=trim($this->note_5);



		// Check parameters
		// Put here code to add a control on parameters values

        // Update request
        $sql = "UPDATE ".MAIN_DB_PREFIX."fichapaciente SET";

		$sql.= " fk_patient=".(isset($this->fk_patient)?$this->fk_patient:"null").",";
		$sql.= " optometrist=".(isset($this->optometrist)?"'".$this->db->escape($this->optometrist)."'":"null").",";
		$sql.= " test_date=".(dol_strlen($this->test_date)!=0 ? "'".$this->db->idate($this->test_date)."'" : 'null').",";
		$sql.= " anamnesis=".(isset($this->anamnesis)?"'".$this->db->escape($this->anamnesis)."'":"null").",";
		$sql.= " od_avsc=".(isset($this->od_avsc)?"'".$this->db->escape($this->od_avsc)."'":"null").",";
		$sql.= " od_avcc=".(isset($this->od_avcc)?"'".$this->db->escape($this->od_avcc)."'":"null").",";
		$sql.= " od_dnp=".(isset($this->od_dnp)?"'".$this->db->escape($this->od_dnp)."'":"null").",";
		$sql.= " od_kx=".(isset($this->od_kx)?"'".$this->db->escape($this->od_kx)."'":"null").",";
		$sql.= " oi_avsc=".(isset($this->oi_avsc)?"'".$this->db->escape($this->oi_avsc)."'":"null").",";
		$sql.= " oi_avcc=".(isset($this->oi_avcc)?"'".$this->db->escape($this->oi_avcc)."'":"null").",";
		$sql.= " oi_dnp=".(isset($this->oi_dnp)?"'".$this->db->escape($this->oi_dnp)."'":"null").",";
		$sql.= " oi_kx=".(isset($this->oi_kx)?"'".$this->db->escape($this->oi_kx)."'":"null").",";
		$sql.= " tests_2=".(isset($this->tests_2)?"'".$this->db->escape($this->tests_2)."'":"null").",";
		$sql.= " od_esf=".(isset($this->od_esf)?"'".$this->db->escape($this->od_esf)."'":"null").",";
		$sql.= " od_cil=".(isset($this->od_cil)?"'".$this->db->escape($this->od_cil)."'":"null").",";
		$sql.= " od_eje=".(isset($this->od_eje)?"'".$this->db->escape($this->od_eje)."'":"null").",";
		$sql.= " od_ad=".(isset($this->od_ad)?"'".$this->db->escape($this->od_ad)."'":"null").",";
		$sql.= " od_av=".(isset($this->od_av)?"'".$this->db->escape($this->od_av)."'":"null").",";
		$sql.= " oi_esf=".(isset($this->oi_esf)?"'".$this->db->escape($this->oi_esf)."'":"null").",";
		$sql.= " oi_cil=".(isset($this->oi_cil)?"'".$this->db->escape($this->oi_cil)."'":"null").",";
		$sql.= " oi_eje=".(isset($this->oi_eje)?"'".$this->db->escape($this->oi_eje)."'":"null").",";
		$sql.= " oi_ad=".(isset($this->oi_ad)?"'".$this->db->escape($this->oi_ad)."'":"null").",";
		$sql.= " oi_av=".(isset($this->oi_av)?"'".$this->db->escape($this->oi_av)."'":"null").",";
		$sql.= " tests_4=".(isset($this->tests_4)?"'".$this->db->escape($this->tests_4)."'":"null").",";
		$sql.= " note1_4=".(isset($this->note1_4)?"'".$this->db->escape($this->note1_4)."'":"null").",";
		$sql.= " note2_4=".(isset($this->note2_4)?"'".$this->db->escape($this->note2_4)."'":"null").",";
		$sql.= " note3_4=".(isset($this->note3_4)?"'".$this->db->escape($this->note3_4)."'":"null").",";
		$sql.= " note4_4=".(isset($this->note4_4)?"'".$this->db->escape($this->note4_4)."'":"null").",";
		$sql.= " note5_4=".(isset($this->note5_4)?"'".$this->db->escape($this->note5_4)."'":"null").",";
		$sql.= " note6_4=".(isset($this->note6_4)?"'".$this->db->escape($this->note6_4)."'":"null").",";
		$sql.= " note7_4=".(isset($this->note7_4)?"'".$this->db->escape($this->note7_4)."'":"null").",";
		$sql.= " note_5=".(isset($this->note_5)?"'".$this->db->escape($this->note_5)."'":"null")."";


        $sql.= " WHERE rowid=".$this->id;

		$this->db->begin();

		dol_syslog(get_class($this)."::update sql=".$sql, LOG_DEBUG);
        $resql = $this->db->query($sql);
    	if (! $resql) { $error++; $this->errors[]="Error ".$this->db->lasterror(); }

        // Commit or rollback
		if ($error)
		{
			foreach($this->errors as $errmsg)
			{
	            dol_syslog(get_class($this)."::update ".$errmsg, LOG_ERR);
	            $this->error.=($this->error?', '.$errmsg:$errmsg);
			}
			$this->db->rollback();
			return -1*$error;
		}
		else
		{
			$this->db->commit();
			return 1;
		}
    }


 	/**
	 *  Delete object in database
     *
	 *  @return	int					 <0 if KO, >0 if OK
	 */
	function delete()
	{
		global $conf, $langs;
		$error=0;

		$this->db->begin();

		if (! $error)
		{
    		$sql = "DELETE FROM ".MAIN_DB_PREFIX."fichapaciente";
    		$sql.= " WHERE rowid=".$this->id;

    		dol_syslog(get_class($this)."::delete sql=".$sql);
    		$resql = $this->db->query($sql);
        	if (! $resql) { $error++; $this->errors[]="Error ".$this->db->lasterror(); }
		}

        // Commit or rollback
		if ($error)
		{
			foreach($this->errors as $errmsg)
			{
	            dol_syslog(get_class($this)."::delete ".$errmsg, LOG_ERR);
	            $this->error.=($this->error?', '.$errmsg:$errmsg);
			}
			$this->db->rollback();
			return -1*$error;
		}
		else
		{
			$this->db->commit();
			return 1;
		}
	}



	/**
	 *	Load an object from its id and create a new one in database
	 *
	 *	@param	int		$fromid     Id of object to clone
	 * 	@return	int					New id of clone
	 */
	function createFromClone($fromid)
	{
		global $langs;

		$error=0;

		$object=new Fichapaciente($this->db);

		$this->db->begin();

		// Load source object
		$object->fetch($fromid);
		$object->id=0;
		$object->statut=0;

		// Clear fields
		// ...

		// Create clone
		$result=$object->create();

		// Other options
		if ($result < 0)
		{
			$this->error=$object->error;
			$error++;
		}

		if (! $error)
		{


		}

		// End
		if (! $error)
		{
			$this->db->commit();
			return $object->id;
		}
		else
		{
			$this->db->rollback();
			return -1;
		}
	}


	/**
	 *	Initialise object with example values
	 *	Id must be 0 if object instance is a specimen
	 *
	 *	@return	void
	 */
	function initAsSpecimen()
	{
		$this->id=0;

		$this->fk_patient='';
		$this->optometrist='';
		$this->test_date='';
		$this->anamnesis='';
		$this->od_avsc='';
		$this->od_avcc='';
		$this->od_dnp='';
		$this->od_kx='';
		$this->oi_avsc='';
		$this->oi_avcc='';
		$this->oi_dnp='';
		$this->oi_kx='';
		$this->tests_2='';
		$this->od_esf='';
		$this->od_cil='';
		$this->od_eje='';
		$this->od_ad='';
		$this->od_av='';
		$this->oi_esf='';
		$this->oi_cil='';
		$this->oi_eje='';
		$this->oi_ad='';
		$this->oi_av='';
		$this->tests_4='';
		$this->note1_4='';
		$this->note2_4='';
		$this->note3_4='';
		$this->note4_4='';
		$this->note5_4='';
		$this->note6_4='';
		$this->note7_4='';
		$this->note_5='';
	}
}
?>
