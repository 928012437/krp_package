require('../less/common.less');
require('../less/index.less');
require('../less/top.less');
var IScroll = require('iscroll')

$(function(){
	var animationEnd = "animationend webkitAnimationEnd";
	setTimeout(function(){
		$('#slogan').addClass('on');
	},400)

	var close = $('#close'),
		mask = $('#mask'),
		topBtn =$('.top_btn'),
		ruleBtn =$('.rule_btn'),
		userBtn =$('.user_btn'),
		user = $('#user'),
		rule=$('#rule'),
		top=$('#top'),
		prizeBtn=$('#prize_btn'),
		phone=$('#phone'),
		userName=$('#userName'),
		register=$('.register'),
		prize=$('#prize'),
		error= $('.error'),
		back=$('#back');

	// 进入全景游戏
	$('#btn').click(function(){
		$('#start').css('top',-105+'%');
		setTimeout(function(){
			$('#vr').show()
		},400)	 
	})

	//排行列表
	topBtn.click(function(){
		$.ajax({})
		top.show()
	})

	back.click(function(){
		top.hide();
	})


	ruleBtn.click(function(){
		mask.show();
		rule.show();
	})

	userBtn.click(function(){
		mask.show();
		user.show();

		console.log('sssss')
	})

	//领取奖品按钮，如果没有注册显示填写表单，注册了显示奖品已经
	prizeBtn.click(function(){
		//判断此用户是否已经注册
		register.show();
		
	})

	var p = /^(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
	var flag = false;

	//手机号验证
	phone.keyup(function(){
		error.show();
		if(p.test($(this).val())){
			error.text('√').css('background','green');
			flag = true;
		}
	})

	// 表单提交
	$('#register_btn').click(function(){
		if(phone.val()!=''&&userName.val()!=''&&flag){
			$(this).attr('disabled','true');
			$.ajax({

			})

		}else{
			alert('信息不能为空')
		}
	})



	//关闭按钮
	close.click(function(){
		mask.hide();
		user.hide();
		rule.hide();
		register.hide();
		prize.hide();
	})

	// var myScroll = new IScroll('#wrapper',{
				
	// })
		
})