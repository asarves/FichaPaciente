<?php
/*
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

//Load stuff
$res=@include("../main.inc.php");								  // For root directory
if (! $res) $res=@include("../../main.inc.php");				  // For "custom" directory
dol_include_once("/fichapaciente/class/fichapaciente.class.php"); // Import fichapaciente mysql interface

//Dolibarr
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formcompany.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/doleditor.class.php';
require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';

//Load languages
$langs->load("fichapaciente@fichapaciente");
$langs->load("companies");

// Security check
$id = (GETPOST('socid','int') ? GETPOST('socid','int') : GETPOST('id','int'));
if ($user->societe_id > 0) $id=$user->societe_id;
$result = restrictedArea($user,'societe',$id,'&societe');

//Header
llxHeader('',$langs->trans('CustomerCard'));

//Objects
$form = new Form($db);
$formcompany = new FormCompany($db);
$soc_object = new Societe($db);
$ficha_object = new FichaPaciente($db);
$user_object = new User($db);

//GET/POST values
$create			= GETPOST('create');
$save			= GETPOST('save');
$cancel			= GETPOST('cancel');
$delete			= GETPOST('delete');
$delete_confirm	= GETPOST('delete_confirm');
$tests_2 = "NNNN"; //Default values of tests_2
if (!empty(GETPOST("cb_cv")))  $tests_2[0] = GETPOST("cb_cv");
if (!empty(GETPOST("cb_ppc"))) $tests_2[1] = GETPOST("cb_ppc");
if (!empty(GETPOST("cb_mot"))) $tests_2[2] = GETPOST("cb_mot");
if (!empty(GETPOST("cb_rp")))  $tests_2[3] = GETPOST("cb_rp");
$tests_4 = "NNNNNNN"; //Default values of tests_4
if (!empty(GETPOST("cb_tw")))  $tests_4[0] = GETPOST("cb_tw");
if (!empty(GETPOST("cb_ts")))  $tests_4[1] = GETPOST("cb_ts");
if (!empty(GETPOST("cb_pc")))  $tests_4[2] = GETPOST("cb_pc");
if (!empty(GETPOST("cb_ra")))  $tests_4[3] = GETPOST("cb_ra");
if (!empty(GETPOST("cb_tm")))  $tests_4[4] = GETPOST("cb_tm");
if (!empty(GETPOST("cb_ret"))) $tests_4[5] = GETPOST("cb_ret");
if (!empty(GETPOST("cb_pio"))) $tests_4[6] = GETPOST("cb_pio");

if (empty($conf->fichapaciente->enabled)) {
	dol_print_error($db,'Module is disabled!');
} elseif ($id > 0) {
	$result = $ficha_object->fetch_patient($id); //Get the sql data using societe id
	if (!empty($create)) { //Create button was pressed
		if ($result == 0) { //Ensure that doesn't exist
			$user_result = $user_object->fetch($user->id); //Load user data
			if ($user_result > 0) {
				$optometrist = $user_object->firstname ." ". $user_object->lastname;
			} else {
				$optometrist = "";
			}
			//Put default values
			$ficha_object->fk_patient = $id;
			$ficha_object->optometrist = $optometrist;
			$ficha_object->test_date = date('Y-m-d', time());
			$result = $ficha_object->create();
		}
	} elseif (!empty($save)) { //Save button was pressed
		if ($result < 0) dol_print_error($db, $ficha_object->error);
		$ficha_object->optometrist 		= GETPOST("optometrist");
		$ficha_object->test_date 		= GETPOST("test_dateyear").'-'.GETPOST("test_datemonth").'-'.GETPOST("test_dateday");
		$ficha_object->anamnesis 		= GETPOST("anamnesis");
		$ficha_object->od_avsc 			= GETPOST("od_avsc");
		$ficha_object->od_avcc 			= GETPOST("od_avcc");
		$ficha_object->od_dnp 			= GETPOST("od_dnp");
		$ficha_object->od_kx 			= GETPOST("od_kx");
		$ficha_object->oi_avsc 			= GETPOST("oi_avsc");
		$ficha_object->oi_avcc 			= GETPOST("oi_avcc");
		$ficha_object->oi_dnp 			= GETPOST("oi_dnp");
		$ficha_object->oi_kx 			= GETPOST("oi_kx");
		$ficha_object->tests_2 			= $tests_2;
		$ficha_object->od_esf 			= GETPOST("od_esf");
		$ficha_object->od_cil 			= GETPOST("od_cil");
		$ficha_object->od_eje 			= GETPOST("od_eje");
		$ficha_object->od_ad 			= GETPOST("od_ad");
		$ficha_object->od_av 			= GETPOST("od_av");
		$ficha_object->oi_esf 			= GETPOST("oi_esf");
		$ficha_object->oi_cil 			= GETPOST("oi_cil");
		$ficha_object->oi_eje 			= GETPOST("oi_eje");
		$ficha_object->oi_ad 			= GETPOST("oi_ad");
		$ficha_object->oi_av 			= GETPOST("oi_av");
		$ficha_object->tests_4 			= $tests_4;
		$ficha_object->note1_4 			= GETPOST("note1_4");
		$ficha_object->note2_4 			= GETPOST("note2_4");
		$ficha_object->note3_4 			= GETPOST("note3_4");
		$ficha_object->note4_4 			= GETPOST("note4_4");
		$ficha_object->note5_4 			= GETPOST("note5_4");
		$ficha_object->note6_4 			= GETPOST("note6_4");
		$ficha_object->note7_4 			= GETPOST("note7_4");
		$ficha_object->note_5 			= GETPOST("note_5");
		$result = $ficha_object->update();
		if ($result < 0) dol_print_error($db, $ficha_object->error);
	} elseif (!empty($delete_confirm)) {
		$ficha_object->delete();
		$result = $ficha_object->fetch_patient($id); //Reupdate values
	}

	// Load data of third party
	$soc_object->fetch($id);
	if ($soc_object->id <= 0) dol_print_error($db, $soc_object->error);

	//Fiche head
	$head = societe_prepare_head($soc_object);
	dol_fiche_head($head, 'fichapaciente', $langs->trans("ThirdParty"),0,'company');

	//Create div with fixed width
	print '<div style="max-width: 800px">';

	//Create form
	print '<form enctype="multipart/form-data" action="'.$_SERVER["PHP_SELF"].'?socid='.$soc_object->id.'" method="post" name="formsoc">';
	print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';

	//Create table
	print '<table class="border" width="100%">';

	//Show patient name
	print '<tr>';
		print '<td width="25%">'.$langs->trans('fichapaciente_patient').'</td>';
		$soc_object->next_prev_filter="te.client in (1,2,3)";
		print '<td>'.$form->showrefnav($soc_object,'socid','',($user->societe_id?0:1),'rowid','nom','','').'</td>';
	print '</tr>';

	if (!empty($delete)) {
		//Close table
		print '</table><br>';

 		//Confirmation
		print '<center><b>'.$langs->trans("fichapaciente_delete_confirm").'</b></center><br>';

		//Buttons
		print '<center>';
			print '<input type="submit" class="button" name="delete_confirm" value="'.$langs->trans("Delete").'">';
			print '<input type="submit" class="button" name="cancel" value="'.$langs->trans("Cancel").'">';
		print '</center>';
	} elseif ($result > 0) { //Found
		//Optometrist
		print '<tr>';
			print '<td width="25%">'.$langs->trans('fichapaciente_optometrist').'</td>';
			print '<td><input type="text" size="81" maxlength="100" name="optometrist" value="'.$ficha_object->optometrist.'"></td>';
		print '</tr>';

		//Exam date
		print '<tr>';
			print '<td width="25%">'.$langs->trans('fichapaciente_date').'</td>';
			print '<td>'.$form->select_date($ficha_object->test_date,'test_date','','',0,'',1,1,1).'</td>';
		print '</tr>';

		//Test 1
		print '</table> <br> <table class="border" width="100%">'; //Close and create table
		print '<tr><td colspan="1"><b>&nbsp;&nbsp;'.$langs->trans('fichapaciente_test_1').'</b></td></tr>';
		print '<tr><td colspan="1">';
	        $doleditor = new DolEditor('anamnesis', $ficha_object->anamnesis, '', 100, 'dolibarr_details', '', false, true, $conf->global->FCKEDITOR_ENABLE_DETAILS, 2, 107);
	        $doleditor->Create();
		print '</td></tr>';

		//Test 2
		print '</table> <br> <table class="border" width="100%">'; //Close and create table
		print '<tr><td colspan="5"><b>&nbsp;&nbsp;'.$langs->trans('fichapaciente_test_2').'</b></td></tr>';
		print '<tr>'; //Header line
			print '<td></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_avsc').'</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_avcc').'</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_dnp'). '</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_kx').  '</b></center></td>';
		print '</tr><tr>'; //OD Line
			print '<td width="5%"><center><b>'.$langs->trans('fichapaciente_od').'</b></center></td>';
			print '<td><center><input type="text" size="22" maxlength="20" name="od_avsc" value="'.$ficha_object->od_avsc.'"></center></td>';
			print '<td><center><input type="text" size="22" maxlength="20" name="od_avcc" value="'.$ficha_object->od_avcc.'"></center></td>';
			print '<td><center><input type="text" size="22" maxlength="20" name="od_dnp"  value="'.$ficha_object->od_dnp.'"> </center></td>';
			print '<td><center><input type="text" size="22" maxlength="20" name="od_kx"   value="'.$ficha_object->od_kx.'">  </center></td>';
		print '</tr><tr>'; //OI Line
			print '<td width="5%"><center><b>'.$langs->trans('fichapaciente_oi').'</b></center></td>';
			print '<td><center><input type="text" size="22" maxlength="20" name="oi_avsc" value="'.$ficha_object->oi_avsc.'"></center></td>';
			print '<td><center><input type="text" size="22" maxlength="20" name="oi_avcc" value="'.$ficha_object->oi_avcc.'"></center></td>';
			print '<td><center><input type="text" size="22" maxlength="20" name="oi_dnp"  value="'.$ficha_object->oi_dnp.'"> </center></td>';
			print '<td><center><input type="text" size="22" maxlength="20" name="oi_kx"   value="'.$ficha_object->oi_kx.'">  </center></td>';
		print '</tr><tr>'; //Empty Line
			print '<td colspan="5">&nbsp;</td>';
		print '</tr><tr>'; //Normal/Altered Header Line
			print '<td></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_ct'). '</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_ppc').'</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_mot').'</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_rp'). '</b></center></td>';
		print '</tr><tr>'; //Altered Line
			print '<td><center><b>'.$langs->trans('fichapaciente_altered').'</b></center></td>';
			print '<td><center><input type="checkbox" name="cb_cv"  value="A" '.($ficha_object->tests_2[0] == "A" ? 'checked' : '').'></center></td>';
			print '<td><center><input type="checkbox" name="cb_ppc" value="A" '.($ficha_object->tests_2[1] == "A" ? 'checked' : '').'></center></td>';
			print '<td><center><input type="checkbox" name="cb_mot" value="A" '.($ficha_object->tests_2[2] == "A" ? 'checked' : '').'></center></td>';
			print '<td><center><input type="checkbox" name="cb_rp"  value="A" '.($ficha_object->tests_2[3] == "A" ? 'checked' : '').'></center></td>';
		print '</tr>';

		//Test 3
		print '</table> <br> <table class="border" width="100%">'; //Close and create table
		print '<tr><td colspan="5"><b>&nbsp;&nbsp;'.$langs->trans('fichapaciente_test_3').'</b></td></tr>';
		print '<tr>'; //Header line
			print '<td></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_esf').'</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_cil').'</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_eje').'</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_ad'). '</b></center></td>';
			print '<td><center><b>'.$langs->trans('fichapaciente_av'). '</b></center></td>';
		print '</tr><tr>'; //OD Line
			print '<td width="5%"><center><b>'.$langs->trans('fichapaciente_od').'</b></center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="od_esf" value="'.$ficha_object->od_esf.'"></center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="od_cil" value="'.$ficha_object->od_cil.'"></center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="od_eje" value="'.$ficha_object->od_eje.'"></center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="od_ad"  value="'.$ficha_object->od_ad.'"> </center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="od_av"  value="'.$ficha_object->od_av.'"> </center></td>';
		print '</tr><tr>'; //OI Line
			print '<td width="5%"><center><b>'.$langs->trans('fichapaciente_oi').'</b></center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="oi_esf" value="'.$ficha_object->oi_esf.'"></center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="oi_cil" value="'.$ficha_object->oi_cil.'"></center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="oi_eje" value="'.$ficha_object->oi_eje.'"></center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="oi_ad"  value="'.$ficha_object->oi_ad.'"> </center></td>';
			print '<td><center><input type="text" size="17" maxlength="20" name="oi_av"  value="'.$ficha_object->oi_av.'"> </center></td>';
		print '</tr>';

		//Test 4
		print '</table> <br> <table class="border" width="100%">'; //Close and create table
		print '<tr><td colspan="5"><b>&nbsp;&nbsp;'.$langs->trans('fichapaciente_test_4').'</b></td></tr>';
		print '<tr>'; //Header Line
			print '<td width="20%"></td>';
			print '<td width="10%"><center><b>'.$langs->trans('fichapaciente_altered').'</b></center></td>';
			print '<td width="70%"><center><b>'.$langs->trans('fichapaciente_notes').'</b></center></td>';
		print '</tr><tr>'; //Line 1
			print '<td><center><b>'.$langs->trans('fichapaciente_tw').'</b></center></td>';
			print '<td><center><input type="checkbox" name="cb_tw"  value="A" '.($ficha_object->tests_4[0] == "A" ? 'checked' : '').'></center></td>';
			print '<td><input type="text" size="75" maxlength="80" name="note1_4" value="'.$ficha_object->note1_4.'"></td>';
		print '</tr><tr>'; //Line 2
			print '<td><center><b>'.$langs->trans('fichapaciente_ts').'</b></center></td>';
			print '<td><center><input type="checkbox" name="cb_ts"  value="A" '.($ficha_object->tests_4[1] == "A" ? 'checked' : '').'></center></td>';
			print '<td><input type="text" size="75" maxlength="80" name="note2_4" value="'.$ficha_object->note2_4.'"></td>';
		print '</tr><tr>'; //Line 3
			print '<td><center><b>'.$langs->trans('fichapaciente_pc').'</b></center></td>';
			print '<td><center><input type="checkbox" name="cb_pc"  value="A" '.($ficha_object->tests_4[2] == "A" ? 'checked' : '').'></center></td>';
			print '<td><input type="text" size="75" maxlength="80" name="note3_4" value="'.$ficha_object->note3_4.'"></td>';
		print '</tr><tr>'; //Line 4
			print '<td><center><b>'.$langs->trans('fichapaciente_ra').'</b></center></td>';
			print '<td><center><input type="checkbox" name="cb_ra"  value="A" '.($ficha_object->tests_4[3] == "A" ? 'checked' : '').'></center></td>';
			print '<td><input type="text" size="75" maxlength="80" name="note4_4" value="'.$ficha_object->note4_4.'"></td>';
		print '</tr><tr>'; //Line 5
			print '<td><center><b>'.$langs->trans('fichapaciente_tm').'</b></center></td>';
			print '<td><center><input type="checkbox" name="cb_tm"  value="A" '.($ficha_object->tests_4[4] == "A" ? 'checked' : '').'></center></td>';
			print '<td><input type="text" size="75" maxlength="80" name="note5_4" value="'.$ficha_object->note5_4.'"></td>';
		print '</tr><tr>'; //Line 6
			print '<td><center><b>'.$langs->trans('fichapaciente_ret').'</b></center></td>';
			print '<td><center><input type="checkbox" name="cb_ret"  value="A" '.($ficha_object->tests_4[5] == "A" ? 'checked' : '').'></center></td>';
			print '<td><input type="text" size="75" maxlength="80" name="note6_4" value="'.$ficha_object->note6_4.'"></td>';
		print '</tr><tr>'; //Line 7
			print '<td><center><b>'.$langs->trans('fichapaciente_pio').'</b></center></td>';
			print '<td><center><input type="checkbox" name="cb_pio"  value="A" '.($ficha_object->tests_4[6] == "A" ? 'checked' : '').'></center></td>';
			print '<td><input type="text" size="75" maxlength="80" name="note7_4" value="'.$ficha_object->note7_4.'"></td>';
		print '</tr>';

		//Test 5
		print '</table> <br> <table class="border" width="100%">'; //Close and create table
		print '<tr><td colspan="1"><b>&nbsp;&nbsp;'.$langs->trans('fichapaciente_test_5').'</b></td></tr>';
		print '<tr><td colspan="1">';
	        $doleditor = new DolEditor('note_5', $ficha_object->note_5, '', 100, 'dolibarr_details', '', false, true, $conf->global->FCKEDITOR_ENABLE_DETAILS, 2, 107);
	        $doleditor->Create();
		print '</td></tr>';

		//Close table
		print '</table><br>';

		//Buttons
		print '<center>';
			print '<input type="submit" class="button" name="save" value="'.$langs->trans("Save").'">';
			print ' &nbsp; &nbsp; ';
			print '<input type="submit" class="button" name="cancel" value="'.$langs->trans("Cancel").'">';
			print ' &nbsp; &nbsp; ';
			print '<input type="submit" class="button" name="delete" value="'.$langs->trans("Delete").'">';
		print '</center>';
	} elseif ($result == 0 and empty($create)) { //Doesn't exist
		//Close table
		print '</table><br>';

		//Buttons
		print '<center>';
			print '<input type="submit" class="button" name="create" value="'.$langs->trans("Create").'">';
		print '</center>';
	} else { //Error ocurred
		//Close table
		print '</table><br>';

		//Show ocurred error
		dol_print_error($db, $ficha_object->error);
	}

	//Close form and div
	print '</form></div>';

	dol_fiche_end();
} else {
	dol_print_error($db,'Bad value for socid parameter');
}

// End of page
llxFooter();
$db->close();
?>