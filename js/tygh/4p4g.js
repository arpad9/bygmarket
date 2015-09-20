$( document ).ready(function() {
  $('.flyout-parent').hover( function() {
    $(this).closest('.sidebox-body, .popup-content').find('.flyout-box').hide();
    $(this).find('.flyout-box').show();
  });
  $('.flyout-parent').closest('.sidebox-body, .popup-content').mouseleave( function() {
    $(this).find('.flyout-box').hide();
  });

  //ugly hack to prevent ugly insertion of html
  $('body').on('DOMNodeInserted', '#tygh_container', function(e) {
    $(e.target).find('.span1,.span2').remove();
    $(e.target).find('.tygh-content.clearfix').remove();
  });
  
  
  /**/
  function setCookie(cname,cvalue)
  {
	  /*var d = new Date();
	  d.setTime(d.getTime());
	  var expires = "expires="+d.toGMTString();*/
	  document.cookie = cname + "=" + cvalue;
  }

  function getCookie(cname)
  {
	  var name = cname + "=";
	  var ca = document.cookie.split(';');
	  for(var i=0; i<ca.length; i++)
	    {
	    var c = ca[i].trim();
	    if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	  }
	  return "";
  }
  
  //alert($.cookie("myAccountPopupOpen");
  //alert(getCookie("myAccountPopupOpen"));
  if(getCookie("myAccountPopupOpen") == ''){
	  
	  $('.myAccountMenu').hide();
	  $('.myAccountMenuButton').show();
	  
	  setTimeout(function() {
		  
	      $('.top-my-account').parent('div').find('.cm-combination').trigger( "click" );
	      //$('.cm-combination').trigger( "click" );
	      setCookie("myAccountPopupOpen","1");
	      
	      setTimeout(function() {
			  $('.top-my-account').parent('div').find('.cm-combination').trigger( "click" );
			 
			  $('.myAccountMenuButton').hide();
			  $('.myAccountMenu').show();
			  
		  },15000);
	      
	  },2000);
	  
  }else{
	  $('.myAccountMenuButton').hide();
	  $('.myAccountMenu').show();
  }
    
  
  /*$('.top-my-account').parent('div').find('.dropdown-box').addClass('dropdown-box-on');
  $('.top-my-account').parent('div').find('.cm-popup-title').removeClass('cm-combo-on');
  $('.top-my-account').parent('div').find('.cm-popup-title').addClass('cm-popup-title-on');
  $('.top-my-account').parent('div').find('.cm-popup-box').removeClass('hidden');
  $('.top-my-account').parent('div').find('.cm-popup-box').show();*/
  
});

