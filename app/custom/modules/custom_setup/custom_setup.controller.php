<?php
	/**
	 * 커스텀 설치 모듈 컨트롤러
	 */
	
	class custom_setupController extends ModuleController
	{
		/**
		 * 설치 완료 후 트리거
		 */
		public function triggerAfterInstallComplete($obj)
		{
			// 설치 완료 후 커스텀 사이트 구조 생성
			$this->createCustomSiteStructure();
			
			return $obj;
		}
		
		/**
		 * 커스텀 사이트 구조 생성
		 */
		private function createCustomSiteStructure()
		{
			try {
				$this->createCustomContent();
				$this->applyCustomSettings();
				
				// 성공 로그
				$this->writeLog('Custom site structure created successfully');
				
			} catch (Exception $e) {
				// 에러 로그
				$this->writeLog('Error: ' . $e->getMessage());
			}
		}
		
		/**
		 * 커스텀 콘텐츠 생성
		 */
		private function createCustomContent()
		{
			$oDocumentController = getController('document');
			$oModuleModel = getModel('module');
			
			// 첫 번째 관리자 계정 가져오기
			$oMemberModel = getModel('member');
			$args = new stdClass();
			$args->is_admin = 'Y';
			$output = executeQueryArray('member.getMemberList', $args);
			
			if (!$output->toBool() || !$output->data) return;
			
			$admin_member = $output->data[0];
			
			// 공지사항 생성
			$notice_module = $oModuleModel->getModuleInfoByMid('notice');
			if ($notice_module) {
				$this->createNoticePost($notice_module, $admin_member);
			}
		}
		
		/**
		 * 공지사항 게시물 생성
		 */
		private function createNoticePost($module_info, $admin_member)
		{
			$oDocumentController = getController('document');
			
			$posts = array(
				array(
					'title' => '사이트 오픈 안내',
					'content' => '<p>저희 회사 홈페이지가 새롭게 오픈했습니다.</p>',
					'is_notice' => 'Y'
				)
			);
			
			foreach ($posts as $post) {
				$obj = new stdClass();
				$obj->module_srl = $module_info->module_srl;
				$obj->title = $post['title'];
				$obj->content = $post['content'];
				$obj->member_srl = $admin_member->member_srl;
				$obj->user_id = $admin_member->user_id;
				$obj->nick_name = $admin_member->nick_name;
				$obj->email_address = $admin_member->email_address;
				$obj->is_notice = $post['is_notice'];
				
				$oDocumentController->insertDocument($obj, true);
			}
		}
		
		/**
		 * 커스텀 설정 적용
		 */
		private function applyCustomSettings()
		{
			// 사이트 기본 설정
			$config = array(
				'site_title' => '우리 회사',
				'default_language' => 'ko'
			);
			
			foreach ($config as $key => $value) {
				$oModuleController = getController('module');
				$oModuleController->insertModuleConfig('module', (object)array($key => $value));
			}
		}
		
		/**
		 * 로그 작성
		 */
		private function writeLog($message)
		{
			$log_file = RX_BASEDIR . 'files/cache/custom_setup.log';
			$log_content = date('Y-m-d H:i:s') . ' - ' . $message . "\n";
			FileHandler::writeFile($log_file, $log_content, 'a');
		}
	}
