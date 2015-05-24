// 第三方登陆
function showlogin(){
	$.post(saveLoginUrl, {"url":top.location.href}, function(data, textStatus, xhr) {
		$('#modal-login').modal('show');
	});
}

// 退出
function logout(){
	$.post(saveLoginUrl, {"url":top.location.href}, function(data, textStatus, xhr) {
		location.href=logoutUrl;
	});
}