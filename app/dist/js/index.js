webpackJsonp([0],[
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {

__webpack_require__(0);
__webpack_require__(6);
__webpack_require__(1);
var IScroll = __webpack_require__(2);

$(function () {
	var animationEnd = "animationend webkitAnimationEnd";
	setTimeout(function () {
		$('#slogan').addClass('on');
	}, 400);

	var close = $('#close'),
	    mask = $('#mask'),
	    topBtn = $('.top_btn'),
	    ruleBtn = $('.rule_btn'),
	    userBtn = $('.user_btn'),
	    user = $('#user'),
	    rule = $('#rule'),
	    top = $('#top'),
	    phone = $('#phone'),
	    userName = $('#userName'),
	    register = $('.register'),
	    prize = $('#prize'),
	    error = $('.error'),
	    back = $('#back');

	// 进入全景游戏
	$('#btn').click(function () {
		$('#start').css('top', -105 + '%');
		setTimeout(function () {
			$('#vr').show();
		}, 400);
	});

	//排行列表
	topBtn.click(function () {
		var url=urlstr+"winlist";
		$.get(url,function(data){
			var str="";
			data=eval("("+data+")");
			data.forEach(v){
				str+='<li><div class="img"><i class="img-wrap pull-left"><img src="'+ v.headimgurl+'" alt="'+ v.nickname+'"/></i></div><div class="score"><p class="name">'+ v.nickname+'</p><time>'+ v.time+'</time></div><div class="placing">'+ v.goodname+'</div></li>';
			}
			$("#winlist").html(str);
		});
		top.show();
	});


	back.click(function () {
		top.hide();
	});

	ruleBtn.click(function () {
		mask.show();
		rule.show();
	});

	userBtn.click(function () {
		mask.show();
		user.show();

		console.log('sssss');
	});


	var p = /^(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
	var flag = false;

	//手机号验证
	phone.keyup(function () {
		error.show();
		if (p.test($(this).val())) {
			error.text('√').css('background', 'green');
			flag = true;
		}
	});

	// 表单提交
	//$('#register_btn').click(function () {
	//	if (phone.val() != '' && userName.val() != '' && flag) {
	//		$(this).attr('disabled', 'true');
	//		$.ajax({});
	//	} else {
	//		alert('信息不能为空');
	//	}
	//});

	//关闭按钮
	close.click(function () {
		mask.hide();
		user.hide();
		rule.hide();
		register.hide();
		prize.hide();
		$("#prompt").hide();
		$("#reg0").hide();
		$("#reg1").hide();
	});

	// var myScroll = new IScroll('#wrapper',{

	// })
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(3)))

/***/ }),
/* 5 */,
/* 6 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(4);


/***/ })
],[7]);