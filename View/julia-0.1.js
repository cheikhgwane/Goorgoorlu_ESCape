///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
////////////////         JULIA.JS v0.1        /////////////////
//////////////////////////////////////////////////////////////
//@Author : Shadow
//@Date   : 2017-03-19

 

getRes = function()
{
  return window.innerWidth || document.body.clientWidth;
}


resLevel = function(res)
{

   var type = 3;


   if(res > 320 && res <1024) type = 2 ; 
   if(res > 315 && res <765)  type = 1 ;


   return type;
}


mediaPrefix = function(level)
{

  var tab = ['s','m','l'];
  return tab[level-1];

}



parseAll = function()
{
	return document.getElementsByTagName('*');
}

getClasses = function(node)
{

  return node.classList; 

}

hasJulia = function(cList)
{
 for (var i = 0; i < cList.length; i++) 
   {
    var has = false;
     if (cList[i].indexOf('j_s') != -1)
        {has = true;}

     if (cList[i].indexOf('j_m') != -1)
        {has = true;}

     if (cList[i].indexOf('j_l') != -1)
        {has = true;}

      return has;
       
   }
}
  

seekClass = function(classList,aClass)
{

  return classList.indexOf(aClass);

}

parseClass = function(class_List)
{

  // var tabClass = class_List.split(" ");
  // return tabClass;

}

seekMedia = function(aClass,prefix)
{
  // media is under the form _m_/_s_/_l_
  var media ="";
  var Allprefix = 'j_'+prefix;

  if (aClass.indexOf((Allprefix+'_'))!=-1) {media = Allprefix;}
 
  return media;

}
//phone, tablette, pc
 setMedia = function(node, mediaClass)
{
  if (mediaClass!="")
   {
     getClasses(node).add(mediaClass);
   }

}

getType = function(aClass)
{
    
    types = ['col','push','vpad','hpad'];
    

    for (var i = 0; i < types.length; i++)
     {

        if(aClass.indexOf(types[i]) != -1)
        {
          return types[i];
        }

     }


}

 gridSpecs = function(aClass ,media, type)
 {
   var appendice = 'j_'+media+'_'+type;

   var next = aClass.slice(appendice.length,aClass.length);
    
   var values = [];

   if(next.indexOf('_') != -1)//Is manualGrid
   {
     values = next.split('_'); 
     values[0] = parseInt(values[0], 10);
     values[1] = parseInt(values[1], 10);
   }
   else
   {
      values[0] = parseInt(next);
      values[1] = 12;
   }

   return values;

 }

matchMedia = function(aClass,prefix)
{
   return aClass.indexOf('_'+prefix+'_');
}

 

seekSize = function(aClass,type)
{
	//size is under the form 1/2/3/.../12

	return parseInt(aClass.split('_'+type)[1],10);


}

//which param to use :width , marginLeft, paddingLeft etc.
cssParam = function(classType)
{
   switch (classType) 
   {
    case 'col' : return 'width';
    case 'push' : return 'margin-left';
    case 'hpad' : return 'padding-left';
    case 'vpad' : return 'padding-top';
    default : ;
   }  
}

setSpec = function(node, aClass,media)
{
  
  var classType = getType(aClass); // col, vpad, hpad, push 
  var cssAttr = cssParam(classType);// width, margin etc...
  var sizeInt = seekSize(aClass,classType);// after classType
  
  var values = gridSpecs(aClass, media, classType);

  var size = (values[0]*100) / values[1];

  // var  nodeStyle = node.getAttribute('style');
 
   
  return cssAttr+ ' : '+size+'% ;';

 
   
   
}



///////// MAIN PROCESS ////////////

window.addEventListener("load", function()

   {

		var Tags = parseAll();
    
    var level = resLevel(getRes());
    var media = mediaPrefix(level);
     
		for (var i = 0; i < Tags.length; i++)
		 {
			 
		    var thisClasses = getClasses(Tags[i]);
        
        if (hasJulia(thisClasses))
          {

                var styleAll = '';

        		    for (var j = 0; j < thisClasses.length; j++)
        		     {
        		    	 
                   if(matchMedia(thisClasses[j],media)!= -1)
                      {

                        styleAll += setSpec(Tags[i], thisClasses[j],media);

                      }
        		     
        		     }

                 var  nodeStyle = Tags[i].getAttribute('style');
                 if (nodeStyle == null){nodeStyle = ''}
                 


                 styleAll+=nodeStyle;
              
                 var jClass = 'j_'+media;

                 Tags[i].classList.add(jClass);
                 Tags[i].setAttribute('style' ,styleAll);





           }


		 }


   
      var jhamb = document.getElementsByClassName('j_hamb')[0];
        if (typeof jhamb !== 'undefined') {
           jhamb.innerHTML = "&#9776";
           
           jhamb.addEventListener('click' , function()
            {
              this.classList.toggle('j_hamb_clicked');
              this.parentNode.classList.toggle('j_mob');
              
            });

   }






     var icondrop = document.getElementsByClassName('j_icon');

     var drops = document.getElementsByClassName('j_dropped');

     // icondrop.innerHTML = '&#x22EE';
    for (var i = 0; i < icondrop.length; i++) {
      
            icondrop[i].addEventListener('click' , function()
            {
                  
             
                   
                  var hidden = this.parentNode.getElementsByTagName('*')[3];
                  var hidHeight = parseInt(hidden.style.maxHeight);
                  
                  var classes = hidden.classList;
                  console.log(classes); 

                  if (classes.contains('active'))
                   {
                      hidden.style.maxHeight = "0px"; 
                       hidden.classList.remove('active');

                   }
                   else
                    {
                       hidden.style.maxHeight = "2999px";
                       hidden.classList.add('active');

                    }

                   this.classList.toggle('j_dropped_icon');

                  
                   console.log(hidHeight);
                    

            });

      }



     var jsame = document.getElementsByClassName('j_colsame')[0];
      if (typeof jsame !== 'undefined') 
      {
         jsameC =  jsame.children.length;

         var blocW = 100/jsameC; 

         for (var i = 0; i < jsameC; i++) 
         {
           
           jsame.children[i].style.width = blocW+'%';
           jsame.children[i].classList.add('j_sames');


         }
        }












	});

