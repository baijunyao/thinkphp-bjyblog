$(function(){
	// js调整时间轴的高度
	$('.b-chat-middle').height($('.b-chat').height());
	// js调整气泡三角的top
	$('.b-arrows-right1,.b-arrows-right2').each(function(index, el) {
		$(el).css('top', $(el).parent('.b-chat-one').height()/2.5);
	});
})
