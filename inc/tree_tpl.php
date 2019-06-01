<?
$nolang=true;
include("../admin/function/db.php");?>var TREE_TPL = {

	// general
	'target':'_self',	// name of the frame links will be opened in
							// other possible values are:
							// _blank, _parent, _search, _self and _top

	// images - root	
	'icon_48':'<?=site_root?>/images/icons/base.gif',   // root icon normal
	'icon_52':'<?=site_root?>/images/icons/base.gif',   // root icon selected
	'icon_56':'<?=site_root?>/images/icons/base.gif',   // root icon opened
	'icon_60':'<?=site_root?>/images/icons/base.gif',   // root icon selected opened

	// images - node	
	'icon_16':'<?=site_root?>/images/icons/folder.gif', // node icon normal
	'icon_20':'<?=site_root?>/images/icons/folderopen.gif', // node icon selected
	'icon_24':'<?=site_root?>/images/icons/folderopen.gif', // node icon opened
	'icon_28':'<?=site_root?>/images/icons/folderopen.gif', // node icon selected opened

	'icon_80':'<?=site_root?>/images/icons/folderopen.gif', // mouseovered node icon normal

	// images - leaf
	'icon_0':'<?=site_root?>/images/icons/page.gif', // leaf icon normal
	'icon_4':'<?=site_root?>/images/icons/page.gif', // leaf icon selected

	// images - junctions	
	'icon_2':'<?=site_root?>/images/icons/joinbottom.gif', // junction for leaf
	'icon_3':'<?=site_root?>/images/icons/join.gif',       // junction for last leaf
	'icon_18':'<?=site_root?>/images/icons/plusbottom.gif', // junction for closed node
	'icon_19':'<?=site_root?>/images/icons/plus.gif',       // junctioin for last closed node
	'icon_26':'<?=site_root?>/images/icons/minusbottom.gif',// junction for opened node
	'icon_27':'<?=site_root?>/images/icons/minus.gif',      // junctioin for last opended node

	// images - misc
	'icon_e':'<?=site_root?>/images/icons/empty.gif', // empty image
	'icon_l':'<?=site_root?>/images/icons/line.gif',  // vertical line
	
	// styles - root
	'style_48':'mout', // normal root caption style
	'style_52':'mout', // selected root caption style
	'style_56':'mout', // opened root caption style
	'style_60':'mout', // selected opened root caption style
	'style_112':'mover', // mouseovered normal root caption style
	'style_116':'mover', // mouseovered selected root caption style
	'style_120':'mover', // mouseovered opened root caption style
	'style_124':'mover', // mouseovered selected opened root caption style
	
	// styles - node
	'style_16':'mout', // normal node caption style
	'style_20':'mout', // selected node caption style
	'style_24':'mout', // opened node caption style
	'style_28':'mout', // selected opened node caption style
	'style_80':'mover', // mouseovered normal node caption style
	'style_84':'mover', // mouseovered selected node caption style
	'style_88':'mover', // mouseovered opened node caption style
	'style_92':'mover', // mouseovered selected opened node caption style

	// styles - leaf
	'style_0':'mout', // normal leaf caption style
	'style_4':'mout', // selected leaf caption style
	'style_64':'mover', // mouseovered normal leaf caption style
	'style_68':'mover', // mouseovered selected leaf caption style
	
	// expand on click
	'onItemSelect':'onItemSelectHandler'
	
	// make sure there is no comma after the last key-value pair
};