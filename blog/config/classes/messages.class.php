<?php
//--------------------------------------------------------------------------------------------------
// Session-Based Flash Messages v1.0
// Copyright 2012 Mike Everhart (http://mikeeverhart.net)
//
//   Licensed under the Apache License, Version 2.0 (the "License");
//   you may not use this file except in compliance with the License.
//   You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
//   Unless required by applicable law or agreed to in writing, software
//   distributed under the License is distributed on an "AS IS" BASIS,
//   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//   See the License for the specific language governing permissions and
//   limitations under the License.
//
//------------------------------------------------------------------------------
// Description:
//------------------------------------------------------------------------------
//
//  Stores messages in Session data to be easily retrieved later on.
//  This class includes four different types of messages:
//  - Success
//  - Error
//  - Warning
//  - Information
//
//  See README for basic usage instructions, or see samples/index.php for more advanced samples
//
//--------------------------------------------------------------------------------------------------
// Changelog
//--------------------------------------------------------------------------------------------------
//
//  2011-05-15 - v1.0 - Initial Version
//
//--------------------------------------------------------------------------------------------------

class Messages {

    //-----------------------------------------------------------------------------------------------
    // Class Variables
    //-----------------------------------------------------------------------------------------------
    protected $msgTypes = array( 'help', 'info', 'warning', 'success', 'error' );
    protected $msgTitres = array( 'help' => 'Aide', 'info' => 'Information', 'warning' => 'Attention', 'success' => 'Succès', 'error' => 'Erreur' );
    protected $msgClass = 'messages';
    protected $msgWrapper = "<div class='%s %s'><a href='#' class='closeMessage'></a>\n<p>%s :</p><ul>%s</ul></div>\n";
    protected $msgBefore = '<li>';
    protected $msgAfter = "</li>\n";
    protected $sessionName = 'flash_messages';


    /**
     * Constructor
     * @author Mike Everhart
     */
    public function __construct() {

    }

    /**
     * Add a message to the queue
     *
     * @author Mike Everhart
     *
     * @param  string   $type           The type of message to add
     * @param  string   $message        The message
     * @param  string   $identifiant    Identifiant du message
     * @param  string   $redirect_to    (optional) If set, the user will be redirected to this URL
     * @return  bool
     *
     */
    public function add($type, $message, $identifiant = null, $redirect_to=null) {

        if( !isset($_SESSION[$this->sessionName]) ) $_SESSION[$this->sessionName] = array();

        if( !isset($type) || !isset($message[0]) ) return false;

        // Replace any shorthand codes with their full version
        if( strlen(trim($type)) == 1 ) {
            $type = strtr($type, array('h' => 'help', 'i' => 'info', 'w' => 'warning', 'e' => 'error', 's' => 'success'));
        }

        // Make sure it's a valid message type
        if( !in_array($type, $this->msgTypes) ) die('"' . strip_tags($type) . '" is not a valid message type!' );

        // If the session array doesn't exist, create it
        if( !array_key_exists( $type, $_SESSION[$this->sessionName] ) ) $_SESSION[$this->sessionName][$type] = array();

        if (empty($identifiant)) {
            $_SESSION[$this->sessionName][$type][] = $message;
        } else {
            $_SESSION[$this->sessionName][$type][$identifiant] = $message;
        }

        if( !is_null($redirect_to) ) {
            header("Location: $redirect_to");
            exit();
        }

        return true;

    }

    /**
     * Adds a messages to the queue
     *
     * @author Mike Everhart
     *
     * @param  string   $type           The type of messages to add
     * @param  array   $messages        messages
     * @param  string   $redirect_to    (optional) If set, the user will be redirected to this URL
     * @return  bool
     *
     */
    public function adds($type, $messages, $redirect_to=null) {

        if( empty($messages) or !is_array($messages) ) return false;

        foreach ($messages as $key => $message) {
            $this->add($type, $message, $key);
        }

        if( !is_null($redirect_to) ) {
            header("Location: $redirect_to");
            exit();
        }

        return true;

    }

    //-----------------------------------------------------------------------------------------------
    // display()
    // print queued messages to the screen
    //-----------------------------------------------------------------------------------------------
    /**
     * Display the queued messages
     *
     * @author Mike Everhart
     *
     * @param  string   $type     Which messages to display
     * @param  bool     $print    True  = print the messages on the screen
     * @return mixed
     *
     */
    public function display($type='all', $print=true, $clear=true) {
        $messages = '';
        $data = '';

        if( !isset($_SESSION[$this->sessionName]) ) return false;

        // Print a certain type of message?
        if( in_array($type, $this->msgTypes) or $type == 'all' ) {
            foreach( $_SESSION[$this->sessionName] as $thisType => $msgArray ) {
                if ($type == $thisType or $type == 'all') {
                    $messages = '';
                    foreach( $msgArray as $ancre => $msg ) {
                        $messages .= $this->msgBefore . $msg;
                        $messages .= !is_numeric($ancre) ? '&nbsp;<a class="messages_ancre" href="#'.htmlXspecialchars($ancre).'">#</a>' : '';
                        $messages .= $this->msgAfter;
                    }
                    $data .= sprintf($this->msgWrapper, $this->msgClass, $thisType, $this->msgTitres[$thisType], $messages);
                }
            }

            if ($clear) {
                // Clear the viewed messages
                $this->clear();
            }
        // Invalid Message Type?
        } else {
            return false;
        }

        // Print everything to the screen or return the data
        if( $print ) {
            echo $data;
        } else {
            return $data;
        }
    }


    /**
     * Check to  see if there are any queued error messages
     *
     * @author Mike Everhart
     *
     * @return bool  true  = There ARE error messages
     *               false = There are NOT any error messages
     *
     */
    public function hasErrors($identifiant=null) {
        if( !is_null($identifiant) ) {
            return empty($_SESSION[$this->sessionName]['error'][$identifiant]) ? false : true;
        } else {
            return empty($_SESSION[$this->sessionName]['error']) ? false : true;
        }

    }

    /**
     * Check to see if there are any ($type) messages queued
     *
     * @author Mike Everhart
     *
     * @param  string   $type     The type of messages to check for
     * @return bool
     *
     */
    public function hasMessages($type=null, $identifiant=null) {
        if( !is_null($type) ) {
            if( !is_null($identifiant) ) {
                if( !empty($_SESSION[$this->sessionName][$type]) ) return $_SESSION[$this->sessionName][$type];
            } else {
                if( !empty($_SESSION[$this->sessionName][$type][$identifiant]) ) return $_SESSION[$this->sessionName][$type][$identifiant];
            }
        } else {
            foreach( $this->msgTypes as $type ) {
                if( !empty($_SESSION[$this->sessionName]) ) return true;
            }
        }
        return false;
    }

    /**
     * Clear messages from the session data
     *
     * @author Mike Everhart
     *
     * @param  string   $type     The type of messages to clear
     * @return bool
     *
     */
    public function clear($type='all') {
        if( $type == 'all' ) {
            unset($_SESSION[$this->sessionName]);
        } else {
            unset($_SESSION[$this->sessionName][$type]);
        }
        return true;
    }

    public function __toString() { return $this->hasMessages(); }

    public function __destruct() {
        //$this->clear();
    }


} // end class
