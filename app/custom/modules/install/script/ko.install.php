<?php
	
	// 커스터마이징된 라이믹스 설치 스크립트
	// 원본을 기반으로 회사/프로젝트에 맞게 수정
	$lang = Context::getLangType();
	$logged_info = Context::get('logged_info');
	
	$oFileModel = getModel('file'); // 파일 모델
	$oModuleModel = getModel('module'); // 모듈 모델
	$oDocumentModel = getModel('document'); // 문서 모델
	
	$oMenuAdminController = getAdminController('menu'); // 메뉴 어드민 컨트롤러
	$oLayoutAdminController = getAdminController('layout'); // 레이아웃 어드민 컨트롤러
	
	$oModuleController = getController('module'); // 모듈 컨트롤러
	$oDocumentController = getController('document'); // 문서 컨트롤러
	$oFileController = getController('file'); // 파일 컨트롤러
	$oAdminController = getAdminController('admin'); // 어드민 컨트롤러
	
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
							'module_id' => 'contact',
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
			if ($output instanceof BaseObject && !$output->toBool()) return $output;
			
			$menu_srl = $oMenuAdminController->get('menu_item_srl');
			$item['menu_srl'] = $menu_srl;
			
			if ($item['list']) __makeMenu($item['list'], $menu_srl);
		}
		return true; // 성공 반환
	}
	
	// 사이트맵 생성
	foreach ($sitemap as $id => &$val) {
		$output = $oMenuAdminController->addMenu($val['title']);
		if (!$output->toBool()) return $output;
		
		$val['menu_srl'] = $output->get('menuSrl');
		
		$result = __makeMenu($val['list'], $val['menu_srl']);
		if ($result instanceof BaseObject && !$result->toBool()) return $result;
		
		$oMenuAdminController->makeHomemenuCacheFile($val['menu_srl']);
	}
	
	// editor 모듈의 기본 config 조회 및 기본 글꼴 변경
	$editor_config = $oModuleModel->getModuleConfig('editor') ?: new stdClass();
	$editor_config->content_font_size = '15px';
	$oModuleController->updateModuleConfig('editor', $editor_config);
	
	// 커스텀 레이아웃 생성
	$args = new stdClass();
	$layout_srl = $args->layout_srl = getNextSequence();
	$args->site_srl = 0;
	$args->layout = 'ibs_layout';  // 커스텀 레이아웃명
	$args->title = 'IBS_Edition';
	$args->layout_type = 'P';
	$output = $oLayoutAdminController->insertLayout($args);
	if (!$output->toBool()) return $output;
	
	// PC 레이아웃 업데이트
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
	
	$args->extra_vars = serialize($extra_vars);
	$output = $oLayoutAdminController->updateLayout($args);
	if (!$output->toBool()) return $output;
	
	// 디자인 파일 생성
	$siteDesignPath = RX_BASEDIR . 'files/site_design/';
	FileHandler::makeDir($siteDesignPath);
	
	$designInfo = new stdClass();
	$designInfo->layout_srl = $layout_srl;
	
	
	$moduleList = array('page', 'board', 'editor');
	$moutput = ModuleHandler::triggerCall('menu.getModuleListInSitemap', 'after', $moduleList);
	if ($moutput->toBool()) $moduleList = array_unique($moduleList);
	
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
	foreach (['advanced_mailer', 'ncenterlite'] as $module_name)
		$oAdminController->_insertFavorite(0, $module_name);
	
	// 메뉴 캐시 생성
	$oMenuAdminController->makeXmlFile($sitemap['GNB']['menu_srl']); // $menuSrl -> $sitemap['GNB']['menu_srl']로 수정
	
	// ---- [시작] 파비콘, 모바일 아이콘, 대표 이미지 자동 등록 코드 ----
	// 파비콘 및 모바일 아이콘 자동 등록
	$script_dir = dirname(__FILE__);
	$identity_dir = $script_dir . '/identity_files';
	
	// 파비콘 파일 경로
	$favicon_source = $identity_dir . '/favicon.png';
	$mobile_icon_source = $identity_dir . '/mobile_icon.png';
	
	if (file_exists($favicon_source) || file_exists($mobile_icon_source)) {
		// 라이믹스 아이콘 디렉터리 생성
		$icon_dir = RX_BASEDIR . 'files/attach/xeicon';
		FileHandler::makeDir($icon_dir);
		
		// 파비콘 업로드 (favicon.ico 또는 favicon.png)
		if (file_exists($favicon_source)) {
			$favicon_dest = $icon_dir . '/favicon.ico'; // 라이믹스는 favicon.ico를 기대
			if (copy($favicon_source, $favicon_dest)) echo "Favicon uploaded successfully.\n"; // 성공적으로 복사됨
		}
		
		// 모바일 아이콘 업로드 (mobicon.png)
		if (file_exists($mobile_icon_source)) {
			$mobicon_dest = $icon_dir . '/mobicon.png'; // 라이믹스는 mobicon.png를 기대
			if (copy($mobile_icon_source, $mobicon_dest)) echo "Mobile icon uploaded successfully.\n"; // 성공적으로 복사됨
		}
	}
	// ---- [끝] 파비콘, 모바일 아이콘, 대표 이미지 자동 등록 코드 ----
	
	// ========== 회원 모듈 이메일 인증 설정 (메일 설정 이후에 실행) ==========
	$member_config = $oModuleModel->getModuleConfig('member') ?? new stdClass();
	$member_config->enable_confirm = 'Y';
	
	// signupForm에서 homepage, blog, birthday 항목의 isUse 비활성화
	if (isset($member_config->signupForm) && is_array($member_config->signupForm))
		foreach ($member_config->signupForm as &$form_item)
			if (in_array($form_item->name, ['homepage', 'blog', 'birthday'])) {
				$form_item->isUse = false;
				$form_item->isPublic = false;
			}
	
	$oModuleController->updateModuleConfig('member', $member_config);
	
	// ---- [시작] SMTP 및 이메일 자동 설정 코드 ----
	
	// ========== .env 파일 설정 로드 ==========
	// 현재 스크립트 디렉터리의 .env 파일 읽기
	function loadEnvFile($filePath)
	{
		$envVars = array();
		if (!file_exists($filePath)) return $envVars;
		
		$lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		foreach ($lines as $line) {
			// 주석 제거
			if (strpos(trim($line), '#') === 0) continue;
			
			// KEY=VALUE 형태로 파싱
			if (strpos($line, '=') !== false) {
				list($key, $value) = explode('=', $line, 2);
				$key = trim($key);
				$value = trim($value);
				
				// 따옴표 제거
				if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
					(substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
					$value = substr($value, 1, -1);
				}
				
				$envVars[$key] = $value;
			}
		}
		return $envVars;
	}
	
	// .env 파일 로드
	$script_dir = dirname(__FILE__);
	$env_file = $script_dir . '/.env';
	$env_vars = loadEnvFile($env_file);
	
	// ========== SMTP 메일 설정 (.env에서 로드) ==========
	// 데이터베이스 모듈 설정 (관리자 페이지 표시용)
	$mail_config = new stdClass();
	$mail_config->type = 'smtp';
	$mail_config->smtp_host = $env_vars['SMTP_HOST'] ?? 'smtp.gmail.com';
	$mail_config->smtp_secure = $env_vars['SMTP_SECURE'] ?? 'tls';
	$mail_config->smtp_port = isset($env_vars['SMTP_PORT']) ? (int)$env_vars['SMTP_PORT'] : 587;
	$mail_config->smtp_auth = $env_vars['SMTP_AUTH'] ?? 'Y';
	$mail_config->smtp_username = $env_vars['SMTP_USERNAME'] ?? 'your_account';
	$mail_config->smtp_password = $env_vars['SMTP_PASSWORD'] ?? 'your_password';
	$mail_config->sender_name = 'OOOO 지역주택조합';
	$mail_config->sender_email = $env_vars['SENDER_EMAIL'] ?? 'noreply@yourdomain.com';
	$mail_config->encoding = 'UTF-8';
	$mail_config->wordwrap = 0;
	$mail_config->html_mail = 'Y';
	$mail_config->use_advanced_mailer = 'Y';
	$output = $oModuleController->updateModuleConfig('mail', $mail_config);
	if (!$output->toBool()) return $output;

	// ========== Advanced Mailer 모듈 설정 (.env에서 로드) ==========
	$advanced_mailer_config = new stdClass();
	$advanced_mailer_config->sender_name = 'OOOO 지역주택조합';
	$advanced_mailer_config->sender_email = $env_vars['SENDER_EMAIL'] ?? 'noreply@yourdomain.com';
	$advanced_mailer_config->force_sender = true;
	$advanced_mailer_config->reply_to = $env_vars['REPLY_TO_EMAIL'] ?? 'your-id@mail.com';
	$output = $oModuleController->updateModuleConfig('advanced_mailer', $advanced_mailer_config);
	if (!$output->toBool()) return $output;
	
	// Rhymix Configuration API를 사용하여 mail 설정 업데이트 (config.php)
	$mail_settings = array(
		'default_name' => 'OOOO 지역주택조합',
		'default_from' => $env_vars['SENDER_EMAIL'] ?? 'noreply@yourdomain.com',
		'default_force' => true,
		'default_reply_to' => $env_vars['REPLY_TO_EMAIL'] ?? 'your-id@mail.com',
		'type' => 'smtp',
		'smtp' => array(
			'smtp_host' => $env_vars['SMTP_HOST'] ?? 'smtp.gmail.com',
			'smtp_security' => $env_vars['SMTP_SECURE'] ?? 'tls',
			'smtp_port' => isset($env_vars['SMTP_PORT']) ? (int)$env_vars['SMTP_PORT'] : 587,
			'smtp_user' => $env_vars['SMTP_USERNAME'] ?? 'your_account',
			'smtp_pass' => $env_vars['SMTP_PASSWORD'] ?? 'your_password',
		)
	);
	
	// config.php에 mail 설정 저장
	Rhymix\Framework\Config::set('mail', $mail_settings);
	Rhymix\Framework\Config::save();
//
//	// 모든 관련 캐시 삭제 (관리자 페이지 반영을 위해)
//	Rhymix\Framework\Cache::delete('module_config:mail');
//	Rhymix\Framework\Cache::delete('module_config:advanced_mailer');
//	Rhymix\Framework\Cache::clearGroup('config');
//	Rhymix\Framework\Cache::clearGroup('module');
//
//	// 추가로 opcache도 클리어 (PHP 캐시)
//	if (function_exists('opcache_reset')) opcache_reset();
//
	// ========== 회원 모듈 webmaster 정보 업데이트 (.env 값으로) ==========
	$member_config = $oModuleModel->getModuleConfig('member') ?? new stdClass();
	$member_config->webmaster_name = 'OOOO 지역주택조합';
	$member_config->webmaster_email = $env_vars['SENDER_EMAIL'] ?? 'noreply@yourdomain.com';
	$output = $oModuleController->updateModuleConfig('member', $member_config);
	if (!$output->toBool()) return $output;
	
	// ---- [끝] SMTP 및 이메일 자동 설정 코드 ----
	
	// ========== rx_documents 테이블에 문서 데이터 삽입 예제 ==========
	function insertCustomDocument($module_id, $title, $content, $logged_info, $sort = 'page', $is_notice = 'N', $category_srl = 0)
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
		// blade.php 파일 경로 확인 (현재 스크립트 파일과 같은 경로)
		$script_dir = dirname(__FILE__);
		$blade_file = $script_dir . '/' . $module_id . '.blade.php';
		
		// blade.php 파일이 있으면 해당 내용을 사용, 없으면 $content 사용
		if (file_exists($blade_file)) {
			$file_content = file_get_contents($blade_file);
			if ($file_content !== false && trim($file_content) !== '') $obj->content = $file_content;
			else $obj->content = $content;
		} else $obj->content = $content;
		
		$obj->status = 'PUBLIC'; // PUBLIC, PRIVATE, SECRET
		$obj->comment_status = 'ALLOW'; // ALLOW, DENY
		if ($sort == 'board') {
			$obj->category_srl = $category_srl; // 카테고리 번호 (0이면 미분류)
			$obj->is_notice = $is_notice; // 알림 메시지 여부
		}
		
		// 문서 삽입
		$output = $oDocumentController->insertDocument($obj, true);
		if (!$output->toBool()) return false;
		
		$document_srl = $output->get('document_srl');
		
		if ($sort == 'page') { // $sort = 'page', 'board'
			// ★ 핵심: ARTICLE 모듈에 문서 연결 ★
			$module_info->document_srl = $document_srl;
			
			// 모듈 정보 업데이트
			$update_output = $oModuleController->updateModule($module_info);
			if (!$update_output->toBool()) return false;
		}
		return $document_srl;
	}
	
	// 실제 문서 삽입 코드
	$page_list = array(
		array( // 1. terms 내용 삽입
			'module_id' => 'terms',
			'title' => '서비스 이용 약관',
		),
		array( // 2. privacy 내용 삽입
			'module_id' => 'privacy',
			'title' => '개인정보처리방침',
		),
		array( // 3. 사업 개요 페이지에 내용 삽입
			'module_id' => 'overview',
			'title' => '사업 개요',
		),
		array( // 4. 브랜드 소개 페이지에 내용 삽입
			'module_id' => 'brand',
			'title' => '브랜드 소개',
		),
		array( // 5. 입지 환경 페이지에 내용 삽입
			'module_id' => 'location',
			'title' => '입지 환경',
		),
		array( // 6. 오시는 길 페이지에 내용 삽입
			'module_id' => 'contact',
			'title' => '오시는 길',
		),
	);
	
	foreach ($page_list as $page) insertCustomDocument($page['module_id'], $page['title'], '', $logged_info);
	
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
	foreach ($faq_questions as $faq) insertCustomDocument('faq', $faq['title'], $faq['content'], $logged_info, 'board');
	
	// 8. 공지사항 게시판에 공지사항 삽입
	$notices = array(
		array(
			'title' => '[안내] 조합 홈페이지 오픈 안내',
			'content' => '
			<h3><u><b>조합 공식 홈페이지 오픈 안내</b></u></h3>
			<p>&nbsp;</p>
			<p>안녕하세요, 조합원 여러분.</p>
			<p>조합의 사업 진행 상황과 각종 소식을 보다&nbsp;<b>신속하고 투명하게</b>&nbsp;전달해 드리기 위해&nbsp;<b>조합 공식 홈페이지</b>를 새롭게 오픈하였습니다.</p>
			<p>&nbsp;</p>
			<table border="1" cellpadding="30" cellspacing="0" style="width:740px;">
				<tbody>
					<tr>
						<td style="padding: 20px; background: #fffff2;">
						<h3><b>주요 기능 안내</b></h3>
						<p>&nbsp;</p>
						<ul>
							<li>
							<p><b>사업 진행 현황 실시간 업데이트</b></p>
							<p>진행 중인 사업의 최신 소식을 빠르게 확인하실 수 있습니다.</p>
							</li>
							<li>
							<p><b>공지사항 및 안내사항 게시</b></p>
							<p>중요한 일정과 변경 사항을 놓치지 않도록 안내드립니다.</p>
							</li>
							<li>
							<p><b>법정 공개 자료 열람</b></p>
							<p>주택법 등 관련 법규에 따라 공개해야 하는 자료를 열람하실 수 있습니다.</p>
							</li>
							<li>
							<p><b>커뮤니티 게시판 운영</b></p>
							<p>조합원 간 자유로운 의견 교환이 가능한 자유게시판과 질문게시판을 제공합니다.</p>
							</li>
						</ul>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<h3><b>조합원 인증 안내</b></h3>
						<p>&nbsp;</p>
						<ul>
							<li>
							<p><b>조합원 전용 콘텐츠</b>는 인증된 조합원만 열람할 수 있습니다.</p>
							</li>
							<li>
							<p>인증을 원하시는 경우&nbsp;<b>&lsquo;조합원 인증 요청&rsquo; 게시판</b>에서 안내 절차에 따라 신청해 주세요.</p>
							</li>
							<li>
							<p>인증이 완료되면 모든 자료를 열람하고, 게시판에 자유롭게 글을 작성하실 수 있습니다.</p>
							</li>
						</ul>
						</td>
					</tr>
				</tbody>
			</table>
			<p>&nbsp;</p>
			<p>조합 공식 홈페이지가 조합원 여러분과의 소통 창구가 되어,</p>
			<p>사업 진행의 모든 과정을 투명하고 편리하게 공유할 수 있도록 노력하겠습니다.</p>
			<p>많은 방문과 이용 부탁드립니다.<a href="https://www.facebook.com/"><i></i></a></p>'
		)
	);
	
	// 공지사항 게시글들 삽입
	foreach ($notices as $notice) insertCustomDocument('notice', $notice['title'], $notice['content'], $logged_info, 'board', 'Y');
	
	// ========== 게시판 권한 설정 함수 ==========
	function setBoardPermissions($module_id, $permissions = array())
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');
		
		// 모듈 정보 가져오기
		$module_info = $oModuleModel->getModuleInfoByMid($module_id);
		if (!$module_info) return false;
		
		// 기본 권한 설정
		$default_permissions = array(
			'access' => array(-1),              // 로그인 회원만 접근 가능
			'list' => array(-1),                // 로그인 회원만 목록 보기 가능
			'view' => array(-1),                // 로그인 회원만 보기 가능
			'write_document' => array(-1),      // 로그인 회원만 글쓰기 가능
			'write_comment' => array(-1),       // 로그인 회원만 댓글 쓰기 가능
			'vote_log_view' => array(-1),       // 로그인 회원만 추천인 보기 가능
			'update_view' => array(-1),         // 로그인 회원만 수정 내역 보기 가능
			'consultation_read' => array(-3),   // 관리자만 상담글 열람 가능
			'manager' => array(-3)              // 관리자만 관리 가능
		);
		
		// 사용자 권한과 기본 권한 병합
		$final_permissions = array_merge($default_permissions, $permissions);
		
		// 새 권한 정보 삽입
		foreach ($final_permissions as $grant_name => $grant_groups) {
			foreach ($grant_groups as $group_srl) {
				$grant_args = new stdClass();
				$grant_args->module_srl = $module_info->module_srl;
				$grant_args->name = $grant_name;
				$grant_args->group_srl = $group_srl;
				
				$output = executeQuery('module.insertModuleGrant', $grant_args);
				if (!$output->toBool()) return false;
			}
		}
		
		// grants 설정을 모듈 정보에도 저장 (캐시용)
		$grants = new stdClass();
		foreach ($final_permissions as $grant_name => $grant_groups)
			$grants->{$grant_name} = $grant_groups;
		
		$module_info->grants = serialize($grants);
		
		// 모듈 업데이트
		$output = $oModuleController->updateModule($module_info);
		if (!$output->toBool()) return false;
		
		return true;
	}
	
	// ========== 게시판별 권한 설정 적용 ==========
	// 사이트맵에서 board 타입 게시판들에 권한 설정 적용
	function applyBoardPermissions($sitemap_list, $parent_name = '')
	{
		foreach ($sitemap_list as $item) {
			// board 모듈인 경우 권한 설정
			if (isset($item['module_type']) && $item['module_type'] === 'board') {
				$module_id = $item['module_id'];
				
				switch ($module_id) {
					case 'notice':  // 공지사항 - 관리자만 글쓰기
					case 'poll':    // 투표(설문) - 관리자만 글쓰기
						$permissions = array(
							'access' => array(-1),             // 로그인 회원만 접근 가능
							'list' => array(2, 4),             // 정회원만 목록 보기 가능
							'view' => array(2, 4),             // 정회원만 보기 가능
							'write_document' => array(-3),     // 관리자만 글쓰기 가능
							'write_comment' => array(2, 4),    // 정회원만 댓글 쓰기 가능
							'vote_log_view' => array(2, 4),    // 정회원만 추천인 보기 가능
							'update_view' => array(-3),        // 관리자만 수정 내역 보기 가능
						);
						break;
					
					case 'askAuth':  // 조합원 인증 요청 - 로그인 회원만 보기/쓰기
						$permissions = array(
							'access' => array(-1),              // 로그인 회원만 접근 가능
							'list' => array(-1),                // 로그인 회원만 목록 보기 가능
							'view' => array(-1),                // 로그인 회원만 보기 가능
							'write_document' => array(-1),      // 로그인 회원만 글쓰기 가능
							'write_comment' => array(-1),       // 로그인 회원만 댓글 쓰기 가능
							'vote_log_view' => array(-1),       // 로그인 회원만 추천인 보기 가능
							'update_view' => array(-1),         // 로그인 회원만 수정 내역 보기 가능
						);
						break;
					
					case 'info_01':
					case 'info_02':
					case 'info_03':
					case 'info_04':
					case 'info_05':
					case 'info_06':
					case 'info_07':
					case 'info_08':
					case 'info_09':
					case 'info_10':
					case 'info_11':
					case 'info_12':
					case 'info_13':
					case 'info_14':
					case 'info_15':  // 자료공개 게시판들 - 인증된 조합원만 (그룹 4번이라고 가정)
						$permissions = array(
							'access' => array(2, 4),           // 관리자, 정회원만 접근 가능
							'list' => array(2, 4),             // 관리자, 정회원만 목록 보기 가능
							'view' => array(2, 4),             // 관리자, 정회원만 보기 가능
							'write_document' => array(-3),     // 관리자만 글쓰기 가능
							'write_comment' => array(2, 4),    // 관리자, 정회원만 댓글 쓰기 가능
							'vote_log_view' => array(2, 4),    // 관리자, 정회원만 추천인 보기 가능
							'update_view' => array(-3),        // 관리자만 수정 내역 보기 가능
						);
						break;
					
					case 'faq':  // FAQ - 모든 사용자 보기, 관리자만 글쓰기
						$permissions = array(
							'access' => array(0),               // 모든 방문자 접근 가능
							'list' => array(0),                 // 모든 방문자 목록 보기 가능
							'view' => array(0),                 // 모든 방문자 보기 가능
							'write_document' => array(-3),      // 관리자만 글쓰기 가능
							'write_comment' => array(-3),       // 관리자만 댓글 쓰기 가능
							'vote_log_view' => array(-3),       // 관리자만 추천인 보기 가능
							'update_view' => array(-3),         // 관리자만 수정 내역 보기 가능
						);
						break;
					
					default:  // 기타 게시판들 (news, qna, free 등) - 기본 권한
						$permissions = array(
							'access' => array(-1),               // 로그인 회원만 접근 가능
							'list' => array(2, 4),               // 관리자, 정회원만 목록 보기 가능
							'view' => array(2, 4),               // 관리자, 정회원만 보기 가능
							'write_document' => array(2, 4),     // 관리자, 정회원만 글쓰기 가능
							'write_comment' => array(2, 4),      // 관리자, 정회원만 댓글 쓰기 가능
						);
						break;
				}
				// 권한 설정 적용
				setBoardPermissions($module_id, $permissions);
			}
			
			// 하위 메뉴가 있으면 재귀 호출
			if (isset($item['list']) && is_array($item['list']))
				applyBoardPermissions($item['list'], $parent_name . '/' . ($item['menu_name'] ?? ''));
		}
	}
	
	// 게시판 권한 설정 실행
	foreach ($sitemap as $menu_id => $menu_data)
		if (isset($menu_data['list']) && is_array($menu_data['list']))
			applyBoardPermissions($menu_data['list'], $menu_id);
	
	/* End of file ko.install.php */
