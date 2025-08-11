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
					'menu_name' => '사업 안내',
					'is_shortcut' => 'Y',
					'shortcut_target' => '/overview',
					'list' => array(
						array(
							'menu_name' => '사업 개요',
							'module_type' => 'board',
							'module_id' => 'overview',
						),
						array(
							'menu_name' => '브랜드 소개',
							'module_type' => 'board',
							'module_id' => 'brand',
						),
						array(
							'menu_name' => '입지 환경',
							'module_type' => 'board',
							'module_id' => 'location',
						),
						array(
							'menu_name' => '오시는 길',
							'module_type' => 'board',
							'module_id' => 'map',
						)
					)
				),
				array(
					'menu_name' => '소통 공간',
					'is_shortcut' => 'Y',
					'shortcut_target' => '/notice',
					'list' => array(
						array(
							'menu_name' => '공지 사항',
							'module_type' => 'board',
							'module_id' => 'notice',
						),
						array(
							'menu_name' => '소식 게시판',
							'module_type' => 'board',
							'module_id' => 'news',
						),
						array(
							'menu_name' => '질문 게시판',
							'module_type' => 'board',
							'module_id' => 'qna',
						),
						array(
							'menu_name' => '자유 게시판',
							'module_type' => 'board',
							'module_id' => 'free',
						),
						array(
							'menu_name' => '투표(설문) 코너',
							'module_type' => 'board',
							'module_id' => 'poll',
						),
						array(
							'menu_name' => '조합원 인증 요청',
							'module_type' => 'board',
							'module_id' => 'askAuth',
						),
					)
				),
				array(
					'menu_name' => '자료 공개',
					'is_shortcut' => 'Y',
					'shortcut_target' => '/info_01',
					'list' => array(
						array(
							'menu_name' => '조합규약 및 내규',
							'module_type' => 'board',
							'module_id' => 'info_01',
						),
						array(
							'menu_name' => '공동사업주체와 체결한 협약서',
							'module_type' => 'board',
							'module_id' => 'info_02',
						),
						array(
							'menu_name' => '설계자 등 용역업체 선정 계약서',
							'module_type' => 'board',
							'module_id' => 'info_03',
						),
						array(
							'menu_name' => '조합총회 및 이사회 등의 의사록',
							'module_type' => 'board',
							'module_id' => 'info_04',
						),
						array(
							'menu_name' => '사업시행계획서',
							'module_type' => 'board',
							'module_id' => 'info_05',
						),
						array(
							'menu_name' => '조합사업의 시행에 관한 공문서',
							'module_type' => 'board',
							'module_id' => 'info_06',
						),
						array(
							'menu_name' => '회계감사보고서',
							'module_type' => 'board',
							'module_id' => 'info_07',
						),
						array(
							'menu_name' => '분기별 사업실적보고서',
							'module_type' => 'board',
							'module_id' => 'info_08',
						),
						array(
							'menu_name' => '업무대행자가 제출한 실적보고서',
							'module_type' => 'board',
							'module_id' => 'info_09',
						),
						array(
							'menu_name' => '연간 자금운용 계획서',
							'module_type' => 'board',
							'module_id' => 'info_10',
						),
						array(
							'menu_name' => '월별 자금 입출금 명세서',
							'module_type' => 'board',
							'module_id' => 'info_11',
						),
						array(
							'menu_name' => '월별 공사진행 상황에 관한 서류',
							'module_type' => 'board',
							'module_id' => 'info_12',
						),
						array(
							'menu_name' => '분양신청에 관한 서류 및 관련 자료',
							'module_type' => 'board',
							'module_id' => 'info_13',
						),
						array(
							'menu_name' => '조합원별 분담금 납부내역',
							'module_type' => 'board',
							'module_id' => 'info_14',
						),
						array(
							'menu_name' => '조합원별 추가 분담금 산출내역',
							'module_type' => 'board',
							'module_id' => 'info_15',
						),
					)
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
					'menu_name' => 'Rhymix Official Site',
					'is_shortcut' => 'Y',
					'open_window' => 'Y',
					'shortcut_target' => 'https://rhymix.org/',
				),
				array(
					'menu_name' => 'Rhymix GitHub',
					'is_shortcut' => 'Y',
					'open_window' => 'Y',
					'shortcut_target' => 'https://github.com/rhymix',
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
		return true; // 성공 반환
	}
	
	// 사이트맵 생성
	foreach ($sitemap as $id => &$val) {
		$output = $oMenuAdminController->addMenu($val['title']);
		if (!$output->toBool()) {
			return $output;
		}
		$val['menu_srl'] = $output->get('menuSrl');
		
		$result = __makeMenu($val['list'], $val['menu_srl']);
		if ($result instanceof BaseObject && !$result->toBool()) {
			return $result;
		}
		
		$oMenuAdminController->makeHomemenuCacheFile($val['menu_srl']);
	}
	
	// 커스텀 레이아웃 생성
	$extra_vars = new stdClass();
	$extra_vars->use_demo = 'Y';
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
	$args->layout = 'default';
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
	
	// 개별 모듈 스킨 설정
	/* @var $oModuleController moduleController */
	$oModuleController = getController('module');
	
	// FAQ 게시판에 IBS FAQ 스킨 적용
	$faq_module_info = $oModuleModel->getModuleInfoByMid('faq');
	if ($faq_module_info) {
		$faq_module_info->skin = 'faq'; // IBS FAQ 스킨 지정
		$faq_module_info->mskin = 'faq'; // 모바일 스킨도 동일하게 설정
		$output = $oModuleController->updateModule($faq_module_info);
		if (!$output->toBool()) return $output;
	}
	
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
	$obj->title = 'Brand Story!';
	
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
	/* @var $oModuleController moduleController */
	$oModuleController = getController('module');
//	$mdocument_srl = $document_srl; // 모바일도 동일한 문서 사용
	$mdocument_srl = $output->get('document_srl');
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
	foreach (['advanced_mailer', 'ncenterlite'] as $module_name) {
		$oAdminController->_insertFavorite(0, $module_name);
	}
	
	// 메뉴 캐시 생성
	$oMenuAdminController->makeXmlFile($sitemap['GNB']['menu_srl']); // $menuSrl -> $sitemap['GNB']['menu_srl']로 수정
	
	/* End of file ko.install.php */
