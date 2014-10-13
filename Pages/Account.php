<?php

    /**
     * Diigo pages
     */

    namespace IdnoPlugins\Pushover\Pages {

        /**
         * Default class to serve Diigo-related account settings
         */
        class Account extends \Idno\Common\Page
        {

            function getContent()
            {
                $t = \Idno\Core\site()->template();
                $body = $t->draw('account/pushover');
                $t->__(['title' => 'Pushover', 'body' => $body])->drawPage();
            }

            function postContent() {
                $pushuser = $this->getInput('pushuserkey');
                $pushapi = $this->getInput('pushapikey');
                $pushdevice = $this->getInput('pushdevicename');
                \Idno\Core\site()->config->config['pushover'] = [
                    'userkey' => $pushuser,
                    'apikey' => $pushapi,
                    'devicename' => $pushdevice
                ];
                \Idno\Core\site()->config()->save();
                \Idno\Core\site()->session()->addMessage('Your Pushover settings were saved.');
                $this->forward('/account/pushover/');
            }

        }

    }