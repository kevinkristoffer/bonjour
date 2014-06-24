var tab=null;
$(function(){
	$('#wrapper').mikoLayout({
		topHeight:50,
		allowTopResize:false,
		leftWidth:250,
		minLeftWidth:200
	});
	$('#left').mikoAccordion({
		height:350
	});
	var mid,url,pid,fid,text;
	$('.tree_nav').each(function(i){
		mid=$(this).attr('mid');
		$(this).mikoTree({
			nodeWidth:150,
			url:baseUrl+'/forum/query-valid/mid/'+mid,
			ajaxType:'post',
			idFieldName:'forumID',
			parentIDFieldName:'parentID',
			textFieldName:'forumName',
			checkbox:false,
			onClick:function(data,target){
				url=data.data.url;
				pid=data.data.parentID || 0;
				fid=data.data.forumID || 0;
				text=data.data.forumName;
				if(url){
					f_addtab(pid+'_'+fid,text,url);
				}
			}
		});
	});
	$('#framecenter').mikoTab({});
	tab=miko.get('framecenter');
	
	/**
	 * 	切换皮肤按钮
	 */
	$('.skinItem').bind('click',function(e){
		e.preventDefault();
		$.cookie('BonjourSkin',$(this).attr('title'));
		window.location.reload();
	});
	/**
	 *  加载logo
	 */
	/**var currentSkin = $.getCurrentSkin();
	$('#logo_picc').attr('src', baseUrl + '/skins/' + currentSkin + '/images/logo/PICC.gif');
	$('#logo_ali').attr('src', baseUrl + '/skins/' + currentSkin + '/images/logo/ali.gif');*/
	/**
	 *  气泡提示
	 */
	
});
function f_addtab(tabid,text,url){
	tab.addTabItem({
        tabid: tabid,
        text: text,
        url: url,
        height:650,
        callback: function ()
        {
            //addShowCodeBtn(tabid); 
            //addFrameSkinLink(tabid); 
        }
    });
}