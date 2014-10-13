<?php

    namespace IdnoPlugins\Pushover {
    
        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                
                // Register settings page
                    \Idno\Core\site()->addPageHandler('account/pushover/?','\IdnoPlugins\Pushover\Pages\Account');

                /** Template extensions */
                // Add menu items to admin screen
                    \Idno\Core\site()->template()->extendTemplate('account/menu/items','account/pushover/menu');
            }

            function registerEventHooks() {
                \Idno\Core\site()->addEventHook('notify', function (\Idno\Core\Event $event) {
					$eventdata = $event->data();
					$vars = $eventdata['vars'];
                    if (empty($vars)) {
                        $vars = array();
                    }
                    $user = $eventdata['user'];
                    $title = $eventdata['message'];
                    $commenter = $vars['owner_name']; // person that did webmention
                    $url = $eventdata['object']->getURL(); // link to post
                    $comment = $vars['content'];
                    $push = $this->connect();
                    if(!empty($comment)){
	                    $push->setTitle($title);
						$push->setMessage($comment);
                    }
                    else{
						$push->setMessage($title);
                    }
                    
					$push->setUrl($url);
					$push->setUrlTitle('View Post');
					$go = $push->send();

                });
            }

            /**
             * Connect to Pushover API
             * @return bool|\Pushover
             */
            function connect(){
            	require_once(dirname(__FILE__) . '/external/pushover.php');
                    
                $pushuserkey = \Idno\Core\site()->config()->pushover['userkey'];
                $pushapikey = \Idno\Core\site()->config()->pushover['apikey'];
                $pushdevicename = \Idno\Core\site()->config()->pushover['devicename'];
                $push = new \Pushover();
                $push->setToken($pushapikey);
				$push->setUser($pushuserkey);
				if(!empty($pushdevicename)){
					$push->setDevice($pushdevicename);
				}
				
                return $push;
                
            }

            /**
             * Are Pushover settings stored?
             * @return bool
             */
            function hasPushover(){
               if (!empty(\Idno\Core\site()->config()->pushover)) {
                    return true;
               }
			   return false;
            }

        }

    }
