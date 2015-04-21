
var loginStatus=0;
function setLoginPost(postData){
	$.post(userUrl+'oauth_login', postData);
}
// qq登陆
var QQOopts={
	btnId:'qqLoginBtn',
	size:'B_M',
}
function cbLoginFun(oInfo, oOpts){
	if(isLogin==''){
		$('#modal-login').modal('hide');
		var headImg=oInfo.figureurl_2;
		var nickname=oInfo.nickname;
		var headImgStr='<span><img src=""/></span>';
		var nicknameStr='<span>'+nickname+'</span>';
		var logoutStr='<span><a href="javascript:QC.Login.signOut();">退出</a></span>';
		var str='<li class="user-info">'+headImgStr+nicknameStr+logoutStr+'</li>';
		$('#login-word').html(str);
		$('#login-word .user-info img').attr('src', headImg);
		QC.Login.getMe(function(openId, accessToken){
			var postData={
				type:1,
				openid:openId,
				access_token:accessToken,
				nickname:nickname,
				head_img:headImg,
			}
			setLoginPost(postData);
			isLogin=1;

		})
	location.replace(location) 
	}

}
function cbLogoutFun(){
	var str='<li class="login" data-toggle="modal" data-target="#modal-login">登陆</li>';
	$('#login-word').html(str);
	$.post(userUrl+'logout');
	isLogin=0;
	var img = new Image(); 
		img.src='http://changyan.sohu.com/api/2/logout?client_id=cyrI0sOYy&callback=C66A5BAD9ED000011E5A1F685821111F';
	setTimeout(function(){location.reload(true)},1000);
}

QC.Login(QQOopts,cbLoginFun,cbLogoutFun);