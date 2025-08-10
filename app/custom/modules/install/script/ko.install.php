<?php
	
	// 커스터마이징된 라이믹스 설치 스크립트
	// 원본을 기반으로 회사/프로젝트에 맞게 수정
	
	$lang = Context::getLangType();
	$logged_info = Context::get('logged_info');
	
	$oMenuAdminController = getAdminController('menu');
	
	// 커스텀 사이트맵 구조
	$sitemap = array(
		'GNB' => array(
			'title' => 'Main Menu',
			'list' => array(
				array(
					'menu_name' => 'Home',
					'module_type' => 'WIDGET',
					'module_id' => 'index',
				),
				array(
					'menu_name' => '사업 인내',
					'module_id' => 'about',
				),
				array(
					'menu_name' => '소통 공간',
					'module_id' => 'notice',
				),
				array(
					'menu_name' => '자료 공개',
					'module_id' => 'board1',
				),
				array(
					'menu_name' => '자주하는 질문',
					'module_type' => 'board',
					'module_id' => 'faq',
				),
			),
		),
		'UNB' => array(
			'title' => 'Utility Menu',
			'list' => array(
				array(
					'menu_name' => '로그인',
					'module_type' => 'member',
					'module_id' => 'login',
				),
				array(
					'menu_name' => '회원가입',
					'module_type' => 'member',
					'module_id' => 'signup',
				),
			),
		),
		'FNB' => array(
			'title' => 'Footer Menu',
			'list' => array(
				array(
					'menu_name' => '서비스 이용 약관',
					'module_type' => 'ARTICLE',
					'module_id' => 'terms',
				),
				array(
					'menu_name' => '개인정보처리방침',
					'module_type' => 'ARTICLE',
					'module_id' => 'privacy',
				),
			),
		),
	);
	
	function __makeMenu(&$list, $parent_srl)
	{
		$oMenuAdminController = getAdminController('menu');
		foreach ($list as $idx => &$item) {
			Context::set('parent_srl', $parent_srl, TRUE);
			Context::set('menu_name', $item['menu_name'], TRUE);
			Context::set('module_type', $item['module_type'], TRUE);
			Context::set('module_id', $item['module_id'], TRUE);
			if ($item['is_shortcut'] === 'Y') {
				Context::set('is_shortcut', $item['is_shortcut'], TRUE);
				Context::set('shortcut_target', $item['shortcut_target'], TRUE);
			} else {
				Context::set('is_shortcut', 'N', TRUE);
				Context::set('shortcut_target', null, TRUE);
			}
			
			$output = $oMenuAdminController->procMenuAdminInsertItem();
			if ($output instanceof BaseObject && !$output->toBool()) {
				return $output;
			}
			$menu_srl = $oMenuAdminController->get('menu_item_srl');
			$item['menu_srl'] = $menu_srl;
			
			if ($item['list']) __makeMenu($item['list'], $menu_srl);
		}
	}
	
	// 사이트맵 생성
	foreach ($sitemap as $id => &$val) {
		$output = $oMenuAdminController->addMenu($val['title']);
		if (!$output->toBool()) {
			return $output;
		}
		$val['menu_srl'] = $output->get('menuSrl');
		
		__makeMenu($val['list'], $val['menu_srl']);
		
		$oMenuAdminController->makeHomemenuCacheFile($val['menu_srl']);
	}
	
	// 커스텀 레이아웃 생성
	$extra_vars = new stdClass();
	$extra_vars->use_demo = 'N';  // 데모 비활성화
//	$extra_vars->company_name = '우리 회사';
//	$extra_vars->company_slogan = '최고의 서비스를 제공합니다';
	$extra_vars->use_ncenter_widget = 'Y';
	$extra_vars->content_fixed_width = 'Y';
	$extra_vars->GNB = $sitemap['GNB']['menu_srl'];
	$extra_vars->UNB = $sitemap['UNB']['menu_srl'];
	$extra_vars->FNB = $sitemap['FNB']['menu_srl'];
	
	$args = new stdClass();
	$layout_srl = $args->layout_srl = getNextSequence();
	$args->site_srl = 0;
	// 커스텀 레이아웃 사용 (app/custom/layouts/에 있는 레이아웃)
	$args->layout = 'ibs_layout';  // 커스텀 레이아웃명
	$args->title = 'IBS_Edition';
	$args->layout_type = 'P';
	$oLayoutAdminController = getAdminController('layout');
	$output = $oLayoutAdminController->insertLayout($args);
	if (!$output->toBool()) return $output;
	
	// PC 레이아웃 업데이트
	$args->extra_vars = serialize($extra_vars);
	$output = $oLayoutAdminController->updateLayout($args);
	if (!$output->toBool()) return $output;
	
	// 모바일 레이아웃 생성
	$mlayout_srl = $args->layout_srl = getNextSequence();
	$args->layout = 'default';  // 커스텀 모바일 레이아웃
	$args->title = 'welcome_mobile_layout';
	$args->layout_type = 'M';
	$extra_vars->main_menu = $sitemap['GNB']['menu_srl'];
	
	$output = $oLayoutAdminController->insertLayout($args);
	if (!$output->toBool()) return $output;
	
	// 모바일 레이아웃 업데이트
	$args->extra_vars = serialize($extra_vars);
	$output = $oLayoutAdminController->updateLayout($args);
	if (!$output->toBool()) return $output;
	
	// 디자인 파일 생성
	$siteDesignPath = RX_BASEDIR . 'files/site_design/';
	FileHandler::makeDir($siteDesignPath);
	
	$designInfo = new stdClass();
	$designInfo->layout_srl = $layout_srl;
	$designInfo->mlayout_srl = $mlayout_srl;
	
	$moduleList = array('page', 'board', 'editor');
	$moutput = ModuleHandler::triggerCall('menu.getModuleListInSitemap', 'after', $moduleList);
	if ($moutput->toBool()) {
		$moduleList = array_unique($moduleList);
	}
	
	$skinTypes = array('skin' => 'skins/', 'mskin' => 'm.skins/');
	
	$designInfo->module = new stdClass();
	
	/* @var $oModuleModel moduleModel */
	$oModuleModel = getModel('module');
	foreach ($skinTypes as $key => $dir) {
		$skinType = $key == 'skin' ? 'P' : 'M';
		foreach ($moduleList as $moduleName) {
			$designInfo->module->{$moduleName} = new stdClass();
			$designInfo->module->{$moduleName}->{$key} = $oModuleModel->getModuleDefaultSkin($moduleName, $skinType, 0, false);
		}
	}
	
	// 커스텀 스킨 사용 (app/custom/modules/board/skins/에 있는 스킨)
	$designInfo->module->board->skin = 'xedition';
	$designInfo->module->editor->skin = 'ckeditor';
	
	/* @var $oAdminController adminAdminController */
	$oAdminController = getAdminController('admin');
	$oAdminController->makeDefaultDesignFile($designInfo, 0);
	
	// Welcome 페이지 생성
	$moduleInfo = $oModuleModel->getModuleInfoByMenuItemSrl($sitemap['GNB']['list'][0]['menu_srl']);
	$module_srl = $moduleInfo->module_srl;
	
	// insert PageContents - widget
	$oTemplateHandler = TemplateHandler::getInstance();
	/* @var $oDocumentModel documentModel */
	$oDocumentModel = getModel('document');
	/* @var $oDocumentController documentController */
	$oDocumentController = getController('document');
	
	$obj = new stdClass();
	
	$obj->member_srl = $logged_info->member_srl;
	$obj->user_id = htmlspecialchars_decode($logged_info->user_id);
	$obj->user_name = htmlspecialchars_decode($logged_info->user_name);
	$obj->nick_name = htmlspecialchars_decode($logged_info->nick_name);
	$obj->email_address = $logged_info->email_address;
	
	$obj->module_srl = $module_srl;
	Context::set('version', RX_VERSION);
	//	Context::set('company_name', '우리 회사');
	$obj->title = '브랜드 이야기';
	
	// 커스텀 Welcome 콘텐츠 (필요시 별도 템플릿 파일 생성)
	$obj->content = '
<link href="./layouts/ibs_layout/css/welcome.css" rel="stylesheet" />
<div class="welcomeXE">
<section class="intro"><span class="noti">BRAND STORY!</span>
<h1 class="tit">변화하는 고객의 삶으로부터 새로운 자이가 시작됩니다</h1>

<p class="cont">자이는 시대의 변화에 맞춰 대한민국 아파트 브랜드 역사의 변곡점마다 주목받는 족적을 납겨왔습니다.</p>

<p class="cont">고유의 미학과 앞선 기술이 투영된 특별한 주거경험을 선보이며 새로운 라이프 스타일을 선도하는 대한민국 대표 아파트 브랜드로 자리매김해 왔습니다.</p>

<p class="cont">이제, 자이가 또 한 번의 도약을 준비합니다. 더욱 깊어진 고객을 향한 시선에 자이만의 새로운 관점을 더해 달라진 주거의 의미와 고객이 추구하는 삶의 가치를 반영한 새로운 주거 경험을 만들어갑니다.<br />
<a class="btn_start" href="/brand">둘러보기</a></p>
</section>
</div>';
	
	$output = $oDocumentController->insertDocument($obj, true);
	if (!$output->toBool()) return $output;
	
	$document_srl = $output->get('document_srl');
	
	unset($obj->document_srl);
	$obj->title = 'Welcome to Mobile Rhymix';
	$output = $oDocumentController->insertDocument($obj, true);
	if (!$output->toBool()) return $output;
	
	// 페이지 위젯 설정
	$oModuleController = getController('module');
	$mdocument_srl = $document_srl; // 모바일도 동일한 문서 사용
	$module_info = $oModuleModel->getModuleInfoByModuleSrl($module_srl);
	$module_info->content = '<img hasContent="true" class="zbxe_widget_output" widget="widgetContent" style="width: 100%; float: left;" body="" document_srl="' . $document_srl . '" widget_padding_left="0" widget_padding_right="0" widget_padding_top="0" widget_padding_bottom="0"  />';
	$module_info->mcontent = '<img hasContent="true" class="zbxe_widget_output" widget="widgetContent" style="width: 100%; float: left;" body="" document_srl="' . $mdocument_srl . '" widget_padding_left="0" widget_padding_right="0" widget_padding_top="0" widget_padding_bottom="0"  />';
	$output = $oModuleController->updateModule($module_info);
	if (!$output->toBool()) return $output;
	
	// 도메인 기본 모듈 설정
	$domain_args = new stdClass();
	$domain_args->domain_srl = 0;
	$domain_args->index_module_srl = $module_srl;
	executeQuery('module.updateDomain', $domain_args);
	
	// 관리자 즐겨찾기에 유용한 모듈들 추가
	foreach (['board', 'member', 'layout', 'menu', 'module'] as $module_name) {
		$oAdminController->_insertFavorite(0, $module_name);
	}
	
	// 메뉴 캐시 생성
	$oMenuAdminController->makeXmlFile($menuSrl);
	
	/* End of file ko.install.php */
