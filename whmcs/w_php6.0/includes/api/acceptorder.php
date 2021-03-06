<?php //00e57
// *************************************************************************
// *                                                                       *
// * WHMCS - The Complete Client Management, Billing & Support Solution    *
// * Copyright (c) WHMCS Ltd. All Rights Reserved,                         *
// * Version: 5.3.14 (5.3.14-release.1)                                    *
// * BuildId: 0866bd1.62                                                   *
// * Build Date: 28 May 2015                                               *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@whmcs.com                                                 *
// * Website: http://www.whmcs.com                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.  This software  or any other *
// * copies thereof may not be provided or otherwise made available to any *
// * other person.  No title to and  ownership of the  software is  hereby *
// * transferred.                                                          *
// *                                                                       *
// * You may not reverse  engineer, decompile, defeat  license  encryption *
// * mechanisms, or  disassemble this software product or software product *
// * license.  WHMCompleteSolution may terminate this license if you don't *
// * comply with any of the terms and conditions set forth in our end user *
// * license agreement (EULA).  In such event,  licensee  agrees to return *
// * licensor  or destroy  all copies of software  upon termination of the *
// * license.                                                              *
// *                                                                       *
// * Please see the EULA file for the full End User License Agreement.     *
// *                                                                       *
// *************************************************************************
if( !defined('WHMCS') )
{
    exit( "This file cannot be accessed directly" );
}
if( !function_exists('acceptOrder') )
{
    require(ROOTDIR . "/includes/orderfunctions.php");
}
if( !function_exists('getRegistrarConfigOptions') )
{
    require(ROOTDIR . "/includes/registrarfunctions.php");
}
if( !function_exists('ModuleBuildParams') )
{
    require(ROOTDIR . "/includes/modulefunctions.php");
}
$result = select_query('tblorders', '', array( 'id' => $orderid, 'status' => 'Pending' ));
$data = mysql_fetch_array($result);
$orderid = $data['id'];
if( !$orderid )
{
    $apiresults = array( 'result' => 'error', 'message' => "Order ID not found or Status not Pending" );
}
else
{
    $ordervars = array(  );
    if( isset($_REQUEST['serverid']) )
    {
        $ordervars['api']['serverid'] = $_REQUEST['serverid'];
    }
    if( isset($_REQUEST['serviceusername']) )
    {
        $ordervars['api']['username'] = $_REQUEST['serviceusername'];
    }
    if( isset($_REQUEST['servicepassword']) )
    {
        $ordervars['api']['password'] = $_REQUEST['servicepassword'];
    }
    if( isset($_REQUEST['registrar']) )
    {
        $ordervars['api']['registrar'] = $_REQUEST['registrar'];
    }
    if( isset($_REQUEST['sendregistrar']) )
    {
        $ordervars['api']['sendregistrar'] = $_REQUEST['sendregistrar'];
    }
    if( isset($_REQUEST['autosetup']) )
    {
        $ordervars['api']['autosetup'] = $_REQUEST['autosetup'];
    }
    if( isset($_REQUEST['sendemail']) )
    {
        $ordervars['api']['sendemail'] = $_REQUEST['sendemail'];
    }
    acceptOrder($orderid, $ordervars);
    $apiresults = array( 'result' => 'success' );
}