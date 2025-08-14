<?php
	
	// 커스터마이징된 라이믹스 설치 스크립트
	// 원본을 기반으로 회사/프로젝트에 맞게 수정
	$lang = Context::getLangType();
	$logged_info = Context::get('logged_info');
	
	$oMenuAdminController = getAdminController('menu');
	$oModuleModel = getModel('module');
	$oModuleController = getController('module');
	$oDocumentController = getController('document');
	
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
							'module_type' => 'ARTICLE',
							'module_id' => 'overview',
						),
						array(
							'menu_name' => '브랜드 소개',
							'module_type' => 'ARTICLE',
							'module_id' => 'brand',
						),
						array(
							'menu_name' => '입지 환경',
							'module_type' => 'ARTICLE',
							'module_id' => 'location',
						),
						array(
							'menu_name' => '오시는 길',
							'module_type' => 'ARTICLE',
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
	$extra_vars->logo_text = 'OOOO 지역주택조합';
	$extra_vars->logo_url = '/';
	$extra_vars->footer_logo_text = 'OOOO 지역주택조합';
	$extra_vars->footer_logo_url = '/';
	$extra_vars->footer_text = '이 사이트는 회원 가입후 인증절차를 거친 조합원(가입자)들에게 주택법 제12조(실적보고 및 관련자료의 공개)에 따른 사업 관련 자료를 공개 운영하고 있습니다.';
	$extra_vars->footer_copyright = 'Powered by dyibs.com';
	
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
	
	// FAQ 게시판에 IBS FAQ 스킨 적용
	$faq_module_info = $oModuleModel->getModuleInfoByMid('faq');
	if ($faq_module_info) {
		// FAQ 게시판만 사이트 디자인을 사용하지 않도록 설정
		$faq_module_info->is_skin_fix = 'Y';
		$faq_module_info->skin = 'faq'; // IBS Faq 스킨으로 설정
		$faq_module_info->mskin = '/USE_DEFAULT/'; // 모바일 스킨 기본값
		
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
	
	// ========== rx_documents 테이블에 문서 데이터 삽입 예제 ==========
	
	// 방법 1: 특정 페이지(ARTICLE 모듈)에 문서 내용 삽입
	function insertPageDocument($module_id, $title, $content, $logged_info)
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');
		$oDocumentController = getController('document');
		
		// 모듈 정보 가져오기
		$module_info = $oModuleModel->getModuleInfoByMid($module_id);
		if (!$module_info) return false;
		
		// 문서 객체 생성
		$obj = new stdClass();
		$obj->module_srl = $module_info->module_srl;
		$obj->member_srl = $logged_info->member_srl;
		$obj->user_id = htmlspecialchars_decode($logged_info->user_id);
		$obj->user_name = htmlspecialchars_decode($logged_info->user_name);
		$obj->nick_name = htmlspecialchars_decode($logged_info->nick_name);
		$obj->email_address = $logged_info->email_address;
		$obj->title = $title;
		$obj->content = $content;
		$obj->status = 'PUBLIC'; // PUBLIC, PRIVATE, SECRET
		$obj->comment_status = 'ALLOW'; // ALLOW, DENY
		
		// 문서 삽입
		$output = $oDocumentController->insertDocument($obj, true);
		if (!$output->toBool()) return false;
		
		$document_srl = $output->get('document_srl');
		
		// ★ 핵심: ARTICLE 모듈에 문서 연결 ★
		$module_info->document_srl = $document_srl;
		
		// 모듈 정보 업데이트
		$update_output = $oModuleController->updateModule($module_info);
		if (!$update_output->toBool()) {
			// 업데이트 실패 시 로그 기록
			FileHandler::writeFile(RX_BASEDIR . 'files/debug.log', 
				date('Y-m-d H:i:s') . " - Module update failed for " . $module_id . ": " . $update_output->getMessage() . "\n", 'a');
			return false;
		}
		
		// 성공 로그
		FileHandler::writeFile(RX_BASEDIR . 'files/debug.log', 
			date('Y-m-d H:i:s') . " - Module " . $module_id . " connected to document_srl: " . $document_srl . "\n", 'a');
		
		return $document_srl;
	}
	
	// 방법 2: 게시판에 문서(게시글) 삽입
	function insertBoardDocument($module_id, $title, $content, $logged_info, $category_srl = 0)
	{
		$oModuleModel = getModel('module');
		$oDocumentController = getController('document');
		
		// 모듈 정보 가져오기
		$module_info = $oModuleModel->getModuleInfoByMid($module_id);
		if (!$module_info) return false;
		
		// 문서 객체 생성
		$obj = new stdClass();
		$obj->module_srl = $module_info->module_srl;
		$obj->category_srl = $category_srl; // 카테고리 번호 (0이면 미분류)
		$obj->member_srl = $logged_info->member_srl;
		$obj->user_id = htmlspecialchars_decode($logged_info->user_id);
		$obj->user_name = htmlspecialchars_decode($logged_info->user_name);
		$obj->nick_name = htmlspecialchars_decode($logged_info->nick_name);
		$obj->email_address = $logged_info->email_address;
		$obj->title = $title;
		$obj->content = $content;
		$obj->status = 'PUBLIC';
		$obj->comment_status = 'ALLOW';
		$obj->notify_message = 'N'; // 알림 메시지 여부
		
		// 문서 삽입
		$output = $oDocumentController->insertDocument($obj, true);
		if (!$output->toBool()) return false;
		
		return $output->get('document_srl');
	}
	
	// 실제 문서 삽입 예제들
	
	// 1. terms 내용 삽입
	$terms_content = '
<p data-end="226" data-start="105">&nbsp;</p>

<p data-end="226" data-start="105"><span style="color:#666666;"><strong data-end="117" data-start="105">제1조 (목적)</strong><br data-end="120" data-start="117" />
이 약관은 ○○○지역주택조합(이하 &quot;조합&quot;)이 운영하는 온라인 커뮤니티(이하 &quot;서비스&quot;)의 이용조건 및 절차, 회원과 조합 간의 권리 및 의무, 기타 필요한 사항을 규정함을 목적으로 합니다.</span></p>

<p data-end="226" data-start="105">&nbsp;</p>

<p><span style="color:#666666;"><strong data-end="245" data-start="233">제2조 (정의)</strong></span></p>

<ol data-end="423" data-start="248">
	<li data-end="308" data-start="248">
	<p data-end="308" data-start="251"><span style="color:#666666;">&quot;서비스&quot;라 함은 조합이 제공하는 커뮤니티, 게시판, 공지사항, 자료실, 알림 기능 등을 말합니다.</span></p>
	</li>
	<li data-end="367" data-start="309">
	<p data-end="367" data-start="312"><span style="color:#666666;">&quot;회원&quot;이라 함은 본 약관에 동의하고 서비스에 가입하여 이용 자격을 부여받은 조합원을 말합니다.</span></p>
	</li>
	<li data-end="423" data-start="368">
	<p data-end="423" data-start="371"><span style="color:#666666;">&quot;운영자&quot;란 조합 또는 조합이 위임한 자로, 서비스의 전반적인 운영을 담당하는 자를 말합니다.</span></p>
	</li>
</ol>

<p data-end="423" data-start="371">&nbsp;</p>

<p data-end="453" data-start="430"><span style="color:#666666;"><strong data-end="451" data-start="430">제3조 (약관의 효력 및 변경)</strong></span></p>

<ol data-end="628" data-start="454">
	<li data-end="491" data-start="454">
	<p data-end="491" data-start="457"><span style="color:#666666;">본 약관은 회원이 가입 시 동의함으로써 효력이 발생합니다.</span></p>
	</li>
	<li data-end="576" data-start="492">
	<p data-end="576" data-start="495"><span style="color:#666666;">조합은 필요 시 관련 법령을 위배하지 않는 범위에서 약관을 개정할 수 있으며, 변경된 약관은 홈페이지 또는 앱에 공지함으로써 효력을 가집니다.</span></p>
	</li>
	<li data-end="628" data-start="577">
	<p data-end="628" data-start="580"><span style="color:#666666;">회원이 개정된 약관에 동의하지 않을 경우, 서비스 이용을 중단하고 탈퇴할 수 있습니다.</span></p>
	</li>
</ol>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p data-end="657" data-start="635"><span style="color:#666666;"><strong data-end="655" data-start="635">제4조 (이용 자격 및 제한)</strong></span></p>

<ol data-end="798" data-start="658">
	<li data-end="714" data-start="658">
	<p data-end="714" data-start="661"><span style="color:#666666;">본 서비스는 ○○○지역주택조합의 <strong data-end="695" data-start="679">조합원 자격을 가진 자</strong>만 가입 및 이용이 가능합니다.</span></p>
	</li>
	<li data-end="750" data-start="715">
	<p data-end="750" data-start="718"><span style="color:#666666;">조합원 지위 상실 시, 서비스 이용 자격도 종료됩니다.</span></p>
	</li>
	<li data-end="798" data-start="751">
	<p data-end="798" data-start="754"><span style="color:#666666;">동일인이 중복 가입한 경우, 조합은 해당 계정을 통합하거나 삭제할 수 있습니다.</span></p>
	</li>
</ol>

<p>&nbsp;</p>

<p data-end="823" data-start="805"><span style="color:#666666;"><strong data-end="821" data-start="805">제5조 (회원의 의무)</strong></span></p>

<ol data-end="1011" data-start="824">
	<li data-end="869" data-start="824">
	<p data-end="869" data-start="827"><span style="color:#666666;">회원은 본인의 정보를 정확하게 기재하고, 변경 시 즉시 수정해야 합니다.</span></p>
	</li>
	<li data-end="1011" data-start="870">
	<p data-end="902" data-start="873"><span style="color:#666666;">회원은 다음 각 호의 행위를 하여서는 안 됩니다:</span></p>

	<ul data-end="1011" data-start="906">
		<li data-end="921" data-start="906">
		<p data-end="921" data-start="908"><span style="color:#666666;">타인의 개인정보 도용</span></p>
		</li>
		<li data-end="962" data-start="925">
		<p data-end="962" data-start="927"><span style="color:#666666;">비방, 욕설, 허위사실 유포 등 커뮤니티 질서를 해치는 행위</span></p>
		</li>
		<li data-end="984" data-start="966">
		<p data-end="984" data-start="968"><span style="color:#666666;">조합 내부자료의 무단 배포</span></p>
		</li>
		<li data-end="1011" data-start="988">
		<p data-end="1011" data-start="990"><span style="color:#666666;">기타 법령 및 공공질서에 위반되는 행위</span></p>
		</li>
	</ul>
	</li>
</ol>

<p>&nbsp;</p>

<p data-end="1036" data-start="1018"><span style="color:#666666;"><strong data-end="1034" data-start="1018">제6조 (조합의 의무)</strong></span></p>

<ol data-end="1173" data-start="1037">
	<li data-end="1072" data-start="1037">
	<p data-end="1072" data-start="1040"><span style="color:#666666;">조합은 안정적인 서비스 제공을 위하여 최선을 다합니다.</span></p>
	</li>
	<li data-end="1121" data-start="1073">
	<p data-end="1121" data-start="1076"><span style="color:#666666;">회원의 개인정보 보호를 위해 보안 시스템을 유지하며, 외부 유출을 방지합니다.</span></p>
	</li>
	<li data-end="1173" data-start="1122">
	<p data-end="1173" data-start="1125"><span style="color:#666666;">조합은 공정한 운영을 위하여 게시글 관리 및 커뮤니티 운영 지침을 수립할 수 있습니다.</span></p>
	</li>
</ol>

<p>&nbsp;</p>

<p data-end="1203" data-start="1180"><span style="color:#666666;"><strong data-end="1201" data-start="1180">제7조 (게시물 관리 및 권리)</strong></span></p>

<ol data-end="1385" data-start="1204">
	<li data-end="1272" data-start="1204">
	<p data-end="1272" data-start="1207"><span style="color:#666666;">회원이 서비스에 게시한 자료의 저작권은 회원에게 있으며, 조합은 커뮤니티 운영 목적으로 이를 사용할 수 있습니다.</span></p>
	</li>
	<li data-end="1385" data-start="1273">
	<p data-end="1316" data-start="1276"><span style="color:#666666;">다음과 같은 게시물은 사전 통보 없이 삭제되거나 제한될 수 있습니다:</span></p>

	<ul data-end="1385" data-start="1320">
		<li data-end="1338" data-start="1320">
		<p data-end="1338" data-start="1322"><span style="color:#666666;">허위 사실, 명예훼손 내용</span></p>
		</li>
		<li data-end="1358" data-start="1342">
		<p data-end="1358" data-start="1344"><span style="color:#666666;">광고성 글, 반복 도배</span></p>
		</li>
		<li data-end="1385" data-start="1362">
		<p data-end="1385" data-start="1364"><span style="color:#666666;">조합 운영에 중대한 영향을 미치는 내용</span></p>
		</li>
	</ul>
	</li>
</ol>

<p>&nbsp;</p>

<p data-end="1418" data-start="1392"><span style="color:#666666;"><strong data-end="1416" data-start="1392">제8조 (서비스 이용 제한 및 탈퇴)</strong></span></p>

<ol data-end="1564" data-start="1419">
	<li data-end="1485" data-start="1419">
	<p data-end="1485" data-start="1422"><span style="color:#666666;">회원이 본 약관 또는 커뮤니티 운영 방침을 위반한 경우, 조합은 이용 제한 또는 탈퇴 조치를 할 수 있습니다.</span></p>
	</li>
	<li data-end="1534" data-start="1486">
	<p data-end="1534" data-start="1489"><span style="color:#666666;">회원이 자발적으로 탈퇴하고자 할 경우, 별도 절차를 통해 요청할 수 있습니다.</span></p>
	</li>
	<li data-end="1564" data-start="1535">
	<p data-end="1564" data-start="1538"><span style="color:#666666;">탈퇴 후에도 작성된 게시물은 삭제되지 않습니다.</span></p>
	</li>
</ol>

<p>&nbsp;</p>

<p data-end="1588" data-start="1571"><span style="color:#666666;"><strong data-end="1586" data-start="1571">제9조 (면책 조항)</strong></span></p>

<ol data-end="1701" data-start="1589">
	<li data-end="1646" data-start="1589">
	<p data-end="1646" data-start="1592"><span style="color:#666666;">조합은 천재지변, 시스템 장애 등 불가항력적 사유로 인한 서비스 중단에 책임을 지지 않습니다.</span></p>
	</li>
	<li data-end="1701" data-start="1647">
	<p data-end="1701" data-start="1650"><span style="color:#666666;">회원 간 또는 회원과 제3자 간 분쟁에 대해 조합은 개입하지 않으며, 책임을 지지 않습니다.</span></p>
	</li>
</ol>

<p>&nbsp;</p>

<p data-end="1731" data-start="1708"><span style="color:#666666;"><strong data-end="1729" data-start="1708">제10조 (준거법 및 관할법원)</strong></span></p>

<ol data-end="1838" data-start="1732">
	<li data-end="1766" data-start="1732">
	<p data-end="1766" data-start="1735"><span style="color:#666666;">본 약관은 대한민국 법령에 따라 해석 및 적용됩니다.</span></p>
	</li>
	<li data-end="1838" data-start="1767">
	<p data-end="1838" data-start="1770"><span style="color:#666666;">서비스 이용과 관련하여 조합과 회원 간 발생한 분쟁에 대해서는 조합의 소재지를 관할하는 법원을 1심 관할 법원으로 합니다.</span></p>
	</li>
</ol>

<p>&nbsp;</p>

<p data-end="1853" data-start="1845"><span style="color:#666666;"><strong data-end="1851" data-start="1845">부칙</strong></span></p>

<ul data-end="1882" data-start="1854">
	<li data-end="1882" data-start="1854">
	<p data-end="1882" data-start="1856"><span style="color:#666666;">본 약관은 20OO년 O월 O일부터 시행합니다.</span></p>
	</li>
</ul>
';
	$terms_doc_srl = insertPageDocument('terms', '서비스 이용 약관', $terms_content, $logged_info);
	
	// 2. privacy 내용 삽입
	$privacy_content = '
<p data-end="295" data-start="182">&nbsp;</p>

<p data-end="295" data-start="182"><span style="color:#666666;"><strong data-end="195" data-start="182">○○○지역주택조합</strong>(이하 &quot;조합&quot;)은 「개인정보 보호법」 등 관련 법령에 따라 조합원 커뮤니티 이용자의 개인정보를 보호하고, 권익을 보호하기 위해 다음과 같이 개인정보처리방침을 수립하여 공개합니다.</span></p>

<p data-end="295" data-start="182">&nbsp;</p>

<h3 data-end="331" data-start="302"><span style="color:#666666;">제1조 (개인정보의 수집 항목 및 수집 방법)</span></h3>

<p data-end="376" data-start="333"><span style="color:#666666;">조합은 다음의 항목을 수집하며, 수집 목적 이외의 용도로는 사용하지 않습니다.</span></p>

<table border="1" cellpadding="0" cellspacing="0" style="margin: 5px 0 5px 0">
	<thead>
		<tr style="padding-left: 10px;">
			<td style="text-align: center;"><span style="color:#666666;"><strong>수집 항목</strong></span></td>
			<td style="text-align: center;"><span style="color:#666666;"><strong>수집 목적</strong></span></td>
			<td style="text-align: center;"><span style="color:#666666;"><strong>수집 방법</strong></span></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">성명</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">본인 확인</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">회원 가입 시</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">생년월일</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">본인 식별 및 연령 확인</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">회원 가입 시</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">휴대전화번호</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">본인 확인, 알림 문자 발송</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">회원 가입 시</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">이메일 주소</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">공지사항 발송, 문의 응답</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">회원 가입 시</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">주소 (선택)</span></p>
			</td>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">거주자 구분 및 우편 발송 목적</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">선택 입력 시</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">조합원 번호 (선택/필수)</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">조합원 확인</span></p>
			</td>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">오프라인/온라인 수기</span></p>
			</td>
		</tr>
	</tbody>
</table>

<p><span style="color:#666666;">※ 서비스 이용 과정에서 서비스 이용기록, 접속로그, 쿠키, IP 주소 등 비식별 정보가 자동 수집될 수 있습니다.</span></p>

<p>&nbsp;</p>

<h3 data-end="985" data-start="964"><span style="color:#666666;">제2조 (개인정보의 이용 목적)</span></h3>

<p data-end="1012" data-start="987"><span style="color:#666666;">수집된 개인정보는 다음의 목적에만 사용됩니다.</span></p>

<ol data-end="1147" data-start="1014">
	<li data-end="1036" data-start="1014">
	<p data-end="1036" data-start="1017"><span style="color:#666666;">조합원 본인 인증 및 자격 확인</span></p>
	</li>
	<li data-end="1072" data-start="1037">
	<p data-end="1072" data-start="1040"><span style="color:#666666;">커뮤니티 서비스 제공 (게시글, 공지, 자료 열람 등)</span></p>
	</li>
	<li data-end="1095" data-start="1073">
	<p data-end="1095" data-start="1076"><span style="color:#666666;">알림 문자, 이메일, 푸시 발송</span></p>
	</li>
	<li data-end="1116" data-start="1096">
	<p data-end="1116" data-start="1099"><span style="color:#666666;">민원 처리 및 공지사항 전달</span></p>
	</li>
	<li data-end="1147" data-start="1117">
	<p data-end="1147" data-start="1120"><span style="color:#666666;">조합 총회, 회의, 분양 관련 고지 및 참여 확인</span></p>
	</li>
</ol>

<p data-end="1147" data-start="1120">&nbsp;</p>

<h3 data-end="1179" data-start="1154"><span style="color:#666666;">제3조 (개인정보의 보유 및 이용기간)</span></h3>

<table border="1" cellpadding="0" cellspacing="0" style="margin: 5px 0 5px 0">
	<thead>
		<tr>
			<th scope="col"><span style="color:#666666;"><strong>항목</strong></span></th>
			<th scope="col"><span style="color:#666666;"><strong>보유기간</strong></span></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">회원가입 정보</span></p>
			</td>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">조합원 자격 유지 기간 + 3년 이내</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">민원/문의 기록</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">민원처리 완료 후 3년</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">서비스 이용기록</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">서비스 종료 또는 탈퇴 시 즉시 파기</span></p>
			</td>
		</tr>
	</tbody>
</table>

<p><span style="color:#666666;">※ 법령에 따라 보관이 필요한 경우 해당 법령에 따릅니다. (예: 전자상거래법, 국세기본법 등)</span></p>

<p data-end="1466" data-start="1413">&nbsp;</p>

<h3 data-end="1494" data-start="1473"><span style="color:#666666;">제4조 (개인정보 제3자 제공)</span></h3>

<p data-end="1551" data-start="1496"><span style="color:#666666;">조합은 원칙적으로 이용자의 개인정보를 외부에 제공하지 않습니다. 다만 다음의 경우는 예외로 합니다.</span></p>

<ol data-end="1637" data-start="1553">
	<li data-end="1573" data-start="1553">
	<p data-end="1573" data-start="1556"><span style="color:#666666;">정보주체의 동의가 있는 경우</span></p>
	</li>
	<li data-end="1597" data-start="1574">
	<p data-end="1597" data-start="1577"><span style="color:#666666;">법령에 의해 제공이 요구되는 경우</span></p>
	</li>
	<li data-end="1637" data-start="1598">
	<p data-end="1637" data-start="1601"><span style="color:#666666;">총회 진행 등을 위해 사전에 고지된 협력사에 필요한 범위 내 제공</span></p>
	</li>
</ol>

<p data-end="1637" data-start="1601">&nbsp;</p>

<h3 data-end="1665" data-start="1644"><span style="color:#666666;">제5조 (개인정보의 처리 위탁)</span></h3>

<p data-end="1714" data-start="1667"><span style="color:#666666;">조합은 원활한 서비스 제공을 위하여 다음과 같이 개인정보 처리를 위탁할 수 있습니다.</span></p>

<table border="1" cellpadding="5" cellspacing="0" style="margin: 5px 0 5px 0">
	<thead>
		<tr>
			<th scope="col"><span style="color:#666666;"><strong>수탁업체</strong></span></th>
			<th scope="col"><span style="color:#666666;"><strong>위탁 업무 내용</strong></span></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">커뮤니티 플랫폼 운영사</span></p>
			</td>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">시스템 운영, 유지보수, 문자 발송 등</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">문자 발송 대행사</span></p>
			</td>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">알림 문자, 공지 발송</span></p>
			</td>
		</tr>
	</tbody>
</table>

<p data-end="1936" data-start="1897"><span style="color:#666666;">※ 위탁계약 시 개인정보 보호를 위한 안전 조치를 계약서에 명시합니다.</span></p>

<p data-end="1936" data-start="1897">&nbsp;</p>

<h3 data-end="1968" data-start="1943"><span style="color:#666666;">제6조 (정보주체의 권리와 행사 방법)</span></h3>

<p data-end="2000" data-start="1970"><span style="color:#666666;">정보주체는 언제든지 다음의 권리를 행사할 수 있습니다.</span></p>

<ul data-end="2057" data-start="2002">
	<li data-end="2021" data-start="2002">
	<p data-end="2021" data-start="2004"><span style="color:#666666;">개인정보 열람 및 수정 요청</span></p>
	</li>
	<li data-end="2044" data-start="2022">
	<p data-end="2044" data-start="2024"><span style="color:#666666;">수집&middot;이용&middot;제공에 대한 동의 철회</span></p>
	</li>
	<li data-end="2057" data-start="2045">
	<p data-end="2057" data-start="2047"><span style="color:#666666;">개인정보 삭제 요청</span></p>
	</li>
</ul>

<p data-end="2096" data-start="2059"><span style="color:#666666;">위 요청은 조합 커뮤니티 또는 조합 사무실을 통해 신청 가능합니다.</span></p>

<p data-end="2096" data-start="2059">&nbsp;</p>

<h3 data-end="2129" data-start="2103"><span style="color:#666666;">제7조 (개인정보의 파기 절차 및 방법)</span></h3>

<ol data-end="2236" data-start="2131">
	<li data-end="2178" data-start="2131">
	<p data-end="2178" data-start="2134"><span style="color:#666666;"><strong data-end="2143" data-start="2134">파기 절차</strong>: 보유기간이 경과하거나 처리 목적이 달성된 경우 즉시 파기</span></p>
	</li>
	<li data-end="2236" data-start="2179">
	<p data-end="2236" data-start="2182"><span style="color:#666666;"><strong data-end="2191" data-start="2182">파기 방법</strong>: 전자적 파일은 복구 불가능한 방법으로 영구 삭제, 종이 문서는 분쇄 또는 소각</span></p>
	</li>
</ol>

<p data-end="2236" data-start="2182">&nbsp;</p>

<h3 data-end="2268" data-start="2243"><span style="color:#666666;">제8조 (개인정보의 안전성 확보 조치)</span></h3>

<p data-end="2302" data-start="2270"><span style="color:#666666;">조합은 개인정보 보호를 위해 다음과 같은 조치를 취합니다.</span></p>

<ul data-end="2393" data-start="2304">
	<li data-end="2322" data-start="2304">
	<p data-end="2322" data-start="2306"><span style="color:#666666;">개인정보 접근 권한 최소화</span></p>
	</li>
	<li data-end="2345" data-start="2323">
	<p data-end="2345" data-start="2325"><span style="color:#666666;">비밀번호 및 인증정보 암호화 저장</span></p>
	</li>
	<li data-end="2366" data-start="2346">
	<p data-end="2366" data-start="2348"><span style="color:#666666;">정기적 백업 및 보안 업데이트</span></p>
	</li>
	<li data-end="2393" data-start="2367">
	<p data-end="2393" data-start="2369"><span style="color:#666666;">보안 위반 시 내부 보고 및 통지 체계 운영</span></p>
	</li>
</ul>

<p data-end="2393" data-start="2369">&nbsp;</p>

<h3 data-end="2420" data-start="2400"><span style="color:#666666;">제9조 (개인정보 보호책임자)</span></h3>

<table border="1" cellpadding="1" cellspacing="0" style="margin: 5px 0 5px 0">
	<thead>
		<tr>
			<th scope="col"><span style="color:#666666;"><strong>구분</strong></span></th>
			<th scope="col"><span style="color:#666666;"><strong>정보</strong></span></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">개인정보보호책임자</span></p>
			</td>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">합장 또는 위임 받은 실무책임자</span></p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="margin-left: 40px;"><span style="color:#666666;">연락처</span></p>
			</td>
			<td>
			<p style="margin-left: 40px; margin-right: 40px;"><span style="color:#666666;">000-0000-0000 / </span><a data-end="2601" data-start="2584" rel="noopener"><span style="color:#666666;">admin@example.com</span></a></p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<h3 data-end="2630" data-start="2610"><span style="color:#666666;">제10조 (권익침해 구제방법)</span></h3>

<p data-end="2683" data-start="2632"><span style="color:#666666;">정보주체는 개인정보 침해로 인한 신고나 상담이 필요한 경우 아래 기관에 문의할 수 있습니다.</span></p>

<ul data-end="2825" data-start="2685">
	<li data-end="2736" data-start="2685">
	<p data-end="2736" data-start="2687"><span style="color:#666666;">개인정보침해신고센터 (</span><a data-end="2725" data-start="2699" rel="noopener" target="_new"><span style="color:#666666;">https://privacy.kisa.or.kr</span></a><span style="color:#666666;"> / ☎ 118)</span></p>
	</li>
	<li data-end="2777" data-start="2737">
	<p data-end="2777" data-start="2739"><span style="color:#666666;">대검찰청 사이버수사과 (</span><a data-end="2765" data-start="2752" rel="noopener" target="_new"><span style="color:#666666;">www.spo.go.kr</span></a><span style="color:#666666;"> / ☎ 1301)</span></p>
	</li>
	<li data-end="2825" data-start="2778">
	<p data-end="2825" data-start="2780"><span style="color:#666666;">경찰청 사이버안전국 (</span><a data-end="2824" data-start="2792" rel="noopener" target="_new"><span style="color:#666666;">https://cyberbureau.police.go.kr</span></a><span style="color:#666666;">)</span></p>
	</li>
</ul>

<p data-end="2825" data-start="2780">&nbsp;</p>

<h3 data-end="2855" data-start="2832"><span style="color:#666666;">제11조 (개인정보처리방침의 변경)</span></h3>

<p data-end="2913" data-start="2857"><span style="color:#666666;">본 방침은 20OO년 O월 O일부터 적용되며, 내용 변경 시 커뮤니티 및 홈페이지에 사전 고지합니다.</span></p>
';
	$privacy_doc_srl = insertPageDocument('privacy', '개인정보처리방침', $privacy_content, $logged_info);
	
	// 3. 사업 개요 페이지에 내용 삽입
	$overview_content = '
	<div class="page-content">
		<p>본 사업은 주택법에 따라 설립된 지역주택조합이 시행하는 공동주택 건설사업입니다.</p>
		<ul>
			<li>사업 위치: OO시 OO구 OO동 일원</li>
			<li>사업 규모: 지하 2층, 지상 15층, 총 200세대</li>
			<li>사업 기간: 2024년 ~ 2027년 (예정)</li>
			<li>시행사: OO지역주택조합</li>
		</ul>
		<h3 style="padding-top: 30px">사업 추진 경과</h3>
		<table class="table">
			<tr><th>일자</th><th>내용</th></tr>
			<tr><td>2024.01.15</td><td>조합 설립 인가</td></tr>
			<tr><td>2024.03.20</td><td>사업시행인가 신청</td></tr>
			<tr><td>2024.06.10</td><td>사업시행인가 승인</td></tr>
		</table>
	</div>';
	
	$overview_doc_srl = insertPageDocument('overview', '사업 개요', $overview_content, $logged_info);
	
	// 4. 브랜드 소개 페이지에 내용 삽입
	$brand_content = '
	<div class="brand-intro">
		<div class="brand-story">
			<h3>우리의 비전</h3>
			<p>품질 높은 주거공간을 통해 조합원 여러분의 꿈을 실현합니다.</p>
			
			<h3 style="padding-top: 30px">브랜드 가치</h3>
			<ul>
				<li><strong>신뢰</strong>: 투명한 사업 진행과 정확한 정보 공개</li>
				<li><strong>품질</strong>: 우수한 시공사 및 설계업체와의 협력</li>
				<li><strong>소통</strong>: 조합원과의 지속적인 소통과 참여</li>
			</ul>
		</div>
	</div>';
	
	$brand_doc_srl = insertPageDocument('brand', '브랜드 소개', $brand_content, $logged_info);
	
	// 5. 입지 환경 페이지에 내용 삽입
	$location_content = '
	<div class="location-info">
		<div class="location-advantages">
			<h3>교통 접근성</h3>
			<ul>
				<li>지하철 1호선 OO역 도보 5분</li>
				<li>버스정류장 도보 2분 (간선 3개 노선, 지선 5개 노선)</li>
				<li>고속도로 IC 차량 10분 거리</li>
			</ul>
			
			<h3 style="padding-top: 30px">생활 편의시설</h3>
			<ul>
				<li>대형마트: 롯데마트, 이마트 차량 5분</li>
				<li>병원: OO종합병원 도보 10분</li>
				<li>학교: OO초등학교 도보 8분, OO중학교 도보 12분</li>
			</ul>
		</div>
	</div>';
	
	$location_doc_srl = insertPageDocument('location', '입지 환경', $location_content, $logged_info);
	
	// 6. 오시는 길 페이지에 내용 삽입
	$location_content = 'aaa';
	
	$location_doc_srl = insertPageDocument('location', '입지 환경', $location_content, $logged_info);
	
	// 7. FAQ 게시판에 자주 묻는 질문들 삽입
	$faq_questions = array(
		array(
			'title' => '우리 조합의 조합원 자격 요건(기준)은 어떻게 되나요?',
			'content' => '
			<p><span style="font-size: 10pt;"><u>지역주택조합의 조합원 자격은 주택법 시행령 제21조에 규정이 되어 있습니다.</u></span></p>
<table border="0" cellpadding="0" cellspacing="0" class="__se_tbl" style="border-width: 1px 1px 0px 0px; border-top-style: solid; border-right-style: solid; border-top-color: rgb(204, 204, 204); border-right-color: rgb(204, 204, 204); border-image: initial; border-left-style: initial; border-left-color: initial; border-bottom-style: initial; border-bottom-color: initial;">
	<tbody>
		<tr>
			<td style="border-width: 0px 0px 1px 1px; border-bottom-style: solid; border-left-style: solid; border-bottom-color: rgb(204, 204, 204); border-left-color: rgb(204, 204, 204); border-image: initial; border-top-style: initial; border-top-color: initial; border-right-style: initial; border-right-color: initial; background-color: rgb(255, 255, 255); padding: 10px;" width="1069">
			<p>&nbsp;<span class="bl" style="font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px; text-indent: -30px; color: rgb(21, 21, 148); margin: 0px; padding: 0px; font-weight: bold;">제21조(조합원의 자격)</span><span style="color: rgb(99, 99, 99); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px; text-indent: -30px;">&nbsp;①&nbsp;</span><a class="link sfon1" style="font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px; text-indent: -30px; color: rgb(8, 109, 255); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">법</a><span style="color: rgb(68, 68, 68); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px; text-indent: -30px;">&nbsp;</span><a class="link sfon2" style="font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px; text-indent: -30px; color: rgb(0, 0, 205); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">제11조</a><span style="color: rgb(99, 99, 99); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px; text-indent: -30px;">에 따른 주택조합의 조합원이 될 수 있는 사람은 다음 각 호의 구분에 따른 사람으로 한다. 다만, 조합원의 사망으로 그 지위를 상속받는 자는 다음 각 호의 요건에도 불구하고 조합원이 될 수 있다. &nbsp;</span><span class="sfon" style="font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px; text-indent: -30px; color: rgb(2, 79, 206); margin: 0px; padding: 0px;">&lt;개정 2019. 10. 22.&gt;</span>&nbsp;</p>
			<p class="pty1_de2h" style="padding-left: 48px; text-indent: -15px; color: rgb(68, 68, 68); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px;"><span style="color: rgb(99, 99, 99);">1.&nbsp;</span><a class="oneView" style="color: rgb(0, 90, 132); margin: 0px; padding: 0px;">지역주택조합 조합원</a><span style="color: rgb(99, 99, 99);">: 다음 각 목의 요건을 모두 갖춘 사람</span></p>
			<p class="pty1_de3" style="padding-left: 65px; text-indent: -17px; color: rgb(68, 68, 68); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px;"><span style="color: rgb(99, 99, 99);">가. 조합설립인가 신청일(해당 주택건설대지가&nbsp;</span><a class="link sfon1" style="color: rgb(8, 109, 255); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">법</a>&nbsp;<a class="link sfon2" style="color: rgb(0, 0, 205); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">제63조</a><span style="color: rgb(99, 99, 99);">에 따른 투기과열지구 안에 있는 경우에는 조합설립인가 신청일 1년 전의 날을 말한다. 이하 같다)부터 해당 조합주택의 입주 가능일까지 주택을 소유(주택의 유형, 입주자 선정방법 등을 고려하여&nbsp;</span><a class="link" style="color: rgb(0, 90, 132); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">국토교통부령</a><span style="color: rgb(99, 99, 99);">으로 정하는 지위에 있는 경우를 포함한다. 이하 이 호에서 같다)하는지에 대하여 다음의 어느 하나에 해당할 것</span></p>
			<p class="pty1_de3" style="padding-left: 65px; text-indent: -17px; color: rgb(68, 68, 68); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px;"><span style="color: rgb(99, 99, 99);">　 1)&nbsp;</span><a class="link" style="color: rgb(0, 90, 132); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">국토교통부령</a><span style="color: rgb(99, 99, 99);">으로 정하는 기준에 따라 세대주를 포함한 세대원[세대주와 동일한 세대별 주민등록표에 등재되어 있지 아니한 세대주의 배우자 및 그 배우자와 동일한 세대를 이루고 있는 사람을 포함한다. 이하 2)에서 같다] 전원이 주택을 소유하고 있지 아니한 세대의 세대주일 것</span></p>
			<p class="pty1_de3" style="padding-left: 65px; text-indent: -17px; color: rgb(68, 68, 68); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px;"><span style="color: rgb(99, 99, 99);">　 2)&nbsp;</span><a class="link" style="color: rgb(0, 90, 132); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">국토교통부령</a><span style="color: rgb(99, 99, 99);">으로 정하는 기준에 따라 세대주를 포함한 세대원 중 1명에 한정하여 주거전용면적 85제곱미터 이하의 주택 1채를 소유한 세대의 세대주일 것</span></p>
			<p class="pty1_de3" style="padding-left: 65px; text-indent: -17px; color: rgb(68, 68, 68); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px;"><span style="color: rgb(99, 99, 99);">나. 조합설립인가 신청일 현재&nbsp;</span><a class="link sfon1" style="color: rgb(8, 109, 255); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">법</a>&nbsp;<a class="link sfon2" style="color: rgb(0, 0, 205); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">제2조</a><a class="link sfon4" style="color: rgb(0, 0, 105); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">제11호</a><a class="link sfon5" style="color: rgb(95, 146, 160); margin: 0px; padding: 0px; text-decoration-line: underline;" title="팝업으로 이동">가목</a><span style="color: rgb(99, 99, 99);">의 구분에 따른 지역에 6개월 이상 계속하여 거주하여 온 사람일 것</span></p>
			<p class="pty1_de3" style="padding-left: 65px; text-indent: -17px; color: rgb(68, 68, 68); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px;"><span style="color: rgb(99, 99, 99);">다. 본인 또는 본인과 같은 세대별 주민등록표에 등재되어 있지 않은 배우자가 같은 또는 다른 지역주택조합의 조합원이거나 직장주택조합의 조합원이 아닐 것</span></p>
			</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><span style="font-size: 10pt;"><u>우리 조합은 설립인가 신청 전이며, 투기과열지구에 해당하지 않으므로 조합원 자격 요건은 다음과 같습니다.</u></span></p>
<table _se2_tbl_template="4" border="0" cellpadding="0" cellspacing="0" class="__se_tbl" style="border: 1px solid rgb(199, 199, 199);">
	<tbody>
		<tr>
			<td style="width: 134px; height: 18px; padding: 3px 4px 2px; color: rgb(102, 102, 102); border-right: 1px solid rgb(231, 231, 231); background-color: rgb(243, 243, 243);">
			<p style="text-align: center; margin-left: 0px;">구분</p>
			</td>
			<td style="width: 234px; height: 18px; padding: 3px 4px 2px; color: rgb(102, 102, 102); border-right: 1px solid rgb(231, 231, 231); background-color: rgb(243, 243, 243);">
			<p style="text-align: center; margin-left: 0px;">기간&nbsp;</p>
			</td>
			<td style="width: 697px; height: 18px; padding: 3px 4px 2px; color: rgb(102, 102, 102); border-right: 1px solid rgb(231, 231, 231); background-color: rgb(243, 243, 243);">
			<p align="center" style="text-align: center; margin-left: 0px;">내용</p>
			</td>
		</tr>
		<tr>
			<td style="width: 134px; height: 18px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="text-align: center; margin-left: 0px;">거주요건</p>
			</td>
			<td style="width: 234px; height: 18px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="text-align: center; margin-left: 0px;">설립인가 신청일 전 6개월 간</p>
			</td>
			<td style="width: 697px; height: 18px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="margin-left: 40px;">해당 기간 동안 <span style="color: rgb(0, 117, 200);">서울특별시</span><span style="color: rgb(0, 117, 200); font-family: Gulim, doutm, tahoma, sans-serif; font-size: 13.2px; text-indent: -2px;">ㆍ</span><span style="color: rgb(0, 117, 200);">인천광역시 및 경기도</span> 거주</p>
			</td>
		</tr>
		<tr>
			<td style="width: 134px; height: 18px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="text-align: center; margin-left: 0px;">주택소유 요건</p>
			</td>
			<td colspan="1" rowspan="3" style="width: 234px; height: 41px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<!--<p align="left" style="text-align: center; margin-left: 0px;"><b><span style="color: rgb(0, 117, 200);">2019. 07. 30.</span></b> - 입주가능일 까지</p>-->
			<p align="left" style="text-align: center; margin-left: 0px;">설립인가 신청일 - 입주가능일 까지</p>
			</td>
			<td style="width: 697px; height: 18px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="margin-left: 40px;">해당 기간 동안 본인 및 배우자, 세대원 전원이 무주택 또는 전용면적 85제곱미터 이하의 주택(분양권 포함) 1채를 소유</p>
			</td>
		</tr>
		<tr>
			<td style="width: 134px; height: 18px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="text-align: center; margin-left: 0px;">세대주 요건</p>
			</td>
			<td style="width: 697px; height: 18px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="margin-left: 40px;">해당 기간 동안 연속적으로 본인이 세대주일 것</p>
			</td>
		</tr>
		<tr>
			<td colspan="1" rowspan="1" style="width: 5px; height: 5px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="margin-left: 0px; text-align: center;">중복가입금지</p>
			</td>
			<td colspan="1" rowspan="1" style="width: 342px; height: 5px; padding: 3px 4px 2px; border-top: 1px solid rgb(231, 231, 231); border-right: 1px solid rgb(231, 231, 231); color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);">
			<p style="margin-left: 40px;">해당 기간 동안 본인 및 배우자가 다른 지역주택조합 또는 직장주택조합의 조합원이 아닐 것</p>
			</td>
		</tr>
	</tbody>
</table>'
		),
	);
	
	// FAQ 게시글들 삽입
	foreach ($faq_questions as $faq) {
		insertBoardDocument('faq', $faq['title'], $faq['content'], $logged_info);
	}
	
	// 8. 공지사항 게시판에 공지사항 삽입
	$notices = array(
		array(
			'title' => '[안내] 웹사이트 오픈 안내',
			'content' => '
			<div class="notice-content">
				<h3>조합 공식 웹사이트 오픈</h3>
				<p>조합원 여러분께 사업 진행 상황과 각종 공지사항을 신속하고 투명하게 전달하기 위해 공식 웹사이트를 오픈하였습니다.</p>
				
				<h4>주요 기능</h4>
				<ul>
					<li>사업 진행 현황 실시간 업데이트</li>
					<li>각종 공지사항 및 안내사항</li>
					<li>주택법에 따른 정보공개 자료</li>
					<li>조합원 간 소통 공간</li>
				</ul>
				
				<p>조합원 인증 후 모든 자료를 열람하실 수 있습니다.</p>
			</div>'
		)
	);
	
	// 공지사항 게시글들 삽입
	foreach ($notices as $notice) {
		insertBoardDocument('notice', $notice['title'], $notice['content'], $logged_info);
	}
	
	/* End of file ko.install.php */
