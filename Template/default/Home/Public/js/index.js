$(function(){
	// 设置iframe宽度
	$('.b-article iframe').width('95%');
	// 返回顶部
	$(window).scroll(function(e) {
		//若滚动条离顶部大于200元素
		if($(window).scrollTop()>200){
			$(".go-top").fadeIn(500);
		}else{
			$(".go-top").fadeOut(500);
		}
	});

	// 改变导航栏高度
	$(window).scroll(function(e) {
		//若滚动条离顶部大于100元素
		if($(window).scrollTop()>100){
			$('#b-public-nav .b-user-info').animate({'padding':'5px'},10);
			$('#b-public-nav .b-nav-cname a').animate({'padding':'10px'},10);
			$('#b-public-nav .navbar-brand').animate({'padding':'5px'},10);
		}else{
			$('#b-public-nav .b-nav-cname a').animate({'padding':'15px'},10);
			$('#b-public-nav .navbar-brand').animate({'padding':'5px'},10);
			$('#b-public-nav .b-user-info').animate({'padding':'10px'},10);
		}
	});

	// 为分页类增加响应式class
	$('.b-page .first,.num,.end').addClass('hidden-xs');
	$('.b-page .rows').addClass('hidden-xs');

	// 随言碎语js调整时间轴的高度
	$('.b-chat-middle').height($('.b-chat').height());
	// 随言碎语js调整气泡三角的top
	$('.b-arrows-right1,.b-arrows-right2').each(function(index, el) {
		$(el).css('top', $(el).parent('.b-chat-one').height()/2.5);
	});
})

// 登陆
function login(){
	$('#b-modal-login').modal('show');
	setCookie('this_url',window.location.href);
}

// 退出
function logout(){
	$.post(logoutUrl);
	setTimeout(function(){location.replace(location)},500);
}

// 点击返回顶部
function goTop(){
	$('body,html').animate({scrollTop:0},500);
	return false;
}

// 设置cookie
function setCookie(name,value) {
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
