<?php
/**
 * Login
 *
 * Copyright 2010 by Shaun McCormick <shaun@modx.com>
 *
 * Login is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * Login is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Login; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package login
 */
/**
 * MODx Login Class
 *
 * @package login
 */
class Login {
    /**
     * Creates an instance of the Login class.
     *
     * @param modX &$modx A reference to the modX instance.
     * @param array $config An array of configuration parameters.
     * @return Login
     */
    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;
        $corePath = $modx->getOption('login.core_path',$config,$modx->getOption('core_path',null,MODX_CORE_PATH).'components/login/');
        $this->config = array_merge(array(
            'corePath' => $corePath,
            'modelPath' => $corePath.'model/',
            'chunksPath' => $corePath.'chunks/',
            'processorsPath' => $corePath.'processors/',
        ),$config);
    }

    /**
     * Loads the Validator class.
     *
     * @access public
     * @param $config array An array of configuration parameters for the
     * lgnValidator class
     * @return lgnValidator An instance of the lgnValidator class.
     */
    public function loadValidator($config = array()) {
        if (!$this->modx->loadClass('login.lgnValidator',$this->config['modelPath'],true,true)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR,'[Login] Could not load Validator class.');
            return false;
        }
        $this->validator = new lgnValidator($this,$config);
        return $this->validator;
    }

    /**
     * Gets the current Request URI.
     *
     * @access public
     * @return string The request URI, with Login-specific code stripped.
     */
    public function getRequestURI() {
        return str_replace(array('?service=logout','&service=logout'),'',$_SERVER['REQUEST_URI']);
    }

    /**
     * Gets a user by a specific field in the table.
     *
     * @access public
     * @param string $field The column to grab by.
     * @param string $value The value to search by.
     * @param string $alias Optional; allows searching by a separate class
     * alias. Defaults to modUser.
     * @return modUser/null Returns a modUser object if successfull; null if
     * not.
     */
    public function getUserByField($field,$value,$alias = 'modUser') {
        $c = $this->modx->newQuery('modUser');
        $c->select('modUser.*, Profile.email AS email');
        $c->innerJoin('modUserProfile','Profile');
        $c->where(array(
            $alias.'.'.$field => $value,
        ));
        return $this->modx->getObject('modUser',$c);
    }

    /**
     * Sends an email based on the specified information and templates.
     *
     * @access public
     * @param string $email The email to send to.
     * @param string $name The name of the user to send to.
     * @param string $subject The subject of the email.
     * @param array $properties A collection of properties.
     * @return array
     */
    public function sendEmail($email,$name,$subject,$properties = array()) {
        if (empty($properties['tpl'])) $properties['tpl'] = 'lgnForgotPassEmail';
        if (empty($properties['tplType'])) $properties['tplType'] = 'modChunk';

        $msg = $this->getChunk($properties['tpl'],$properties,$properties['tplType']);

        $this->modx->getService('mail', 'mail.modPHPMailer');
        $this->modx->mail->set(modMail::MAIL_BODY, $msg);
        $this->modx->mail->set(modMail::MAIL_FROM, $this->modx->getOption('emailsender'));
        $this->modx->mail->set(modMail::MAIL_FROM_NAME, $this->modx->getOption('site_name'));
        $this->modx->mail->set(modMail::MAIL_SENDER, $this->modx->getOption('emailsender'));
        $this->modx->mail->set(modMail::MAIL_SUBJECT, $subject);
        $this->modx->mail->address('to', $email, $name);
        $this->modx->mail->address('reply-to', $this->modx->getOption('emailsender'));
        $this->modx->mail->setHTML(true);
        $sent = $this->modx->mail->send();
        $this->modx->mail->reset();

        return $sent;
    }

    /**
     * Generates a random password.
     *
     * @access public
     * @param integer $length The length of the generated password.
     * @return string The newly-generated password.
     */
    public function generatePassword($length=8) {
        $pword = '';
        $charmap = '0123456789bcdfghjkmnpqrstvwxyz';
        $i = 0;
        while ($i < $length) {
            $char = substr($charmap, rand(0, strlen($charmap)-1), 1);
            if (!strstr($pword, $char)) {
                $pword .= $char;
                $i++;
            }
        }
        return $pword;
    }

    /**
     * Helper function to get a chunk or tpl by different methods.
     *
     * @access public
     * @param string $name The name of the tpl/chunk.
     * @param array $properties The properties to use for the tpl/chunk.
     * @param string $type The type of tpl/chunk. Can be embedded,
     * modChunk, file, or inline. Defaults to modChunk.
     * @return string The processed tpl/chunk.
     */
    public function getChunk($name,$properties,$type = 'modChunk') {
        $output = '';
        switch ($type) {
            case 'embedded':
                if (!$this->modx->user->isAuthenticated($this->modx->context->get('key'))) {
                    $this->modx->setPlaceholders($properties);
                }
                break;
            case 'modChunk':
                $output .= $this->modx->getChunk($name, $properties);
                break;
            case 'file':
                $name = str_replace(array(
                    '{base_path}',
                    '{assets_path}',
                    '{core_path}',
                ),array(
                    $this->modx->getOption('base_path'),
                    $this->modx->getOption('assets_path'),
                    $this->modx->getOption('core_path'),
                ),$name);
                $output .= file_get_contents($name);
                $this->modx->setPlaceholders($properties);
                break;
            case 'inline':
            default:
                /* default is inline, meaning the tpl content was provided directly in the property */
                $output .= $name;
                $this->modx->setPlaceholders($properties);
                break;
        }
        return $output;
    }
    
    /**
     * Loads the Hooks class.
     *
     * @access public
     * @param $config array An array of configuration parameters for the
     * hooks class
     * @return fiHooks An instance of the fiHooks class.
     */
    public function loadHooks($type,$config = array()) {
        if (!$this->modx->loadClass('login.lgnHooks',$this->config['modelPath'],true,true)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR,'[Login] Could not load Hooks class.');
            return false;
        }
        $this->{$type} = new lgnHooks($this,$config);
        return $this->hooks;
    }

    /**
     * Overrides modx->executeProcessor to provide better support
     */
    public function executeProcessor(array $options = array()) {
        $processor = isset($options['processors_path']) && !empty($options['processors_path']) ? $options['processors_path'] : $this->modx->config['processors_path'];
        if (isset($options['location']) && !empty($options['location'])) $processor .= $options['location'] . '/';
        $processor .= str_replace('../', '', $options['action']) . '.php';
        if (file_exists($processor)) {
            if (!isset($this->modx->lexicon)) $this->modx->getService('lexicon', 'modLexicon');
            if (!isset($this->modx->error)) $this->modx->request->loadErrorHandler();

            /* create scriptProperties array from HTTP GPC vars */
            if (!isset($_POST)) $_POST = array();
            if (!isset($_GET)) $_GET = array();
            $scriptProperties = array_merge($_GET,$_POST,$options);
            if (isset($_FILES) && !empty($_FILES)) {
                $scriptProperties = array_merge($scriptProperties,$_FILES);
            }

            $modx =& $this->modx;
            $login =& $this;
            $result = include $processor;
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, "Processor {$processor} does not exist; " . print_r($options, true));
        }
        return $result;
    }


    /**
     * Encodes an array/string of params for URL transmission
     * 
     * @param array/string $params
     * @return string
     */
    public function encodeParams($params) {
        if (is_array($params)) {
            $params = serialize($params);
        } else {
            $params = serialize(array($params));
        }
        return strtr(base64_encode($params), '+/=', '-_,');
    }

    /**
     * Unencode a serialized, encoded param string
     * 
     * @param string $params
     * @return array
     */
    public function decodeParams($params) {
        return unserialize(base64_decode(strtr($params, '-_,', '+/=')));
    }
}