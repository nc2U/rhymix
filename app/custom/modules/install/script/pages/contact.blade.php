<div class="location_map">
	<div class="img_sec">
		<img src="./app/custom/modules/install/script/img/map.jpg" alt="견본주택 및 현장 위치 지도"/>
	</div>

	<div class="txt_sec">
		<div class="addr_con">
			<dl>
				<dt>견본주택</dt>
				<dd>경기도 안양시 만안구 안양동 594-24번지</dd>
				<dd><a href="https://naver.me/FdC4DtIC" target="_blank" class="btn btn-nm btn_map">네이버지도 보기</a></dd>
			</dl>
			<dl>
				<dt>현장</dt>
				<dd>경기도 안양시 만안구 안양동 398-32번지 일원</dd>
				<dd><a href="https://naver.me/xiqdfa6n" target="_blank" class="btn btn-nm btn_map">네이버지도 보기</a></dd>
			</dl>
			<dl>
				<dt>조합사무실</dt>
				<dd>경기도 안양시 만안구 안양동 594-24번지</dd>
				<dd><a href="https://naver.me/xiqdfa6n" target="_blank" class="btn btn-nm btn_map">네이버지도 보기</a></dd>
			</dl>
			<dl>
				<dt>업무대행사</dt>
				<dd>경기도 안양시 만안구 안양동 398-32번지 일원</dd>
				<dd><a href="https://naver.me/xiqdfa6n" target="_blank" class="btn btn-nm btn_map">네이버지도 보기</a></dd>
			</dl>
		</div>
	</div>
</div>

<style>
    .location_map {
        width: 100%;
        display: table;
        padding-top: 2rem;
        padding-bottom: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .location_map .img_sec {
        line-height: 0;
        display: table-cell;
        padding-right: 50px;
        width: 50%;
        vertical-align: top;
    }

    .location_map .img_sec img {
        width: 100%;
        max-width: 500px;
        min-width: 380px;
        border: 1px #d6d6d6 solid;
    }

    .location_map .txt_sec {
        display: table-cell;
        width: 50%;
        vertical-align: top;
        padding-left: 20px;
    }

    .location_map .txt_sec h3 {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 32px;
        position: relative;
        padding-bottom: 12px;
    }

    .location_map .txt_sec h3:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-radius: 2px;
    }

    .addr_con {
        background: #f8f9fa;
        padding: 28px;
        margin-bottom: 28px;
        border: 1px solid #e9ecef;
    }

    .addr_con dl {
        display: grid;
        grid-template-columns: 100px 1fr auto;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
        padding: 12px 0;
        border-bottom: 1px solid #dee2e6;
    }

    .addr_con dl:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .addr_con dt {
        font-weight: 600;
        color: #495057;
        font-size: 14px;
        background: #ffffff;
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid #dee2e6;
        text-align: center;
        margin: 0;
    }

    .addr_con dd {
        color: #212529;
        font-size: 15px;
        line-height: 1.6;
        margin: 0;
    }

    .btn_map {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        display: inline-block;
    }

    .btn_map:hover {
        background: linear-gradient(135deg, #0056b3, #004085);
        color: #ffffff;
        text-decoration: none;
        transform: scale(1.05);
    }

    @media only screen and (max-width: 768px) {
        .location_map .img_sec,
        .location_map .txt_sec {
            display: block;
            width: 50%;
            padding: 0;
        }

        .location_map .img_sec {
            padding-bottom: 2rem;
        }

        .location_map .txt_sec {
            padding-left: 0;
        }

        .addr_con dl {
            flex-direction: column;
            align-items: flex-start;
        }

        .addr_con dt {
            margin-bottom: 8px;
            margin-right: 0;
        }
    }

    @media only screen and (max-width: 768px) {
        .location_map .img_sec {
            padding-right: 25px;
        }
    }
</style>
