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
		
		return $output->get('document_srl');
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
	$terms_content = 'asdfasd';
	$terms_doc_srl = insertPageDocument('terms', '서비스 이용 약관', $terms_content, $logged_info);
	
	// 2. privacy 내용 삽입
	$privacy_content = 'asdfasdfddd';
	$privacy_doc_srl = insertPageDocument('privacy', '개인정보처리방침', $privacy_content, $logged_info);
	
	// 3. 사업 개요 페이지에 내용 삽입
	$overview_content = '
	<div class="page-content">
		<h2>사업 개요</h2>
		<p>본 사업은 주택법에 따라 설립된 지역주택조합이 시행하는 공동주택 건설사업입니다.</p>
		<ul>
			<li>사업 위치: OO시 OO구 OO동 일원</li>
			<li>사업 규모: 지하 2층, 지상 15층, 총 200세대</li>
			<li>사업 기간: 2024년 ~ 2027년 (예정)</li>
			<li>시행사: OO지역주택조합</li>
		</ul>
		<h3>사업 추진 경과</h3>
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
		<h2>브랜드 소개</h2>
		<div class="brand-story">
			<h3>우리의 비전</h3>
			<p>품질 높은 주거공간을 통해 조합원 여러분의 꿈을 실현합니다.</p>
			
			<h3>브랜드 가치</h3>
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
		<h2>입지 환경</h2>
		<div class="location-advantages">
			<h3>교통 접근성</h3>
			<ul>
				<li>지하철 1호선 OO역 도보 5분</li>
				<li>버스정류장 도보 2분 (간선 3개 노선, 지선 5개 노선)</li>
				<li>고속도로 IC 차량 10분 거리</li>
			</ul>
			
			<h3>생활 편의시설</h3>
			<ul>
				<li>대형마트: 롯데마트, 이마트 차량 5분</li>
				<li>병원: OO종합병원 도보 10분</li>
				<li>학교: OO초등학교 도보 8분, OO중학교 도보 12분</li>
			</ul>
		</div>
	</div>';
	
	$location_doc_srl = insertPageDocument('location', '입지 환경', $location_content, $logged_info);
	
	// 7. FAQ 게시판에 자주 묻는 질문들 삽입
	$faq_questions = array(
		array(
			'title' => '조합원 가입 조건은 무엇인가요?',
			'content' => '
			<div class="faq-answer">
				<p><strong>답변:</strong></p>
				<p>조합원 가입을 위해서는 다음 조건을 충족해야 합니다:</p>
				<ul>
					<li>무주택 세대주 또는 세대원</li>
					<li>해당 지역 거주 조건 충족</li>
					<li>소득 기준 충족</li>
					<li>가입비 및 1차 분담금 납부</li>
				</ul>
				<p>자세한 사항은 조합 사무실로 문의하시기 바랍니다.</p>
			</div>'
		),
		array(
			'title' => '분담금은 언제, 얼마를 납부해야 하나요?',
			'content' => '
			<div class="faq-answer">
				<p><strong>답변:</strong></p>
				<p>분담금 납부 일정은 다음과 같습니다:</p>
				<table class="table">
					<tr><th>차수</th><th>납부 시기</th><th>금액</th></tr>
					<tr><td>1차</td><td>조합원 가입 시</td><td>1,000만원</td></tr>
					<tr><td>2차</td><td>착공 전</td><td>2,000만원</td></tr>
					<tr><td>3차</td><td>중간금</td><td>2,000만원</td></tr>
					<tr><td>잔금</td><td>입주 시</td><td>나머지 금액</td></tr>
				</table>
				<p>※ 상기 일정 및 금액은 사업 진행에 따라 변동될 수 있습니다.</p>
			</div>'
		),
		array(
			'title' => '입주 예정 시기는 언제인가요?',
			'content' => '
			<div class="faq-answer">
				<p><strong>답변:</strong></p>
				<p>현재 계획으로는 2027년 하반기 입주 예정입니다.</p>
				<ul>
					<li>착공: 2024년 하반기 예정</li>
					<li>공사 기간: 약 30개월</li>
					<li>입주: 2027년 하반기 예정</li>
				</ul>
				<p>※ 인허가 및 공사 진행 상황에 따라 일정이 변경될 수 있으며, 변경 시 즉시 공지해드리겠습니다.</p>
			</div>'
		)
	);
	
	// FAQ 게시글들 삽입
	foreach ($faq_questions as $faq) {
		insertBoardDocument('faq', $faq['title'], $faq['content'], $logged_info);
	}
	
	// 8. 공지사항 게시판에 공지사항 삽입
	$notices = array(
		array(
			'title' => '[공지] 조합원 총회 개최 안내',
			'content' => '
			<div class="notice-content">
				<h3>제1차 조합원 총회 개최 안내</h3>
				<p>안녕하십니까? OO지역주택조합입니다.</p>
				<p>조합 설립 후 첫 정기총회를 아래와 같이 개최하오니 조합원 여러분의 많은 참석 부탁드립니다.</p>
				
				<table class="table">
					<tr><th>구분</th><th>내용</th></tr>
					<tr><td>일시</td><td>2024년 4월 15일(월) 오후 7시</td></tr>
					<tr><td>장소</td><td>OO구민회관 대강당</td></tr>
					<tr><td>안건</td><td>사업시행인가 보고, 2024년도 사업계획 승인 등</td></tr>
				</table>
				
				<p>감사합니다.</p>
				<p>OO지역주택조합 이사장</p>
			</div>'
		),
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
