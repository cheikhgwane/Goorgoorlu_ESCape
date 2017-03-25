/***************************************************************************/
/********** GJS :contains js scripts for the main pages and annexes ********/
/***************************************************************************/
idGet = function(id)
  {
     return document.getElementById(id);
  }

clGet = function(aClass)
  {
     return document.getElementsByClassName(aClass)[0];
  }


var header = clGet('g_header');
var logo = clGet('g_logo');
var logomin = clGet('g_logo_min');

var hasScrolled = false;

window.addEventListener('scroll' , function()
	{

      var scrolled = window.pageYOffset;
      var shrinkLimit = 150; 

      if (scrolled > shrinkLimit) 
      {
      	// console.log("Shring it !");
      	hasScrolled = true;
      	header.classList.add('g_fixheader1'); 
      	// logo.classList.add('g_logo_switch');
      	logo.classList.add('g_hide');
      	logomin.classList.add('g_show');



      }
      else
      {
      	if (hasScrolled) 
      		{window.scrollTo(0, 0);hasScrolled = false;}
      	
      	header.classList.remove('g_fixheader1'); 
      
        logo.classList.remove('g_hide');
      	logomin.classList.remove('g_show');

       
      }

 	});