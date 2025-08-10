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
					'menu_name' => '회사소개',
					'module_type' => 'ARTICLE',
					'module_id' => 'about',
				),
				array(
					'menu_name' => '제품소개',
					'module_type' => 'board',
					'module_id' => 'products',
				),
				array(
					'menu_name' => '공지사항',
					'module_type' => 'board',
					'module_id' => 'notice',
				),
				array(
					'menu_name' => '고객지원',
					'module_type' => 'board',
					'module_id' => 'support',
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
					'menu_name' => '이용약관',
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
	$extra_vars->company_name = '우리 회사';
	$extra_vars->company_slogan = '최고의 서비스를 제공합니다';
	$extra_vars->GNB = $sitemap['GNB']['menu_srl'];
	$extra_vars->UNB = $sitemap['UNB']['menu_srl'];
	$extra_vars->FNB = $sitemap['FNB']['menu_srl'];
	
	$args = new stdClass();
	$layout_srl = $args->layout_srl = getNextSequence();
	$args->site_srl = 0;
// 커스텀 레이아웃 사용 (app/custom/layouts/에 있는 레이아웃)
	$args->layout = 'custom_company';  // 커스텀 레이아웃명
	$args->title = 'Company Layout';
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
	$args->layout = 'custom_mobile';  // 커스텀 모바일 레이아웃
	$args->title = 'Mobile Layout';
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
	
	$oModuleModel = getModel('module');
	foreach ($skinTypes as $key => $dir) {
		$skinType = $key == 'skin' ? 'P' : 'M';
		foreach ($moduleList as $moduleName) {
			$designInfo->module->{$moduleName} = new stdClass();
			$designInfo->module->{$moduleName}->{$key} = $oModuleModel->getModuleDefaultSkin($moduleName, $skinType, 0, false);
		}
	}

// 커스텀 스킨 사용 (app/custom/modules/board/skins/에 있는 스킨)
	$designInfo->module->board->skin = 'custom_board';
	$designInfo->module->editor->skin = 'ckeditor';
	
	$oAdminController = getAdminController('admin');
	$oAdminController->makeDefaultDesignFile($designInfo, 0);

// Welcome 페이지 생성
	$moduleInfo = $oModuleModel->getModuleInfoByMenuItemSrl($sitemap['GNB']['list'][0]['menu_srl']);
	$module_srl = $moduleInfo->module_srl;
	
	$oTemplateHandler = TemplateHandler::getInstance();
	$oDocumentModel = getModel('document');
	$oDocumentController = getController('document');
	
	$obj = new stdClass();
	$obj->member_srl = $logged_info->member_srl;
	$obj->user_id = htmlspecialchars_decode($logged_info->user_id);
	$obj->user_name = htmlspecialchars_decode($logged_info->user_name);
	$obj->nick_name = htmlspecialchars_decode($logged_info->nick_name);
	$obj->email_address = $logged_info->email_address;
	$obj->module_srl = $module_srl;
	
	Context::set('version', RX_VERSION);
	Context::set('company_name', '우리 회사');
	$obj->title = '우리 회사에 오신 것을 환영합니다';

// 커스텀 Welcome 콘텐츠 (필요시 별도 템플릿 파일 생성)
	$obj->content = '
<div class="welcome-content">
    <h2>우리 회사에 오신 것을 환영합니다</h2>
    <p>최고의 서비스와 제품을 제공하는 우리 회사입니다.</p>
    <p>궁금한 사항이 있으시면 언제든 문의해 주세요.</p>
</div>
';
	
	$output = $oDocumentController->insertDocument($obj, true);
	if (!$output->toBool()) return $output;
	
	$document_srl = $output->get('document_srl');

// 초기 공지사항들 생성
	$notice_module_info = null;
	foreach ($sitemap['GNB']['list'] as $menu_item) {
		if ($menu_item['module_id'] === 'notice') {
			$notice_module_info = $oModuleModel->getModuleInfoByMenuItemSrl($menu_item['menu_srl']);
			break;
		}
	}
	
	if ($notice_module_info) {
		$notice_posts = array(
			array(
				'title' => '사이트 오픈 안내',
				'content' => '<p>안녕하세요. 저희 회사 홈페이지가 새롭게 오픈되었습니다.</p><p>많은 관심과 이용 부탁드립니다.</p>',
				'is_notice' => 'Y'
			),
			array(
				'title' => '고객지원 서비스 안내',
				'content' => '<p>고객지원 게시판을 통해 문의사항을 남겨주세요.</p><p>빠른 시간 내에 답변드리겠습니다.</p>',
				'is_notice' => 'Y'
			),
		);
		
		foreach ($notice_posts as $post) {
			$obj = new stdClass();
			$obj->module_srl = $notice_module_info->module_srl;
			$obj->title = $post['title'];
			$obj->content = $post['content'];
			$obj->member_srl = $logged_info->member_srl;
			$obj->user_id = htmlspecialchars_decode($logged_info->user_id);
			$obj->nick_name = htmlspecialchars_decode($logged_info->nick_name);
			$obj->email_address = $logged_info->email_address;
			$obj->is_notice = $post['is_notice'];
			
			$output = $oDocumentController->insertDocument($obj, true);
			if (!$output->toBool()) return $output;
		}
	}

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
