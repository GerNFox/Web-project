/*   
    ##################################################
    
            FUNCTIONS Created at 2018.07.03                       
            Author : Szabolcs Németh (FoX).         
            Copyrights 2018 All Rights Reserved. 

    ##################################################

    Change log :

       # Modified by FoX at 2018.07.03:18:20. --> Created
       # Modified by FoX at 2018.07.03:21:55. --> FoX_Login_System ver.0.1.1 is finished + Added Comments
       # Modified by FoX at 2018.07.04:19:00. --> FoX_Reg_System ver.0.1.1 is finished + Added Comments

*/

var jqueryObj = $;

    //isEmpty Function
    function isEmpty(param){
        if( typeof param == 'undefined' || param == null || param == ''  )
        {  
             return true;
        }else{
            return false;
         }
    }

    //Email regex checking function
    function validEmail(Email){
      
        //Regex pattern. It describes which characters should be contained in the text, in this case the email. 
        var regex  = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
      
        //It checks that the given email compliance the above declared regex pattern or not.  
        if(regex.test( Email )){ return true; } else { return false; }

    }

    //Fade animation for appearing text/content
    function fade(printing_path_fade){
       // jQuery(printing_path_fade).css('opacity', '0');
        //It's all starts with add fadein class to printing path
        printing_path_fade.addClass("fadein"); 
        
            setTimeout(function(){
                
                //Remove the added fadein class from printing_path
                printing_path_fade.removeClass("fadein");
                
                //Add fadeout class to printing_path
                printing_path_fade.addClass("fadeout");
                
            },6000); // Delay for 7 sec

            setTimeout(function(){
                    
                //Remove the added fadeout class from printig_path
                printing_path_fade.removeClass("fadeout");
                
            },10000);// Delay for 9 sec

                // Plan for avoid bugged fadein/out action :
                    // -> Every inputs will has an error_param.
     }


                                    //  ################################
                                    //  ##     FoX_Login_System       ##
                                    //  ##         Ver.0.1.1          ##
                                    //  ################################  


        //FoX_Sign_In_System Function : Parameters -> Given email, and Password -> and the path for the printing location. 
        function FoX_Login_System(code, password, printing_path){ 

                //Checking , email's and password's content with isEmpty function.
                if( !isEmpty(code) && !isEmpty(password) ){
                
                    //Check the email regex. -> basic loginsystem
                    //if( validEmail(email) ){
                       // console.log(email);
                        
                        //Encrypt the given password with md5 or sha1 hasing method 
                        
                       var encrypted_pass  = $().crypt({method:"sha1",source:password});
                        // Send an encrypted pass and a checked email to the validation process with Ajax.
                            
                        dataS = {
                                 "code" : code,
                                 "password" : encrypted_pass,
                                }

                         $.ajax({
                                // POST communictation type will be used.s
                                type:"POST",

                                //PHP Controller url
                                url: "http://localhost/ajaxcalls.php",
                                //Gathered data which will be validated
                                data: dataS,
                                

                                success: function(response){
                                    //Console log for testing  NOTE : It will be deleted at it's publication day! 
                                    if(response) { 
                                    
                                    fade(printing_path); printing_path.text(response);
                                }else{  window.location = 'http://localhost/'; }
                                        //Comment out when the background process is done and profile.php created.
                                          
                                    
                                    //Success message when the php file validate the given datas.
                                    
                                },
                                error: function(errorThrown){
                                    //alert(errorThrown);
                                    console.log("error:" + JSON.stringify(errorThrown));
                                

                                   fade(printing_path); printing_path.text("There was an error within AJAX communication!");
                                }
                        }); 


                  /* }else{
                        //Error message for mail regex.
                        fade(printing_path); printing_path.text("The Email address does not match with the requiments!");
                    } */

                 }else{
                    //Error message for empty form.
                    fade(printing_path); printing_path.text("All fields are required to fill!");
                } 

        }


                                        //  ################################
                                        //  ##       FoX_Reg_System       ##
                                        //  ##         Ver.0.1.1          ##
                                        //  ################################  


        //Parameters : Firstname,Lastname,Email,Password pair,Adoption of the policy(Later just: Policy),and the printing path.
        function  FoX_Reg_System(username,password_one,password_two,email,printing_path){
            //Checking content with isEmpty function.
            if(!isEmpty(username)){
                
                //Checking Password's length which is between 8 and 32 characters or not.
                if(password_one.length >= 8 && password_one.length <= 32){

                        //Checking Password matching.
                        if(password_one == password_two){

                            //Email matching with the mail regex.
                            if( validEmail(email) ){
                                
                                //checking Policy whether is checked or not.
                               // if( Policy.is(':checked') ){

                                        //Change property of the Policy to Accepted. 
                                       // Policy.prop('value', "Accepted");
                                        //var Policy_val = Policy.val(),
                                        
                                        //Encrypt the given password with md5 or sha1 hasing method 
                                        encrypted_password = $().crypt({ method: "sha1", source: password_one });

                                        dataS = {
                                            
                                                'code' : username,
                                                'email'     : email,
                                                'password'  : encrypted_password,
                                        }
                                        $.ajax({

                                                type: "POST",
                                                //PHP Controller url
                                                url: "ajaxcalls.php",  
                                                //Data array which will be validated by the server.
                                                data: dataS,
                                                success: function(response){
                                                    console.log(response);
                                                    
                                                    //Success message
                                                    fade(printing_path); printing_path.text(response);
                                                },
                                                error:function(){

                                                    //Error message . There is a problem with the communication between PHP and AJAX.
                                                    fade(printing_path); printing_path.text("Error occured in Ajax <-> PHP communication");
                                                }

                                        });

                              /*   }else{
                                    
                                    //Policy Unchecked error message.
                                    fade(printing_path); printing_path.text("You must accept our policy!");
                                } */

                            }else{
                                
                                //Email matching error message.
                                fade(printing_path); printing_path.text("The Email address does not match with the requiments !");
                            }

                        }else{
                            
                            //Password matching error message.
                            fade(printing_path); printing_path.text("The two password do not match ! Try Again.");
                        }

                }else{
                    
                    //Error message for password length.
                    fade(printing_path); printing_path.text("Password must be between 8 and 32 characters !");
                }
           
            }else{
                
                //Error message for empty form.
                fade(printing_path); printing_path.text(" All fields are required to fill !");
            }
        }



                                                //########################
                                                //    END OF THE FILE    #
                                                //########################