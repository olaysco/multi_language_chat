<?php

/* 
 * Copyright (C) 2018 olayiwola
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

?>

<?php

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>MultiLanguage Chat</title>
        <meta name="description" content="Love UI Kit." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link href="css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <script src="js/handlebar.js" type="text/javascript"></script>
        <script src="js/moment.js" type="text/javascript"></script>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript"></script>
        <style>
            .hide{
                display: none;
            }
            .show{
                display:inline;
            }
            
            .login-box{
                position: relative;
                top: 50%;
                transform: translateY(100%);
            }
            </style>
    </head>
    <body>
        
        <div class="container">
            <div class="row init-window">
                <div class="col-md-4 offset-4 login-wrap ">
                    <div class="brand login-box">
                                <form class="form-horizontal" role="form" method="POST" action="" id="logForm">
                                    <div class="form-group">                                      
                                        <div class="col-sm-10">
                                            <input type="" class="form-control" id="username" name="l_username" placeholder="Enter Username" required="required">
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <div class="col-sm-10">
                                            <label for="name">Select language</label> 
                                            <select class="form-control" name="lang" required="required" id="language">
                                                <option value="">Select Language</option>
                                                <option value="en">English</option>
                                                <option value="yo">Yoruba</option>
                                                <option value="ha">Hausa</option>
                                                <option value="ig">Igbo</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                        
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-round btn-block" id="start-chat" value="Start Chatting" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                </div>
            </div>
            <div class="row hide chat-window">
                <div class="chat_box col-9 centered clearfix" style="">
                    <!-- chat box area-->
                    <div class="chat_box_area pull-left" style="">
                        
                        <!--Messages sent and received are displayed here -->
                        <div class="chat_box_area_messages" style="">
                            
                            
                            
                            
                        </div>
                        
                        <!--Sending message area -->
                        <div class="chat_box_area_send" style="width: 100%; height:16%;">
                            <form class="form">
                                <div class="form-group">
                                    <div class="col-md-12 pull-left">
                                        <div class="wrap_input">
                                            <textarea placeholder="Start typing..." class="form-text" style="" id="msg-text"></textarea>
                                            <button class="btn btn-lg" style=""id="send" ><i class="fa fa-send-o"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Shows all users that are online and 
                    -- current user info with settings option cog wheel 
                        logout button -->
                    <div class="chat_box_user" style=" /*background-color:#0275d8;*/">
                        
                        <div class="chat_box_user_top" style="">
                            <h2 class="text" style="">Language</h2>
                            <div class="dropdown pull-left"> 
                                <button type="button" class="btn dropdown-toggle" id="optionMenu" data-toggle="dropdown"> 
                                     <i class="fa fa-cog"></i>
                                    <span class="caret"></span> 
                                </button>
                                <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    <div class="dropdown-item form-group">
                                        <label for="name">Set language</label> 
                                        <div class="radio">
                                            <label class="checkbox-inline">
                                            <input type="radio" name="language" id="optionsRadios" value="en" checked>English
                                            </label>
                                        </div> 
                                        <div class="radio">
                                            <label class="checkbox-inline">
                                            <input type="radio" name="language" id="optionsRadios" value="ha" checked>Hausa
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label class="checkbox-inline">
                                            <input type="radio" name="language" id="optionsRadios" value="ig" checked>Igbo
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label class="checkbox-inline">
                                            <input type="radio" name="language" id="optionsRadios" value="yo" checked>Yoruba
                                            </label>
                                        </div>
                                        
                                    </div>
                                    
                                    <li class="dropdown-divider"></li>
                                    <a class="dropdown-item fa fa-power-off" href="" id="end-chat">  Logout</a>
                                </div>
                            </div>
                        </div>
                        
                        <!--Active users are displayed here -->
<!--                        <div class="chat_box_user_online active_user" style="" >
                            <img class="img-thumbnail pull-right user_online" style=""/>
                  
                            <span class="fa fa-user fa-3x user_icon" style=""></span>
                            <span class="user_name">John</span>
                            <form><input type="hidden" value=""name="id"/>
                            <input type="hidden" value=""name="lang"/>
                            <input type="hidden" value=""name="uname"/>
                            </form>
                        </div>
                        
                        <div class="chat_box_user_online" style="" >
                            <img class="img-thumbnail pull-right user_online" style=""/>
                  
                            <span class="fa fa-user fa-3x user_icon" style=""></span>
                            <span class="user_name">Funke</span>
                        </div>
                        <div class="chat_box_user_online" style="" >
                            <img class="img-thumbnail pull-right user_offline" style=""/>
                  
                            <span class="fa fa-user fa-3x user_icon" style=""></span>
                            <span class="user_name">Shade</span>
                        </div>-->
                        <div class="chat_box_user_online_wrapper">
                            
                        </div>
                    </div>
                </div>
        </div>
            <script id="online-user-template" type="text/x-handlebars-template">
                {{#each users}}
                    <div class="chat_box_user_online " style="" >
                        <img class="img-thumbnail pull-right user_online" style=""/>

                        <span class="fa fa-user fa-3x user_icon" style=""></span>
                        <span class="user_name">{{username}}</span>
                        <input type="hidden" value={{user_language}} name="lang"/>
                        <input type="hidden" value={{username}} name="uname"/>
                    </div>
                {{/each}}
            </script>
            
            <script id="my-messages-template" type="text/x-handlebars-template">
                
                <div class="my_message" style="">
                    <span class="username">{{username}}</span>
                    <p class="message">{{text}}</p>
                </div>
                
            </script>
            <script id="other-messages-template" type="text/x-handlebars-template">
                
                 <div class="other_message"style="">
                    <span class="username">{{username}}</span>
                    <p class="message">{{text}}</p>
                </div>
            </script>
            
       
        <script src="js/processor.js" type="text/javascript"></script>     
    </body>
</html>

