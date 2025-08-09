/**
 * FAQ 게시판 아코디언 기능
 */
jQuery(function($) {
    'use strict';
    
    var FAQAccordion = {
        // 초기화
        init: function() {
            console.log('FAQ Accordion 초기화 시작');
            this.bindEvents();
            this.loadInitialContent();
        },
        
        // 이벤트 바인딩
        bindEvents: function() {
            // 클릭 이벤트 (이벤트 위임 사용)
            $(document).on('click', '.faq_title', this.handleClick.bind(this));
        },
        
        // 클릭 핸들러
        handleClick: function(e) {
            e.preventDefault();
            var $title = $(e.currentTarget);
            var targetId = $title.data('target');
            var $target = $('#' + targetId);
            
            if ($target.length === 0) {
                console.error('대상 요소를 찾을 수 없습니다:', targetId);
                return;
            }
            
            this.toggleAccordion($target);
        },
        
        // 아코디언 토글
        toggleAccordion: function($target) {
            if ($target.hasClass('in')) {
                // 닫기
                this.closeAccordion($target);
            } else {
                // 다른 열린 항목들 먼저 닫기
                this.closeAllAccordions();
                
                // 현재 항목 열기
                this.openAccordion($target);
            }
        },
        
        // 아코디언 열기
        openAccordion: function($target) {
            var $loadingContent = $target.find('.loading-content');
            
            // 내용 로드 (아직 로드되지 않은 경우에만)
            if ($loadingContent.length > 0 && !$loadingContent.hasClass('loaded')) {
                var documentSrl = $loadingContent.data('document-srl');
                if (documentSrl) {
                    $loadingContent.addClass('loaded');
                    this.loadDocumentContent(documentSrl, $loadingContent);
                }
            }
            
            // 아코디언 열기 애니메이션
            $target.addClass('in');
            this.updateHeight($target);
        },
        
        // 아코디언 닫기
        closeAccordion: function($target) {
            $target.removeClass('in');
            $target.css('max-height', '0');
        },
        
        // 모든 아코디언 닫기
        closeAllAccordions: function() {
            $('.panel-collapse.in').each((function(index, element) {
                this.closeAccordion($(element));
            }).bind(this));
        },
        
        // 높이 업데이트
        updateHeight: function($target) {
            var self = this;
            setTimeout(function() {
                if ($target.hasClass('in')) {
                    var scrollHeight = $target.prop('scrollHeight');
                    $target.css('max-height', scrollHeight + 'px');
                }
            }, 100);
        },
        
        // 문서 내용 로드
        loadDocumentContent: function(documentSrl, $container) {
            var self = this;
            var mid = this.getMidValue();
            var url = this.getBaseUrl();
            
            console.log('문서 로드 시작:', documentSrl, 'MID:', mid);
            
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    mid: mid,
                    document_srl: documentSrl
                },
                timeout: 10000,
                success: function(response) {
                    self.handleContentResponse(response, $container);
                },
                error: function(xhr, status, error) {
                    console.error('Ajax 오류:', status, error);
                    self.handleLoadError(documentSrl, $container);
                }
            });
        },
        
        // MID 값 가져오기
        getMidValue: function() {
            return $('input[name="mid"]').val() || 
                   $('meta[name="mid"]').attr('content') || 
                   location.pathname.split('/').pop() || 
                   'faq';
        },
        
        // 기본 URL 가져오기
        getBaseUrl: function() {
            var path = location.pathname;
            return location.origin + (path.endsWith('/') ? path.slice(0, -1) : path);
        },
        
        // 응답 처리
        handleContentResponse: function(response, $container) {
            try {
                var content = this.extractContent(response);
                
                if (content && content.trim()) {
                    content = this.cleanContent(content);
                    $container.html('<div class="content-loaded">' + content + '</div>');
                    console.log('내용 로드 완료');
                } else {
                    $container.html('<div class="no-content"><p>내용이 없습니다.</p></div>');
                }
                
                this.updateHeight($container.closest('.panel-collapse'));
                
            } catch (e) {
                console.error('내용 파싱 오류:', e);
                $container.html('<div class="error-content"><p>내용을 표시하는데 오류가 발생했습니다.</p></div>');
            }
        },
        
        // 내용 추출
        extractContent: function(response) {
            var $response = $(response);
            var content = '';
            
            // 다양한 선택자로 내용 찾기
            var selectors = [
                '.xe_content',
                '.document_content',
                '.read_content',
                '.board_read .content',
                '.content:not(.loading-content)',
                'article'
            ];
            
            for (var i = 0; i < selectors.length && !content; i++) {
                var $elements = $response.find(selectors[i]);
                $elements.each(function() {
                    var html = $(this).html();
                    if (html && html.trim() && 
                        html.indexOf('이 게시물을') === -1 && 
                        html.length > 10) {
                        content = html;
                        return false; // break
                    }
                });
            }
            
            // 정규식으로 내용 찾기 (백업)
            if (!content) {
                var patterns = [
                    /<div[^>]*class="[^"]*content[^"]*"[^>]*>([\s\S]*?)<\/div>/i,
                    /<article[^>]*>([\s\S]*?)<\/article>/i,
                    /<p>([\s\S]{10,}?)<\/p>/
                ];
                
                for (var j = 0; j < patterns.length && !content; j++) {
                    var match = response.match(patterns[j]);
                    if (match && match[1] && match[1].indexOf('이 게시물을') === -1) {
                        content = match[1];
                    }
                }
            }
            
            return content;
        },
        
        // 내용 정리
        cleanContent: function(content) {
            return content
                .replace(/이 게시물을[\s\S]*?<\/div>/g, '') // 관리 텍스트 제거
                .replace(/<div[^>]*class="[^"]*btn[^"]*"[\s\S]*?<\/div>/g, '') // 버튼 div 제거
                .replace(/<div[^>]*class="[^"]*manage[^"]*"[\s\S]*?<\/div>/g, '') // 관리 div 제거
                .replace(/<script[\s\S]*?<\/script>/g, '') // 스크립트 제거
                .trim();
        },
        
        // 로드 오류 처리
        handleLoadError: function(documentSrl, $container) {
            var mid = this.getMidValue();
            var directUrl = this.getBaseUrl() + '?mid=' + mid + '&document_srl=' + documentSrl;
            
            $container.html(
                '<div class="error-content">' +
                '<p>내용을 불러올 수 없습니다.</p>' +
                '<p><a href="' + directUrl + '" target="_blank" class="view-link">별도 창에서 보기 →</a></p>' +
                '</div>'
            );
            
            this.updateHeight($container.closest('.panel-collapse'));
        },
        
        // 초기 내용 로드 (페이지 로드시 열린 항목)
        loadInitialContent: function() {
            var self = this;
            setTimeout(function() {
                $('.panel-collapse.in .loading-content').each(function() {
                    var $this = $(this);
                    if (!$this.hasClass('loaded')) {
                        var documentSrl = $this.data('document-srl');
                        if (documentSrl) {
                            $this.addClass('loaded');
                            self.loadDocumentContent(documentSrl, $this);
                        }
                    }
                });
            }, 300);
        }
    };
    
    // 초기화 실행
    FAQAccordion.init();
    
    // 전역에서 접근 가능하도록 설정 (디버깅용)
    window.FAQAccordion = FAQAccordion;
});