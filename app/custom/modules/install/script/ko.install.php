<?php
	
	// 커스터마이징된 라이믹스 설치 스크립트
	// 원본을 기반으로 회사/프로젝트에 맞게 수정
	$lang = Context::getLangType();
	$logged_info = Context::get('logged_info');
	
	$oFileModel = getModel('file'); // 파일 모델
	$oModuleModel = getModel('module'); // 모듈 모델
	$oDocumentModel = getModel('document'); // 문서 모델
	
	$oAdminController = getAdminController('admin'); // 어드민 컨트롤러
	$oMenuAdminController = getAdminController('menu'); // 메뉴 어드민 컨트롤러
	$oLayoutAdminController = getAdminController('layout'); // 레이아웃 어드민 컨트롤러
	
	$oFileController = getController('file'); // 파일 컨트롤러
	$oModuleController = getController('module'); // 모듈 컨트롤러
	$oDocumentController = getController('document'); // 문서 컨트롤러
	
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
							'menu_name' => '자유 게시판',
							'module_type' => 'board',
							'module_id' => 'free',
						),
						array(
							'menu_name' => '질문 게시판',
							'module_type' => 'board',
							'module_id' => 'qna',
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
	
	$moduleList = array('page', 'board', 'editor', 'member');
	$moutput = ModuleHandler::triggerCall('menu.getModuleListInSitemap', 'after', $moduleList);
	if ($moutput->toBool()) $moduleList = array_unique($moduleList);
	
	$skinTypes = array('skin' => 'skins/', 'mskin' => 'm.skins/');
	
	$designInfo->module = new stdClass();
	
	foreach ($skinTypes as $key => $dir) {
		$skinType = $key == 'skin' ? 'P' : 'M';
		foreach ($moduleList as $moduleName) {
			$designInfo->module->{$moduleName} = new stdClass();
			if ($key == 'skin')
				$designInfo->module->{$moduleName}->{$key} = $oModuleModel->getModuleDefaultSkin($moduleName, $skinType, 0, false);
			else $designInfo->module->{$moduleName}->{$key} = '/RESPONSIVE/'; // 모바일은 PC와 동일한 반응형 스킨 사용
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
		$faq_module_info->mskin = '/RESPONSIVE/'; // 모바일 스킨 반응형 사용
		
		$output = $oModuleController->updateModule($faq_module_info);
		if (!$output->toBool()) return $output;
	}
	
	// Welcome 페이지 생성
	$moduleInfo = $oModuleModel->getModuleInfoByMenuItemSrl($sitemap['GNB']['list'][0]['menu_srl']);
	$module_srl = $moduleInfo->module_srl;
	
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
	<h1 class="tit">변화하는 시대 속에서 새로운 주거의 이야기가 시작됩니다.</h1>
	<p class="cont">고급 주거 공간은 언제나 삶의 변화를 반영하며 도시의 새로운 기준을 만들어왔습니다.</p>
	<p class="cont">세련된 미학과 앞선 기술이 어우러진 특별한 공간 경험은 현대인의 라이프스타일을 선도하며, 단순한 거주를 넘어 삶의 가치를 더하는 상징으로 자리매김해왔습니다.</p>
	<p class="cont">이제, 주거는 또 한 번의 진화를 준비합니다. 깊이 있는 시선과 혁신적인 관점을 더해, 달라진 삶의 의미와 미래를 향한 가치를 담은 새로운 고급 주거 경험이 시작됩니다.<br />
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
	
	if ($env_vars) {
		// ========== SMTP 메일 설정 (.env에서 로드) ==========
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
		
		// ========== 회원 모듈 webmaster 정보 업데이트 (.env 값으로) ==========
		$member_config = $oModuleModel->getModuleConfig('member') ?? new stdClass();
		$member_config->webmaster_name = 'OOOO 지역주택조합';
		$member_config->webmaster_email = $env_vars['SENDER_EMAIL'] ?? 'noreply@yourdomain.com';
		$output = $oModuleController->updateModuleConfig('member', $member_config);
		if (!$output->toBool()) return $output;
	}
	
	// ========== 세션 DB 사용 설정 (쿠버네티스 멀티 Pod 환경 대응) ==========
	$session_config = Rhymix\Framework\Config::get('session');
	$session_config['use_db'] = true;  // DB 기반 세션 사용
	$session_config['lifetime'] = 86400;  // 24시간 (0은 브라우저 닫으면 만료)
	$session_config['refresh'] = 1800;  // 30분마다 갱신 (기본 5분에서 연장)
	Rhymix\Framework\Config::set('session', $session_config);
	Rhymix\Framework\Config::save();
	
	// ---- [시작] FCM 푸시 알림 설정 코드 ----
	
	// FCM 서비스 계정 파일 로드
	$firebase_key_file = $script_dir . '/firebase-key.json';
	if (file_exists($firebase_key_file)) {
		$firebase_service_account = file_get_contents($firebase_key_file);
		
		// JSON 유효성 검증
		$decoded_firebase = @json_decode($firebase_service_account, true);
		if ($decoded_firebase && isset($decoded_firebase['project_id']) && isset($decoded_firebase['private_key'])) {
			
			// FCM 설정 디렉터리 생성
			$fcm_config_dir = RX_BASEDIR . 'files/config/fcmv1';
			FileHandler::makeDir($fcm_config_dir);
			
			// 서비스 계정 파일을 안전한 위치에 저장
			$service_account_filename = './files/config/fcmv1/pkey-' . \Rhymix\Framework\Security::getRandom(32) . '.json';
			\Rhymix\Framework\Storage::write($service_account_filename, $firebase_service_account);
			\Rhymix\Framework\Storage::write('./files/config/fcmv1/index.html', '<!-- Direct Access Not Allowed -->');
			
			// Push 설정 구성
			$push_config = array(
				'types' => array(
					'fcmv1' => true  // FCM HTTP v1 API 활성화
				),
				'allow_guest_device' => false,  // 게스트 디바이스 허용 안함
				'fcmv1' => array(
					'service_account' => $service_account_filename  // 파일명만 저장
				)
			);
			
			// config.php에 push 설정 저장
			Rhymix\Framework\Config::set('push', $push_config);
			Rhymix\Framework\Config::save();
		}
	}
	// ---- [끝] FCM 푸시 알림 설정 코드 ----
	
	// ---- [끝] SMTP 및 이메일 자동 설정 코드 ----
	
	// ========== rx_documents 테이블에 문서 데이터 삽입 예제 ==========
	function createInitDocument($module_id, $title, $logged_info, $sort = 'page', $is_notice = 'N', $category_srl = 0)
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
		$docs_dir = $sort === 'page' ? '/pages/' : '/posts/';
		$blade_file = $script_dir . $docs_dir . $module_id . '.blade.php';
		
		$obj->content = '내용이 없습니다.';
		// blade.php 파일이 있으면 해당 내용을 사용
		if (file_exists($blade_file)) {
			$file_content = file_get_contents($blade_file);
			if ($file_content !== false && trim($file_content) !== '') $obj->content = $file_content;
		}
		
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
	
	// 초기 문서 생성 코드
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
	
	foreach ($page_list as $page) createInitDocument($page['module_id'], $page['title'], $logged_info);
	
	// 초기 게시물 생성 코드
	$post_list = array(
		array(
			'module_id' => 'notice',
			'title' => '[안내] 조합 홈페이지 오픈 안내'
		),
		array(
			'module_id' => 'news',
			'title' => '✨ 조합 소식 게시판 이용 안내 ✨'
		),
		array(
			'module_id' => 'free',
			'title' => '자유 게시판 이용 안내'
		),
		array(
			'module_id' => 'qna',
			'title' => '질문 게시판 이용 안내'
		),
		array(
			'module_id' => 'poll',
			'title' => '투표(설문) 게시판 이용 안내'
		),
		array(
			'module_id' => 'askAuth',
			'title' => '🪪 조합원 인증 요청 게시판 이용 안내'
		),
		array(
			'module_id' => 'faq',
			'title' => '우리 조합의 조합원 자격 요건(기준)은 어떻게 되나요?'
		),
	);
	
	foreach ($post_list as $post) {
		$is_notice = $post['module_id'] === 'faq' ? 'N' : 'Y';
		createInitDocument($post['module_id'], $post['title'], $logged_info, 'board', $is_notice);
	}
	
	// ========== 게시판 비밀글 기능 및 기본값 설정 함수 ==========
	function setBoardSecretStatus($module_id, $is_default = false): bool
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');
		
		// 모듈 정보 가져오기
		$module_info = $oModuleModel->getModuleInfoByMid($module_id);
		if (!$module_info) return false;
		
		// 현재 use_status 가져오기
		$current_status = explode('|@|', $module_info->use_status ?? 'PUBLIC');
		if (!in_array('SECRET', $current_status)) $current_status[] = 'SECRET'; // SECRET 상태가 없으면 추가하여 비밀글 옵션 활성화
		$module_info->use_status = implode('|@|', $current_status); // use_status 업데이트
		$output = $oModuleController->updateModule($module_info); // 모듈 업데이트
		if (!$output->toBool()) return false;
		
		// JavaScript 기반 클라이언트 사이드 해결책 추가
		if ($is_default) {
			$js_dir = RX_BASEDIR . 'files/cache/js/';
			FileHandler::makeDir($js_dir);
			
			$js_content = "
// 비밀글 기본 선택 스크립트 for {$module_id}
jQuery(document).ready(function($) {
	// 현재 모듈이 {$module_id}이고 새 글 작성 페이지인지 확인
	var currentMid = $('input[name=\"mid\"]').val() || '{$module_id}';
	var isWritePage = location.search.includes('act=dispBoardWrite') || 
	                  $('body').hasClass('act-dispBoardWrite') || 
	                  $('#fo_insert_document').length > 0;
	var isNewDocument = !location.search.includes('document_srl=');
	
	if (currentMid === '{$module_id}' && isWritePage && isNewDocument) {
		// 페이지 로드 후 약간의 지연을 두고 실행
		setTimeout(function() {
			var secretRadio = $('input[name=\"status\"][value=\"SECRET\"]');
			var publicRadio = $('input[name=\"status\"][value=\"PUBLIC\"]');
			
			if (secretRadio.length > 0) {
				secretRadio.prop('checked', true);
				publicRadio.prop('checked', false);
				console.log('{$module_id}: SECRET 기본 선택 적용됨');
			}
		}, 200);
		
		// 추가: 폼 리셋 이벤트 처리
		$('#fo_insert_document, form[id*=\"insert\"]').on('reset', function() {
			setTimeout(function() {
				$('input[name=\"status\"][value=\"SECRET\"]').prop('checked', true);
				$('input[name=\"status\"][value=\"PUBLIC\"]').prop('checked', false);
			}, 10);
		});
	}
});";
			
			$js_file = $js_dir . 'secret_default_' . $module_id . '.js';
			FileHandler::writeFile($js_file, $js_content);
			
			// 레이아웃에서 JavaScript 파일 자동 로드하도록 설정
			$layout_js_path = RX_BASEDIR . 'files/cache/js/secret_defaults.js';
			$load_script = "
// 비밀글 기본값 스크립트들 로드
if (typeof jQuery !== 'undefined')
	jQuery.getScript('./files/cache/js/secret_default_{$module_id}.js');";
			
			// 기존 내용이 있으면 추가, 없으면 새로 생성
			$existing_content = '';
			if (file_exists($layout_js_path))
				$existing_content = file_get_contents($layout_js_path);
			
			if (!str_contains($existing_content, "secret_default_{$module_id}.js"))
				FileHandler::writeFile($layout_js_path, $existing_content . $load_script);
		}
		
		return true;
	}
	
	// ========== 게시판 권한 설정 함수 ==========
	function setBoardPermissions($module_id, $permissions = array()): bool
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
	function applyBoardPermissions($sitemap_list, $parent_name = ''): void
	{
		foreach ($sitemap_list as $item) {
			// board 모듈인 경우 권한 설정
			if (isset($item['module_type']) && $item['module_type'] === 'board') {
				$module_id = $item['module_id'];
				
				$permissions = match ($module_id) {
					'askAuth' => array(),
					'faq' => array(
						'access' => array(0),               // 모든 방문자 접근 가능
						'list' => array(0),                 // 모든 방문자 목록 보기 가능
						'view' => array(0),                 // 모든 방문자 보기 가능
						'write_document' => array(-3),      // 관리자만 글쓰기 가능
						'write_comment' => array(-3),       // 관리자만 댓글 쓰기 가능
						'vote_log_view' => array(-3),       // 관리자만 추천인 보기 가능
						'update_view' => array(-3),         // 관리자만 수정 내역 보기 가능
					),
					'notice' => array(
						'write_document' => array(-3),     // 관리자만 글쓰기 가능
						'write_comment' => array(2, 4),    // 관리자, 정회원만 댓글 쓰기 가능
						'update_view' => array(-3),        // 관리자만 수정 내역 보기 가능
					),
					'poll' => array(
						'view' => array(2, 4),             // 관리자, 정회원만 보기 가능
						'write_document' => array(-3),     // 관리자만 글쓰기 가능
						'write_comment' => array(2, 4),    // 관리자, 정회원만 댓글 쓰기 가능
						'update_view' => array(-3),        // 관리자만 수정 내역 보기 가능
					),
					'info_01', 'info_02', 'info_03', 'info_04', 'info_05',
					'info_06', 'info_07', 'info_08', 'info_09', 'info_10',
					'info_11', 'info_12', 'info_13', 'info_14', 'info_15' => array(
						'access' => array(2, 4),           // 관리자, 정회원만 접근 가능
						'list' => array(2, 4),             // 관리자, 정회원만 목록 보기 가능
						'view' => array(2, 4),             // 관리자, 정회원만 보기 가능
						'write_document' => array(-3),     // 관리자만 글쓰기 가능
						'write_comment' => array(2, 4),    // 관리자, 정회원만 댓글 쓰기 가능
						'update_view' => array(-3),        // 관리자만 수정 내역 보기 가능
					),
					default => array(
						'view' => array(2, 4),               // 관리자, 정회원만 보기 가능
						'write_document' => array(2, 4),     // 관리자, 정회원만 글쓰기 가능
						'write_comment' => array(2, 4),      // 관리자, 정회원만 댓글 쓰기 가능
					),
				};
				// 권한 설정 적용
				setBoardPermissions($module_id, $permissions);
				
				// 특정 게시판에 비밀글 기능 활성화 (필요한 게시판 ID 추가 가능)
				$secret_enabled_boards = ['askAuth', 'qna']; // 조합원 인증 요청, 질문 게시판
				$secret_default_boards = ['askAuth']; // 비밀글이 기본값인 게시판
				
				if (in_array($module_id, $secret_enabled_boards)) {
					$is_default = in_array($module_id, $secret_default_boards);
					setBoardSecretStatus($module_id, $is_default);
				}
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
	
	// 메뉴 캐시 생성
	$oMenuAdminController->makeXmlFile($sitemap['GNB']['menu_srl']); // $menuSrl -> $sitemap['GNB']['menu_srl']로 수정
	
	/* End of file ko.install.php */
