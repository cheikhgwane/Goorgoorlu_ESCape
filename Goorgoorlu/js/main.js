/***************************************************************************/
/********** contains js scripts for the main pages and annexes ********/
/***************************************************************************/
    var result;
    function Xhr(url, dataString, handler)  
    {  
     
    var xhr;    
        xhr = new XMLHttpRequest();  
     

        var data = dataString;  
         xhr.open("POST", url, true);   
         xhr.setRequestHeader("Content-Type", "application/json");                    
         xhr.send(data);  
         xhr.onreadystatechange = display_data;  
        function display_data() {  
         if (xhr.readyState == 4) {  
          if (xhr.status == 200) {  
           result = JSON.parse(xhr.responseText);
       
            handler(result);
 


          } 
          else{}  
         }  
        }  

    }

/// To get the params passed to an Url (in the case of displaying Notif Details)
   var getParam = function (field)
        {
        var href = window.location.href;
        var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
        var string = reg.exec(href);
        return string ? string[1] : null;
    };

////////////////////////////////////////////////////////////////////////////////



idGet = function(id)
  {
     return document.getElementById(id);
  }

clGet = function(aClass)
  {
     return document.getElementsByClassName(aClass)[0];
  }


attGet = function(aValue)
{
   return document.querySelectorAll('[name=' + aValue + ']')[0];
}

/////////////////////////////////////////////////////


window.addEventListener("load", function()

   {


        var windH = window.innerHeight;


        var splbox = clGet('splashbox');
        if (typeof splbox !== 'undefined') 
        {
        
          splbox.style.height = windH+"px";

        }


        var boxinner = clGet('boxinner');
        var boxheader = clGet('boxheader');
 
        var bheaderH = 0;
        if (typeof boxheader !== 'undefined') 
        {
          bheaderH = boxheader.offsetHeight; 
        }  


        if (typeof boxinner !== 'undefined') 
        {
        
          boxinner.style.height = (windH-bheaderH)+'px';
        }


        var container = clGet('container');
        var container2 = clGet('container2');
        var container3 = clGet('container3');



        if (typeof container !== 'undefined') 
        {
          container.style.height = (windH-(bheaderH+100))+'px';
        }

        if (typeof container2 !== 'undefined') 
        {
          container2.style.height = (windH-(bheaderH+150))+'px';
        }

       if (typeof container3 !== 'undefined') 
        {
          container3.style.height = (windH-(bheaderH+180))+'px';
        }


});