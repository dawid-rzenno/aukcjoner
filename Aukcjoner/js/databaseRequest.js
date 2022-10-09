function databaseRequest(formId, link, customParams){

/////////////////////////////
                           //
   var debugMode = true;   //
                           //
/////////////////////////////

   var $form = $(formId);
   var params;

   if(customParams == undefined) params = $form.serialize()
   else params = customParams;

   if(debugMode){
         
      console.log('===================| DEBUG MODE |===================');
      console.log("(!) DATABASE REQUEST WITH DATA FROM == " + formId + " == PROCESSED BY == " + link);
   }

   if(debugMode) console.log("parameters: " + params);

   var requestResult = $.ajax({
      
      type: "POST",
      url: link,
      data: params,
      dataType : "html",
      error: function(xhr, textStatus, error){
         
         console.log(xhr.status);
         console.log(textStatus);
         console.log(error);   
      }
   });
   
   requestResult.done(function(response) {
      
      if(debugMode) console.log('AJAX Response: ' + JSON.parse(response));
      main(response);

   });

   return false;

}