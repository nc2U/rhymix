<div class="content_wrapper">
	<div class="img_box tabcontents">
		<img src="./app/custom/modules/install/script/img/overview.jpg" alt="조감도 CG"/>
	</div>

	<div class="summary_box">
		<table class="col_datatable">
			<caption>사업지 관련내용으로 사업명 대지위치 연면적 주택형 공급규모 분양물 용도로 구성</caption>
			<tr>
				<th>사업명</th>
				<td>송도힐스테이크 센터파크</td>
			</tr>
			<tr>
				<th>대지위치</th>
				<td>인천광역시 연수구 동춘동 712-1번지 일원</td>
			</tr>
			<tr>
				<th>연면적</th>
				<td>336,121.11㎡</td>
			</tr>
			<tr>
				<th>주택형</th>
				<td>전용 74㎡ / 84㎡</td>
			</tr>
			<tr>
				<th>공급규모</th>
				<td>총 625세대</td>
			</tr>
			<tr>
				<th>분양물 용도</th>
				<td>공동주택 및 부대시설</td>
			</tr>
		</table>
	</div>
</div>

<style>
    /* 컨텐츠 래퍼 */
    .content_wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* 이미지 박스 스타일 */
    .img_box.tabcontents {
        margin-top: 40px;
        margin-bottom: 40px;
        text-align: center;
    }

    .img_box.tabcontents img {
        width: 100%;
        height: auto;
    }

    /* 요약 박스 스타일 */
    .summary_box {
        padding: 30px 0;
    }

    .col_datatable {
        width: 100%;
        border-collapse: collapse;
        border-top: 1px solid #E0E0E0;
        margin: 0 auto;
        background: #fff;
        border-radius: 8px;
    }

    .col_datatable caption {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .col_datatable tr {
        border-bottom: 1px solid #e0e0e0;
    }

    .col_datatable th {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        color: #333;
        font-weight: bold;
        text-align: center;
        padding: 20px 15px;
        width: 25%;
        border-right: 1px solid #e0e0e0;
        font-size: 16px;
        vertical-align: middle;
    }

    .col_datatable td {
        padding: 20px 25px;
        color: #555;
        font-size: 15px;
        line-height: 1.6;
        vertical-align: middle;
    }

    /* 반응형 디자인 */
    @media (max-width: 768px) {
        .img_list img {
            max-width: 100%;
        }

        .img_thumb_list img {
            width: 80px;
            height: 48px;
        }

        .col_datatable {
            font-size: 14px;
        }

        .col_datatable th {
            padding: 15px 10px;
            font-size: 14px;
            width: 30%;
        }

        .col_datatable td {
            padding: 15px 15px;
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .col_datatable th,
        .col_datatable td {
            display: block;
            width: 100%;
            border-right: none;
            text-align: left;
        }

        .col_datatable th {
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            font-size: 13px;
        }

        .col_datatable td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .col_datatable tr {
            border: none;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
        }
    }
</style>
