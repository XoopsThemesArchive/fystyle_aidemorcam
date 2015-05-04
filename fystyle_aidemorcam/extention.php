<?php
// $Id$
// FILE		::	ex_assign.php
// AUTHOR	::	Ryuji AMANO <info@joetsu.info>
// WEB		::	Ryu's Planning <http://ryus.joetsu.info/>
//

//プライベートメッセージ・モジュールディレクトリ
global $xoopsUser, $xoopsModule;
if (is_object($xoopsUser)) {
	$pm_handler =& xoops_gethandler('privmessage');

	$criteria = new CriteriaCompo(new Criteria('read_msg', 0));
	$criteria->add(new Criteria('to_userid', $xoopsUser->getVar('uid')));
	$this->assign("ex_new_messages", $pm_handler->getCount($criteria));
}

if ( is_object($xoopsModule) ) {
	$this->assign('ex_moduledir', $xoopsModule->getVar('dirname'));
}

//メインメニュー
require_once XOOPS_ROOT_PATH."/modules/system/blocks/system_blocks.php";
$mainmenu = b_system_main_show();
foreach($mainmenu["modules"] as $module){
    if (count($module["sublinks"]) > 0 ){
        $mainmenu["sublinks"] = $module["sublinks"];
    }
}
$this->assign("ex_mainmenu", $mainmenu);

//サブメニュー
global $xoopsRequestUri;
if ( is_object($xoopsModule) ) {
  $this->assign('ex_moduledir', $xoopsModule->getVar('dirname'));
  $this->assign('ex_modulename', $xoopsModule->getVar('name'));
  if( count($xoopsModule->subLink()) > 0 ) {
    $replacedUri = preg_replace("/\/modules\/".$xoopsModule->getVar('dirname')."\/(.*)$/i", "$1", $xoopsRequestUri);
    foreach( $xoopsModule->subLink() as $sublink ) {
      if( $sublink['url'] == $replacedUri ) {
        $this->assign('ex_sublinkname', $sublink['name']);
      }
    }
  }
}
?>